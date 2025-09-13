<?php
/**
 * logout.php
 *
 * This script handles the user logout process.
 * It starts the session, destroys all session data, and then redirects the user
 * to the main index page, effectively logging them out of the application.
 */

// Start the session. This is necessary to access and manipulate session variables.
session_start();

// Destroy all data registered to the session. This effectively logs out the user
// by clearing all session-related information.
session_destroy();

// Redirect the user to the main index page after logging out.
header("Location: index.php");
exit(); // Terminate script execution after redirection to ensure no further code is run.
?>
