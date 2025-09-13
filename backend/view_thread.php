<?php
require_once '../db_connect.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"])) {
    $thread_id = $_GET["id"];

    try {
        $thread_id = mysqli_real_escape_string($conn, $thread_id);

        $sql = "SELECT * FROM threads WHERE id = '$thread_id'";
        $result = $conn->query($sql);
        $thread = $result->fetch_assoc();

        $sql = "SELECT * FROM community_posts WHERE thread_id = '$thread_id' ORDER BY created_at ASC";
        $result = $conn->query($sql);

        $posts = array();
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: index.php");
    exit();
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
                                        <h4 class="card-title"><?php echo htmlspecialchars($thread["title"]); ?></h4>
                                        <?php if ($_SESSION["username"] == $thread["author"]): ?>
                                            <div class="card-tools">
                                                <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a href="edit_thread.php?id=<?php echo $thread["id"]; ?>" class="dropdown-item">Edit</a>
                                                    <a href="delete_thread.php?id=<?php echo $thread["id"]; ?>" class="dropdown-item">Delete</a>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <p>Created by <?php echo htmlspecialchars($thread["author"]); ?> on <?php echo $thread["created_at"]; ?></p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><?php echo nl2br($thread["content"]); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="card-footer ms-5">
                                    <h3>Comments</h3>
                                    <?php if ($posts): ?>
                                        <ul class="list-group">
                                            <?php foreach ($posts as $post): ?>
                                                <li class="list-group-item">
                                                    <?php echo nl2br($post["content"]); ?>
                                                    - Posted by <?php echo htmlspecialchars($post["author"]); ?> on <?php echo $post["created_at"]; ?>
                                                    <?php if ($_SESSION["username"] == $post["author"] || $_SESSION['user_id'] == 1): ?>
                                                        <div class="card-title ms-5">
                                                            <div class="card-tools">
                                                                <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-h"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <a href="edit_comment.php?id=<?php echo $post["id"]; ?>" class="dropdown-item">Edit</a>
                                                                    <a href="delete_comment.php?id=<?php echo $post["id"]; ?>" class="dropdown-item">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <p>No comments yet.</p>
                                    <?php endif; ?>
                                    <form method="post" action="add_comment.php">
                                        <input type="hidden" name="thread_id" value="<?php echo $thread_id; ?>">
                                        <div class="form-group">
                                            <label for="content">Add a comment:</label>
                                            <textarea name="content" id="content" rows="3" class="form-control" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-3" onclick="tinyMCE.triggerSave();">Comment</button>
                                    </form>
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