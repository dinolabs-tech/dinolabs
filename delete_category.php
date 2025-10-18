<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include("db_connect.php");

$category_id = $_GET["id"];

$sql = "DELETE FROM categories WHERE id = $category_id";

if ($conn->query($sql) === TRUE) {
    header("Location: manage_categories.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
