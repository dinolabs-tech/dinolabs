<?php
include("../db_connect.php");


if (isset($_POST['add_schedule'])) {
    $stmt = $conn->prepare("INSERT INTO schedules (class_id, day, time) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $_POST['class_id'], $_POST['day'], $_POST['time']);
    $stmt->execute();
    $stmt->close();
    header("Location: class_schedule.php?message=Class Schedule Saved successfully");
    exit;
}



if (isset($_POST['update_schedule'])) {
    $stmt = $conn->prepare("UPDATE schedules SET day = ?, time = ? WHERE id = ?");
    $stmt->bind_param("ssi", $_POST['day'], $_POST['time'], $_POST['schedule_id']);
    $stmt->execute();
    $stmt->close();
    header("Location: class_schedule.php?message=Class Schedule Updated successfully");
    exit;
}

if (isset($_POST['delete_schedule'])) {
        $stmt = $conn->prepare("DELETE FROM schedules WHERE id=?");
        $stmt->bind_param("i", $_POST['schedule_id']);
        $stmt->execute();
        $stmt->close();
         header("Location: class_schedule.php?message=Class Schedule Deleted successfully");
    exit;
    }

$conn->close();
?>
