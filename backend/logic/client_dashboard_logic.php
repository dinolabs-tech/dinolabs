<?php
session_start();
if (!isset($_SESSION['client_id'])) {
    header("Location: login.php");
    exit();
}

include('adupdate_students.php');
include("../db_connect.php");

$client_id = $_SESSION['client_id'];
$license_expiry_date = $total_amount = $amount_paid = $outstanding_balance = $total_students = $amount_per_student = null;

$sql = "SELECT license_expiry_date, total_amount, amount_paid, outstanding_balance, total_students, amount_per_student FROM clients WHERE id = $client_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $license_expiry_date = $row["license_expiry_date"];
    $total_amount = $row["total_amount"];
    $amount_paid = $row["amount_paid"];
    $outstanding_balance = $row["outstanding_balance"];
    $total_students = $row["total_students"];
    $amount_per_student = $row["amount_per_student"];
}


if (!isset($_SESSION['client_id'])) {
    header("Location: login.php");
    exit();
}


$client_id = $_SESSION['client_id'];
$sql = "SELECT * FROM clients WHERE id = $client_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $client = $result->fetch_assoc();
} else {
    echo "Client not found.";
    exit;
}

$conn->close();
?>