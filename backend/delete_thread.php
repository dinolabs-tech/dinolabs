<?php
require_once '../db_connect.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"])) {
    $thread_id = $_GET["id"];

    $thread_id = mysqli_real_escape_string($conn, $thread_id);
    $sql = "SELECT * FROM threads WHERE id = '$thread_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $thread = $result->fetch_assoc();
        if (!$thread || $_SESSION["username"] != $thread["author"]) {
            header("Location: index.php");
            exit();
        }
    } else {
        header("Location: index.php");
        exit();
    }

 // Delete comments associated with the post
    $sql_comments = "DELETE FROM comments WHERE post_id = $thread_id";
    $conn->query($sql_comments);

    $sql = "DELETE FROM threads WHERE id = '$thread_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: community.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
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
        <h2>Delete Thread</h2>
        <p>Are you sure you want to delete this thread?</p>
        <a href="delete_thread.php?id=<?php echo $_GET['id']; ?>" class="btn btn-danger">Yes, Delete</a>
        <a href="community.php" class="btn btn-secondary">No, Cancel</a>
    </div>
      <?php include('components/footer.php'); ?>
    </div>

    <?php include('components/script.php'); ?>
  </div>
</body>
</html>