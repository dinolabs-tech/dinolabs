<?php include('logic/assignstudents_logic.php'); ?>

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
                    <h4 class="card-title">Assign Students to Class</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

                      <p>

                      <form action="process_assignstudents.php" method="post" class="row g-3">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fa fa-building"></i>
                            </span>
                            <select name="student_id" class="form-control form-select" required>
                              <option value="" selected disabled>Select Student</option>
                              <?php
                              $students_result = $conn->query("SELECT academy.*, courses.course_name from academy join courses on academy.course_id=courses.id");
                              while ($row = $students_result->fetch_assoc()) {
                                echo "<option value='{$row['id']}'>{$row['name']} - {$row['course_name']}</option>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fa fa-building"></i>
                            </span>
                            <select name="class_id" class="form-control form-select" required>
                              <option value="" selected disabled>Select Class</option>
                              <?php
                              $classes_result = $conn->query("SELECT * FROM classes");
                              while ($row = $classes_result->fetch_assoc()) {
                                echo "<option value='{$row['id']}'>{$row['name']}</option>";
                              }
                              ?>
                            </select>
                          </div>
                        </div>



                        <div class="col-md-2">
                          <button type="submit" name="assign_student" class="btn btn-primary">Assign</button>
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
                              <th>Student</th>
                              <th>Class</th>
                              <th>Action</th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php if ($assignments->num_rows > 0): ?>
                              <?php while ($row = $assignments->fetch_assoc()): ?>
                                <tr>
                                  <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                                  <td><?php echo htmlspecialchars($row['class_name']); ?></td>
                                  <td>
                                    <form method="POST" style="display:inline;" action="process_assignstudents.php">
                                      <input type="hidden" name="assignment_id" value="<?php echo $row['id']; ?>">
                                      <button class="btn btn-danger" type="submit" name="unassign_student" onclick="return confirm('Are you sure you want to unassign this student?');">Unassign</button>
                                    </form>
                                    <form method="POST" style="display:inline;" action="process_assignstudents.php">
                                      <input type="hidden" name="assignment_id" value="<?php echo $row['id']; ?>">

                                      
                                      <select class="form-control form-select" name="new_class_id" required>
                                        <option value="">Select New Class</option>
                                        <?php
                                        $classes_result_reassign = $conn->query("SELECT * FROM classes");
                                        while ($class_row = $classes_result_reassign->fetch_assoc()) {
                                          echo "<option value='{$class_row['id']}'>{$class_row['name']}</option>";
                                        }
                                        ?>
                                      </select>
                                      <button class="btn btn-warning" type="submit" name="reassign_student">Reassign</button>
                                    </form>
                                  </td>
                                </tr>
                              <?php endwhile; ?>
                            <?php else: ?>
                              <tr>
                                <td colspan="3" class="text-center text-muted">No Students Assigned yet.</td>
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