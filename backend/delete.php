
<?php
include('database_schema.php');

include("../db_connect.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM clients WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: client.php?message=Record deleted successfully");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
    exit;
}

$conn->close();
?>
