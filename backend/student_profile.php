<?php

include("../db_connect.php");

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}
// Assuming user_id is stored in the session
$user_id = $_SESSION['username'];

// Database connection details (replace with your actual credentials)
include("../db_connect.php");

// Fetch user data from clients table
$sql_clients = "SELECT * FROM academy WHERE email = '$user_id'";
$result_clients = $conn->query($sql_clients);

if ($result_clients->num_rows > 0) {
  $row_clients = $result_clients->fetch_assoc();
  $email = $row_clients['email'];
  $address = $row_clients['address'];
  $mobile = $row_clients['mobile'];
  $password = $row_clients['password'];
  $image_path = $row_clients['image_path'];
} else {
  echo "No data found in clients table";
  $email = "";
  $address = "";
  $mobile = "";
  $password = "";
  $image_path = "";
}


$conn->close();
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
                    <h4 class="card-title">Update Profile</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

                      <p>

                      <form action="process_student_profile.php" method="post" class="row g-3" enctype="multipart/form-data">

                        <div class="col-md-2">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                            </span>
                            <input type="password" id="password" name="password" value="<?php echo $password; ?>"
                              class="form-control" placeholder="Password" />
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-phone"></i>
                            </span>
                            <input type="text" id="mobile" name="mobile" value="<?php echo $mobile; ?>" required
                              class="form-control" placeholder="Mobile" />
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-envelope"></i>
                            </span>
                            <input type="text" id="email" name="email" value="<?php echo $email; ?>" required
                              class="form-control" placeholder="Email" />
                          </div>
                        </div>

                        <div class="col-md-8">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <input type="text" id="address" name="address" value="<?php echo $address; ?>" required
                              class="form-control" placeholder="Address" />
                          </div>
                        </div>


                        <div class="col-md-2">
                          <input type="submit" class="btn btn-primary" value="Submit">
                        </div>

                        <div class="col-md-2">
                          <img src="../<?php echo $image_path; ?>" alt="Profile Image" class="avatar-img rounded-circle" />
                          <input type="file" name="passport">
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
