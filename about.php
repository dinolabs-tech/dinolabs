<?php
/**
 * about.php
 *
 * This file displays the "About Us" page of the website.
 * It includes information about the company's mission, services, and team.
 */

// Start the session to manage user sessions
session_start();

// Include the database connection file to establish a connection to the database
include("db_connect.php");
?>
<!DOCTYPE html>
<!--
This file, about.php, is dedicated to displaying the "About Us" page of the Dinolabs Tech Services website.
It provides comprehensive information about the company's mission, what it offers, why clients should choose them,
and a general overview of "Who We Are." The page is structured using Bootstrap for responsiveness and
includes various sections to present this information clearly and engagingly.
PHP includes are utilized to modularize common components such as the head, topbar, navbar, footer, and scripts.
-->
<html lang="en">

<head>
    <!-- Set the title of the page, which appears in the browser tab. -->
    <title>About Us</title>
</head>
<?php
/**
 * Includes the head component. This file typically contains:
 * - Meta tags for character set, viewport, and compatibility.
 * - Page title (though already set above, this might include a default or additional title logic).
 * - Favicon link.
 * - Google Web Fonts (e.g., Open Sans, Poppins).
 * - Icon font libraries (e.g., Font Awesome, Bootstrap Icons).
 * - Vendor CSS files (e.g., Animate.css, Owl Carousel).
 * - Bootstrap CSS framework.
 * - Custom CSS styles for the website.
 */
include('components/head.php'); ?>

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
    <!-- This section contains the main navigation bar and the page header with the "About Us" title. -->
    <div class="container-fluid position-relative p-0">
        <?php
        /**
         * Includes the navbar component. This file typically contains:
         * - The main navigation menu with links to different sections of the website (e.g., Home, About, Services, Blog, Contact).
         * - Branding or logo.
         * - Responsive navigation toggler for mobile devices.
         */
        include('components/navbar.php'); ?>

        <!-- Page Header for About Us -->
        <!-- This div creates a styled header section specifically for the "About Us" page,
             featuring a background image/color and the main page title. -->
        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <!-- Display the "About Us" heading, animated to zoom in. -->
                    <h1 class="display-4 text-white animated zoomIn">About Us</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Mission, Offerings, and Why Choose Us Section Start -->
    <!-- This section presents key information about the company in a three-column layout:
         Our Mission, What We Offer (services), and Why Choose Dinolabs. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <!-- Display the section title, emphasizing innovation and progress. -->
                <h5 class="fw-bold text-primary text-uppercase">Innovating Solutions. Empowering Progress.</h5>
                <!-- The commented out line below suggests a previous or alternative heading. -->
                <!-- <h1 class="mb-0">We are Offering Competitive Prices for Our Clients</h1> -->
            </div>
            <div class="row g-0">
                <!-- Our Mission Column -->
                <!-- This column details the company's core mission statement. -->
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="bg-light rounded">
                        <div class="border-bottom py-4 px-5 mb-4">
                            <!-- Heading for the mission statement. -->
                            <h4 class="text-primary mb-1">Our Mission</h4>
                        </div>
                        <div class="p-5 pt-0">
                            <!-- The actual mission statement text. -->
                            <p>
                                To build and deliver smart, efficient, and user-friendly technology solutions that solve real-world problems and empower our clients to thrive in the digital age.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- What We Offer Column -->
                <!-- This central column lists the various services and solutions provided by Dinolabs. -->
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="bg-white rounded shadow position-relative" style="z-index: 1;">
                        <div class="border-bottom py-4 px-5 mb-4">
                            <!-- Heading for the services offered. -->
                            <h4 class="text-primary mb-1">What We Offer</h4>
                        </div>
                        <div class="p-5 pt-0">
                            <!-- List of services, each with a check icon. -->
                            <div class="d-flex justify-content-between mb-3"><span>Custom Software Development</span><i
                                    class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Educationl Management
                                    Systems</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Sales Management Solutions</span><i
                                    class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Pharmacy Solutions</span><i
                                    class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-2"><span>Web Design & Development</span><i
                                    class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-2"><span>Database Management</span><i
                                    class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-2"><span>Technology Consulting</span><i
                                    class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-2"><span>IT Training and Support</span><i
                                    class="fa fa-check text-primary pt-1"></i></div>
                        </div>
                    </div>
                </div>
                <!-- Why Choose Dinolabs? Column -->
                <!-- This column outlines the competitive advantages and reasons for choosing Dinolabs. -->
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                    <div class="bg-light rounded">
                        <div class="border-bottom py-4 px-5 mb-4">
                            <!-- Heading for the reasons to choose Dinolabs. -->
                            <h4 class="text-primary mb-1">Why Choose Dinolabs?</h4>
                        </div>
                        <div class="p-5 pt-0">
                            <!-- Explanation of why Dinolabs is a preferred partner. -->
                            <p>
                                We combine deep industry knowledge with advanced technical expertise to create impactful
                                solutions. Our commitment to excellence, affordable pricing, and strong customer support
                                make us a trusted partner for digital transformation.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mission, Offerings, and Why Choose Us Section End -->


    <!-- Who We Are Section Start -->
    <!-- This section provides a more detailed narrative about the company, its values, and key attributes.
         It includes descriptive text, a list of features, and an accompanying image. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <!-- The commented out line below suggests a previous or alternative subheading. -->
                        <!-- <h5 class="fw-bold text-primary text-uppercase">About Us</h5> -->
                        <!-- Main heading for the "Who We Are" section. -->
                        <h1 class="mb-0">Who We Are</h1>
                    </div>
                    <!-- Detailed description of Dinolabs Tech Services. -->
                    <p class="mb-4">
                        Dinolabs Tech Services is a forward-thinking technology company committed to delivering
                        innovative software solutions that drive digital transformation across various sectors.
                        With a passion for quality and a user-centric approach, we help businesses, schools, and
                        organizations achieve their goals through reliable and scalable technologies.
                    </p>
                    <div class="row g-0 mb-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <!-- Feature item: Award Winning. -->
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Award Winning</h5>
                            <!-- Feature item: Professional Staff. -->
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Professional Staff</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                            <!-- Feature item: 24/7 Support. -->
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>24/7 Support</h5>
                            <!-- Feature item: Fair Prices. -->
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Fair Prices</h5>
                        </div>
                    </div>
                </div>
                <!-- Image display for the "Who We Are" section, providing a visual context. -->
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <!-- Image for the about us section, animated to zoom in. -->
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s"
                            src="img/about.jpg" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Who We Are Section End -->


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
