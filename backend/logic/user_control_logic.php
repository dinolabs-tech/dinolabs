<?php
session_start();

include("../db_connect.php");

// Fetch all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

?>