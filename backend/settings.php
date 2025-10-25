<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once 'functions/access_control.php';
include_once 'db_connect.php'; // Assuming db_connect.php handles database connection

// Check if user is logged in and has admin privileges
if (!is_logged_in() || !isAdmin()) {
    header("Location: login.php");
    exit();
}

$flutterwave_public_key = '';
$flutterwave_secret_key = '';

// Fetch existing settings from the database
$stmt = $conn->prepare("SELECT setting_name, setting_value FROM payment_settings WHERE setting_name IN (?, ?)");
$stmt->bind_param("ss", $public_key_name, $secret_key_name);

$public_key_name = 'flutterwave_public_key';
$secret_key_name = 'flutterwave_secret_key';

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    if ($row['setting_name'] === 'flutterwave_public_key') {
        $flutterwave_public_key = htmlspecialchars($row['setting_value']);
    } elseif ($row['setting_name'] === 'flutterwave_secret_key') {
        $flutterwave_secret_key = htmlspecialchars($row['setting_value']);
    }
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'components/head.php'; ?>
    <title>Payment Settings</title>
</head>
<body class="sb-nav-fixed">
    <?php include 'components/navbar.php'; ?>
    <div id="layoutSidenav">
        <?php include 'components/sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Payment Settings</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Payment Settings</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-cog me-1"></i>
                            Flutterwave API Keys
                        </div>
                        <div class="card-body">
                            <?php if (isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
                            <?php endif; ?>

                            <form action="process_settings.php" method="POST">
                                <div class="mb-3">
                                    <label for="flutterwave_public_key" class="form-label">Flutterwave Public Key</label>
                                    <input type="text" class="form-control" id="flutterwave_public_key" name="flutterwave_public_key" value="<?php echo $flutterwave_public_key; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="flutterwave_secret_key" class="form-label">Flutterwave Secret Key</label>
                                    <input type="text" class="form-control" id="flutterwave_secret_key" name="flutterwave_secret_key" value="<?php echo $flutterwave_secret_key; ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Settings</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'components/footer.php'; ?>
        </div>
    </div>
    <?php include 'components/scripts.php'; ?>
</body>
</html>
