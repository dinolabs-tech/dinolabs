<?php
require_once '../db_connect.php';
session_start();

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit();
}

// ADD QUESTION ==============================
if (isset($_POST['delete'])) {
  // SQL to delete all records from mst_result
  $sql = "DELETE FROM mst_result";

  // SQL to delete all records from mst_useranswer
  $sql0 = "DELETE FROM mst_useranswer";

  // SQL to delete all records from timer
  $sql1 = "DELETE FROM timer";

  // Execute the queries and check if all are successful
  if (
    $conn->query($sql) === TRUE &&
    $conn->query($sql0) === TRUE &&
    $conn->query($sql1) === TRUE
  ) {
    echo '<script type="text/javascript">
      alert("Exam Initiated successfully!\nStudents can take their exams");
      </script>';
  } else {
    echo "Error Initiating Exams: " . $conn->error;
  }
}

// Process deletion if a delete button was clicked
if (isset($_POST['delete_subject'])) {
  // Retrieve the class, arm, and subject values directly from POST
  $class   = $_POST['class'];

  // Prepare the DELETE statement including the subject in the WHERE clause
  $stmt = $conn->prepare("DELETE FROM question WHERE course = ?");
  if ($stmt === false) {
    echo "<p style='color: red;'>Error preparing statement: " . htmlspecialchars($conn->error) . "</p>";
  } else {
    // Bind the parameters as strings ("sss")
    $stmt->bind_param("s", $class);
    if ($stmt->execute()) {
      // echo "<p style='color: green;'>Questions deleted for Course: " . htmlspecialchars($class) . ".</p>";
       $insert_message = "Question Deleted successfully!";
    } else {
      echo "<p style='color: red;'>Error deleting Course: " . htmlspecialchars($stmt->error) . "</p>";
    }
    $stmt->close();
  }
}




// Fetch courses
$class_options = "";
$class_result = $conn->query("SELECT * FROM courses");
if ($class_result) {
  while ($row = $class_result->fetch_assoc()) {
    $class_options .= "<option value='" . htmlspecialchars($row['course_name']) . "'>" . htmlspecialchars($row['course_name']) . "</option>";
  }
} else {
  die("Error fetching class: " . $conn->error);
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

          <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Upload Question</h3>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">CBT</li>
                <li class="breadcrumb-item active">Upload Question</li>
              </ol>
            </div>

          </div>

          <!-- BULK UPLOAD ============================ -->
          <div class="row">

            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row">
                    <div class="card-title">Upload Questions</div>
                  </div>
                </div>
                <div class="card-body pb-0">
                  <form method="post" action="">
                    <div style="float: right;"><button type="submit" name="delete" class="btn btn-secondary"><span class="btn-label">
                          <i class="fa fa-play-circle"></i>Initiate Exam</button></div>
                  </form>
                  <div class="mb-4 mt-2">

                    <h5 class="mb-5">Bulk Upload Questions via CSV</h5>
                    <form id="csvUploadForm" action="upload_csv.php" method="post" enctype="multipart/form-data" class="row g-3">

                      <!-- CSV File Upload -->
                      <div class="row">
                        <div class="col-md-8">
                          <label for="csvFile" class="form-label">Select CSV File</label>
                          <input type="file" class="form-control" id="csvFile" name="csvFile" accept=".csv">
                          <div class="form-text">
                            CSV file should include: <strong>ID, Question, Option 1, Option 2, Option 3, Option 4, Correct Answer</strong>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <label for="class" class="form-label">Course</label>
                          <select class="form-control form-select" id="class" name="class" required>
                            <option value="" selected disabled>Select Course</option>
                            <?= $class_options ?>
                          </select>
                        </div>
                      </div>

                      <!-- Submit Button -->
                      <div class="row mt-3">
                        <div class="col-md-8">
                          <button type="submit" class="btn btn-success"><span class="btn-label">
                              <i class="fa fa-cloud-upload-alt"></i>Upload CSV</button>
                        </div>

                        <!-- Download Template Link -->
                        <div class="col-md-4">
                          <a href="download_template.php" class="btn btn-warning"><span class="btn-label">
                              <i class="fa fa-cloud-download-alt"></i>Download CSV Template</a>
                        </div>
                      </div>


                    </form>

                    <div id="errorMsg" class="alert alert-danger d-none"></div>

                  </div>
                </div>
              </div>
            </div>


          </div>

          <div class="row">

            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row">
                    <div class="card-title">Uploaded Questions</div>
                  </div>
                </div>
                <div class="card-body pb-0">
                  <div class="mb-4 mt-2">

                    <?php
                    if (!empty($insert_message)) {
                      echo '<div class="alert alert-info">' . htmlspecialchars($insert_message) . '</div>';
                    }
                    ?>

                    <p>
                      <?php
                      // Query to get distinct class, arm, and subject values
                      $query = "SELECT question.*, courses.course_name from question join courses on question.course=courses.id";

                      $result = mysqli_query($conn, $query);

                      $current_class = '';
                      while ($row = mysqli_fetch_assoc($result)) {
                        // Start a new section when class changes
                        if ($current_class != $row['course']) {
                          if ($current_class != '') {
                            echo '</div>';
                          }
                          // $current_class = $row['course_name'];
                          echo '<div class="mb-3">';
                          echo '<h6 class="border-bottom pb-1">' . htmlspecialchars($current_class) . '</h6>';
                        }

                        // Display the arm and subject with a delete button on the far right.
                        // The form sends the class and arm values (used for deletion) when the button is clicked.
                        echo '<p class="ml-3" style="display: flex; justify-content: space-between; align-items: center;">';
                        echo '<span>' . htmlspecialchars($row['course_name']) . '</span>';
                        echo '<form method="post" action="" style="margin: 0;">';
                        echo '<input type="hidden" name="class" value="' . htmlspecialchars($row['course']) . '">';  // Include subject here
                        echo '<button type="submit" name="delete_subject" class="btn btn-danger"><span class="btn-label">
                      <i class="fa fa-trash"></i></button>';
                        echo '</form>';

                        echo '</p>';
                      }

                      // Close the last class section div if needed
                      if ($current_class != '') {
                        echo '</div>';
                      }

                      // Close the database connection
                      $conn->close();
                      ?>
                    </p>

                  </div>
                </div>
              </div>
            </div>


          </div>

        </div>
      </div>

      </script>
      <?php include('components/footer.php'); ?>
    </div>

  </div>
  <?php include('components/scripts.php'); ?>



</body>

</html>