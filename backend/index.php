<?php include('logic/dashboard_logic.php');
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
              <h3 class="fw-bold mb-3">Welcome, <?php echo $_SESSION['name']; ?>!</h3>
              <h6 class="op-7 mb-2">Dinolabs Dashboard</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
              <a href="register_client_user.php" class="btn btn-primary btn-round">Register Client User</a>
            </div>
          </div>

          <?php
          if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'admin') { ?>

              <div class="row">
                <div class="col-sm-6 col-md-6">
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
                            <p class="card-category">Total License Paid Overall</p>
                            <h4 class="card-title"><?php echo number_format($total_license_paid, 2); ?></h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6 col-md-6">
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
                            <p class="card-category">Total Amount Expected</p>
                            <h4 class="card-title"><?php echo number_format($total_amount_expected, 2); ?></h4>
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
                            <p class="card-category">Clients</p>
                            <h4 class="card-title"><?php echo $number_of_clients; ?></h4>
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
                            <p class="card-category">License Expired</p>
                            <h4 class="card-title"><?php echo $expired_licenses; ?></h4>
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
                            <p class="card-category">Total Outstanding Balance</p>
                            <h4 class="card-title"><?php echo number_format($sum_outstanding, 2); ?></h4>
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
                            <p class="card-category">Total Amount Paid</p>
                            <h4 class="card-title"><?php echo number_format($sum_amount_paid, 2); ?></h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="row">
              
                <div class="col-md-8">
                  <div class="card card-round">
                    <div class="card-header">
                      <div class="card-head-row">
                        <div class="card-title">Financial Overview</div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="chart-container" style="min-height: 375px">
                        <canvas id="financialPieChart"></canvas>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-md-4">
                  <div class="card card-primary card-round">
                    <div class="card-header">
                      <div class="card-head-row">
                        <div class="card-title">Today's License Sales</div>
                      </div>
                      <div class="card-category"><?php echo date('jS F Y'); ?> </div>
                    </div>
                    <div class="card-body pb-0">
                      <div class="mb-4 mt-2">
                        <h1><?php echo number_format($total_license_paid_today, 2); ?></h1>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php }
          } ?>

          <div class="row">
            <div class="col-md-6">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <div class="card-title">Client with Expired License</div>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <!-- List -->
                    <ul class="list-group">
                      <?php
                      if ($result_clients_with_expired_license->num_rows > 0) {
                        while ($row = $result_clients_with_expired_license->fetch_assoc()) {
                          echo "<li class='list-group-item'>" . $row["business_name"] . "</li>";
                        }
                      } else {
                        echo "<li class='list-group-item'>No clients with expired licenses.</li>";
                      }
                      ?>
                    </ul>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <div class="card-title">Total Revenue received per Client</div>
                  </div>
                </div>
                <div class="card-body p-0"><br>

                  <?php
          if (isset($_GET['message'])) {
            echo "<div class='alert alert-success'>" . $_GET['message'] . "</div>";
          }
          ?>

                  <div class="table-responsive">
                    <table id="basic-datatables" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Client ID</th>
                          <th>Business Name</th>
                          <th>Total Revenue</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if ($result_total_revenue_per_client->num_rows > 0) {
                          while ($row = $result_total_revenue_per_client->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["client_id"] . "</td>";
                            echo "<td>" . $row["business_name"] . "</td>";
                            echo "<td>" . number_format($row["total_revenue"], 2) . "</td>";
                            echo "<td><a href='deactivate.php?id=" . $row["client_id"] . "' class='btn btn-sm btn-danger'>Deactivate</a></td>";
                            echo "</tr>";
                          }
                        } else {
                          echo "<tr><td colspan='4'>No transactions found.</td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
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

 
<script>
  // 1) Grab the canvas context
  var ctxFin = document
    .getElementById("financialPieChart")
    .getContext("2d");

  // 2) Pull in your PHP variables (ensure they are numeric)
  var totals = [
    <?= floatval($total_license_paid_today ?? 0) ?>,      // if you want today's paid
    <?= floatval($total_license_paid ?? 0) ?>,            // overall license paid
    <?= floatval($total_amount_expected ?? 0) ?>,         // total expected
    <?= floatval($sum_outstanding ?? 0) ?>,               // sum outstanding
    <?= floatval($sum_amount_paid ?? 0) ?>                // sum amount paid
  ];

  // 3) Define labels and colors
  var labels = [
    "License Paid Today",
    "Total License Paid",
    "Total Amount Expected",
    "Outstanding Balance",
    "Amount Paid"
  ];
  var backgroundColors = [
    "#1d7af3",
    "#59d05d",
    "#fdaf4b",
    "#f3545d",
    "#716aca"
  ];

  // 4) Instantiate the pie chart
  new Chart(ctxFin, {
    type: "pie",
    data: {
      labels: labels,
      datasets: [{
        data: totals,
        backgroundColor: backgroundColors,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        position: "bottom",
        labels: {
          boxWidth: 12,
          padding: 20
        }
      },
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(sum, val) {
              return sum + val;
            }, 0);
            var currentValue = dataset.data[tooltipItem.index];
            var percentage = ((currentValue / total) * 100).toFixed(1);
            return data.labels[tooltipItem.index] + ": " 
                 + currentValue.toLocaleString() + " (" + percentage + "%)";
          }
        }
      }
    }
  });
</script>

</body>

</html>