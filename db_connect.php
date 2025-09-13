<?php
/**
 * db_connect.php
 *
 * This file is responsible for establishing a connection to the MySQL database.
 * It defines the database connection parameters (host, username, password, database name)
 * and attempts to create a new mysqli connection. If the connection fails, it terminates
 * the script and displays an error message.
 *
 * There are two sets of connection parameters, one commented out, likely for a production
 * environment, and the active one for a local development environment.
 */

// --- Production Database Connection (Commented Out) ---
// These settings are typically used for a live server environment.
// $host = "localhost";             // Database host (usually 'localhost' for shared hosting).
// $username = "dinolabs_root";    // Database username for production.
// $password = "foxtrot2november"; // Database password for production.
// $database = "dinolabs_command";  // Database name for production.

// // Attempt to establish a new mysqli connection using the production credentials.
// $conn = new mysqli($host, $username, $password, $database);

// // Check if the connection was successful.
// if ($conn->connect_error) {
//     // If connection failed, terminate script execution and display the error.
//     die("Connection failed: " . $conn->connect_error);
// }

// --- Local Development Database Connection (Active) ---
// These settings are typically used for a local development environment (e.g., XAMPP, WAMP).
$host = "localhost"; // Database host (usually 'localhost' for local development).
$username = "root";  // Default username for local MySQL installations.
$password = "";      // Default empty password for local MySQL installations.
$database = "command"; // Database name for local development.

// Attempt to establish a new mysqli connection using the local development credentials.
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection was successful.
if ($conn->connect_error) {
    // If connection failed, terminate script execution and display the error.
    die("Connection failed: " . $conn->connect_error);
}
?>
