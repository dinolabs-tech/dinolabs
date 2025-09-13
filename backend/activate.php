<?php
include("../db_connect.php");

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "UPDATE clients SET is_active = 1 WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
 
    header("Location: inactive_clients.php?message=Client Activated Successfully!");
    exit;

  } else {
    echo "Error activating client: " . $conn->error;
  }
} else {
  echo "Client ID not provided";
}

$conn->close();
?>