<?php
session_start();
// Assuming user_id is stored in the session
$user_id = $_SESSION['user_id'];

// Database connection details (replace with your actual credentials)
include("../db_connect.php");

// Fetch user data from clients table
$sql_clients = "SELECT email, address, mobile FROM clients WHERE user_id = $user_id";
$result_clients = $conn->query($sql_clients);

if ($result_clients->num_rows > 0) {
 $row_clients = $result_clients->fetch_assoc();
 $email = $row_clients['email'];
 $address = $row_clients['address'];
 $mobile = $row_clients['mobile'];
} else {
 echo "No data found in clients table";
 $email = "";
 $address = "";
 $mobile = "";
}

// Fetch user data from users table (for password - not displayed)
// $sql_users = "SELECT password FROM users WHERE user_id = $user_id";
// $result_users = $conn->query($sql_users);

// if ($result_users->num_rows > 0) {
//  $row_users = $result_users->fetch_assoc();
//  $password = $row_users['password']; // Don't display the password
// } else {
//  echo "No data found in users table";
//  $password = "";
// }

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

                      <form action="process_edit_profile.php" method="post" class="row g-3">
                  
                        <div class="col-md-2">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-asterisk"></i>
                            </span>
                            <input type="password" id="password" name="password"
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