<?php include('logic/license_history_logic.php'); ?>

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
                    <h4 class="card-title">License History</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">


                      <div class="table-responsive">
                          <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
                          <thead>
                            <tr>
                              <th>Transaction ID</th>
                              <th>Name</th>
                              <th>Phone</th>
                              <th>Email</th>
                              <th>Software</th>
                              <th>Organization</th>
                              <th>Capacity</th>
                              <th>Software</th>
                              <th>Expiry Date</th>
                              <th>License</th>
                              <th>Date</th>
                            </tr>
                          </thead>
                      <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row["id"]) ?></td>
                            <td><?= htmlspecialchars($row["name"]) ?></td>
                            <td><?= htmlspecialchars($row["phone"]) ?></td>
                            <td><?= htmlspecialchars($row["email"]) ?></td>
                            <td><?= htmlspecialchars($row["sofware_name"]) ?></td>
                            <td><?= htmlspecialchars($row["organization"]) ?></td>
                            <td><?= htmlspecialchars($row["txtcapacity"]) ?></td>
                            <td><?= htmlspecialchars($row["cmbpackage"]) ?></td>
                            <td><?= htmlspecialchars($row["enddate"]) ?></td>
                            <td><?= htmlspecialchars($row["license_key"]) ?></td>
                            <td><?= htmlspecialchars($row["transaction_date"]) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="text-center text-muted">No license payments found.</td>
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