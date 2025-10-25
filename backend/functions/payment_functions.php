<?php
include_once __DIR__ . '/../db_connect.php'; // Adjust path as necessary

function getFlutterwaveSecretKey() {
    global $conn; // Assuming $conn is available from db_connect.php

    $secret_key = null;
    $setting_name = 'flutterwave_secret_key';

    // Re-establish connection if closed, or use existing one
    if (!isset($conn) || $conn->connect_error) {
        include __DIR__ . '/../db_connect.php'; // Re-include to get $conn
    }

    $stmt = $conn->prepare("SELECT setting_value FROM payment_settings WHERE setting_name = ?");
    if ($stmt) {
        $stmt->bind_param("s", $setting_name);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $secret_key = $row['setting_value'];
        }
        $stmt->close();
    }
    return $secret_key;
}

function getFlutterwavePublicKey() {
    global $conn; // Assuming $conn is available from db_connect.php

    $public_key = null;
    $setting_name = 'flutterwave_public_key';

    // Re-establish connection if closed, or use existing one
    if (!isset($conn) || $conn->connect_error) {
        include __DIR__ . '/../db_connect.php'; // Re-include to get $conn
    }

    $stmt = $conn->prepare("SELECT setting_value FROM payment_settings WHERE setting_name = ?");
    if ($stmt) {
        $stmt->bind_param("s", $setting_name);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $public_key = $row['setting_value'];
        }
        $stmt->close();
    }
    return $public_key;
}
?>
