<?php
include("../db_connect.php");

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

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($business_name)) {
        $errors["business_name"] = "Business Name is required";
    }
    if (empty($ceo_name)) {
        $errors["ceo_name"] = "CEO Name is required";
    }
    if (empty($mobile)) {
        $errors["mobile"] = "Mobile is required";
    }
    if (empty($email)) {
        $errors["email"] = "Email is required";
    }
    if (empty($address)) {
        $errors["address"] = "Address is required";
    }
    if (empty($category)) {
        $errors["category"] = "Category is required";
    }
    if (empty($total_students)) {
        $errors["total_students"] = "Total Students is required";
    }
    if (empty($amount_per_student)) {
        $errors["amount_per_student"] = "Amount per Student is required";
    }
    if (empty($license_expiry_date)) {
        $errors["license_expiry_date"] = "License Expiry Date is required";
    }

    if (empty($errors)) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
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
                // header("Location: client.php?message=Client updated successfully");
                // exit;
                 echo "<script> alert('Client Updated Successfully!'); 
                    window.location.href = 'client.php';
                    </script>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            $sql = "INSERT INTO clients (business_name, ceo_name, mobile, email, address, category, total_students, amount_per_student, license_expiry_date, web_ip_address, web_username, web_password, web_database, total_amount)
            VALUES ('$business_name', '$ceo_name', '$mobile', '$email', '$address', '$category', '$total_students', '$amount_per_student', '$license_expiry_date', '$web_ip_address', '$web_username', '$web_password', '$web_database', '$total_amount')";

            if ($conn->query($sql) === TRUE) {
                // header("Location: client.php?message=Client Saved successfully");
                // exit;
                 echo "<script> alert('Client Registered Successfully!'); 
                    window.location.href = 'client.php';
                    </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        // Handle errors (e.g., redirect back to the form with error messages)
        $error_string = http_build_query($errors);
        header("Location: register_client_user.php?" . $error_string);
        exit;
    }
}

$conn->close();
?>
