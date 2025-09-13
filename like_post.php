<?php
/**
 * like_post.php
 *
 * This script handles the liking of a blog post by a logged-in user.
 * It checks if the user is authenticated and if the post ID is provided.
 * It then verifies if the user has already liked the post to prevent duplicate likes.
 * If the user has not liked the post, it records the like in the 'likes' table
 * and increments the 'likes' count in the 'posts' table.
 * Finally, it redirects the user back to the original blog post page.
 */

// Start the session to manage user sessions.
session_start();
// Include the database connection file.
include 'db_connect.php';

// Check if the 'user_id' session variable is not set, meaning the user is not logged in.
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect the user to the login page.
    header("Location: login.php");
    exit(); // Terminate script execution after redirection.
}

// Check if the 'id' (post ID) is provided in the GET request.
if (isset($_GET['id'])) {
    // Retrieve the 'id' of the post from the GET request parameters.
    $post_id = $_GET['id'];
    // Retrieve the 'user_id' from the session, identifying the current logged-in user.
    $user_id = $_SESSION['user_id'];

    // --- Check for Existing Like ---
    // Prepare a SQL statement to check if the user has already liked this specific post.
    $stmt = $conn->prepare("SELECT * FROM likes WHERE user_id = ? AND post_id = ?");
    // Bind the user ID and post ID parameters to the prepared statement. "ii" indicates two integers.
    $stmt->bind_param("ii", $user_id, $post_id);
    // Execute the prepared statement.
    $stmt->execute();
    // Get the result set from the executed statement.
    $result = $stmt->get_result();

    // If no rows are returned, it means the user has not yet liked this post.
    if ($result->num_rows == 0) {
        // --- Add New Like ---
        // Prepare a SQL statement to insert a new record into the 'likes' table.
        $stmt = $conn->prepare("INSERT INTO likes (user_id, post_id) VALUES (?, ?)");
        // Bind the user ID and post ID parameters.
        $stmt->bind_param("ii", $user_id, $post_id);
        // Execute the insert statement.
        if ($stmt->execute()) {
            // If the like was successfully recorded, update the 'likes' count in the 'posts' table.
            $update_stmt = $conn->prepare("UPDATE posts SET likes = likes + 1 WHERE id = ?");
            // Bind the post ID parameter.
            $update_stmt->bind_param("i", $post_id);
            // Execute the update statement.
            $update_stmt->execute();
            // Close the update statement.
            $update_stmt->close();
        }
    }
    // Close the initial statement (for checking existing like).
    $stmt->close();
}

// Redirect the user back to the specific blog post page after processing the like/check.
// The 'post_id' is appended to the URL as a GET parameter.
header("Location: post.php?id=" . $post_id);
exit(); // Terminate script execution after redirection.
?>
