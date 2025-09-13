<?php
// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    // Redirect to the index page
    header("Location: index.php");
    exit();
}

// Include the database connection file
include("db_connect.php");
?>

<!DOCTYPE html>
<!--
create_post.php

This file provides a web interface for authenticated users (likely administrators or content creators)
to create new blog posts. It includes a form for entering the post title, content (using TinyMCE editor),
uploading an image, and selecting a category.
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

    <!-- Page Header for Create Post -->
    <!-- This div creates a styled header section specifically for the "Create Post" page,
         featuring a background image/color and the main page title. -->
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <!-- Display the "Create Post" heading, animated to zoom in. -->
                <h1 class="display-4 text-white animated zoomIn">Create Post</h1>
            </div>
        </div>
    </div>

    <!-- Create Post Form Section Start -->
    <!-- This section contains the form for creating a new blog post. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="bg-primary rounded p-5 wow zoomIn" data-wow-delay="0.9s">
                    <!-- Form to save the post.
                         It uses the POST method, submits data to 'save_post.php', and supports file uploads (enctype="multipart/form-data").
                         'novalidate' prevents default browser validation, allowing custom JavaScript validation. -->
                    <form action="save_post.php" method="post" enctype="multipart/form-data" class="row g-4" novalidate>
                        <!-- Post Title Input Field -->
                        <div class="col-12">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Post Title" required>
                        </div>
                        <!-- Post Content Textarea (TinyMCE Editor) -->
                        <div class="col-12">
                            <textarea class="form-control" id="content" name="content" placeholder="Content" rows="6" ></textarea>
                        </div>
                        <!-- Image Upload Input Field -->
                        <div class="col-12">
                            <label for="image" class="form-label text-white">Upload Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <!-- Category Selection Dropdown -->
                        <div class="col-12">
                            <select class="form-select" id="category" name="category" required>
                                <option value="">Select Category</option>
                                <?php
                                // SQL query to fetch all available categories from the 'categories' table.
                                $sql_categories = "SELECT id, name FROM categories";
                                // Execute the query.
                                $result_categories = $conn->query($sql_categories);
                                // Check if there are any categories returned from the database.
                                if ($result_categories->num_rows > 0) {
                                    // Loop through each category and display it as an option in the dropdown.
                                    while ($row_category = $result_categories->fetch_assoc()) {
                                        echo "<option value='" . $row_category["id"] . "'>" . htmlspecialchars($row_category["name"]) . "</option>";
                                    }
                                } else {
                                    // If no categories are available, display a default option.
                                    echo "<option value=''>No categories available</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Submit Button for the Form -->
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-light px-5 py-2">Save Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Create Post Form Section End -->

    <script>
    // Initialize TinyMCE editor for the 'content' textarea.
    tinymce.init({
      selector: '#content', // Target the textarea with id 'content'.
      menubar: false,       // Hide the menubar.
      toolbar: 'undo redo | formatselect | bold italic underline superscript subscript | alignleft aligncenter alignright | bullist numlist outdent indent | table', // Configure toolbar buttons.
      plugins: 'lists',     // Enable the 'lists' plugin for list formatting.
      branding: false       // Hide the TinyMCE branding.
    });

    // Add an event listener to the form to perform custom validation before submission.
    document.querySelector('form').addEventListener('submit', function(e) {
      // Check if the content of the TinyMCE editor is empty after trimming whitespace.
      if (tinymce.get('content').getContent({ format: 'text' }).trim() === '') {
        // If content is empty, display an alert to the user.
        alert('Please enter some content.');
        // Prevent the form from being submitted.
        e.preventDefault();
      }
    });
  </script>

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
