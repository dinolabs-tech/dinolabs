<?php
include('logic/add_user_logic.php');

$username = $email = $password = $category = "";
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $category = $_POST["category"];

    if (empty($username)) {
        $errors["username"] = "Username is required";
    }
    if (empty($email)) {
        $errors["email"] = "Email is required";
    }
    if (empty($password)) {
        $errors["password"] = "Password is required";
    }
    if (empty($category) || $category == "Role") {
        $errors["category"] = "Role is required";
    }
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
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Clients</h3>
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

                        <div class="col-md-2">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-at"></i>
                            </span>
                            <input type="text" id="username" name="username" class="form-control"
                              placeholder="Username" />
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-envelope"></i>
                            </span>
                            <input type="text" id="email" name="email" class="form-control"
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
                          <select id="category" name="category" class="form-select form-control">
                            <option>Role</option>
                            <?php
                            if ($result_roles->num_rows > 0) {
                              while ($row = $result_roles->fetch_assoc()) {
                                echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                              }
                            } else {
                              echo "<option value=''>No roles found.</option>";
                            }
                            ?>
                          </select>
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
