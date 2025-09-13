<?php
ob_start(); // Start output buffering
include("../db_connect.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Sanitize inputs
$course_name = htmlspecialchars($_POST['course_name']);
$description = $_POST['description'];
$price = htmlspecialchars($_POST['price']);
$duration = htmlspecialchars($_POST['duration']);

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = intval($_POST['id']); // Ensure it's an integer
    $sql = "UPDATE courses SET
        course_name = '$course_name',
        description = '$description',
        price = '$price',
        duration = '$duration'
        WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: courses.php?message=Courses updated successfully");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    $sql = "INSERT INTO courses (course_name, description, price, duration)
    VALUES ('$course_name', '$description', '$price', '$duration')";

    if ($conn->query($sql) === TRUE) {
        header("Location: courses.php?message=Courses saved successfully");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
ob_end_flush(); // Send output buffer
?>
