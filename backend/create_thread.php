<?php
require_once '../db_connect.php';
session_start();

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST["title"];
  $content = $_POST["content"];
  $author = $_SESSION["username"];

  try {
    $title = mysqli_real_escape_string($conn, $title);
    $content = mysqli_real_escape_string($conn, $content);
    $author = mysqli_real_escape_string($conn, $author);

    $sql = "INSERT INTO threads (title, content, author, created_at) VALUES ('$title', '$content', '$author', NOW())";

    if ($conn->query($sql) === TRUE) {
      header("Location: community.php");
      exit();
    } else {
      echo "Error: " . $conn->error;
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

          <?php
          if (isset($_GET['message'])) {
            echo "<div class='alert alert-success'>" . $_GET['message'] . "</div>";
          }
          ?>



          <div class="row">
            <div class="col-md-12">
              <div class="card card-round">
                
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

                      <div class="table-responsive">
                        <div class="container">
                          <h2>Create New Thread</h2>
                          <form method="post" action="">
                            <div class="mb-3">
                              <label for="title" class="form-label">Title:</label>
                              <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                              <label for="content" class="form-label">Content:</label>
                              <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" onclick="tinyMCE.triggerSave();">Create</button>
                          </form>
                        </div>
                      </div>

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