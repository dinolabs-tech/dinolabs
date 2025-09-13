<?php include('logic/inactive_client_logic.php'); ?>

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
                    <h4 class="card-title">Clients Data</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

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
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if ($inactiveClients): ?>
                              <?php foreach ($inactiveClients as $client): ?>
                                <tr>
                                  <td><?= $client["id"]; ?></td>
                                  <td><?= $client["business_name"]; ?></td>
                                  <td><a href="activate.php?id=<?= $client["id"]; ?>">Activate</a></td>
                                </tr>
                              <?php endforeach; ?>
                            <?php else: ?>
                              <tr>
                                <td colspan="3">No inactive clients found.</td>
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