<?php
session_start();

include("../db_connect.php");

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    if ($password == $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['name'] = $user['name'];

        if (isset($user['role_id'])) {
            $_SESSION['role_id'] = $user['role_id'];
        }
        $_SESSION['is_admin'] = $user['is_admin'];

        $role_id = $user['role_id'];
        switch ($role_id) {
            case 1:
                header("Location: index.php");
                $_SESSION['role'] = 'admin';
                break;
            case 2:
                header("Location: ../dashboard.php");
                $_SESSION['role'] = 'mod';
                break;
            case 3:
                header("Location: index.php");
                $_SESSION['role'] = 'staff';
                break;
            case 4:
                header("Location: index.php");
                $_SESSION['role'] = 'sec';
                break;
            default:
                // Get client details
                $sql_client = "SELECT * FROM clients WHERE user_id = " . $user['id'];
                $result_client = $conn->query($sql_client);

                if ($result_client->num_rows == 1) {
                    $client = $result_client->fetch_assoc();

                    // Check if client is active
                    if ($client['is_active'] == 0) {

                        header("Location: login.php?error=Sorry, your account has been deactivated. Please contact Dinolabs Support.");
                        exit;
                    }


                    // Set client session variables
                    $_SESSION['client_id'] = $client['id'];
                    $_SESSION['ceo_name'] = $client['ceo_name'];
                    $_SESSION['mobile'] = $client['mobile'];
                    $_SESSION['email'] = $client['email'];
                    $_SESSION['business_name'] = $client['business_name'];
                    $_SESSION['total_students'] = $client['total_students'];
                    $_SESSION['category'] = $client['category'];
                    $_SESSION['amount_per_student'] = $client['amount_per_student'];
                    $_SESSION['role'] = 'client';
                    $_SESSION['name'] = $client['ceo_name'];

                    header("Location: client_dashboard.php");
                } else {
                    header("Location: login.php?error=Client record not found.");
                }
                break;
        }

        include('audit_log.php');
        log_activity($user['id'], "User logged in");
        exit;
    } else {
        header("Location: login.php?error=Incorrect password");
        exit;
    }
} else {
    header("Location: login.php?error=Incorrect username");
    exit;
}
?>