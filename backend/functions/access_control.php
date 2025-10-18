<?php
// ...existing code...
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// ...existing code...

function check_access($allowed_roles) {
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
        header("Location: ../backend/login.php?error=Please log in to access this page.");
        exit();
    }

    if (!in_array($_SESSION['role'], $allowed_roles)) {
        // Redirect to a generic access denied page or dashboard based on role
        switch ($_SESSION['role']) {
            case 'admin':
            case 'mod':
            case 'staff':
            case 'sec':
                header("Location: ../backend/index.php?error=Access denied.");
                break;
            case 'client':
                header("Location: ../backend/client_dashboard.php?error=Access denied.");
                break;
            case 'student':
                header("Location: ../backend/student_dashboard.php?error=Access denied.");
                break;
            default:
                header("Location: ../backend/login.php?error=Access denied.");
                break;
        }
        exit();
    }
}

// Function to check if a user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Function to get the current user's role
function get_user_role() {
    return $_SESSION['role'] ?? null;
}
?>
