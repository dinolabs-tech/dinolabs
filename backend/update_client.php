<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
  include("../db_connect.php");

    // Retrieve and sanitize POST data
    $expiry_date = filter_var($_POST['expiry_date'], FILTER_SANITIZE_STRING);

    // Retrieve client_id from the session
    $client_id = $_SESSION['client_id'] ?? null;

    // Retrieve payment_amount from save_transaction.php (assuming it's stored in session)
    $payment_amount = $_SESSION['payment_amount'] ?? 0;

    if ($client_id === null) {
        echo "Error: client_id not found in session.";
        $conn->close();
        exit;
    }
    
    // Use prepared statement to update client information
    $stmt = $conn->prepare("UPDATE clients SET license_expiry_date = ?, amount_paid = amount_paid + ?, outstanding_balance = total_amount - amount_paid WHERE id = ?");
    $stmt->bind_param("sdi", $expiry_date, $payment_amount, $client_id);

    if ($stmt->execute()) {
        echo "Client updated successfully!";
    } else {
        echo "Error updating client: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
