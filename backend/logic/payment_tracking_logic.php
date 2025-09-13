<?php
// Database configuration
include("../db_connect.php");
session_start();
// SQL to select all clients
$sql = "SELECT id, business_name, total_amount, amount_paid, outstanding_balance FROM clients";
$result = $conn->query($sql);
?>