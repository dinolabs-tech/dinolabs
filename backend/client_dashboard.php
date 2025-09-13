<?php
include('logic/client_dashboard_logic.php');
?>


<!DOCTYPE html>
<html lang="en">

<?php include('components/head.php');?>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <?php include('components/sidebar.php');?>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <?php include('components/logo_header.php');?>
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <?php include('components/navbar.php');?>
        <!-- End Navbar -->
      </div>

      <div class="container">
        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Welcome to your Dashboard, <?php echo $_SESSION['business_name']; ?>!</h3>
              <h6 class="op-7 mb-2">Here you can purchase License code, view payment history, and access other relevant
                information.</h6>
            </div>

            <?php if ($outstanding_balance == 0): ?>
            <div class="ms-md-auto py-2 py-md-0">
              <a class="btn btn-primary btn-round">Fully Paid</a>
            </div>
<?php else: ?>
<div class="ms-md-auto py-2 py-md-0">
              <a class="btn btn-primary btn-round">Not fully Paid</a>
            </div>
  <?php endif; ?>
          </div>

          <?php if ($result->num_rows > 0): ?>
            <div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">License Expiry Date</p>
                          <h4 class="card-title"><?php echo date('d/m/Y', strtotime($license_expiry_date)); ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                          <i class="fas fa-user-check"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Total Amount</p>
                          <h4 class="card-title"><?php echo number_format($total_amount, 2); ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                          <i class="fas fa-luggage-cart"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Amount Paid</p>
                          <h4 class="card-title"><?php echo number_format($amount_paid, 2); ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div class="icon-big text-center icon-secondary bubble-shadow-small">
                          <i class="far fa-check-circle"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Outstanding Balance</p>
                          <h4 class="card-title"><?php echo number_format($outstanding_balance, 2); ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Total Students</p>
                          <h4 class="card-title"><?php echo $total_students; ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                          <i class="fas fa-luggage-cart"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Amount per Student</p>
                          <h4 class="card-title"> <?php echo $amount_per_student; ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          <?php endif; ?>


            <div class="col-md-8 ps-md-0 pe-md-0 ms-auto me-auto">
                <div class="card card-pricing card-pricing-focus card-primary">
                  <div class="card-header">
                    <h4 class="card-title">Profile Card</h4>
                    <div class="card-price">
                      <span class="price"><?php echo $client['ceo_name']; ?></span>
                      <span class="text"> Director/CEO</span>
                    </div>
                  </div>
                  <div class="card-body">
                    <ul class="specification-list">
                      <li>
                        <span class="name-specification">Business Name</span>
                        <span class="status-specification"><?php echo $client['business_name']; ?></span>
                      </li>
                      <li>
                        <span class="name-specification">Mobile</span>
                        <span class="status-specification"><?php echo $client['mobile']; ?></span>
                      </li>
                      <li>
                        <span class="name-specification">Email</span>
                        <span class="status-specification"><?php echo $client['email']; ?></span>
                      </li>
                      <li>
                        <span class="name-specification">Address</span>
                        <span class="status-specification"><?php echo $client['address']; ?></span>
                      </li>
                     <li>
                        <span class="name-specification">Product Subscribed</span>
                        <span class="status-specification"><?php echo $client['category']; ?></span>
                      </li>
                    </ul>
                  </div>
                  
                </div>
              </div>
        </div>
      </div>

    <?php include('components/footer.php');?>
    </div>


  </div>
  <?php include('components/scripts.php');?>
</body>

</html>