<?php
include("../db_connect.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "UPDATE clients SET is_active = 0 WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
      
        header("Location: index.php?message=Client Deactivated Successfully.");
        exit;
    } else {
        echo "Error deactivating client: " . $conn->error;
    }
} else {
    echo "Client ID not provided";
}

$conn->close();
?>