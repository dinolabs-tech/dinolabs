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

        if (!$thread || $_SESSION["username"] != $thread["author"]) {
            header("Location: index.php");
            exit();
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    try {
        $title = mysqli_real_escape_string($conn, $title);
        $content = mysqli_real_escape_string($conn, $content);

        $sql = "UPDATE threads SET title = '$title', content = '$content' WHERE id = '$thread_id'";

        if ($conn->query($sql) === TRUE) {
            header("Location: view_thread.php?id=" . $thread_id);
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-round">
                                <div class="card-header">
                                    <div class="card-head-row card-tools-still-right">
                                        <h4 class="card-title">Edit Thread</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>
                                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $thread_id; ?>">
                                                <div class="form-group">
                                                    <label>Title:</label>
                                                    <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($thread["title"]); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Content:</label>
                                                    <textarea name="content" rows="5" class="form-control" required><?php echo htmlspecialchars($thread["content"]); ?></textarea>
                                                </div>
                                                <input type="submit" value="Update" class="btn btn-primary">
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

        <?php include('components/scripts.php'); ?>
    </div>

</body>

</html>