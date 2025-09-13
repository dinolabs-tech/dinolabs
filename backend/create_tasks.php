<?php
if (!isset($_SESSION)) {
  session_start();
}

include("../db_connect.php");

// Only allow admins
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
  header("Location: login.php");
  exit();
}

// Handle delete task BEFORE form redirect
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_task'])) {
  if (isset($_POST['task_id']) && is_numeric($_POST['task_id'])) {
    $task_id = intval($_POST['task_id']);
    $delete_stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $delete_stmt->bind_param("i", $task_id);
    $delete_stmt->execute();
    $delete_stmt->close();
    header("Location: create_tasks.php?message=Task deleted successfully");
    exit();
  }
}

// Handle create task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_task'])) {
  $stmt = $conn->prepare("INSERT INTO tasks (course_id, description, submission_date) VALUES (?, ?, ?)");
  $stmt->bind_param("iss", $_POST['course_id'], $_POST['description'], $_POST['submission_date']);
  $stmt->execute();
  $stmt->close();
  header("Location: create_tasks.php?message=Task Created successfully");
  exit();
}

// Fetch all tasks for display
$tasks = $conn->query("SELECT tasks.*, courses.course_name as course_name FROM tasks JOIN courses ON tasks.course_id = courses.id");
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
                    <h4 class="card-title">Create Task</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

                      <p>

                      <form method="post" class="row g-3">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fa fa-building"></i>
                            </span>
                            <select name="course_id" class="form-control form-select" required>
                              <option value="" selected disabled>Select Course</option>
                              <?php
                              $students_result = $conn->query("SELECT * from courses");
                              while ($row = $students_result->fetch_assoc()) {
                                echo "<option value='{$row['id']}'>{$row['course_name']}</option>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="input-icon">
                            <textarea class="form-control" id="comment" rows="5" name="description" placeholder="Task Description" required></textarea>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="input-icon">
                            <input class="form-control" type="datetime-local" name="submission_date" required>
                          </div>
                        </div>

                        <div class="col-md-2">
                          <button type="submit" name="create_task" class="btn btn-primary">Create Task</button>
                        </div>
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
                    <h4 class="card-title">Manage Assignments</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">


                      <div class="table-responsive">
                        <table id="basic-datatables" class="table table-striped table-bordered">
                          <thead class="table-dark">
                            <tr>
                              <th>Class</th>
                              <th>Description</th>
                              <th>Submission Date</th>
                              <th>Action</th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php if ($tasks->num_rows > 0): ?>
                              <?php while ($row = $tasks->fetch_assoc()): ?>
                                <tr>
                                  <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                                  <td><?php echo htmlspecialchars($row['description']); ?></td>
                                  <td><?php echo htmlspecialchars($row['submission_date']); ?></td>
                                  <td>
                                    <form method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                      <input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">
                                      <button type="submit" name="delete_task" class="btn btn-danger btn-sm">Delete</button>
                                    </form>

                                  </td>
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