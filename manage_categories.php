<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}
include("db_connect.php");

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<!--
manage_categories.php

This file provides an administrative interface for managing blog post categories.
It displays a table of all existing categories, allowing administrators to view,
edit, or delete them. A button to create new categories is also provided.
The page uses DataTables for enhanced table functionality (pagination, search, sorting).
User authentication is required, redirecting unauthenticated users to the index page.
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

<!-- DataTables CSS: Links to the DataTables stylesheet for table styling and features. -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

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

    <!-- Page Header for Manage Categories -->
    <!-- This div creates a styled header section specifically for the "Manage Categories" page,
         featuring a background image/color and the main page title. -->
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <!-- Display the "Manage Categories" heading, animated to zoom in. -->
                <h1 class="display-4 text-white animated zoomIn">Manage Categories</h1>
            </div>
        </div>
    </div>

    <!-- Content Section Start -->
    <!-- This section contains the main content, including the "Create New Category" button and the categories table. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <div class="col-12 mb-4">
                    <!-- Button to navigate to the category creation page. -->
                    <a href="create_category.php" class="btn btn-primary w-100 py-3">Create New Category</a>
                </div>
            </div>

            <div class="row g-5">
                <div class="col-lg-12 wow slideInUp" data-wow-delay="0.3s">
                    <div class="table-responsive">
                        <!-- Table to display categories. DataTables is initialized on this table. -->
                        <table id="categoryTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Check if there are any categories returned from the database query.
                                if ($result->num_rows > 0) {
                                    // Loop through each category and display its details in a table row.
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                                        echo "<td>";
                                        // Link to edit the category, passing the category ID.
                                        echo "<a href='edit_category.php?id=" . $row["id"] . "' class='btn btn-sm btn-primary'>Edit</a> ";
                                        // Link to delete the category, with a JavaScript confirmation prompt.
                                        echo "<a href='delete_category.php?id=" . $row["id"] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this category?\")'>Delete</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    // Optionally, display a message if no categories are found.
                                    // This part is not explicitly in the original code but can be added for better UX.
                                    // echo "<tr><td colspan='3'>No categories found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Section End -->

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
    // - Bootstrap JavaScript bundle.
    // - Vendor JavaScript files (e.g., Waypoints, CounterUp, Owl Carousel, Easing, WOW.js).
    // - Custom JavaScript for interactive elements and animations.
    include('components/scripts.php'); ?>

    <!-- jQuery (needed for DataTables): Links to the jQuery library. -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS: Links to the DataTables JavaScript library. -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        // Initialize DataTables on the '#categoryTable' once the document is ready.
        $(document).ready(function () {
            $('#categoryTable').DataTable({
                "pageLength": 10, // Set the default number of rows per page to 10.
                "lengthMenu": [5, 10, 25, 50], // Provide options for changing the number of rows per page.
                "language": {
                    "search": "Search Categories:" // Customize the search input label.
                }
            });
        });
    </script>

</body>

</html>
