<?php

include("../db_connect.php");

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

$schedules = $conn->query("SELECT schedules.*, classes.name as class_name FROM schedules JOIN classes ON schedules.class_id = classes.id");

