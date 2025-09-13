<?php include('logic/students_logic.php'); ?>

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
                    <h4 class="card-title">Student List</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">


                      <div class="table-responsive">
                        <table id="basic-datatables" class="table table-striped table-bordered">
                          <thead class="table-dark">
                            <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Gender</th>
                              <th>Email</th>
                              <th>Mobile</th>
                              <th>State</th>
                              <th>City</th>
                              <th>Address</th>
                              <th>Course</th>
                              <th>Duration</th>
                              <th>Year Enrolled</th>
                              <th>Qualification</th>
                              <th>Computer Litearcy</th>
                              <th>Date Registered</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if ($result->num_rows > 0): ?>
                              <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                  <td><?= htmlspecialchars($row["id"]) ?></td>
                                  <td><?= htmlspecialchars($row['name']) ?></td>
                                  <td><?= htmlspecialchars($row['gender']) ?></td>
                                  <td><?= htmlspecialchars($row['email']) ?></td>
                                  <td><?= htmlspecialchars($row['mobile']) ?></td>
                                  <td><?= htmlspecialchars($row['state']) ?></td>
                                  <td><?= htmlspecialchars($row['city']) ?></td>
                                  <td><?= htmlspecialchars($row['address']) ?></td>
                                  <td><?= htmlspecialchars($row['course_name']) ?></td>
                                  <td><?= htmlspecialchars($row['duration']) ?></td>
                                  <td><?= htmlspecialchars($row['year_enrolled']) ?></td>
                                  <td><?= htmlspecialchars($row['qualification']) ?></td>
                                  <td><?= htmlspecialchars($row['computer_literacy']) ?></td>
                                  <td><?= htmlspecialchars($row['created_at']) ?></td>
                                  <td>
                                    <a href="delete_students.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                      onclick="return confirm('Are you sure?')">Delete</a>
                                  </td>
                                </tr>
                              <?php endwhile; ?>
                            <?php else: ?>
                              <tr>
                                <td colspan="15" class="text-center text-muted">No Courses registered yet.</td>
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