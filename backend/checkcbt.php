<?php

session_start();

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit();
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
          <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Check Result</h3>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">CBT</li>
                <li class="breadcrumb-item active">Check Result</li>
              </ol>
            </div>

          </div>

          <!-- BULK UPLOAD ============================ -->
          <div class="row">

            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row">
                    <div class="card-title">Check Result</div>
                  </div>
                </div>
                <div class="card-body pb-0">
                  <div class="mb-4 mt-2">

                    <form method="post" action="checker.php">
                      <div class="mb-3">
                        <input type="text" class="form-control" id="check" name="check" placeholder="Enter Student ID" required>
                      </div>
                      <button type="submit" name="checksubmit" class="btn btn-success"><span class="btn-label">
                          <i class="fa fa-eye"></i>View Result</button>
                    </form>

                  </div>
                </div>
              </div>
            </div>


            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row">
                    <div class="card-title">Check Result | Full Download</div>
                  </div>
                </div>
                <div class="card-body pb-0">
                  <div class="mb-4 mt-2">

                    <form method="post" action="downloadcbt.php">
                      <button type="submit" name="checksubmit" class="btn btn-secondary"><span class="btn-label">
                          <i class="fa fa-cloud-download-alt"></i>Download Entire Result</button>
                    </form>

                  </div>
                </div>
              </div>
            </div>

          </div>



        </div>
      </div>

      </script>
      <?php include('components/footer.php'); ?>
    </div>

  </div>
  <?php include('components/scripts.php'); ?>


</body>

</html>