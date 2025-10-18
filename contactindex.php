<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        * {
            margin: 0;
            padding: 0;
        }
        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .contact-container {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            width: 900px;
        }
        .contact-container > div {
            padding: 30px;
        }
        .details-container {
            background-image: linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%);
        }
        .details-container > p {
            margin: 10px;
        }
        .details-container > h6 {
            margin: 25px;
        }
        .social {
            margin: 10px 35px;
        }
        .social > i {
            font-size: 25px;
            margin-right: 15px;
        }
    </style>
</head>
<body>

<div class="main">
    <div class="contact-container row">
        <div class="details-container col-6">
            <h2>Contact Us</h2>
            <p>Welcome to Lorem Ipsum Inc.! We value your feedback, inquiries, and suggestions. Feel free to reach out:</p>

            <h6><i class="fa-solid fa-location-dot"></i> 24 Lorem Ipsum St., District 2, Chicago</h6>
            <h6><i class="fa-solid fa-envelope"></i> loremipsum@gmail.com</h6>
            <h6><i class="fa-solid fa-phone"></i> (639) 234231</h6>

            <div class="social">
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-linkedin"></i>
                <i class="fa-brands fa-square-instagram"></i>
            </div>
        </div>

        <div class="form-container col-6">
           <?php session_start(); ?>

<!-- Success or Error Message Section -->
<?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success" style="margin-top: 20px;">
        <?php 
        echo $_SESSION['success_message']; 
        unset($_SESSION['success_message']); // Clear the message after displaying
        ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger" style="margin-top: 20px;">
        <?php 
        echo $_SESSION['error_message']; 
        unset($_SESSION['error_message']); // Clear the message after displaying
        ?>
    </div>
<?php endif; ?>

<!-- Your Contact Form -->
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
    <button type="submit" class="btn btn-primary form-control">Send Message &rarr;</button>
</form>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

</body>
</html>
