<?php
session_start();
include_once 'functions/payment_functions.php'; // Include the new payment functions

$flutterwave_public_key = getFlutterwavePublicKey(); // Fetch public key from DB
if (!$flutterwave_public_key) {
    // Handle error if public key is not set, e.g., redirect to settings or show a message
    $_SESSION['message'] = "Flutterwave Public Key is not configured. Please set it in settings.";
    $_SESSION['message_type'] = "danger";
    header("Location: settings.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('components/head.php'); ?>
<script src="https://checkout.flutterwave.com/v3.js"></script>

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

          <!-- Customized Card -->
          <div class="row">

            <div class="col-md-4">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">Purchase License</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

                      <p>

                      <form method="post" id="paymentForm" action="save_license.php">
                        <input type="text" class="form-control" placeholder="Your Name" id="name" name="name"
                          value="<?php echo htmlspecialchars($_SESSION['ceo_name'] ?? ''); ?>" readonly required><br>

                        <input type="tel" class="form-control" placeholder="Mobile" id="phone" name="phone"
                          value="<?php echo htmlspecialchars($_SESSION['mobile'] ?? ''); ?>" readonly required><br>

                        <input type="email" class="form-control" placeholder="Email" id="email" name="email"
                          value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>" readonly required><br>

                        <input type="text" class="form-control" placeholder="Software Name" id="software_name"
                          name="software_name" value="<?php echo htmlspecialchars($_SESSION['category'] ?? ''); ?>"
                          readonly required><br>

                        <input type="text" class="form-control" placeholder="Business Name" id="organization"
                          name="organization" value="<?php echo htmlspecialchars($_SESSION['business_name'] ?? ''); ?>"
                          readonly required><br>

                        <input type="text" class="form-control" placeholder="Amount per Student" id="amount_per_student"
                          name="amount_per_student"
                          value="<?php echo htmlspecialchars($_SESSION['amount_per_student'] ?? ''); ?>" readonly
                          required><br>

                        <input type="number" class="form-control" placeholder="Application Capacity" id="txtcapacity"
                          name="txtcapacity" min="1"
                          value="<?php echo htmlspecialchars($_SESSION['total_students'] ?? ''); ?>" readonly required
                          oninput="updatePackageBasedOnCapacity()"><br>

                        <script>
                          document.addEventListener('DOMContentLoaded', function () {
                            updatePackageBasedOnCapacity();
                          });

                          function updatePackageBasedOnCapacity() {
                            const capacityInput = parseInt(document.getElementById('txtcapacity').value);
                            const packageSelect = document.getElementById('cmbpackage');

                            if (capacityInput <= 50) {
                              packageSelect.value = 'Spark';
                            } else if (capacityInput <= 120) {
                              packageSelect.value = 'Nexus';
                            } else {
                              packageSelect.value = 'UltraMax';
                            }
                          }
                        </script>

                        <select class="form-control" id="cmbpackage" name="cmbpackage" required>
                          <option value="Spark">Spark</option>
                          <option value="Nexus">Nexus</option>
                          <option value="UltraMax">UltraMax</option>
                        </select><br>

                        <label for="enddate">Expiry Date</label>
                        <input type="date" class="form-control" id="enddate" name="enddate" required oninvalid="this.setCustomValidity('Please select an expiry date')" oninput="setCustomValidity('')"><br>




                        <button class="btn btn-primary" type="button" onclick="calculateAndPay()">Proceed to
                          Pay</button>
                        <div id="licenseDisplay" style="display:none; margin-top:10px;" class="alert alert-success">
                        </div>

                      </form>

         <script>
  function calculateAndPay() {
    // ✅ Step 1: Fetch and trim all values
    const name = document.getElementById('name').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const email = document.getElementById('email').value.trim();
    const software_name = document.getElementById('software_name').value.trim(); // fixed typo
    const organization = document.getElementById('organization').value.trim();
    const capacity = parseInt(document.getElementById('txtcapacity').value);
    const packageSelect = document.getElementById('cmbpackage');
    packageSelect.disabled = false; // Enable to read value
    const package = packageSelect.value;
    const expiry_date = document.getElementById('enddate').value;

    // ✅ Step 2: Basic validations
    if (name.length < 4 || phone.length < 4 || !email.includes('@')) {
      alert("Please enter valid Name, Phone, and Email (minimum 4 characters).");
      return;
    }

    const startDate = new Date();
    const endDate = new Date(expiry_date);

    if (isNaN(endDate) || endDate <= startDate) {
      alert("Please select a valid expiry date.");
      return;
    }

    const days = (endDate - startDate) / (1000 * 60 * 60 * 24);
    const amount_per_student = parseFloat(document.getElementById('amount_per_student').value);
    const rate = amount_per_student / 365;
    const amount = parseFloat((days * rate * capacity).toFixed(2));

    if (isNaN(amount) || amount <= 0) {
      alert("Invalid payment amount. Check the student count and expiry date.");
      return;
    }

    const now = new Date();
    const subdate = `${String(now.getMonth() + 1).padStart(2, '0')}/${String(now.getDate()).padStart(2, '0')}/${now.getFullYear()}`;

    console.log("=== Payment Info ===", { name, phone, email, amount, software_name, organization });

    // ✅ Step 3: Generate License Key
    fetch('encryption.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({
        subdate,
        txtcapacity: capacity,
        txtpackage: package,
        enddate: expiry_date
      })
    })
    .then(response => response.text())
    .then(result => {
      const license_key = result.replace("Encrypted Text:", "").trim();


const txRef = "TX_" + Date.now();
console.log("Generated TX_REF:", txRef);


      // ✅ Step 4: Launch Flutterwave Checkout
      FlutterwaveCheckout({
        public_key: "<?php echo $flutterwave_public_key; ?>", // LIVE KEY
        tx_ref: "TX_" + Date.now(),
        amount: amount,
        currency: "NGN",
        payment_options: "card, banktransfer, ussd",
        customer: {
          email: email,
          phonenumber: phone,
          name: name
        },
        customizations: {
          title: "License Purchase",
          description: "Software License Payment"
        },
        callback: function (data) {
          console.log("Payment callback:", data);
          if (data.status === "successful") {

            // ✅ Step 5: Save License Info
            fetch('save_license.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
              body: new URLSearchParams({
                name,
                phone,
                email,
                software_name,
                organization,
                txtcapacity: capacity,
                cmbpackage: package,
                enddate: expiry_date,
                license_key
              })
            })
            .then(res => res.text())
            .then(saveResult => {
              alert("Payment Successful!\nYour License Key:\n" + license_key);
              document.getElementById('licenseDisplay').innerHTML = "Your License Key: <strong>" + license_key + "</strong>";
              document.getElementById('licenseDisplay').style.display = 'block';
              downloadLicenseKey(license_key);

              const clientId = '<?php echo htmlspecialchars($_SESSION['client_id'] ?? ''); ?>';
              const transactionParams = new URLSearchParams({
                client_id: clientId,
                payment_amount: amount.toFixed(2),
                transaction_date: subdate,
                business_name: organization,
                license_subscription: package,
                flutterwave_transaction_id: data.transaction_id // Pass Flutterwave transaction ID
              });

              // ✅ Step 6: Save Transaction
              fetch('save_transaction.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: transactionParams
              })
              .then(res => res.text())
              .then(() => {
                // ✅ Step 7: Update Client Record
                fetch('update_client.php', {
                  method: 'POST',
                  headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                  body: new URLSearchParams({
                    email,
                    expiry_date,
                    license_key
                  })
                })
                .then(res => res.text())
                .then(updateResult => {
                  console.log("Client updated:", updateResult);
                });
              });
            })
            .catch(err => {
              alert("Payment succeeded but saving license failed. Contact support.");
              console.error(err);
            });

          } else {
            alert("Payment failed or cancelled.");
          }
        },
        onclose: function () {
          console.log("Flutterwave modal closed");
        }
      });
    })
    .catch(error => {
      alert("License key generation failed. Check internet or contact support.");
      console.error(error);
    });
  }
</script>



                      </p>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-8">
              <div class="card card-post card-round">
                <img class="card-img-top" src="assets/img/license.jpg" alt="Card image cap" />
                <div class="card-body">
                  <div class="d-flex">

                    <h3 class="card-title">
                     Need Help?
                  </h3>
                  </div>
                  <div class="separator-solid"></div>

                  
                  
                    <i class="far fa-check-circle"></i>
                    Your user credentials are auto-generated.
                 <br>
                  
                    <i class="far fa-check-circle"></i>
                    Please confirm your Student count before commencing payment.
                  <br>
                    <i class="far fa-check-circle"></i>
                    For our Hybrid Users, Your package type is determined by your application capacity.
                  
                  <ul>
                    <li>Spark: Maximum of 50</li>
                    <li>Nexus: Maximum of 100</li>
                    <li>Ultramax: Unlimited</li>
                  </ul>
                  </p>
                  </p>
                  
                    <i class="far fa-check-circle"></i>
                    Choose your desired expiry date for the license.
                  <br>
                  
                    <i class="far fa-check-circle"></i>
                    Proceed to Pay!
                  <br><br>
                  <a href="../Contact.php" class="btn btn-primary btn-rounded btn-sm">Contact Us</a>
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
