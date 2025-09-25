<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once '../db_connect.php';

// Ensure required session variables are set
if (!isset($_SESSION['subject']) || !isset($_SESSION['trueans'])) {
    // Redirect or show an error if the necessary data is not in the session
    // This prevents errors if the user lands on this page directly
    header("Location: student_dashboard.php"); 
    exit();
}

$loginid = $_SESSION['user_id'];
$course = $_SESSION['subject']; // Use the subject from the session
$score = $_SESSION['trueans'] * 4; // Apply consistent scoring
$test_date = date('Y-m-d H:i:s'); // Use a standard DATETIME format

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO mst_result(login, course, test_date, score) VALUES(?, ?, ?, ?)");
if ($stmt) {
    $stmt->bind_param("sssi", $loginid, $course, $test_date, $score);
    $stmt->execute();
    $stmt->close();
} else {
    // Handle potential error in statement preparation
    // For debugging, you might log the error: error_log($conn->error);
    // For the user, you could show a generic error message
    die("An error occurred while saving your results.");
}

// Clear the quiz session data after saving the result
unset($_SESSION['qn']);
unset($_SESSION['subject']);
unset($_SESSION['trueans']);

?>

<script type="text/javascript">
    // Redirect to the results page
    window.location='result.php';
</script>
