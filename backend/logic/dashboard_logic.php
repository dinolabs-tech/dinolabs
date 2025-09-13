<?php
session_start();

if (!isset($_SESSION['role_id'])) {
    header("Location: login.php");
    exit;
}

// Database configuration
include("../db_connect.php");

// Total amount expected
$sql_total_amount_expected = "SELECT SUM(total_amount) AS total_amount_expected FROM clients WHERE is_active = 1";
$result_total_amount_expected = $conn->query($sql_total_amount_expected);
$total_amount_expected = $result_total_amount_expected->fetch_assoc()['total_amount_expected'];

// Total license paid overall
$sql_total_license_paid = "SELECT SUM(payment_amount) AS total_license_paid FROM transactions";
$result_total_license_paid = $conn->query($sql_total_license_paid);
$total_license_paid = $result_total_license_paid->fetch_assoc()['total_license_paid'];

// Total license paid for today
$sql_total_license_paid_today = "SELECT SUM(payment_amount) AS total_license_paid_today FROM transactions WHERE DATE(transaction_date) = CURDATE();
";
$result_total_license_paid_today = $conn->query($sql_total_license_paid_today);
$total_license_paid_today = $result_total_license_paid_today->fetch_assoc()['total_license_paid_today'];

// Sum of outstanding
$sql_sum_outstanding = "SELECT SUM(outstanding_balance) AS sum_outstanding FROM clients WHERE is_active = 1";
$result_sum_outstanding = $conn->query($sql_sum_outstanding);
$sum_outstanding = $result_sum_outstanding->fetch_assoc()['sum_outstanding'];

// Sum of amount paid
$sql_sum_amount_paid = "SELECT SUM(amount_paid) AS sum_amount_paid FROM clients WHERE is_active = 1";
$result_sum_amount_paid = $conn->query($sql_sum_amount_paid);
$sum_amount_paid = $result_sum_amount_paid->fetch_assoc()['sum_amount_paid'];

// Number of clients
$sql_number_of_clients = "SELECT COUNT(*) AS number_of_clients FROM clients WHERE is_active = 1";
$result_number_of_clients = $conn->query($sql_number_of_clients);
$number_of_clients = $result_number_of_clients->fetch_assoc()['number_of_clients'];

// Expired licenses
$sql_expired_licenses = "SELECT COUNT(*) AS expired_licenses FROM clients WHERE license_expiry_date < CURDATE() AND is_active = 1";
$result_expired_licenses = $conn->query($sql_expired_licenses);
$expired_licenses = $result_expired_licenses->fetch_assoc()['expired_licenses'];

// List of clients with expired license
$sql_clients_with_expired_license = "SELECT business_name FROM clients WHERE license_expiry_date < CURDATE() AND is_active = 1";
$result_clients_with_expired_license = $conn->query($sql_clients_with_expired_license);

// Revenue from each client
$sql_total_revenue_per_client = "
    SELECT t.client_id, t.business_name, SUM(t.payment_amount) AS total_revenue 
    FROM transactions t 
    INNER JOIN clients c ON t.client_id = c.id 
    WHERE c.is_active = 1 
    GROUP BY t.client_id 
    ORDER BY total_revenue DESC
";
$result_total_revenue_per_client = $conn->query($sql_total_revenue_per_client);
?>
