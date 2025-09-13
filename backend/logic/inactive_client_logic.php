<?php
session_start();

include("../db_connect.php");

$sql = "SELECT id, business_name FROM clients WHERE is_active = 0";
$result = $conn->query($sql);

$inactiveClients = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $inactiveClients[] = $row;
    }
} else {
    $inactiveClients = null;
}

$conn->close();
?>