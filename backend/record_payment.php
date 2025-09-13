<?php include('logic/record_payment_logic.php'); ?>

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

          <div class="row">
            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">Record Payment</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive table-hover table-sales">
                        <p>

                          <?php if ($client_found): ?>
                          <p>Business Name: <?= htmlspecialchars($business_name) ?></p>
                          <p>Total Amount: <?= number_format($total_amount, 2) ?></p>
                          <p>Amount Paid: <?= number_format($amount_paid, 2) ?></p>
                          <p>Outstanding Balance: <?= number_format($outstanding_balance, 2) ?></p>

                          <form method="post" action="process_payment.php">
                            <input type="hidden" name="client_id" value="<?= htmlspecialchars($client_id) ?>">
                            <div class="form-group">
                              <input type="number" class="form-control" name="payment_amount" id="payment_amount"
                                required placeholder="Payment Amount">
                            </div>
                            <button type="submit" class="btn btn-primary">Record Payment</button>
                          </form>
                        <?php else: ?>
                          <p class="text-danger">Client not found.</p>
                        <?php endif; ?>


                        </p>
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
  <?php include('functions/client_function.php'); ?>
</body>

</html>