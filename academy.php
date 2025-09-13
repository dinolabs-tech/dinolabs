<?php
/**
 * academy.php
 *
 * This file displays the academy page, listing available courses.
 */

// Start the session to manage user sessions
session_start();

// Include the database connection file to establish a connection to the database
include('db_connect.php');

// SQL query to fetch all courses from the 'courses' table
$sql = "SELECT * FROM courses";
// Execute the query and store the result
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<!--
This file, academy.php, is responsible for displaying the "Academy" page of the Dinolabs Tech Services website.
It lists all available courses fetched from the database, presenting them as clickable cards.
Each card provides a course name, description, duration, and price, linking to a course registration page.
The page utilizes Bootstrap for responsive design and includes modular components for the head, topbar, navbar, footer, and scripts.
-->
<html lang="en">

<?php
/**
 * Includes the main head component. This file typically contains:
 * - Meta tags for character set, viewport, and compatibility.
 * - Favicon link.
 * - Google Web Fonts (e.g., Open Sans, Poppins).
 * - Icon font libraries (e.g., Font Awesome, Bootstrap Icons).
 * - Vendor CSS files (e.g., Animate.css, Owl Carousel).
 * - Bootstrap CSS framework.
 * - Custom CSS styles for the website.
 */
include('components/head.php'); ?>
<?php
/**
 * Includes the backend head component. This might contain additional
 * stylesheets or scripts specifically required for backend-related functionalities
 * or components, ensuring all necessary resources are loaded.
 */
include('backend/components/head.php'); ?>

<body>

    <!-- Topbar Start -->
    <!-- This section includes the top navigation bar, which typically contains contact information,
         social media links, or other utility elements at the very top of the page. -->
    <?php
    /**
     * Includes the topbar component. This section usually contains:
     * - Contact information (email, phone).
     * - Social media links.
     * - A small navigation or utility links.
     */
    include('components/topbar.php'); ?>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <!-- This section contains the main navigation bar. -->
    <?php
    /**
     * Includes the navbar component. This file typically contains:
     * - The main navigation menu with links to different sections of the website (e.g., Home, About, Services, Blog, Contact).
     * - Branding or logo.
     * - Responsive navigation toggler for mobile devices.
     */
    include('components/navbar.php'); ?>
    <!-- Navbar End -->

    <!-- Page Header for Academy -->
    <!-- This div creates a styled header section specifically for the "Academy" page,
         featuring a background image/color and the main page title. -->
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <!-- Display the "Academy" heading, animated to zoom in. -->
                <h1 class="display-4 text-white animated zoomIn">Academy</h1>
            </div>
        </div>
    </div>

    <!-- Courses Listing Section Start -->
    <!-- This section dynamically displays all available courses fetched from the database.
         Each course is presented as a clickable card, leading to a registration page. -->
    <div class="container-fluid py-1 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-1">
            <div class="row mb-3">
                <?php
                // Check if there are any courses returned from the database query.
                if ($result->num_rows): ?>
                    <?php
                    // Loop through each course and display its details in a card format.
                    while ($row = $result->fetch_assoc()): ?>
                        <div class="col-md-4 mb-3">
                            <!-- Link to the course registration page, passing the course ID. -->
                            <a href="register_course.php?id=<?php echo $row['id']; ?>">
                                <!-- Course Card -->
                                <div class="card card-primary card-round" style="border-radius: 10px;">
                                    <!-- Card Header: Course Name -->
                                    <div class="card-header bg-success rounded">
                                        <div class="card-head-row">
                                            <!-- Display the course name, ensuring special characters are properly escaped. -->
                                            <div class="card-title text-white" style="color:black;"><strong><?= htmlspecialchars($row['course_name'])?></strong></div>
                                        </div>
                                    </div>
                                    <!-- Card Body: Course Description and Duration -->
                                    <div class="card-body pb-0">
                                        <!-- Display the course description. -->
                                        <?=$row['description']?>
                                        <!-- Display the course duration, ensuring special characters are properly escaped. -->
                                        <p class="mt-2">Duration: <?= htmlspecialchars($row['duration'])?></p>
                                    </div>
                                    <!-- Card Footer: Course Price -->
                                    <div class="card-footer pb-0">
                                        <div style="text-align: right;color:black;" class="mb-4 mt-2">
                                           <!-- Display the course price, formatted as currency. -->
                                           <strong> &#8358; <?= number_format($row['price'])?></strong>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <!-- Message displayed if no courses are found in the database. -->
                    <p>No posts found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Courses Listing Section End -->

    <!-- Footer Start -->
    <!-- This section includes the website's footer, containing copyright information,
         links, and other standard footer content. -->
    <?php
    /**
     * Includes the footer component. This file typically contains:
     * - Copyright information.
     * - Quick links to other pages.
     * - Contact details.
     * - Social media links.
     * - Newsletter subscription forms.
     */
    include('components/footer.php'); ?>
    <!-- Footer End -->

    <!-- Back to Top Button -->
    <!-- This button provides a smooth scroll-to-top functionality for user convenience.
         It is typically hidden until the user scrolls down a certain distance. -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

    <?php
    /**
     * Includes the scripts component. This file typically contains:
     * - jQuery library.
     * - Bootstrap JavaScript bundle.
     * - Vendor JavaScript files (e.g., Waypoints, CounterUp, Owl Carousel, Easing, WOW.js).
     * - Custom JavaScript for interactive elements and animations.
     */
    include('components/scripts.php'); ?>

</body>

</html>
