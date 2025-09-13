<?php

include("../db_connect.php");

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

$class_name = "";
$id = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM classes WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $class_name = $row['name'];
    } else {
        echo "Record not found.";
        exit;
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $class_name = $_POST['class_name'];

    $sql = "UPDATE classes SET
        name = '$class_name',
        WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../courses.php?message=Class updated successfully");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch clients
$sql = "SELECT * FROM classes";
$result = $conn->query($sql);
