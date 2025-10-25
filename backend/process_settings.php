<?php
session_start();
include_once 'functions/access_control.php';
include_once 'db_connect.php';

if (!is_logged_in() || !isAdmin()) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flutterwave_public_key = $_POST['flutterwave_public_key'] ?? '';
    $flutterwave_secret_key = $_POST['flutterwave_secret_key'] ?? '';

    if (empty($flutterwave_public_key) || empty($flutterwave_secret_key)) {
        $_SESSION['message'] = "Both Flutterwave Public and Secret Keys are required.";
        $_SESSION['message_type'] = "danger";
        header("Location: settings.php");
        exit();
    }

    // Prepare to insert or update the public key
    $stmt_public = $conn->prepare("INSERT INTO payment_settings (setting_name, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");
    $public_key_name = 'flutterwave_public_key';
    $stmt_public->bind_param("sss", $public_key_name, $flutterwave_public_key, $flutterwave_public_key);
    $stmt_public->execute();
    $stmt_public->close();

    // Prepare to insert or update the secret key
    $stmt_secret = $conn->prepare("INSERT INTO payment_settings (setting_name, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");
    $secret_key_name = 'flutterwave_secret_key';
    $stmt_secret->bind_param("sss", $secret_key_name, $flutterwave_secret_key, $flutterwave_secret_key);
    $stmt_secret->execute();
    $stmt_secret->close();

    $_SESSION['message'] = "Flutterwave settings saved successfully!";
    $_SESSION['message_type'] = "success";
    header("Location: settings.php");
    exit();

} else {
    $_SESSION['message'] = "Invalid request method.";
    $_SESSION['message_type'] = "danger";
    header("Location: settings.php");
    exit();
}
?>
