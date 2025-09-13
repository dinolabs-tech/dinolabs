<!DOCTYPE html>
<!--
contactindex.php

This file presents a simplified, standalone "Contact Us" page.
It features a two-column layout: one for displaying contact details and social media links,
and the other for a contact form. The page uses Bootstrap for basic styling and responsiveness,
along with Font Awesome for icons. Session messages are used to provide feedback on form submission.
-->
<html lang="en">
<head>
    <!-- Set character set for the document to UTF-8 for proper text rendering. -->
    <meta charset="UTF-8">
    <!-- Configure the viewport for responsive design, ensuring the page scales correctly on all devices. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Set the title of the page, which appears in the browser tab. -->
    <title>Contact Us</title>

    <!-- Bootstrap CSS: Links to the Bootstrap 4.6.2 stylesheet for responsive design and UI components. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome CSS: Links to the Font Awesome 6.5.1 stylesheet for various icons. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        /* Custom CSS styles for this contact page. */

        /* Universal reset for margins and paddings to ensure consistent spacing. */
        * {
            margin: 0;
            padding: 0;
        }
        /* Main container style: Centers its content vertically and horizontally on the page. */
        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Takes full viewport height. */
        }
        /* Contact container style: Applies a shadow and sets a fixed width for the contact form and details block. */
        .contact-container {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; /* Adds a subtle shadow. */
            width: 900px; /* Fixed width for the container. */
        }
        /* Padding for direct children divs of the contact container. */
        .contact-container > div {
            padding: 30px;
        }
        /* Details container style: Sets a linear gradient background for the left-hand side. */
        .details-container {
            background-image: linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%);
        }
        /* Margins for paragraphs within the details container. */
        .details-container > p {
            margin: 10px;
        }
        /* Margins for headings within the details container. */
        .details-container > h6 {
            margin: 25px;
        }
        /* Styling for the social media icon container. */
        .social {
            margin: 10px 35px;
        }
        /* Styling for individual social media icons. */
        .social > i {
            font-size: 25px; /* Sets icon size. */
            margin-right: 15px; /* Adds space between icons. */
        }
    </style>
</head>
<body>

<!-- Main Wrapper for the Contact Page Content -->
<div class="main">
    <!-- Contact Container: Holds both the details and form sections, arranged in a row. -->
    <div class="contact-container row">
        <!-- Details Container (Left Side): Displays company contact information and social links. -->
        <div class="details-container col-6">
            <h2>Contact Us</h2>
            <p>Welcome to Lorem Ipsum Inc.! We value your feedback, inquiries, and suggestions. Feel free to reach out:</p>

            <!-- Location Detail -->
            <h6><i class="fa-solid fa-location-dot"></i> 24 Lorem Ipsum St., District 2, Chicago</h6>
            <!-- Email Detail -->
            <h6><i class="fa-solid fa-envelope"></i> loremipsum@gmail.com</h6>
            <!-- Phone Detail -->
            <h6><i class="fa-solid fa-phone"></i> (639) 234231</h6>

            <!-- Social Media Icons -->
            <div class="social">
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-linkedin"></i>
                <i class="fa-brands fa-square-instagram"></i>
            </div>
        </div>

        <!-- Form Container (Right Side): Contains the contact form and feedback messages. -->
        <div class="form-container col-6">
           <?php 
           // Start the session. This is crucial for managing session-based messages (e.g., success/error).
           session_start(); 
           ?>

            <!-- Success Message Section -->
            <!-- Displays a success alert if a 'success_message' is set in the session. -->
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success" style="margin-top: 20px;">
                    <?php 
                    echo $_SESSION['success_message']; 
                    // Clear the message after displaying it to prevent it from reappearing on page refresh.
                    unset($_SESSION['success_message']); 
                    ?>
                </div>
            <?php endif; ?>

            <!-- Error Message Section -->
            <!-- Displays an error alert if an 'error_message' is set in the session. -->
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger" style="margin-top: 20px;">
                    <?php 
                    echo $_SESSION['error_message']; 
                    // Clear the message after displaying it.
                    unset($_SESSION['error_message']); 
                    ?>
                </div>
            <?php endif; ?>

            <!-- Contact Form -->
            <!-- This form allows users to submit their name, email, and message.
                 It uses the POST method and sends data to 'send-message.php' for processing. -->
            <form action="send-message.php" method="POST">
                <div class="form-group">
                    <label for="name">Your Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" name="message" id="message" cols="30" rows="4" required></textarea>
                </div>
                <!-- Submit button for the form. -->
                <button type="submit" class="btn btn-primary form-control">Send Message &rarr;</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS: Includes jQuery, Popper.js, and Bootstrap's JavaScript bundle for interactive components. -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

</body>
</html>
