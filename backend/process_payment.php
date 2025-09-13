<?php
// Database configuration
include("../db_connect.php");

// Get client ID and payment amount from form submission
$client_id = $_POST["client_id"];
$payment_amount = $_POST["payment_amount"];

// SQL to select client by ID
$sql = "SELECT id, business_name, total_amount, amount_paid, outstanding_balance FROM clients WHERE id = " . $client_id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $business_name = $row["business_name"];
    $total_amount = $row["total_amount"];
    $amount_paid = $row["amount_paid"];
    $outstanding_balance = $row["outstanding_balance"];

    // Calculate new amount paid and outstanding balance
    $new_amount_paid = $amount_paid + $payment_amount;
    $new_outstanding_balance = $total_amount - $new_amount_paid;

    // SQL to insert transaction
    $sql_insert_transaction = "INSERT INTO transactions (client_id, payment_amount, business_name, license_subscription) VALUES ($client_id, $payment_amount, '$business_name', 'license')";

    if ($conn->query($sql_insert_transaction) === TRUE) {
        // SQL to update client
        $sql_update_client = "UPDATE clients SET amount_paid = $new_amount_paid, outstanding_balance = $new_outstanding_balance WHERE id = $client_id";

        if ($conn->query($sql_update_client) === TRUE) {
            // Redirect to payment tracking page
            header("Location: payment_tracking.php");
            exit();
        } else {
            echo "Error updating client: " . $conn->error;
        }
    } else {
        echo "Error inserting transaction: " . $conn->error;
    }
} else {
    echo "Client not found";
}

$conn->close();
?>
