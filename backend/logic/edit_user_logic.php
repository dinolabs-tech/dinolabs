<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

include("../db_connect.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $role_id = $_POST["role_id"];
    $password = $_POST["password"];

    $sql = "UPDATE users SET username='$username', email='$email', role_id=$role_id";

    if (!empty($password)) {
        $hashed_password = $password;
        $sql .= ", password='$hashed_password'";
    }

    $sql .= " WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: user_control.php?message=User updated successfully");
        exit();
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

// Get user ID from query string
$id = $_GET["id"];

// Fetch user data
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

// Fetch all roles
$sql_roles = "SELECT id, name FROM roles";
$result_roles = $conn->query($sql_roles);

?>