<?php
// Database configuration
include("../db_connect.php");

// Get client ID from POST request
$client_id = $_POST["client_id"];

// SQL to select client data
$sql = "SELECT amount_per_student, total_students, outstanding_balance FROM clients WHERE id = $client_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $amount_per_student = $row["amount_per_student"];
    $total_students = $row["total_students"];
    $outstanding_balance = $row["outstanding_balance"];

    // Calculate new total amount
    $new_total_amount = $amount_per_student * $total_students + $outstanding_balance;

    // Get the current license expiry date
    $sql_select_expiry_date = "SELECT license_expiry_date FROM clients WHERE id = $client_id";
    $result_expiry_date = $conn->query($sql_select_expiry_date);

    if ($result_expiry_date->num_rows == 1) {
        $row_expiry_date = $result_expiry_date->fetch_assoc();
        $license_expiry_date = $row_expiry_date["license_expiry_date"];

        // Increase the year by one
        $new_expiry_date = date('Y-m-d', strtotime('+1 year', strtotime($license_expiry_date)));

        // SQL to update client
        $sql_update_client = "UPDATE clients SET total_amount = $new_total_amount, license_expiry_date = '$new_expiry_date', outstanding_balance = total_amount, amount_paid=0 WHERE id = $client_id";

        if ($conn->query($sql_update_client) === TRUE) {
            echo "Client rollover successful. New total amount: " . $new_total_amount . ". New expiry date: " . $new_expiry_date;
        } else {
            echo "Error updating client: " . $conn->error;
        }
    } else {
        echo "Error fetching license expiry date";
    }
} else {
    echo "Client not found";
}

$conn->close();
?>
