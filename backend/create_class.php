<?php include('logic/create_class_logic.php'); ?>

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
                    <h4 class="card-title">Create Classes</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

                      <p>

                      <form action="process_class.php" method="post" class="row g-3">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fa fa-building"></i>
                            </span>
                            <input type="text" id="class_name" name="class_name"
                              value="<?php echo $class_name; ?>" required class="form-control"
                              placeholder="Class Name" />
                          </div>
                        </div>

                        <div class="col-md-2">
                          <button type="submit" name="<?php echo isset($_GET['id']) ? 'update' : 'register'; ?>"
                            class="btn btn-primary"><?php echo isset($_GET['id']) ? 'Update' : 'Create'; ?></button>
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
                    <h4 class="card-title">Course List</h4>
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
                              <th>Class</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if ($result->num_rows > 0): ?>
                              <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                  <td><?= htmlspecialchars($row["id"]) ?></td>
                                  <td><?= htmlspecialchars($row['name']) ?></td>
                                  <td>
                                    <a href="create_class.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="delete_class.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                      onclick="return confirm('Are you sure?')">Delete</a>
                                  </td>
                                </tr>
                              <?php endwhile; ?>
                            <?php else: ?>
                              <tr>
                                <td colspan="3" class="text-center text-muted">No Class registered yet.</td>
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