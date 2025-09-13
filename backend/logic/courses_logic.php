<?php

include("../db_connect.php");

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

$course_name = "";
$description = "";
$price = "";
$duration = "";
$id = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM courses WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $course_name = $row['course_name'];
        $description = $row['description'];
        $price = $row['price'];
        $duration = $row['duration'];
    } else {
        echo "Record not found.";
        exit;
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $course_name = $_POST['course_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];

    $sql = "UPDATE academy SET
        course_name = '$course_name',
        description = '$description',
        price = '$price',
        duration = '$duration'
        WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../courses.php?message=Course updated successfully");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch clients
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
