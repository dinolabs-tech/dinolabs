<?php

include("../db_connect.php");

session_start();

$business_name = "";
$ceo_name = "";
$mobile = "";
$email = "";
$address = "";
$category = "eduhive";
$total_students = "";
$amount_per_student = "";
$license_expiry_date = "";
$web_ip_address = "";
$web_username = "";
$web_password = "";
$web_database = "";
$total_amount = "";
$id = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM clients WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $business_name = $row['business_name'];
        $ceo_name = $row['ceo_name'];
        $mobile = $row['mobile'];
        $email = $row['email'];
        $address = $row['address'];
        $category = $row['category'];
        $total_students = $row['total_students'];
        $amount_per_student = $row['amount_per_student'];
        $license_expiry_date = $row['license_expiry_date'];
        $web_ip_address = $row['web_ip_address'];
        $web_username = $row['web_username'];
        $web_password = $row['web_password'];
        $web_database = $row['web_database'];
        $total_amount = $row['total_amount'];
    } else {
        echo "Record not found.";
        exit;
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $business_name = $_POST['business_name'];
    $ceo_name = $_POST['ceo_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $category = $_POST['category'];
    $total_students = $_POST['total_students'];
    $amount_per_student = $_POST['amount_per_student'];
    $license_expiry_date = $_POST['license_expiry_date'];
    $web_ip_address = $_POST['web_ip_address'];
    $web_username = $_POST['web_username'];
    $web_password = $_POST['web_password'];
    $web_database = $_POST['web_database'];
    $total_amount = $_POST['total_amount'];

    $sql = "UPDATE clients SET
        business_name = '$business_name',
        ceo_name = '$ceo_name',
        mobile = '$mobile',
        email = '$email',
        address = '$address',
        category = '$category',
        total_students = '$total_students',
        amount_per_student = '$amount_per_student',
        license_expiry_date = '$license_expiry_date',
        web_ip_address = '$web_ip_address',
        web_username = '$web_username',
        web_password = '$web_password',
        web_database = '$web_database',
        total_amount = '$total_amount'
        WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../client.php?message=Record updated successfully");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch clients
$sql = "SELECT * FROM clients WHERE is_active = 1";
$result = $conn->query($sql);
?>