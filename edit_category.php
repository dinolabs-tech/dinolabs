<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include("db_connect.php");

$category_id = $_GET["id"];

$sql = "SELECT * FROM categories WHERE id = $category_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Category not found";
    exit();
}

$category = $result->fetch_assoc();
?>

<!DOCTYPE html>
<!--
edit_category.php

This file provides a web interface for administrators to edit an existing blog post category.
It fetches the details of a specific category (identified by its ID from GET parameters)
and pre-fills a form with its current name and description.
Upon form submission, the data is sent to 'update_category.php' to save the changes.
The page handles user authentication, redirecting unauthenticated users to the login page.
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

    <!-- Page Header for Edit Category -->
    <!-- This div creates a styled header section specifically for the "Edit Category" page,
         featuring a background image/color and the main page title. -->
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <!-- Display the "Edit Category" heading, animated to zoom in. -->
                <h1 class="display-4 text-white animated zoomIn">Edit Category</h1>
            </div>
        </div>
    </div>

    <!-- Edit Category Form Section Start -->
    <!-- This section contains the form for editing an existing category. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-12 wow slideInUp" data-wow-delay="0.3s">
                    <!-- Form to update the category.
                         It uses the POST method and submits data to 'update_category.php'. -->
                    <form action="update_category.php" method="post">
                        <!-- Hidden input field to pass the category ID to the update script. -->
                        <input type="hidden" name="id" value="<?php echo $category_id; ?>">
                        <div class="row g-3">
                            <div class="col-12">
                                <!-- Input field for the category name, pre-filled with the current name. -->
                                <input type="text" class="form-control border-0 bg-light px-4" placeholder="Name" style="height: 55px;"  id="name" name="name" value="<?php echo htmlspecialchars($category["name"]); ?>" required>
                            </div>
                            <div class="col-12">
                                <!-- Textarea for the category description, pre-filled with the current description. -->
                                <textarea class="form-control border-0 bg-light px-4 py-3" rows="4" placeholder="Description" id="description" name="description" required><?php echo htmlspecialchars($category["description"]); ?></textarea>
                            </div>
                            <div class="col-12">
                                <!-- Submit button to update the category. -->
                                <button class="btn btn-primary w-100 py-3" type="submit">Update Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Category Form Section End -->

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
