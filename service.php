<?php
// Start a new session or resume the existing session.
session_start();

// Include the database connection file. This file is responsible for establishing a connection to the database.
include("db_connect.php");
?>
<!DOCTYPE html>
<!--
This is the Services page for the Dinolabs Tech Services website.
It provides an overview of the company's offerings, highlighting why clients should choose Dinolabs
and detailing the specific services provided through a testimonial-style carousel.
The page uses Bootstrap for responsive design and includes various sections like a hero header,
feature highlights, service descriptions, and a vendor carousel.
PHP includes are used to modularize the page components such as head, topbar, navbar, footer, and scripts.
-->
<html lang="en">

<head>
    <!-- Set the title of the page, which appears in the browser tab. -->
    <title>Services</title>
</head>
<?php
// Include the head component. This file typically contains:
// - Meta tags for character set, viewport, and compatibility.
// - Page title (though overridden by the <title> tag above).
// - Favicon link.
// - Google Web Fonts (e.g., Open Sans, Poppins).
// - Icon font libraries (e.g., Font Awesome, Bootstrap Icons).
// - Vendor CSS files (e.g., Animate.css, Owl Carousel).
// - Bootstrap CSS framework.
// - Custom CSS styles for the website.
include('components/head.php');
?>

<body>
    <!-- Top Bar Start -->
    <?php
    // Include the topbar component. This section usually contains:
    // - Contact information (email, phone).
    // - Social media links.
    // - A small navigation or utility links.
    include('components/topbar.php');
    ?>
    <!-- Top Bar End -->

    <!-- Navbar Start -->
    <?php
    // Include the navbar component. This file typically contains:
    // - The main navigation menu with links to different sections of the website (e.g., Home, About, Services, Blog, Contact).
    // - Branding or logo.
    // - Responsive navigation toggler for mobile devices.
    include('components/navbar.php');
    ?>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <!-- This section serves as a hero header for the Services page, displaying a prominent title. -->
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <!-- Main heading for the services page, animated to zoom in. -->
                <h1 class="display-4 text-white animated zoomIn">Our Services</h1>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

<!-- Service Start -->
<!-- This section highlights the reasons to choose Dinolabs, presented as a grid of feature cards. -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <!-- Main heading for the "Why Choose Dinolabs" section. -->
            <h1 class="mb-0">Why Choose Dinolabs</h1>
        </div>
        <div class="row g-5">
            <!-- Feature Item: Experienced Developers -->
            <!-- Card highlighting the experienced team. -->
            <div class="col-12 col-md-6 col-lg-3 wow zoomIn" data-wow-delay="0.3s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center h-100">
                    <div class="service-icon">
                        <i class="fa fa-laptop-code text-white"></i>
                    </div>
                    <h4 class="mb-3">Experienced developers and IT professionals.</h4>
                </div>
            </div>
            <!-- Feature Item: Customizable and Scalable Products -->
            <!-- Card highlighting product flexibility. -->
            <div class="col-12 col-md-6 col-lg-3 wow zoomIn" data-wow-delay="0.6s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center h-100">
                    <div class="service-icon">
                        <i class="fa fa-layer-group text-white"></i>
                    </div>
                    <h4 class="mb-3">Fully customizable and scalable products</h4>
                </div>
            </div>
            <!-- Feature Item: Deployment Options -->
            <!-- Card highlighting various deployment options. -->
            <div class="col-12 col-md-6 col-lg-3 wow zoomIn" data-wow-delay="0.9s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center h-100">
                    <div class="service-icon">
                        <i class="fa fa-cloud text-white"></i>
                    </div>
                    <h4 class="mb-3">Online, offline and Hybrid deployment options</h4>
                    
                </div>
            </div>
            <!-- Feature Item: Excellent Support and Training -->
            <!-- Card highlighting post-sales support. -->
            <div class="col-12 col-md-6 col-lg-3 wow zoomIn" data-wow-delay="1.2s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center h-100">
                    <div class="service-icon">
                        <i class="fas fa-headset text-white"></i>
                    </div>
                    <h4 class="mb-3">Excellent after-sales support and training</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->


    <!-- What We Do Start -->
    <!-- This section details the specific services offered by Dinolabs, presented in a testimonial-style carousel. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <!-- Main heading for the "What We Do" section. -->
                <h1 class="mb-0">What We Do</h1>
            </div>
            <!-- Owl Carousel for displaying individual service descriptions. -->
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">
                <!-- Service Item: Custom Software Development -->
                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <i class="fas fa-code fa-2x text-primary"></i>
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">Custom Software Development</h4>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        We build powerful and scalable applications tailored to your business processes.
                    </div>
                </div>
                <!-- Service Item: Educational Management Systems -->
                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <i class="fas fa-school fa-2x text-primary"></i>
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">Educational Management Systems</h4>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        Complete ERP solutions for schools, including student info, billing, results, CBT, library, ID
                        cards, and more.
                    </div>
                </div>
                <!-- Service Item: Pharmacy Management Systems -->
                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <i class="fas fa-pills fa-2x text-primary"></i>
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">Pharmacy Management Systems</h4>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        Manage drug inventory, sales, suppliers, refunds, staff roles, and reports.
                    </div>
                </div>
                <!-- Service Item: Sales Management Solutions -->
                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <i class="fas fa-cash-register fa-2x text-primary"></i>
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">Sales Management Solutions</h4>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        Track sales, inventory, customers, receipts, and generate financial reports for retail and
                        wholesale businesses.
                    </div>
                </div>
                <!-- Service Item: Web Design & Development -->
                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <i class="fas fa-globe fa-2x text-primary"></i>
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">Web Design & Development</h4>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        Clean, modern, and responsive websites for businesses and institutions.
                    </div>
                </div>
                <!-- Service Item: Database Management -->
                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <i class="fas fa-database fa-2x text-primary"></i>
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">Database Management</h4>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        Secure data storage, backups, and analytics services for optimal data use.
                    </div>
                </div>
                <!-- Service Item: IT Training & Consultancy -->
                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <i class="fas fa-chalkboard-teacher fa-2x text-primary"></i>
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">IT Training & Consultancy</h4>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        Hands-on training in software, web development, and productivity tools like Microsoft Excel
                        among others.
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- What We Do End -->


    <!-- Vendor Start -->
    <!-- This section displays a carousel of vendor or partner logos, indicating collaborations or affiliations. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5 mb-5">
            <div class="bg-white">
                <!-- Owl Carousel for displaying vendor images. -->
                <div class="owl-carousel vendor-carousel">
                    <?php
                    // Define the folder path where vendor images are stored.
                    $vendorFolder = 'img/vendors/';
                    // Use glob to find all image files (jpg, jpeg, png, gif) within the specified vendor folder.
                    // GLOB_BRACE allows for multiple patterns.
                    $vendorImages = glob($vendorFolder . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                    // Loop through each found vendor image file.
                    foreach ($vendorImages as $img): ?>
                        <!-- Display each vendor image within the carousel. -->
                        <img src="<?php echo $img; ?>" alt="Vendor">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->


    <!-- Footer Start -->
    <?php
    // Include the footer component. This file typically contains:
    // - Copyright information.
    // - Quick links to other pages.
    // - Contact details.
    // - Social media links.
    // - Newsletter subscription forms.
    include('components/footer.php');
    ?>
    <!-- Footer End -->

    <!-- Back to Top Button -->
    <!-- This button is a scroll-to-top feature, allowing users to quickly return to the top of the page.
         It is typically hidden until the user scrolls down a certain distance. -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

    <?php
    // Include the scripts component. This file typically contains:
    // - jQuery library.
    // - Bootstrap JavaScript bundle.
    // - Vendor JavaScript files (e.g., Waypoints, CounterUp, Owl Carousel, Easing, WOW.js).
    // - Custom JavaScript for interactive elements and animations.
    include('components/scripts.php');
    ?>
</body>

</html>
