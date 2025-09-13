<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

include("../db_connect.php");

$sql = "SELECT * FROM license order by transaction_date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>