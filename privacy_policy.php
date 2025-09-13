<?php
session_start();

include("db_connect.php");
?>

<!DOCTYPE html>
<!--
privacy_policy.php

This file displays the Privacy Policy page for Dinolabs Tech Services.
It outlines how personal information is collected, used, disclosed, secured, and retained.
The policy emphasizes the company's commitment to privacy and compliance with legal requirements.
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
include('components/head.php');?>
<style>
        /* Custom CSS styles specifically for the Privacy Policy page content. */
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 0; color: #333; }
        header { background: #004080; color: #fff; padding: 20px 0; text-align: center; }
        main { padding: 20px; max-width: 900px; margin: auto; }
        h1, h2, h3 { color: #004080; }
        section { margin-bottom: 20px; }
        footer { background: #f4f4f4; text-align: center; padding: 10px; font-size: 0.9em; }
        .container { width: 90%; margin: auto; }
    </style>

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
    <div class="container-fluid position-relative p-0">
        <?php 
        // Include the navbar component.
        include('components/navbar.php'); ?>

        <!-- Page Header for Privacy Policy -->
        <!-- This div creates a styled header section specifically for the "Privacy Policy" page,
             featuring a background image/color and the main page title. -->
        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <!-- Display the "Privacy Policy" heading, animated to zoom in. -->
                    <h1 class="display-4 text-white animated zoomIn">Privacy Policy</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Main Content Area for Privacy Policy -->
    <main>
        <!-- Main Heading for the Privacy Policy Document -->
        <h1>Dinolabs Tech Services Privacy Policy</h1>
        <p>This policy covers how we use your personal information. We take your privacy seriously and will take all measures to protect your personal information.</p>
        <p>We are committed to protecting your privacy</p>
        <p>We collect the minimum amount of information about you that is commensurate with providing you with a satisfactory service. The purpose of this Privacy Policy to enable you to understand which personal identifying information ("PII", "Personal Information") of yours is collected, how and when we might use your information, who has access to this information, and how you can correct any inaccuracies in the information. To better protect your privacy, this policy explains our online information practices and the choices you can make about the way your information is collected and used. For easy access, we have made this policy available on our website.</p>

        <!-- Section: Information Collected -->
        <h2>Information Collected</h2>
        <p>We may collect any or all of the information you provide us via automated means such as communications profiles. The personal information you give us may include your name, address, telephone number, and email address, dates of service provided, types of service provided, payment history, manner of payment, amount of payments, date of payments or other payment information. The financial information will only be used to bill you for the products and services you purchased. If you purchase by credit card, this information is forwarded to your credit card provider. All sensitive information is collected on a secure server and data is transferred.</p>

        <!-- Section: Information Use -->
        <h2>Information Use</h2>
        <p>This information is used for billing and to provide service and support to our customers. We may also study this information to determine our customers' needs and provide support for our customers. All reasonable precautions are taken to prevent unauthorized access to this information. Our precautionary measures may require you to provide additional forms of identity should you wish to obtain information about your account details.</p>

        <!-- Section: What Constitutes your Consent? -->
        <h2>What Constitutes your Consent?</h2>
        <p>Where the processing of Personal Data is based on consent, we shall obtain the requisite consent at the time of collection of the Personal Data. In this regard, you consent to the processing of your Personal Data when you access our platforms or use our services, content, features, technologies, or functions offered on our website or other digital platforms. You can withdraw your consent at any time but such withdrawal will not affect the lawfulness of the processing of your data based on consent given before its withdrawal.</p>

        <!-- Section: Disclosing Information -->
        <h2>Disclosing Information</h2>
        <p>We do not disclose any personal information obtained about you from this website to third parties.</p>
        <p>We may use personal information to keep in contact with you and inform you of developments associated with our business. We may also disclose aggregate, anonymous data based on information collected from users to potential partners, our affiliates, and reputable third parties. We take all available measures to select affiliates and service providers that are ethical and provide similar privacy protection to their customers and the community. We do not make any representations about the practices and policies of these companies.</p>

        <!-- Section: Security and Retention of your Personal Data -->
        <h2>Security and Retention of your Personal Data</h2>
        <p>Your Personal Data is kept private and We make every effort to keep your Personal Data secure, including restricting access to your Personal Data with us on a need to know basis. We require our staff and any third parties who carry out any work on our behalf to comply with appropriate security standards to protect your Personal Data.</p>
        <p>We take appropriate measures to ensure that your Personal Data is only processed for the minimum period necessary in line with the purposes set out in this policy notice or as required by applicable laws until a time it is no longer required or has no use. Once your Personal Data is no longer required, we destroy it in a safe and secure manner.</p>

        <!-- Section: Compliance with Laws and Law Enforcement -->
        <h2>Compliance with Laws and Law Enforcement</h2>
        <p>We cooperate with government and law enforcement officials to enforce and comply with the law. We will disclose any information about Users upon valid request by government or law officials as we, in our sole discretion, believe necessary or appropriate to respond to claims and legal process (including without limitation subpoenas), to protect your property and rights, or the property and rights of a third party, to protect the safety of the public or any person, or stop activity we consider illegal or unethical.</p>

        <!-- Section: Changes to this Policy -->
        <h2>Changes to this Policy</h2>
        <p>Any changes to our Privacy Policy will be placed here and will supersede this version of our Policy. We will take reasonable steps to draw your attention to any changes in our Policy. However, to be on the safe side, we suggest that you read this document each time you use the website to ensure that it still meets with your approval.</p>
    </main>

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
