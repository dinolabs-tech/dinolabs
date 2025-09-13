<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include("db_connect.php");

$comment_id = $_GET["id"];

$sql = "SELECT * FROM comments WHERE id = $comment_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Comment not found";
    exit();
}

$comment = $result->fetch_assoc();
$post_id = $comment["post_id"];
?>


<!DOCTYPE html>
<!--
edit_comment.php

This file provides a web interface for authenticated users (likely administrators or moderators)
to edit an existing comment on a blog post. It fetches the details of a specific comment
(identified by its ID from GET parameters) and pre-fills a form with its current content.
Upon form submission, the updated content is sent to 'update_comment.php' to save the changes.
The page also retrieves the associated post ID to ensure proper redirection after the update.
User authentication is required, redirecting unauthenticated users to the login page.
Modular components for head, topbar, navbar, footer, and scripts are included for consistency.
-->
<html lang="en">

<?php 
// Include the head component. This file typically contains:
// - Meta tags for character set, viewport, and compatibility.
// - Favicon link.
// - Google Web Fonts (e.g., Open Sans, Poppins).
// - Icon font libraries (e.g., Font Awesome, Bootstrap Icons).
// - Vendor CSS files (e.g., Animate.css, Owl Carousel).
// - Bootstrap CSS framework.
// - Custom CSS styles for the website.
include('components/head.php'); ?>

<body>
    <!-- Topbar Start -->
    <!-- This section includes the top navigation bar, which typically contains contact information,
         social media links, or other utility elements at the very top of the page. -->
    <?php 
    // Include the topbar component.
    include('components/topbar.php'); ?>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <!-- This section contains the main navigation bar. -->
    <?php 
    // Include the navbar component.
    include('components/navbar.php'); ?>
    <!-- Navbar End -->

    <!-- Page Header for Edit Comment -->
    <!-- This div creates a styled header section specifically for the "Edit Comment" page,
         featuring a background image/color and the main page title. -->
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <!-- Display the "Edit Comment" heading, animated to zoom in. -->
                <h1 class="display-4 text-white animated zoomIn">Edit Comment</h1>
            </div>
        </div>
    </div>

    <!-- Edit Comment Form Section Start -->
    <!-- This section contains the form for editing an existing comment. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
            <div class="bg-primary rounded p-5 wow zoomIn" data-wow-delay="0.9s">
                    <!-- Form to update the comment.
                         It uses the POST method and submits data to 'update_comment.php'. -->
                    <form action="update_comment.php" method="post">
                        <!-- Hidden input field to pass the comment ID to the update script. -->
                        <input type="hidden" name="id" value="<?php echo $comment_id; ?>">
                        <!-- Hidden input field to pass the associated post ID for redirection after update. -->
                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">

                        <div class="row g-3">
                            <div class="col-12">
                                <!-- Textarea for the comment content, pre-filled with the current content. -->
                                <textarea class="form-control bg-light border-0" id="comment" name="comment"
                                    placeholder="Enter Post Comment" style="height: 150px;"
                                    required><?php echo htmlspecialchars($comment["content"]); ?></textarea>
                            </div>

                            <div class="col-12">
                                <!-- Submit button to update the comment. -->
                                <button type="submit" class="btn btn-dark w-100 py-3">Update Comment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</div>
        </div>
    </div>
    <!-- Edit Comment Form Section End -->

    <!-- Footer Start -->
    <!-- This section includes the website's footer, containing copyright information,
         links, and other standard footer content. -->
    <?php 
    // Include the footer component.
    include('components/footer.php'); ?>
    <!-- Footer End -->

    <!-- Back to Top Button -->
    <!-- This button provides a smooth scroll-to-top functionality for user convenience.
         It is typically hidden until the user scrolls down a certain distance. -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

    <?php
    // Include the scripts component. This file typically contains:
    // - jQuery library.
    // - Bootstrap JavaScript bundle.
    // - Vendor JavaScript files (e.g., Waypoints, CounterUp, Owl Carousel, Easing, WOW.js).
    // - Custom JavaScript for interactive elements and animations.
    include('components/scripts.php'); ?>
</body>

</html>
