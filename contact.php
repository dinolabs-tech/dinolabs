<?php 
// Start the session
session_start();
?>

<!DOCTYPE html>
<!--
contact.php

This file displays the "Contact Us" page of the Dinolabs Tech Services website.
It provides contact information (phone, email, address) and a contact form for visitors to send messages.
The page also includes an embedded Google Map to show the office location.
Modular components for head, topbar, navbar, footer, and scripts are included for consistency.
Session messages are used to display success or error feedback after form submission.
-->
<html lang="en">

<head>
    <!-- Set the title of the page, which appears in the browser tab. -->
    <title>Contact</title>
</head>
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

    <!-- Page Header for Contact Us -->
    <!-- This div creates a styled header section specifically for the "Contact Us" page,
         featuring a background image/color and the main page title. -->
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <!-- Display the "Contact Us" heading, animated to zoom in. -->
                <h1 class="display-4 text-white animated zoomIn">Contact Us</h1>
            </div>
        </div>
    </div>


    <!-- Contact Section Start -->
    <!-- This section provides contact details and a form for users to send messages. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <!-- Section Title for Contact Us -->
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <!-- Subheading for the contact section. -->
                <h5 class="fw-bold text-primary text-uppercase">Contact Us</h5>
                <!-- Main heading encouraging users to reach out. -->
                <h1 class="mb-0">If You Have Any Query, Feel Free To Contact Us</h1>
            </div>
            <!-- Contact Details Row -->
            <!-- This row displays various contact methods: phone, email, and physical address. -->
            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <!-- Contact Item: Phone Number -->
                    <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.1s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Call to ask any question</h5>
                            <h6 class="text-primary mb-0">+234 813 772 6887</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Contact Item: Email Address -->
                    <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.4s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Email to get free quote</h5>
                            <h6 class="text-primary mb-0">enquiries@dinolabstech.com</h6>
                            <!-- The commented out line below suggests an alternative email address. -->
                            <!--<h6 class="text-primary mb-0">dinolabs.tech@gmail.com</h6>-->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Contact Item: Office Address -->
                    <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.8s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Visit our office</h5>
                            <h6 class="text-primary mb-0">Suite 5, 5th Floor, TISCO Building, Alagbaka Akure, Ondo State, Nigeria.</h6>
                            <!-- The commented out line below suggests an alternative address. -->
                            <!--<h6 class="text-primary mb-0">Plot 2 ireti Ayo street off Aule GRA, Ondo State, Nigeria</h6>-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact Form and Google Map Row -->
            <div class="row g-5">
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                    <!-- Success or Error Message Display Section -->
                    <!-- This section conditionally displays feedback messages to the user after form submission. -->
                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success" style="margin-top: 20px;">
                            <?php 
                            echo $_SESSION['success_message']; 
                            // Unset the session message after displaying it to prevent it from showing again on refresh.
                            unset($_SESSION['success_message']);
                            ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger" style="margin-top: 20px;">
                            <?php 
                            echo $_SESSION['error_message']; 
                            // Unset the session message after displaying it.
                            unset($_SESSION['error_message']);
                            ?>
                        </div>
                    <?php endif; ?>

                    <!-- Contact Form -->
                    <!-- This form allows visitors to send a message to the company.
                         It uses POST method and submits data to 'send-message.php'. -->
                    <form method="post" action="send-message.php">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <!-- Input field for the sender's name. -->
                                <input type="text" class="form-control border-0 bg-light px-4"  id="name" name="name" placeholder="Your Name" style="height: 55px;" required>
                            </div>
                            <div class="col-md-6">
                                <!-- Input field for the sender's email address. -->
                                <input type="email" class="form-control border-0 bg-light px-4"  id="email" name="email" placeholder="Your Email" style="height: 55px;" email>
                            </div>
                            <div class="col-12">
                                <!-- Input field for the message subject. -->
                                <input type="text" class="form-control border-0 bg-light px-4"  id="subject" name="subject" placeholder="Subject" style="height: 55px;" required>
                            </div>
                            <div class="col-12">
                                <!-- Textarea for the message content. -->
                                <textarea class="form-control border-0 bg-light px-4 py-3" rows="4" id="message" name="message" placeholder="Message" required></textarea>
                            </div>
                            <div class="col-12">
                                <!-- Submit button for the contact form. -->
                                <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Google Map Embed -->
                <!-- This column displays an embedded Google Map showing the company's office location. -->
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d640.6690182300736!2d5.2145191194978935!3d7.252504593673251!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sng!4v1745751141530!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Section End -->


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
