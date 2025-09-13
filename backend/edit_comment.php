<?php
// edit_comment.php
// ————————

require_once '../db_connect.php';
session_start();

// 1) Must be logged in
if (!isset($_SESSION['user_id'], $_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// 2) Validate & fetch the post
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $post_id = (int)$_GET['id'];

    $stmt = $conn->prepare("SELECT thread_id, author, content FROM community_posts WHERE id = ? LIMIT 1");
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post   = $result->fetch_assoc();
    $stmt->close();

    // Not found or not the author? kick back.
    if (
        !$post ||
        $post['author'] !== $_SESSION['username']
    ) {
        header('Location: index.php');
        exit;
    }

    // Keep this for redirect after update:
    $thread_id = (int)$post['thread_id'];
} else {
    header('Location: index.php');
    exit;
}

$error = '';

// 3) Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Make sure TinyMCE has synced its textarea
    // (you can also do this in JS instead of onclick on the button)
    echo '<script>tinyMCE.triggerSave();</script>';

    // Validate
    if (empty($_POST['content'])) {
        $error = 'Content cannot be empty.';
    } else {
        $content = $_POST['content'];

        $stmt = $conn->prepare("UPDATE community_posts SET content = ? WHERE id = ?");
        $stmt->bind_param('si', $content, $post_id);

        if ($stmt->execute()) {
            $stmt->close();
            // Success! Back to thread view.
            header("Location: view_thread.php?id={$thread_id}");
            exit;
        } else {
            $error = 'Update failed: ' . htmlspecialchars($stmt->error);
            $stmt->close();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<?php include('components/head.php'); ?>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include('components/sidebar.php'); ?>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <?php include('components/logo_header.php'); ?>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <?php include('components/navbar.php'); ?>
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">

                    <?php
                    if (isset($_GET['message'])) {
                        echo "<div class='alert alert-success'>" . $_GET['message'] . "</div>";
                    }
                    ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-round">
                                <div class="card-header">
                                    <div class="card-head-row card-tools-still-right">
                                        <h4 class="card-title">Edit Comment</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>
                                            <form method="post" action="">
                                                <div class="mb-3">
                                                    <label for="content" class="form-label">Content:</label>
                                                    <textarea
                                                        id="content"
                                                        name="content"
                                                        class="form-control"
                                                        required><?php echo htmlspecialchars($post['content']); ?></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>



            <?php include('components/footer.php'); ?>
        </div>

    </div>
    <?php include('components/scripts.php'); ?>
</body>

</html>