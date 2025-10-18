<?php
$host = "localhost";
$username = "dinolabs_root";
$password = "foxtrot2november";
$database = "dinolabs_command";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $host = "localhost";
// $username = "root";
// $password = "";
// $database = "command";

// $conn = new mysqli($host, $username, $password, $database);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
?>
