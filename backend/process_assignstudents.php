<?php
include("../db_connect.php");

if (isset($_POST['assign_student'])) {
    $student_id = $_POST['student_id'];
    $class_id = $_POST['class_id'];

    $check_stmt = $conn->prepare("SELECT id FROM assignments WHERE student_id = ? AND class_id = ?");
    $check_stmt->bind_param("ii", $student_id, $class_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows === 0) {
        $stmt = $conn->prepare("INSERT INTO assignments (student_id, class_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $student_id, $class_id);
        $stmt->execute();
        $stmt->close();
    }
    $check_stmt->close();
    header("Location: assign_students.php?message=Student Assigned successfully");
    exit;
}


if (isset($_POST['unassign_student'])) {
    $stmt = $conn->prepare("DELETE FROM assignments WHERE id = ?");
    $stmt->bind_param("i", $_POST['assignment_id']);
    $stmt->execute();
    $stmt->close();
    header("Location: assign_students.php?message=Student Un-Assigned successfully");
    exit;
}

if (isset($_POST['reassign_student'])) {
    $stmt = $conn->prepare("UPDATE assignments SET class_id = ? WHERE id = ?");
    $stmt->bind_param("ii", $_POST['new_class_id'], $_POST['assignment_id']);
    $stmt->execute();
    $stmt->close();
    header("Location: assign_students.php?message=Student Re-Assigned successfully");
    exit;
}

$conn->close();
?>
