<?php include('logic/payment_tracking_logic.php'); ?>

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
                    <h4 class="card-title">Payment Tracking</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

                      <p>

                      <div class="table-responsive">
                        <?php if ($result->num_rows > 0): ?>
                          <table id="multi-filter-select" class="display table table-striped table-hover">
                            <thead class="table-dark">
                              <tr>
                                <th>Business Name</th>
                                <th>Total Amount</th>
                                <th>Amount Paid</th>
                                <th>Outstanding Balance</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                  <td><?= htmlspecialchars($row['business_name']) ?></td>
                                  <td><?= number_format($row['total_amount'], 2) ?></td>
                                  <td>
                                    <?= number_format($row['amount_paid'], 2) ?>
                                    <?php if ($row['amount_paid'] >= $row['total_amount']): ?>
                                      <span class="badge bg-success">Paid Up</span>
                                    <?php endif; ?>
                                  </td>
                                  <td><?= number_format($row['outstanding_balance'], 2) ?></td>
                                  <td>
                                    <?php if ($row['amount_paid'] < $row['total_amount']): ?>
                                      <a href="record_payment.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Record
                                        Payment</a>
                                    <?php endif; ?>
                                  </td>
                                </tr>
                              <?php endwhile; ?>
                            </tbody>
                          </table>
                        <?php else: ?>
                          <div class="alert alert-warning">No clients found.</div>
                        <?php endif; ?>

                        <?php $conn->close(); ?>
                      </div>


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
  <?php include('functions/client_function.php'); ?>
</body>

</html>