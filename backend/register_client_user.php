<?php include('logic/register_client_user_logic.php'); ?>

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
              <h3 class="fw-bold mb-3">Client User Registration</h3>
            </div>
          </div>


          <div class="row">
            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">Add New User</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

                      <p>

                      <form method="post" class="row g-3">

                        <div class="col-md-6">
                          <select class="form-control form-select" name="client_id" id="client_id">
                            <?php
                            if ($result_clients->num_rows > 0) {
                              while ($row = $result_clients->fetch_assoc()) {
                                echo "<option value='" . $row["id"] . "'>" . $row["business_name"] . "</option>";
                              }
                            } else {
                              echo "<option value=''>No clients found.</option>";
                            }
                            ?>
                          </select>
                        </div>

                        <div class="col-md-2">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-at"></i>
                            </span>
                            <input type="text" id="username" name="username" required class="form-control"
                              placeholder="Username" />
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-envelope"></i>
                            </span>
                            <input type="text" id="email" name="email" required class="form-control"
                              placeholder="Email" />
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-asterisk"></i>
                            </span>
                            <input type="text" id="password" name="password" class="form-control"
                              placeholder="Password" />
                          </div>
                        </div>


                        <div class="col-md-2">
                          <button type="submit" class="btn btn-primary"> Register</button>
                        </div>
                      </form>

                      </p>

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