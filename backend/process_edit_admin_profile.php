<?php
session_start();
// Assuming user_id is stored in the session
$user_id = $_SESSION['user_id'];

// Database connection details (replace with your actual credentials)
include("../db_connect.php");

$new_password = $_POST['password'];
$email = $_POST['email'];



// Update users table only if a new password is provided
if (!empty($new_password)) {
 $hashed_password = $new_password; // Hash the password
 $sql_users = "UPDATE users SET password='$hashed_password', email = '$email' WHERE id=$user_id";

 if ($conn->query($sql_users) === TRUE) {
//  echo "Users table updated successfully<br>";
echo "<script>
    alert('Data updated Successfully!');
    window.location.href = 'edit_admin_profile.php';
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
