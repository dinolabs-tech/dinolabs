<?php
session_start();
if (!isset($_SESSION['client_id'])) {
    header("Location: login.php");
    exit();
}

include("../db_connect.php");

$client_id = $_SESSION['client_id'];
$sql = "SELECT * FROM transactions WHERE client_id = $client_id order by transaction_date DESC";
$result = $conn->query($sql);
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
                              <th>Transaction ID</th>
                              <th>Payment Amount</th>
                              <th>Transaction Date</th>
                              <th>License Subscription</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["transaction_id"] . "</td>";
                                echo "<td>" . $row["payment_amount"] . "</td>";
                                echo "<td>" . $row["transaction_date"] . "</td>";
                                echo "<td>" . $row["license_subscription"] . "</td>";
                                echo "</tr>";
                              }
                            } else {
                              echo "<tr><td colspan='4'>No payments found.</td></tr>";
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

        </div>
      </div>

      <?php include('components/footer.php'); ?>
    </div>


  </div>
  <?php include('components/scripts.php'); ?>
</body>

</html>