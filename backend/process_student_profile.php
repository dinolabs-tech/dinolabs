<?php
session_start();
// Assuming user_id is stored in the session
if (!isset($_SESSION['username'])) {
    // Redirect to login or show an error if the user is not logged in
    echo "You are not logged in.";
    exit;
}
$user_id = $_SESSION['username'];

include("../db_connect.php");

// Get current user data to check for old image path
$sql_select = "SELECT image_path FROM academy WHERE email = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("s", $user_id);
$stmt_select->execute();
$result = $stmt_select->get_result();

$old_image_path_db = null;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $old_image_path_db = $row['image_path'];
}
$stmt_select->close();

$new_password = $_POST['password'];
$email = $_POST['email'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
// Initialize image_path with the old path from DB
$image_path = $old_image_path_db;

// Process student image if a new file is provided
if (isset($_FILES["passport"]) && $_FILES["passport"]["error"] === UPLOAD_ERR_OK) {
    $upload_dir = '../academy_img/';
    $file_ext = strtolower(pathinfo($_FILES['passport']['name'], PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($file_ext, $allowed_extensions)) {
        // Create a new filename using the email
        $new_filename = $email . '.' . $file_ext;
        $new_image_path_db = 'academy_img/' . $new_filename;
        $full_upload_path = $upload_dir . $new_filename;

        // Before moving, delete the old image if it exists and is different
        if ($old_image_path_db && file_exists('../' . $old_image_path_db) && $old_image_path_db !== $new_image_path_db) {
            unlink('../' . $old_image_path_db);
        }

        if (move_uploaded_file($_FILES['passport']['tmp_name'], $full_upload_path)) {
            $image_path = $new_image_path_db; // Update image path to the new one
        } else {
            echo "Error: Failed to upload image.";
            exit;
        }
    } else {
        echo "Error: Invalid file type. Only JPG, JPEG, PNG, GIF are allowed.";
        exit;
    }
} elseif ($email !== $user_id && $old_image_path_db) {
    // No new image, but email changed. Rename the old image file.
    $old_full_path = '../' . $old_image_path_db;
    if (file_exists($old_full_path)) {
        $old_file_ext = pathinfo($old_full_path, PATHINFO_EXTENSION);
        $new_filename = $email . '.' . $old_file_ext;
        $new_image_path_db = 'academy_img/' . $new_filename;
        $new_full_path = '../academy_img/' . $new_filename;

        if (rename($old_full_path, $new_full_path)) {
            $image_path = $new_image_path_db; // Update path to the new renamed file
        }
    }
}

// Use prepared statements to prevent SQL injection
$sql_clients = "UPDATE academy SET email=?, address=?, mobile=?, password=?, image_path=? WHERE email=?";
$stmt_clients = $conn->prepare($sql_clients);
// The password from the form is used directly, assuming it can be empty or filled
$password_to_update = !empty($new_password) ? $new_password : $_POST['password'];
$stmt_clients->bind_param("ssssss", $email, $address, $mobile, $password_to_update, $image_path, $user_id);

if ($stmt_clients->execute()) {
    if ($email !== $user_id) {
        $_SESSION['username'] = $email;
    }
} else {
    echo "Error updating profile: " . $stmt_clients->error . "<br>";
    $stmt_clients->close();
    $conn->close();
    exit;
}
$stmt_clients->close();

// Update users table only if a new password is provided
if (!empty($new_password)) {
    $sql_users = "UPDATE users SET password=? WHERE email=?";
    $stmt_users = $conn->prepare($sql_users);
    $stmt_users->bind_param("ss", $new_password, $user_id);
    
    if (!$stmt_users->execute()) {
        echo "Error updating password: " . $stmt_users->error . "<br>";
    }
    $stmt_users->close();
}

// If email was changed, update it in the users table as well
if ($email !== $user_id) {
    $sql_update_email_users = "UPDATE users SET email=? WHERE email=?";
    $stmt_update_email = $conn->prepare($sql_update_email_users);
    $stmt_update_email->bind_param("ss", $email, $user_id);
    if (!$stmt_update_email->execute()) {
        // Handle error if needed, but don't block the success message
    }
    $stmt_update_email->close();
}

echo "<script>
    alert('Profile updated Successfully!');
    window.location.href = 'student_profile.php';
</script>";

$conn->close();
exit();
