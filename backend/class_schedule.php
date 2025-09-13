<?php include('logic/class_schedule_logic.php');?>

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
                    <h4 class="card-title">Add Schedule to Class</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

                      <p>

                      <form action="process_schedule.php" method="post" class="row g-3">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

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

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fa fa-building"></i>
                            </span>
                            <input type="text" class="form-control" name="day" placeholder="Day (e.g Monday, Tuesday)" required>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fa fa-user"></i>
                            </span>
                            <input type="text" class="form-control" name="time" placeholder="Time (e.g 13:00, 18:00)" required>
                          </div>
                        </div>


                        <div class="col-md-2">
                          <button type="submit" name="add_schedule" class="btn btn-primary">Add Schedule</button>
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
                    <h4 class="card-title">Schedules</h4>
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
                              <th>Day</th>
                              <th>Time</th>
                              <th>Action</th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php if ($schedules->num_rows > 0): ?>
                              <?php while ($row = $schedules->fetch_assoc()): ?>
                                <tr>
                                  <form method="POST" action="process_schedule.php">
                                    <td><?php echo htmlspecialchars($row['class_name']); ?></td>
                                    <td><input type="text" class="form-control" name="day" value="<?php echo htmlspecialchars($row['day']); ?>"></td>
                                    <td><input type="text" class="form-control" name="time" value="<?php echo htmlspecialchars($row['time']); ?>"></td>
                                    <td>
                                      <input type="hidden" name="schedule_id" value="<?php echo $row['id']; ?>">
                                      <button type="submit" class="btn btn-primary" name="update_schedule">Update</button>
                                      <button type="submit" class="btn btn-danger" name="delete_schedule" onclick="return confirm('Are you sure you want to delete this schedule?');">Delete</button>
                                    </td>
                                  </form>
                                </tr>
                              <?php endwhile; ?>
                            <?php else: ?>
                              <tr>
                                <td colspan="4" class="text-center text-muted">No Schedule registered yet.</td>
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