<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

// Database configuration
include("../db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = $_POST["client_id"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Hash the password
    $hashed_password = $password;

    // Insert the new user into the users table
    $sql_insert = "INSERT INTO users (username, password, email, role_id, is_admin) 
                   VALUES ('$username', '$hashed_password', '$email', NULL, 0)";

    if ($conn->query($sql_insert) === TRUE) {
        $user_id = $conn->insert_id;

        // Update the client table with the new user ID
        $sql_update = "UPDATE clients SET user_id = $user_id WHERE id = $client_id";
        if ($conn->query($sql_update) === TRUE) {
            // echo "Client user registered successfully!";
            echo "<script> alert('Client User Registered Successfully!'); 
            window.Location.href = register_client_user.php;
            </script>";
        } else {
            echo "Error updating client: " . $conn->error;
        }
        include('audit_log.php');
        log_activity($_SESSION['user_id'], "Registered new client user: " . $username . " for client ID: " . $client_id);
    } else {
        echo "Error registering user: " . $conn->error;
    }
}

// Get all clients
$sql_clients = "SELECT id, business_name FROM clients";
$result_clients = $conn->query($sql_clients);
?>