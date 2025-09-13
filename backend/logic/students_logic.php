<?php

include("../db_connect.php");

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

// Fetch clients
// $sql = "SELECT * FROM academy";
$sql="SELECT academy.*, courses.course_name from academy join courses on academy.course_id=courses.id";
$result = $conn->query($sql);
?>