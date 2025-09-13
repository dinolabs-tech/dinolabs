<?php
include 'db_connect.php';


// Flutterwave payment success redirect handler
if (isset($_GET['status']) && $_GET['status'] == 'paid' && isset($_GET['form_data'])) {
    $decoded = json_decode(base64_decode($_GET['form_data']), true);

    if ($decoded) {
        extract($decoded);

        $course_id = $_GET["id"];

        $image_path = ''; // You may enhance this by storing the image before payment

        // Check if email exists
        $check_stmt = $conn->prepare("SELECT id FROM academy WHERE email = ?");
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $sql = "UPDATE academy SET 
                        name=?, gender=?, mobile=?, state=?, city=?, address=?, course_id=?, duration=?, year_enrolled=?, 
                        qualification=?, computer_literacy=?, nkin_name=?, nkin_mobile=?, nkin_email=?, 
                        spn_name=?, spn_mobile=?, spn_email=?, password=? WHERE email=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssisssssssssss", 
                $name, $gender, $mobile, $state, $city, $address, $course_id, $duration, $year_enrolled, 
                $qualification, $literacy, $kin_name, $kin_mobile, $kin_email, 
                $sponsor_name, $sponsor_mobile, $sponsor_email, $password, $email
            );
        } else {
            $stmt = $conn->prepare("INSERT INTO academy 
                (name, gender, email, mobile, state, city, address, course_id, duration, year_enrolled, 
                qualification, computer_literacy, nkin_name, nkin_mobile, nkin_email, 
                spn_name, spn_mobile, spn_email, image_path, password) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssissssssssssss", 
                $name, $gender, $email, $mobile, $state, $city, $address, $course_id, $duration, $year_enrolled, 
                $qualification, $literacy, $kin_name, $kin_mobile, $kin_email, 
                $sponsor_name, $sponsor_mobile, $sponsor_email, $image_path, $password
            );
        }

        if ($stmt->execute()) {
            echo "<script>alert('Payment successful and data saved.'); window.location.href = 'academy.php';</script>";
        } else {
            echo "Error saving data: " . $stmt->error;
        }

        $stmt->close();
        $check_stmt->close();
        exit();
    }
}

$course_id = $_GET["id"] ?? "";
if ($course_id == "") {
    header("Location: academy.php");
    exit();
}

$sql = "SELECT * FROM courses WHERE id = $course_id";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "Course not found";
    exit();
}
$course = $result->fetch_assoc();
?>

<?php
/**
 * register_course.php
 *
 * This file handles the course registration process, including displaying course details,
 * collecting student information through a form, and processing payments via Flutterwave.
 * Upon successful payment and data submission, it either updates an existing student record
 * or inserts a new one into the 'academy' table.
 * The page dynamically fetches course details based on a provided course ID.
 * Modular components for head, topbar, navbar, footer, and scripts are included for consistency.
 */

// Include the database connection file.
include 'db_connect.php';

// --- Flutterwave Payment Success Redirect Handler ---
// This block executes when Flutterwave redirects back to this page after a payment attempt.
// It checks for 'status=paid' and 'form_data' in the GET parameters.
if (isset($_GET['status']) && $_GET['status'] == 'paid' && isset($_GET['form_data'])) {
    // Decode the base64 encoded JSON string containing the form data.
    $decoded = json_decode(base64_decode($_GET['form_data']), true);

    // If decoding was successful, process the data.
    if ($decoded) {
        // Extract variables from the decoded JSON array into the current symbol table.
        extract($decoded);

        // Retrieve the course ID from GET parameters.
        $course_id = $_GET["id"];

        // Initialize image_path. This part might need enhancement if image upload is part of the payment flow.
        $image_path = ''; // You may enhance this by storing the image before payment

        // --- Check if Student Email Already Exists ---
        // Prepare a statement to check if a student with the given email already exists in the 'academy' table.
        $check_stmt = $conn->prepare("SELECT id FROM academy WHERE email = ?");
        // Bind the email parameter. "s" indicates a string.
        $check_stmt->bind_param("s", $email);
        // Execute the check statement.
        $check_stmt->execute();
        // Store the result to check the number of rows.
        $check_stmt->store_result();

        // If a student with this email exists, update their record.
        if ($check_stmt->num_rows > 0) {
            // SQL query to update an existing student's information.
            $sql = "UPDATE academy SET 
                        name=?, gender=?, mobile=?, state=?, city=?, address=?, course_id=?, duration=?, year_enrolled=?, 
                        qualification=?, computer_literacy=?, nkin_name=?, nkin_mobile=?, nkin_email=?, 
                        spn_name=?, spn_mobile=?, spn_email=?, password=? WHERE email=?";
            // Prepare the update statement.
            $stmt = $conn->prepare($sql);
            // Bind all parameters for the update query. "sssssssisssssssssss" defines the types of parameters.
            $stmt->bind_param("sssssssisssssssssss", 
                $name, $gender, $mobile, $state, $city, $address, $course_id, $duration, $year_enrolled, 
                $qualification, $literacy, $kin_name, $kin_mobile, $kin_email, 
                $sponsor_name, $sponsor_mobile, $sponsor_email, $password, $email
            );
        } else {
            // If no student with this email exists, insert a new record.
            $stmt = $conn->prepare("INSERT INTO academy 
                (name, gender, email, mobile, state, city, address, course_id, duration, year_enrolled, 
                qualification, computer_literacy, nkin_name, nkin_mobile, nkin_email, 
                spn_name, spn_mobile, spn_email, image_path, password) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            // Bind all parameters for the insert query. "sssssssissssssssssss" defines the types of parameters.
            $stmt->bind_param("sssssssissssssssssss", 
                $name, $gender, $email, $mobile, $state, $city, $address, $course_id, $duration, $year_enrolled, 
                $qualification, $literacy, $kin_name, $kin_mobile, $kin_email, 
                $sponsor_name, $sponsor_mobile, $sponsor_email, $image_path, $password
            );
        }

        // Execute the prepared statement (either INSERT or UPDATE).
        if ($stmt->execute()) {
            // If data is saved successfully, display a success message and redirect to the academy page.
            echo "<script>alert('Payment successful and data saved.'); window.location.href = 'academy.php';</script>";
        } else {
            // If there's an error saving data, display the error message.
            echo "Error saving data: " . $stmt->error;
        }

        // Close the prepared statements.
        $stmt->close();
        $check_stmt->close();
        exit(); // Terminate script execution after handling payment redirect.
    }
}

// --- Course ID Validation and Fetching ---
// Retrieve the course ID from GET parameters, defaulting to an empty string if not set.
$course_id = $_GET["id"] ?? "";
// If no course ID is provided, redirect to the academy page.
if ($course_id == "") {
    header("Location: academy.php");
    exit();
}

// SQL query to fetch details of the selected course.
$sql = "SELECT * FROM courses WHERE id = $course_id";
// Execute the query.
$result = $conn->query($sql);
// If no course is found with the given ID, display an error and terminate.
if ($result->num_rows == 0) {
    echo "Course not found";
    exit();
}
// Fetch the course details as an associative array.
$course = $result->fetch_assoc();
?>

<!DOCTYPE html>
<!--
register_course.php

This file provides a registration form for students to enroll in a specific course.
It dynamically displays details of the selected course and collects personal, educational,
and sponsor information from the student. The form integrates with Flutterwave for payment processing.
Upon successful payment, student data is saved or updated in the database.
Modular components for head, topbar, navbar, footer, and scripts are included for consistency.
-->
<html lang="en">

<head>
    <!-- Set the title of the page, which appears in the browser tab. -->
    <title> Registration form</title>
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
</head>

<body>
<?php 
// Include the topbar component.
include('components/topbar.php'); ?>
<?php 
// Include the navbar component.
include('components/navbar.php'); ?>

<!-- Page Header for Course Registration -->
<!-- This div creates a styled header section specifically for the course registration page,
     featuring a background image/color and the name of the course being registered for. -->
<div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
    <div class="row py-5">
        <div class="col-12 pt-lg-5 mt-lg-5 text-center">
            <!-- Display the course name as the page heading, animated to zoom in. -->
            <h1 class="display-4 text-white animated zoomIn"><?php echo htmlspecialchars($course['course_name']); ?></h1>
        </div>
    </div>
</div>

<!-- Course Registration Form Section Start -->
<!-- This section contains the detailed form for student registration and course enrollment. -->
<div class="container-fluid py-1 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-1">
        <!-- Registration Form -->
        <!-- The form uses enctype="multipart/form-data" in case image uploads are re-enabled.
             It is processed by JavaScript for Flutterwave integration. -->
        <form id="registrationForm" enctype="multipart/form-data">
            <div class="row g-3">
                <!-- Personal Information Fields -->
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control" style="border-radius: 10px;" placeholder="Name (Surname First)" required>
                </div>
                <div class="col-md-2">
                    <select style="border-radius: 10px;" name="gender" id="" class="form-control form-select" required>
                        <option value="" selected disabled>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input style="border-radius: 10px;" type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-md-2">
                    <input style="border-radius: 10px;" type="text" name="mobile" class="form-control" placeholder="Mobile" required>
                </div>
                <div class="col-md-2">
                    <input style="border-radius: 10px;" type="text" name="state" class="form-control" placeholder="State of residence" required>
                </div>
                <div class="col-md-2">
                    <input style="border-radius: 10px;" type="text" name="city" class="form-control" placeholder="City" required>
                </div>
                <div class="col-md-6">
                    <input style="border-radius: 10px;" type="text" name="address" class="form-control" placeholder="Home Address" required>
                </div>

                <!-- Course Selection Details (Read-only, pre-filled from database) -->
                <b><span>Course Selection</span></b>
                <div class="col-md-2">
                    <Label for="course">Preferred Course</Label>
                    <input style="border-radius: 10px;" type="text" name="course" readonly id="course" value="<?= htmlspecialchars($course['course_name']) ?>" class="form-control" placeholder="Course" required>
                </div>
                <div class="col-md-2">
                    <small><i>Price</i></small>
                    <input style="border-radius: 10px;" type="text" name="price" readonly id="price" value="<?= htmlspecialchars($course['price']) ?>" class="form-control" placeholder="Price" required>
                </div>
                <div class="col-md-2">
                    <small><i>Duration</i></small>
                    <input style="border-radius: 10px;" type="text" name="duration" readonly id="duration" value="<?= htmlspecialchars($course['duration']) ?>" class="form-control" placeholder="Duration" required>
                </div>
                <div class="col-md-2">
                    <small><i>Year Enrolled</i></small>
                    <input style="border-radius: 10px;" type="text" name="year_enrolled" readonly id="year_enrolled" value="<?= date('Y') ?>" class="form-control" placeholder="Year Enrolled" required>
                </div>
                <div class="col-md-2">
                    <i><small>Preferred Password</small></i>
                    <input style="border-radius: 10px;" type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <!-- Educational Information Fields -->
                <b><span>Educational Information <small><i>(Please select where appropriate)</i></small></span></b>
                <div class="col-md-4">
                    <select style="border-radius: 10px;" name="qualification" id="" class="form-control form-select" required>
                        <option value="" disabled selected>Highest Qualification Obtained</option>
                        <option value="Senior School Certificate">Senior School Certificate</option>
                        <option value="National Diploma">National Diploma</option>
                        <option value="Higher National Diploma">Higher National Diploma</option>
                        <option value="Bachelor`s Degree">Bachelor`s Degree</option>
                        <option value="Masters Degree">Master's Degree</option>
                        <option value="Doctorate">Doctorate</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select style="border-radius: 10px;" name="literacy" id="" class="form-control form-select">
                        <option value="" disabled selected>Computer Literacy</option>
                        <option value="Beginner">Beginner</option>
                        <option value="Basic">Basic</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>

                <!-- Next of Kin Information Fields -->
                <b><Label> Next of Kin Information</Label></b>
                <div class="col-md-4">
                    <input style="border-radius: 10px;" type="text" name="kin_name" class="form-control" placeholder="Next of Kin Name" required>
                </div>
                <div class="col-md-4">
                    <input style="border-radius: 10px;" type="text" name="kin_mobile" class="form-control" placeholder="Next of Kin Mobile" required>
                </div>
                <div class="col-md-4">
                    <input style="border-radius: 10px;" type="email" name="kin_email" class="form-control" placeholder="Next of Kin Email" required>
                </div>

                <!-- Sponsor Information Fields -->
                <b><label for="">Sponsor Informaion</label><i><small> - Sponsor Information must be completed (if self sponsored, input personal details)</small></i></b>
                <div class="col-md-4">
                    <input style="border-radius: 10px;" type="text" name="sponsor_name" class="form-control" placeholder="Sponsor Name" required>
                </div>
                <div class="col-md-4">
                    <input style="border-radius: 10px;" type="text" name="sponsor_mobile" class="form-control" placeholder="Sponsor Mobile" required>
                </div>
                <div class="col-md-4">
                    <input style="border-radius: 10px;" type="email" name="sponsor_email" class="form-control" placeholder="Sponsor Email" required>
                </div>
                <!-- Passport Upload Field (currently hidden) -->
                <b><label for="passport" class="d-none"> Upload Passport</label></b>
                <div class="col-md-4 d-none">
                    <input type="file" name="passport">
                </div>

                <!-- Hidden field to store JSON representation of form data for Flutterwave callback. -->
                <input type="hidden" id="form_data_json" name="form_data_json">
                <div class="col-md-2">
                    <!-- Register Button: Triggers the Flutterwave payment process. -->
                    <button class="btn btn-primary w-100 py-2 px-3 mt-5" id="registerBtn" style="border-radius: 10px;">Register</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Course Registration Form Section End -->

<?php 
// Include the footer component.
include('components/footer.php'); ?>
<!-- Back to Top Button -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>
<?php 
// Include the scripts component.
include('components/scripts.php'); ?>

<!-- Flutterwave Checkout Script: Links to the Flutterwave V3 JavaScript library for payment processing. -->
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script>
// Event listener for the 'Register' button click.
document.getElementById('registerBtn').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default form submission.

    const form = document.getElementById('registrationForm');
    const formData = new FormData(form); // Create FormData object from the form.
    const jsonData = {}; // Initialize an empty object to store form data as JSON.

    // Iterate over FormData entries and populate the jsonData object.
    formData.forEach((value, key) => {
        jsonData[key] = value;
    });

    // Store the JSON data in a hidden input field.
    document.getElementById('form_data_json').value = JSON.stringify(jsonData);

    // Generate a unique transaction reference.
    const txRef = "ACADEMY_" + Date.now();

    // Initialize Flutterwave Checkout.
    FlutterwaveCheckout({
        public_key: "FLWPUBK-3b4554a666b54d38f291bad092ec7e1b-X", // Replace with your actual Flutterwave public key.
        tx_ref: txRef, // Unique transaction reference.
        amount: parseFloat(jsonData.price), // Payment amount from form data.
        currency: "NGN", // Currency code (Nigerian Naira).
        customer: {
            email: jsonData.email,        // Customer email from form data.
            phone_number: jsonData.mobile, // Customer phone number from form data.
            name: jsonData.name           // Customer name from form data.
        },
        customizations: {
            title: "Course Registration", // Title displayed on the payment modal.
            description: jsonData.course,  // Description of the payment (course name).
            logo: "https://dinolabstech.com/img/logo.png" // Logo displayed on the payment modal.
        },
        callback: function (response) {
            // Callback function executed after payment attempt.
            if (response.status === "successful") {
                // If payment is successful, construct a new URL with payment status and form data.
                const url = new URL(window.location.href);
                url.searchParams.set("tx_ref", txRef); // Add transaction reference.
                url.searchParams.set("status", "paid"); // Set status to 'paid'.
                url.searchParams.set("form_data", btoa(JSON.stringify(jsonData))); // Encode form data as base64 JSON.
                window.location.href = url.toString(); // Redirect to the new URL to save data.
            } else {
                // If payment failed or was cancelled, display an alert.
                alert("Payment failed or was cancelled.");
            }
        },
        onclose: function () {
            // Optional: Function to execute when the payment modal is closed.
            // Can be used to alert the user or re-enable UI elements.
        }
    });
});
</script>

</body>
</html>
