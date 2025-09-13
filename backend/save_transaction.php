<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $conn = new mysqli("localhost", "root", "", "command");
  if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

  // Get POST data safely
  $client_id = $conn->real_escape_string($_POST['client_id']);
  $payment_amount = $conn->real_escape_string($_POST['payment_amount']);

  // Set session variables
  $_SESSION['client_id'] = $client_id;
  $_SESSION['payment_amount'] = $payment_amount;

  $business_name = $conn->real_escape_string($_POST['business_name']);
  $license_subscription = 'License Purchase';

  $sql = "INSERT INTO transactions (client_id, payment_amount, transaction_date, business_name, license_subscription)
          VALUES ('$client_id', '$payment_amount', NOW(), '$business_name', '$license_subscription')";

  if ($conn->query($sql) === TRUE) {
    echo "Transaction saved successfully!";
  } else {
    echo "Error: " . $conn->error;
  }

  $conn->close();
}
?>
