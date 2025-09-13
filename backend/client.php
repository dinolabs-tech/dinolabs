<?php include('logic/client_logic.php'); ?>

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
         

          <?php
          if (isset($_GET['message'])) {
            echo "<div class='alert alert-success'>" . $_GET['message'] . "</div>";
          }
          ?>

          <div class="row">
            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">Clients Registration</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

                      <p>

                      <form action="process_registration.php" method="post" class="row g-3">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fa fa-building"></i>
                            </span>
                            <input type="text" id="business_name" name="business_name"
                              value="<?php echo $business_name; ?>" required class="form-control"
                              placeholder="Business Name" />
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fa fa-user"></i>
                            </span>
                            <input type="text" id="ceo_name" name="ceo_name" value="<?php echo $ceo_name; ?>" required
                              class="form-control" placeholder="CEO Name" />
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-phone"></i>
                            </span>
                            <input type="text" id="mobile" name="mobile" value="<?php echo $mobile; ?>" required
                              class="form-control" placeholder="Mobile" />
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-envelope"></i>
                            </span>
                            <input type="text" id="email" name="email" value="<?php echo $email; ?>" required
                              class="form-control" placeholder="Email" />
                          </div>
                        </div>

                        <div class="col-md-8">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <input type="text" id="address" name="address" value="<?php echo $address; ?>" required
                              class="form-control" placeholder="Address" />
                          </div>
                        </div>

                        <div class="col-md-2">
                          <select id="category" name="category" required onchange="updatePlaceholders()"
                            class="form-select form-control">
                            <option>Select Category</option>
                            <option value="Eduhive" <?php if ($category == 'Eduhive')
                              echo 'selected'; ?>>Eduhive
                            </option>
                             <option value="Enrollio" <?php if ($category == 'Enrollio')
                              echo 'selected'; ?>>Enrollio
                            </option>
                            <option value="Salesvantage" <?php if ($category == 'Salesvantage')
                              echo 'selected'; ?>>
                              Salesvantage</option>
                            <option value="Rxpulse" <?php if ($category == 'Rxpulse')
                              echo 'selected'; ?>>Rxpulse
                            </option>
                             <option value="VantageX" <?php if ($category == 'VantageX')
                              echo 'selected'; ?>>VantageX
                            </option>
                          </select>
                        </div>

                        <div class="col-md-2">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-users"></i>
                            </span>
                            <input type="text" id="total_students" name="total_students"
                              value="<?php echo $total_students; ?>" required placeholder="Total students"
                              onkeyup="calculateTotal()" class="form-control" />
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-money-bill-alt"></i>
                            </span>
                            <input type="text" id="amount_per_student" name="amount_per_student"
                              value="<?php echo $amount_per_student; ?>" required onkeyup="calculateTotal()"
                              placeholder="Amount per student" class="form-control" />
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="input-icon">
                            <input type="date" id="license_expiry_date" name="license_expiry_date"
                              value="<?php echo $license_expiry_date; ?>" required class="form-control" />
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-globe"></i>
                            </span>
                            <input type="text" id="web_ip_address" name="web_ip_address"
                              value="<?php echo $web_ip_address; ?>" class="form-control"
                              placeholder="Web Ip Address" />
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-at"></i>
                            </span>
                            <input type="text" id="web_username" name="web_username"
                              value="<?php echo $web_username; ?>" class="form-control" placeholder="Web Username" />
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-asterisk"></i>
                            </span>
                            <input type="text" id="web_password" name="web_password"
                              value="<?php echo $web_password; ?>" class="form-control" placeholder="Web Password" />
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-database"></i>
                            </span>
                            <input type="text" id="web_database" name="web_database"
                              value="<?php echo $web_database; ?>" class="form-control" placeholder="Web Database" />
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-credit-card"></i>
                            </span>
                            <input type="text" id="total_amount" name="total_amount"
                              value="<?php echo $total_amount; ?>" readonly class="form-control"
                              placeholder="Total Amount" />
                          </div>
                        </div>

                        <div class="col-md-2">
                          <button type="submit" name="<?php echo isset($_GET['id']) ? 'update' : 'register'; ?>"
                            class="btn btn-primary"><?php echo isset($_GET['id']) ? 'Update' : 'Register'; ?></button>
                        </div>
                      </form>

                      </p>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

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


                      <div class="table-responsive">
                        <table id="clientsTable" class="table table-striped table-bordered">
                          <thead class="table-dark">
                            <tr>
                              <th>Business Name</th>
                              <th>CEO Name</th>
                              <th>Mobile</th>
                              <th>Email</th>
                              <th>Address</th>
                              <th>Category</th>
                              <th>Total</th>
                              <th>Amount Per</th>
                              <th>License Expiry Date</th>
                              <th>Total Amount</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if ($result->num_rows > 0): ?>
                              <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                  <td><?= htmlspecialchars($row["business_name"]) ?></td>
                                  <td><?= htmlspecialchars($row["ceo_name"]) ?></td>
                                  <td><?= htmlspecialchars($row["mobile"]) ?></td>
                                  <td><?= htmlspecialchars($row["email"]) ?></td>
                                  <td><?= htmlspecialchars($row["address"]) ?></td>
                                  <td><?= htmlspecialchars($row["category"]) ?></td>
                                  <td><?= htmlspecialchars($row["total_students"]) ?></td>
                                  <td><?= htmlspecialchars($row["amount_per_student"]) ?></td>
                                  <td><?= htmlspecialchars($row["license_expiry_date"]) ?></td>
                                  <td><?= number_format($row["total_amount"], 2) ?></td>
                                  <td>
                                    <a href="client.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                      onclick="return confirm('Are you sure?')">Delete</a>
                                  </td>
                                </tr>
                              <?php endwhile; ?>
                            <?php else: ?>
                              <tr>
                                <td colspan="11" class="text-center text-muted">No clients registered yet.</td>
                              </tr>
                            <?php endif; ?>
                            <?php $conn->close(); ?>
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
  <?php include('functions/client_function.php'); ?>
</body>

</html>