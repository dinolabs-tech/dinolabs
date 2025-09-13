<?php

include("../db_connect.php");

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

$assignments = $conn->query("SELECT assignments.id, academy.name as student_name, classes.name as class_name FROM assignments JOIN academy ON assignments.student_id = academy.id JOIN classes ON assignments.class_id = classes.id");
