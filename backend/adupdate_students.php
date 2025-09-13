<?php

// Database configuration
include("../db_connect.php");

// Get client ID from POST or SESSION
$client_id = $_SESSION['client_id'];

// SQL to select the client
$sql = "SELECT web_ip_address, web_username, web_password, web_database, total_students FROM clients WHERE id = " . $client_id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Extract remote credentials
    $web_ip = $row["web_ip_address"];
    $web_user = $row["web_username"];
    $web_pass = $row["web_password"];
    $web_db   = $row["web_database"];
    $current_total_students = $row["total_students"];

    // Check if any remote credential is missing
    // if (empty($web_ip) || empty($web_user) || empty($web_pass) || empty($web_db)) {
    if (empty($web_ip) || empty($web_user) || empty($web_db)) {
        // Do nothing — maintain the current total_students
        // Optionally recalculate total_amount
        $sql_update = "UPDATE clients SET total_amount = total_students * amount_per_student WHERE id = " . $client_id;
        $conn->query($sql_update);
    } else {
        // Attempt remote connection
        $remote_conn = new mysqli($web_ip, $web_user, $web_pass, $web_db);

        if ($remote_conn->connect_error) {
            // Remote connection failed — maintain current total_students
            // Optionally recalculate total_amount
            $sql_update = "UPDATE clients SET total_amount = total_students * amount_per_student WHERE id = " . $client_id;
            $conn->query($sql_update);
        } else {
            // Remote connection succeeded — get student count
            $sql_remote_students = "SELECT COUNT(*) AS total FROM students";
            $result_remote_students = $remote_conn->query($sql_remote_students);

            if ($result_remote_students && $result_remote_students->num_rows > 0) {
                $row_remote_students = $result_remote_students->fetch_assoc();
                $remote_total_students = $row_remote_students["total"];

                // Update local total_students and total_amount
                $sql_update = "UPDATE clients 
                               SET total_students = $remote_total_students, 
                                   total_amount = $remote_total_students * amount_per_student 
                               WHERE id = " . $client_id;

                $conn->query($sql_update);
            }
            $remote_conn->close();
        }
    }
} else {
    echo "Client not found";
}

$conn->close();
?>
