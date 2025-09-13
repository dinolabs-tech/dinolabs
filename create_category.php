<?php
// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

// Include the database connection file
include("db_connect.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the category name from the POST data
    $name = $_POST["name"];
    // Retrieve the category description from the POST data
    $description = $_POST["description"];

    // SQL query to insert a new category into the categories table
    $sql = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // Redirect to the manage categories page if the query was successful
        header("Location: manage_categories.php");
        exit();
    } else {
        // Display an error message if the query failed
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<!--
create_category.php

This file provides a web interface for administrators to create new blog post categories.
It includes a form where users can input a category name and description.
Upon submission, the data is processed by the same script (via POST request),
which inserts the new category into the 'categories' table in the database.
The page also handles user authentication, redirecting unauthenticated users to the login page.
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

    <!-- Page Header for Create Category -->
    <!-- This div creates a styled header section specifically for the "Create Category" page,
         featuring a background image/color and the main page title. -->
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <!-- Display the "Create Category" heading, animated to zoom in. -->
                <h1 class="display-4 text-white animated zoomIn">Create Category</h1>
            </div>
        </div>
    </div>

    <!-- Create Category Form Section Start -->
    <!-- This section contains the form for creating a new category. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-12 wow slideInUp" data-wow-delay="0.3s">
                    <!-- Form to create a new category.
                         It uses the POST method and submits data to 'create_category.php' (this same script). -->
                    <form action="create_category.php" method="post">
                        <div class="row g-3">
                            <div class="col-12">
                                <!-- Input field for the category name. -->
                                <input type="text" class="form-control border-0 bg-light px-4" placeholder="Category Name" style="height: 55px;"  id="name" name="name" required>
                            </div>
                            <div class="col-12">
                                <!-- Textarea for the category description. -->
                                <textarea class="form-control border-0 bg-light px-4 py-3" rows="4" placeholder="Description" id="description" name="description" required></textarea>
                            </div>
                            <div class="col-12">
                                <!-- Submit button to create the category. -->
                                <button class="btn btn-primary w-100 py-3" type="submit">Create Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Create Category Form Section End -->

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
