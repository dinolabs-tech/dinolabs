<?php include('logic/transaction_history_logic.php'); ?>

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
                    <h4 class="card-title">Transaction History</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">


                      <div class="table-responsive">
                        <table id="basic-datatables" class="table table-striped table-bordered basic-datatables">
                          <thead>
                            <tr>
                              <th>Business Name</th>
                              <th>Payment Amount</th>
                              <th>Transaction Date</th>
                              <th>Description</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (count($transactions) > 0): ?>
                              <?php foreach ($transactions as $transaction): ?>
                                <tr>
                                  <td><?= htmlspecialchars($transaction["business_name"]) ?></td>
                                  <td><?= number_format($transaction["payment_amount"], 2) ?></td>
                                  <td><?= htmlspecialchars($transaction["transaction_date"]) ?></td>
                                  <td><?= htmlspecialchars($transaction["license_subscription"]) ?></td>
                                </tr>
                              <?php endforeach; ?>
                            <?php else: ?>
                              <tr>
                                <td colspan="6">No transactions found</td>
                              </tr>
                            <?php endif; ?>
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