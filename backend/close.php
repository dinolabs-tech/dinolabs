<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$loginid = $_SESSION['user_id'];
error_reporting(1);
$time = date("h:i:s");
$date = date("l, F j, Y");
$tdate = $time . '  ' . $date;

require_once '../db_connect.php';

extract($_POST);
extract($_GET);
extract($_SESSION);

if(isset($subid) && isset($testid))
{
    $_SESSION['sid'] = $subid;
    $_SESSION['tid'] = $testid;
}

// Insert result into the database
mysqli_query($conn, "INSERT INTO mst_result(login, test_id, test_date, score) VALUES('$loginid', $tid, '$tdate', " . $_SESSION['trueans'] . ")") or die(mysqli_error($conn));
?>

<script type="text/javascript">
    window.location='result.php';
</script>