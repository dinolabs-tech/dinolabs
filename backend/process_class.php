<?php
include("../db_connect.php");

$class_name = $_POST['class_name'];

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "UPDATE classes SET
        name = '$class_name'
        WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // header("Location: client.php?message=Client updated successfully");
        // exit;
         echo "<script> alert('Class Updated Successfully!'); 
            window.location.href = 'create_class.php';
            </script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    $sql = "INSERT INTO classes (name)
    VALUES ('$class_name')";

    if ($conn->query($sql) === TRUE) {
        // header("Location: client.php?message=Client Saved successfully");
        // exit;
         echo "<script> alert('Class Created Successfully!'); 
            window.location.href = 'create_class.php';
            </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
