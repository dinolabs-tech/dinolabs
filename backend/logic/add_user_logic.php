<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

include("../db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $role_id = $_POST["category"];

    // Hash the password
    $hashed_password = $password;

    // Insert the new user into the users table
    $sql_insert = "INSERT INTO users (username, password, email, role_id, is_admin) 
                   VALUES ('$username', '$hashed_password', '$email', $role_id, 0)";

    if ($conn->query($sql_insert) === TRUE) {
        header("Location: add_user.php?message=User added successfully!");
        exit();
    } else {
        echo "Error registering user: " . $conn->error;
    }
}

// Get all roles
$sql_roles = "SELECT id, name FROM roles";
$result_roles = $conn->query($sql_roles);
?>
