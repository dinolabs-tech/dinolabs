<?php
session_start();
// Assuming user_id is stored in the session
$user_id = $_SESSION['user_id'];

include("../db_connect.php");

$new_password = $_POST['password'];
$email = $_POST['email'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];

// Update clients table
$sql_clients = "UPDATE clients SET email='$email', address='$address', mobile='$mobile' WHERE user_id=$user_id";

if ($conn->query($sql_clients) === TRUE) {
//  echo "Clients table updated successfully<br>";


} else {
 echo "Error updating clients table: " . $conn->error . "<br>";
}

// Update users table only if a new password is provided
if (!empty($new_password)) {
 $hashed_password = $new_password; // Hash the password
 $sql_users = "UPDATE users SET password='$hashed_password' WHERE id=$user_id";

 if ($conn->query($sql_users) === TRUE) {
//  echo "Users table updated successfully<br>";
echo "<script>
    alert('Data updated Successfully!');
    window.location.href = 'edit_profile.php';
</script>";
exit();

 } else {
 echo "Error updating users table: " . $conn->error . "<br>";
 }
} else {
 echo "No new password provided, users table not updated<br>";
}

$conn->close();
?>
