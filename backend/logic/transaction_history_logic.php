<?php
// Database configuration
include("../db_connect.php");

session_start();
// SQL to select all payment transactions
$sql = "SELECT transaction_id, client_id, payment_amount, transaction_date, business_name, license_subscription FROM transactions order by transaction_date DESC";
$result = $conn->query($sql);

// Store all rows in an array for processing in HTML
$transactions = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }
}

?>