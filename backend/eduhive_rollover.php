<?php include('logic/eduhive_rollover_logic.php'); ?>

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
                    <h4 class="card-title">Eduhive Rollover</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        
                        <table id="multi-filter-select" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Business Name</th>
                              <th>Total Amount</th>
                              <th>Outstanding Balance</th>
                              <th>License Expiry Date</th>
                              <th>Amount Per Student</th>
                              <th>Total Students (Local)</th>
                              <th>Total Students (Remote)</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (count($clients) > 0): ?>
                              <?php foreach ($clients as $client): ?>
                                <tr>
                                  <td><?= htmlspecialchars($client["id"]) ?></td>
                                  <td><?= htmlspecialchars($client["business_name"]) ?></td>
                                  <td><?= number_format($client["total_amount"], 2) ?></td>
                                  <td><?= number_format($client["outstanding_balance"], 2) ?></td>
                                  <td><?= htmlspecialchars($client["license_expiry_date"]) ?></td>
                                  <td><?= number_format($client["amount_per_student"], 2) ?></td>
                                  <td><?= intval($client["total_students"]) ?></td>
                                  <td><?= htmlspecialchars($client["remote_total_students"]) ?></td>
                                  <td>
                                    <button class="rollover-button btn btn-primary" data-client-id="<?= $client["id"] ?>"
                                      <?= $client["button_disabled"] ?>>
                                      Rollover
                                    </button>
                                  </td>
                                </tr>
                              <?php endforeach; ?>
                            <?php else: ?>
                              <tr>
                                <td colspan="8">No clients found</td>
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
  <?php include('functions/rollover_function.php'); ?>
</body>

</html>