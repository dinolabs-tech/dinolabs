<?php
// Database configuration
include("../db_connect.php");
session_start();
// Get client ID from URL
$client_id = $_GET["id"];

// SQL to select client by ID
$sql = "SELECT id, business_name, total_amount, amount_paid, outstanding_balance FROM clients WHERE id = " . $client_id;
$result = $conn->query($sql);

$client_found = false;

if ($result->num_rows > 0) {
    $client_found = true;
    $row = $result->fetch_assoc();
    $business_name = $row["business_name"];
    $total_amount = $row["total_amount"];
    $amount_paid = $row["amount_paid"];
    $outstanding_balance = $row["outstanding_balance"];
}

$conn->close();
?>