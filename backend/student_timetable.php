<?php 
include("../db_connect.php");

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
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
                    <h4 class="card-title">View Timetable</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

                      <p>

                      <form method="GET">
                        <select class="form-control form-select" name="student_id" onchange="this.form.submit()">
                          <option value="" selected disabled>Select Student</option>
                          <?php
                          $students_result = $conn->query("SELECT academy.*, courses.course_name from academy join courses on academy.course_id=courses.id");
                          while ($row = $students_result->fetch_assoc()) {
                            $selected = (isset($_GET['student_id']) && $_GET['student_id'] == $row['id']) ? 'selected' : '';
                            echo "<option value='{$row['id']}' {$selected}>{$row['name']} - {$row['course_name']}</option>";
                          }
                          ?>
                        </select>
                      </form>

                      </p>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">Student Timetable</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">


                      <div id="timetable-output">
                        <?php
                        if (isset($_GET['student_id'])) {
                          $student_id = $_GET['student_id'];
                          $assignments_result = $conn->query("SELECT class_id FROM assignments WHERE student_id = $student_id");
                          if ($assignments_result->num_rows > 0) {
                            // echo '<h3>Your T-imetable</h3>';
                            while ($assignment = $assignments_result->fetch_assoc()) {
                              $class_id = $assignment['class_id'];
                              $class_info = $conn->query("SELECT name FROM classes WHERE id = $class_id")->fetch_assoc();
                              echo "<h4>{$class_info['name']}</h4>";

                              $schedules_result = $conn->query("SELECT * FROM schedules WHERE class_id = $class_id");
                              if ($schedules_result->num_rows > 0) {
                                echo '<ul>';
                                while ($schedule = $schedules_result->fetch_assoc()) {
                                  echo "<li>{$schedule['day']}: {$schedule['time']}</li>";
                                }
                                echo '</ul>';
                              } else {
                                echo '<p>No schedule found for this class.</p>';
                              }
                            }
                          } else {
                            echo '<p>This student is not assigned to any classes.</p>';
                          }
                        }
                        ?>
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