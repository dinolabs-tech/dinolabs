<?php
session_start();
function decryptString($encrypted, $key, $iv)
{
  // Ensure the key and iv lengths are correct
  $key = substr($key, 0, 24); // 24 bytes = 192 bits
  $iv = substr($iv, 0, 16);   // 16 bytes = 128 bits

  // Decode from Base64 then decrypt using AES-192-CBC
  $decoded = base64_decode($encrypted);
  $decrypted = openssl_decrypt($decoded, 'aes-192-cbc', $key, OPENSSL_RAW_DATA, $iv);

  return $decrypted;
}

// Set key and IV to match encryption
$key = "abcdefghijklmnopqrstuvwx";
$iv = "1234567890123456";

$decryptedText = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $encryptedCode = $_POST['license_code'] ?? '';
  if (!empty($encryptedCode)) {
    $decryptedText = decryptString($encryptedCode, $key, $iv);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('components/head.php'); ?>
<style>
  .result {
    margin-top: 20px;
    background: #eef;
    padding: 15px;
    border-radius: 5px;
    word-break: break-word;
  }
</style>

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
                    <h4 class="card-title">Verify License</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

                      <p>
                      <form method="post" class="row g-3">
                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fa fa-building"></i>
                            </span>
                            <textarea name="license_code" required class="form-control"
                              placeholder="Enter Encrypted License Code"></textarea>
                          </div>
                        </div>

                        <div class="col-md-2">
                          <input class="btn btn-primary" type="submit" value="Decrypt">
                        </div>
                      </form>

                      <?php if (!empty($decryptedText)): ?>
                        <div class="result">
                          <strong>Decrypted Output:</strong><br>
                          <?php echo htmlspecialchars($decryptedText); ?>
                        </div>
                      <?php endif; ?>
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
</body>

</html>