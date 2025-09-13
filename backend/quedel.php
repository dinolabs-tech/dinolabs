<?php
session_start();
// Database connection
require_once '../db_connect.php';
$did = $_GET['delid'];

// Use mysqli for database operations
mysqli_query($conn, "DELETE FROM question WHERE que_id = '$did'") or die(mysqli_error($cn));

echo '<script type="text/javascript">
alert("The selected question has successfully been deleted from the Database");
window.location="adquest.php";
</script>';

exit();
?>