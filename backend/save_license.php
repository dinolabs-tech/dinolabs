<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
include("../db_connect.php");

  // Get POST data safely
  $name = $conn->real_escape_string($_POST['name']);
  $phone = $conn->real_escape_string($_POST['phone']);
  $email = $conn->real_escape_string($_POST['email']);
  $software_name = $conn->real_escape_string($_POST['software_name']);
  $organization = $conn->real_escape_string($_POST['organization']);
  $txtcapacity = $conn->real_escape_string($_POST['txtcapacity']);
  $cmbpackage = $conn->real_escape_string($_POST['cmbpackage']);
  $enddate = $conn->real_escape_string($_POST['enddate']);
  $license_key = $conn->real_escape_string($_POST['license_key']);

  $sql = "INSERT INTO license (name, phone, email, sofware_name, organization, txtcapacity, cmbpackage, enddate, license_key)
          VALUES ('$name', '$phone', '$email', '$software_name', '$organization', '$txtcapacity', '$cmbpackage', '$enddate', '$license_key')";

  if ($conn->query($sql) === TRUE) {
    echo "License saved successfully!";
  } else {
    echo "Error: " . $conn->error;
  }

  $conn->close();
}
?>
