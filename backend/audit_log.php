<?php
function log_activity($user_id, $activity, $details = null) {
include("../db_connect.php");

    $activity = mysqli_real_escape_string($conn, $activity);
    if ($details !== null) {
        $details = mysqli_real_escape_string($conn, json_encode($details));
    }

    $sql = "INSERT INTO audit_log (user_id, activity, details) VALUES ($user_id, '$activity', " . ($details === null ? "NULL" : "'$details'") . ")";

    if ($conn->query($sql) === FALSE) {
        error_log("Error logging activity: " . $conn->error);
    }
    $conn->close();
}
?>
