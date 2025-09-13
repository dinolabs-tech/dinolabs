<?php

session_start();
include("../db_connect.php");

// Initialize an empty array to hold peers
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}


$course_id = $_SESSION['course'];
$timetable = [];
$no_classes = false;

if (isset($_SESSION['user_id'])) {
  $student_id = $_SESSION['user_id'];

  // Get class assignments
  $assignments_result = $conn->query("SELECT class_id FROM assignments WHERE student_id = $student_id");

  if ($assignments_result && $assignments_result->num_rows > 0) {
    while ($assignment = $assignments_result->fetch_assoc()) {
      $class_id = $assignment['class_id'];

      // Get class name
      $class_info_result = $conn->query("SELECT name FROM classes WHERE id = $class_id");
      $class_name = $class_info_result && $class_info_result->num_rows > 0
        ? $class_info_result->fetch_assoc()['name']
        : 'Unknown Class';

      // Get schedules for this class
      $schedule_result = $conn->query("SELECT * FROM schedules WHERE class_id = $class_id");
      if ($schedule_result && $schedule_result->num_rows > 0) {
        while ($schedule = $schedule_result->fetch_assoc()) {
          $timetable[] = [
            'class_name' => $class_name,
            'day' => $schedule['day'],
            'time' => $schedule['time']
          ];
        }
      }
    }
  } else {
    $no_classes = true;
  }
}


$peers = [];

if (isset($_SESSION['user_id'])) {
  $student_id = $_SESSION['user_id'];

  // Get all class_ids for this student
  $assignments_result = $conn->query("SELECT class_id FROM assignments WHERE student_id = $student_id");

  if ($assignments_result && $assignments_result->num_rows > 0) {
    $class_ids = [];

    while ($assignment = $assignments_result->fetch_assoc()) {
      $class_ids[] = $assignment['class_id'];
    }

    $class_ids_str = implode(',', $class_ids);

    // Fetch peers from the same classes
    $peers_result = $conn->query("
            SELECT DISTINCT s.* 
            FROM academy s 
            JOIN assignments a ON s.id = a.student_id 
            WHERE a.class_id IN ($class_ids_str) 
              AND s.id != $student_id
        ");

    if ($peers_result && $peers_result->num_rows > 0) {
      while ($peer = $peers_result->fetch_assoc()) {
        $peers[] = $peer;
      }
    }
  }
}


// Fetch data for display
$tasks = $conn->query("SELECT tasks.*, courses.course_name as course_name FROM tasks JOIN courses ON tasks.course_id = courses.id WHERE tasks.course_id = $course_id");
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
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>

              <h3 class="fw-bold mb-3">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h3>


              <h6 class="op-7 mb-2">Student's Dashboard</h6>
            </div>
            <!-- <div class="ms-md-auto py-2 py-md-0">
              <a href="register_client_user.php" class="btn btn-primary btn-round">Register Client User</a>
            </div> -->
          </div>



          <div class="row">
            <div class="col-md-6">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <div class="card-title">Your Class Schedule</div>
                  </div>
                </div>
                <div class="card-body p-4">
                  <div class="table-responsive">

                    <div id="timetable-output">
                      <?php if (!empty($timetable)): ?>
                        <div id="timetable">
                          <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                              <tr>
                                <th>Class</th>
                                <th>Day</th>
                                <th>Time</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($timetable as $row): ?>
                                <tr>
                                  <td><?= htmlspecialchars($row['class_name']) ?></td>
                                  <td><?= htmlspecialchars($row['day']) ?></td>
                                  <td><?= htmlspecialchars($row['time']) ?> (GMT +1)</td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      <?php elseif ($no_classes): ?>
                        <p>This student is not assigned to any class.</p>
                      <?php endif; ?>

                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <div class="card-title">Assessment</div>
                  </div>
                </div>
                <div class="card-body p-4"><br>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                      <thead class="table-dark">
                        <tr>
                          <th>Class</th>
                          <th>Description</th>
                          <th>Submission Date</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php if ($tasks->num_rows > 0): ?>
                          <?php while ($row = $tasks->fetch_assoc()): ?>
                            <tr>
                              <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                              <td><?php echo htmlspecialchars($row['description']); ?></td>
                              <td><?php echo htmlspecialchars($row['submission_date']); ?></td>
                            </tr>
                          <?php endwhile; ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="3" class="text-center text-muted">No Task Assigned yet.</td>
                          </tr>
                        <?php endif; ?>
                        <?php $conn->close(); ?>
                      </tbody>
                    </table>
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
                    <div class="card-title">Current Class Peers</div>
                  </div>
                </div>
                <div class="card-body p-4">
                  <div class="table-responsive">

                    <?php if (!empty($peers)): ?>
                      <div id="peer-output">
                        <table class="table table-striped table-bordered">
                          <thead class="table-dark">
                            <tr>
                              <th>Name</th>
                              <th>Gender</th>
                              <th>Mobile</th>
                              <th>Email</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($peers as $peer): ?>
                              <tr>
                                <td><?= htmlspecialchars($peer['name']) ?></td>
                                <td><?= htmlspecialchars($peer['gender']) ?></td>
                                <td><?= htmlspecialchars($peer['mobile']) ?></td>
                                <td><?= htmlspecialchars($peer['email']) ?></td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php elseif (isset($_SESSION['user_id'])): ?>
                      <div id="peer-output">
                        <p>No peers found in your class.</p>
                      </div>
                    <?php endif; ?>


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