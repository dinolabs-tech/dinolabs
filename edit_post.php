<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

include("db_connect.php");

$post_id = $_GET["id"];

$sql = "SELECT * FROM posts WHERE id = $post_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Post not found";
    exit();
}

$post = $result->fetch_assoc();
?>


<!DOCTYPE html>
<!--
edit_post.php

This file provides a web interface for authenticated users (likely administrators or content creators)
to edit an existing blog post. It fetches the details of a specific post (identified by its ID from GET parameters)
and pre-fills a form with its current title, content (using TinyMCE editor), image, and category.
Users can update the post's information, including uploading a new image.
Upon form submission, the updated data is sent to 'update_post.php' to save the changes.
The page handles user authentication, redirecting unauthenticated users to the index page.
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
<!-- Include TinyMCE editor script from a CDN. This rich text editor allows for formatted content input. -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
    <script>
    // Initialize TinyMCE editor for the 'content' textarea.
    tinymce.init({
      selector: '#content', // Target the textarea with id 'content'.
      menubar: false,       // Hide the menubar.
      toolbar: 'undo redo | formatselect | bold italic underline superscript subscript | alignleft aligncenter alignright | bullist numlist outdent indent | table', // Configure toolbar buttons.
      plugins: 'lists',     // Enable the 'lists' plugin for list formatting.
      branding: false       // Hide the TinyMCE branding.
    });
  </script>

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

    <!-- Page Header for Edit Post -->
    <!-- This div creates a styled header section specifically for the "Edit Post" page,
         featuring a background image/color and the main page title. -->
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <!-- Display the "Edit Post" heading, animated to zoom in. -->
                <h1 class="display-4 text-white animated zoomIn">Edit Post</h1>
            </div>
        </div>
    </div>

    <!-- Edit Post Form Section Start -->
    <!-- This section contains the form for editing an existing blog post. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="col-lg-12">
                <div class="bg-primary rounded h-100 d-flex align-items-center p-5 wow zoomIn" data-wow-delay="0.9s">
                    <!-- Form to update the post.
                         It uses the POST method, submits data to 'update_post.php', and supports file uploads (enctype="multipart/form-data"). -->
                    <form action="update_post.php" method="post" enctype="multipart/form-data" class="w-100">
                        <!-- Hidden input field to pass the post ID to the update script. -->
                        <input type="hidden" name="id" value="<?php echo $post_id; ?>">
                        <div class="row g-3">

                            <div class="col-12">
                                <label for="title" class="text-white">Title:</label>
                                <!-- Input field for the post title, pre-filled with the current title. -->
                                <input type="text" class="form-control bg-light border-0" id="title" name="title"
                                    value="<?php echo htmlspecialchars($post["title"]); ?>"
                                    placeholder="Enter Post Title" style="height: 55px;" required>
                            </div>

                            <div class="col-12">
                                <label for="content" class="text-white">Content:</label>
                                <!-- Textarea for the post content, pre-filled with the current content.
                                     This textarea is enhanced by the TinyMCE editor. -->
                                <textarea class="form-control bg-light border-0" id="content" name="content"
                                    placeholder="Enter Post Content" style="height: 150px;"
                                    required><?php echo htmlspecialchars($post["content"]); ?></textarea>
                            </div>

                            <div class="col-12">
                                <label for="image" class="text-white">Image:</label>
                                <!-- Input field for uploading a new image. -->
                                <input type="file" class="form-control bg-light border-0" id="image" name="image"
                                    style="height: 55px;">
                                <?php
                                // Display the current image if one exists.
                                if (!empty($post["image_path"])): ?>
                                    <div class="mt-2">
                                        <img src="assets/images/<?php echo htmlspecialchars($post["image_path"]); ?>"
                                            alt="Blog Image" style="max-width: 100px;">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-12">
                                <label for="category" class="text-white">Category:</label>
                                <!-- Dropdown for selecting the post's category, pre-selecting the current category. -->
                                <select class="form-control form-select bg-light border-0" id="category" name="category"
                                    style="height: 55px;" required>
                                    <option value="">Select Category</option>
                                    <?php
                                    // SQL query to fetch all available categories.
                                    $sql_categories = "SELECT id, name FROM categories";
                                    // Execute the query.
                                    $result_categories = $conn->query($sql_categories);
                                    // Check if categories are available.
                                    if ($result_categories->num_rows > 0) {
                                        // Loop through each category to populate the dropdown options.
                                        while ($row_category = $result_categories->fetch_assoc()) {
                                            // Mark the option as 'selected' if its ID matches the post's current category ID.
                                            $selected = ($post["category_id"] == $row_category["id"]) ? "selected" : "";
                                            echo "<option value='" . $row_category["id"] . "' $selected>" . htmlspecialchars($row_category["name"]) . "</option>";
                                        }
                                    } else {
                                        // Display a default option if no categories are available.
                                        echo "<option value=''>No categories available</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12">
                                <!-- Submit button to update the post. -->
                                <button type="submit" class="btn btn-dark w-100 py-3">Update Post</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Post Form Section End -->

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
