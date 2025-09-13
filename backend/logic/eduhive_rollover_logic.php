<?php
// Database configuration
include("../db_connect.php");

// SQL to select all clients
$sql = "SELECT id,business_name, total_amount, outstanding_balance, license_expiry_date, amount_per_student, total_students, web_ip_address, web_username, web_password, web_database FROM clients where category = 'eduhive'";
$result = $conn->query($sql);

// Store all rows in an array for processing in HTML
$clients = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $client = $row;

        // Connect to remote database
        $remote_conn = new mysqli(
            $row["web_ip_address"],
            $row["web_username"],
            $row["web_password"],
            $row["web_database"]
        );

        if ($remote_conn->connect_error) {
            $client["remote_total_students"] = "Connection failed: " . $remote_conn->connect_error;
        } else {
            $sql_remote_students = "SELECT COUNT(*) AS total FROM students";
            $result_remote_students = $remote_conn->query($sql_remote_students);
            if ($result_remote_students && $result_remote_students->num_rows > 0) {
                $row_remote_students = $result_remote_students->fetch_assoc();
                $client["remote_total_students"] = $row_remote_students["total"];
            } else {
                $client["remote_total_students"] = "No students found";
            }
            $remote_conn->close();
        }

        // Check if the license is expired
        $current_date = date("Y-m-d");
        $client["button_disabled"] = ($current_date <= $row["license_expiry_date"]) ? "disabled" : "";

        $clients[] = $client;
    }
}
?>