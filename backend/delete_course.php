
<?php
include("../db_connect.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM courses WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: courses.php?message=Record deleted successfully");
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
