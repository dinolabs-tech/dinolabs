<?php include('menu.php'); ?>
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

include("../db_connect.php");

// Get user ID from query string
$id = $_GET["id"];

// Prepare the SQL statement
$sql = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);

// Bind the parameter
$stmt->bind_param("i", $id);

// Execute the statement
if ($stmt->execute() === TRUE) {
    header("Location: user_control.php?message=User deleted successfully");
    exit();
} else {
    echo "Error deleting user: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
