<?php
// Include database connection
include("../db_connect.php");

session_start();
// Function to get username by user_id
function getUsername($conn, $user_id)
{
  $sql = "SELECT name FROM users WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  return ($result->num_rows > 0) ? $result->fetch_assoc()['name'] : "Unknown User";
}

// Function to get client name by user_id
function getClientName($conn, $user_id)
{
  $sql = "SELECT ceo_name FROM clients WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  return ($result->num_rows > 0) ? $result->fetch_assoc()['ceo_name'] : null;
}

// Fetch audit logs
$sql = "SELECT * FROM audit_log ORDER BY timestamp DESC";
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
       



          <div class="row">
            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">Activity Logs</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">


                      <div class="table-responsive">
                        <table id="basic-datatables" class="table table-striped table-bordered basic-datatables">
                          <thead>
                            <tr>
                              <th>Timestamp</th>
                              <th>User</th>
                              <th>Action</th>
                              <th>Details</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if ($result->num_rows > 0): ?>
                              <?php while ($row = $result->fetch_assoc()): ?>
                                <?php
                                $user_id = $row["user_id"];
                                $client_name = getClientName($conn, $user_id);
                                $user_display_name = $client_name ?: getUsername($conn, $user_id);
                                $details = json_decode($row["details"], true);
                                ?>
                                <tr>
                                  <td><?= $row["timestamp"] ?></td>
                                  <td><?= htmlspecialchars($user_display_name) ?></td>
                                  <td><?= htmlspecialchars($row["activity"]) ?></td>
                                  <td>
                                    <?= is_array($details) ? htmlspecialchars(json_encode($details, JSON_PRETTY_PRINT)) : htmlspecialchars($row["details"]) ?>
                                  </td>
                                </tr>
                              <?php endwhile; ?>
                            <?php else: ?>
                              <tr>
                                <td colspan="4" class="text-center text-muted">No audit logs found.</td>
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