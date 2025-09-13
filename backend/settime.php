<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

// Database connection
require_once '../db_connect.php';


// ADD QUESTION ==============================
// Fetch classes
$course_options = "";
$course_result = $conn->query("SELECT * FROM courses");
if ($course_result) {
  while ($row = $course_result->fetch_assoc()) {
    $course_options .= "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['course_name']) . "</option>";
  }
} else {
  die("Error fetching class: " . $conn->error);
}


// Process form submissions for insert, update and delete
if (isset($_POST['action'])) {
  if ($_POST['action'] == 'insert') {
    // Insert new record
    $course    = $_POST['course'];
    $testdate = $_POST['testdate'];
    $testtime = $_POST['testtime'];

    // Check if the course already exists
    $check_sql = "SELECT * FROM cbtadmin WHERE course = '$course'";
    $check_result = $conn->query($check_sql);
    if ($check_result && $check_result->num_rows > 0) {
      $msg = "Course time already set.";
    } else {
      $sql = "INSERT INTO cbtadmin (course, testdate, testtime)
                  VALUES ('$course', '$testdate', '$testtime')";
      if ($conn->query($sql) === TRUE) {
        $msg = "Record inserted successfully.";
      } else {
        $msg = "Error inserting record: " . $conn->error;
      }
    }
  } elseif ($_POST['action'] == 'update') {
    // Update existing record
    $id       = $_POST['id'];
    $course    = $_POST['course'];
    $testdate = $_POST['testdate'];
    $testtime = $_POST['testtime'];

    $sql = "UPDATE cbtadmin 
                SET course='$course', testdate='$testdate', testtime='$testtime'
                WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
      $msg = "Record updated successfully.";
    } else {
      $msg = "Error updating record: " . $conn->error;
    }
  } elseif ($_POST['action'] == 'delete') {
    // Delete record
    $id = $_POST['id'];
    $sql = "DELETE FROM cbtadmin WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
      $msg = "Record deleted successfully.";
    } else {
      $msg = "Error deleting record: " . $conn->error;
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
          <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Set Exam Time</h3>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">CBT</li>
                <li class="breadcrumb-item active">Set Exam Time</li>
              </ol>
            </div>

          </div>

          <!-- BULK UPLOAD ============================ -->
          <div class="row">

            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row">
                    <div class="card-title">Set Exam Time</div>
                  </div>
                </div>
                <div class="card-body pb-0">
                  <div class="mb-4 mt-2">

                    <?php if (isset($msg)) { ?>
                      <div class="alert alert-info"><?php echo $msg; ?></div>
                    <?php } ?>

                    <?php
                    // Check if we are editing a record – if so, display the update form
                    if (isset($_GET['edit'])) {
                      $edit_id = $_GET['edit'];
                      $sql = "SELECT cbtadmin.*, courses.course_name FROM cbtadmin JOIN courses ON cbtadmin.course = courses.id WHERE cbtadmin.id='$edit_id'";
                      $result = $conn->query($sql);
                      if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                    ?>
                        <h2>Edit Record</h2>
                        <form method="post" action="">
                          <!-- Hidden fields to indicate update -->
                          <div class="row g-3 mb-3">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                            <div class="col-md-4">
                              <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['course_name']); ?>" readonly>
                              <input type="hidden" name="course" value="<?php echo $row['course']; ?>">
                            </div>

                            <div class="col-md-2">
                              <input type="date" id="testdate" name="testdate" class="form-control" value="<?php echo $row['testdate']; ?>" required>

                            </div>
                            <div class="col-md-2">
                              <input type="number" name="testtime" class="form-control" value="<?php echo $row['testtime']; ?>" required>
                            </div>
                            <div class="col-md-4">
                              <button type="submit" class="btn btn-primary">Update</button>
                              <a href="settime.php" class="btn btn-secondary">Cancel</a>
                            </div>
                          </div>

                        </form>
                      <?php
                      } else {
                      }
                    } else {
                      // Otherwise, display the insertion form
                      ?>
                      <form method="post" action="" class="row g-3">
                        <!-- Hidden field to indicate insert -->
                        <input type="hidden" name="action" value="insert">
                        <div class="row g-3 mb-3">
                          <div class="col-md-4">
                            <select class="form-select" id="course" name="course" required>
                              <option value="" selected disabled>Select Course</option>
                              <?= $course_options ?>
                            </select>
                          </div>
                          <div class="col-md-2">
                            <input type="date" id="testdate" name="testdate" class="form-control">
                          </div>
                          <div class="col-md-2">
                            <input type="number" name="testtime" class="form-control" placeholder="Test Time (Mins)">
                          </div>
                          <div class="col-md-4">
                            <button type="submit" class="btn btn-success"><span class="btn-label">
                                <i class="fa fa-save"></i> Save</button>
                          </div>
                        </div>


                      </form>
                    <?php
                    }
                    ?>

                  </div>
                </div>
              </div>
            </div>


            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row">
                    <div class="card-title">Records</div>
                  </div>
                </div>
                <div class="card-body pb-0">
                  <div class="mb-4 mt-2">

                    <div class="table-responsive">
                      <table id="basuc-datatables" class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                          <tr>
                            <!-- <th>ID</th> -->
                            <th>Course</th>
                            <th>Test Date</th>
                            <th>Test Time</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          // Retrieve and display all records
                          // $sql = "SELECT * FROM cbtadmin";
                          $sql = "SELECT cbtadmin.*, courses.course_name FROM cbtadmin join courses on course where cbtadmin.course=courses.id";
                          $result = $conn->query($sql);
                          if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                              echo "<tr>";
                              // echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                              echo "<td>" . htmlspecialchars($row['course_name']) . "</td>";
                              echo "<td>" . htmlspecialchars($row['testdate']) . "</td>";
                              echo "<td>" . htmlspecialchars($row['testtime']) . "</td>";
                              echo "<td>";
                              echo "<a href='?edit=" . $row['id'] . "' class='btn btn-sm btn-warning me-2'>Edit</a>";
                              echo "<form style='display:inline;' method='post' action='' onsubmit=\"return confirm('Are you sure you want to delete this record?');\">";
                              echo "<input type='hidden' name='action' value='delete'>";
                              echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                              echo "<button type='submit' class='btn btn-sm btn-danger'>Delete</button>";
                              echo "</form>";
                              echo "</td>";
                              echo "</tr>";
                            }
                          } else {
                            echo "<tr><td colspan='8' class='text-center'>No records found.</td></tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>

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