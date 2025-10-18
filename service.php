<?php
session_start();

include("db_connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Services</title>
</head>
<?php include('components/head.php'); ?>

<body>
    <!-- Top Bar Start -->
    <?php include('components/topbar.php'); ?>
    <!-- Top Bar End -->

    <!-- Navbar Start -->
    <?php include('components/navbar.php'); ?>
    <!-- Navbar End -->

    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Our Services</h1>
            </div>
        </div>
    </div>

<!-- Service Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h1 class="mb-0">Why Choose Dinolabs</h1>
        </div>
        <div class="row g-5">
            <div class="col-12 col-md-6 col-lg-3 wow zoomIn" data-wow-delay="0.3s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center h-100">
                    <div class="service-icon">
                        <i class="fa fa-laptop-code text-white"></i>
                    </div>
                    <h4 class="mb-3">Experienced developers and IT professionals.</h4>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 wow zoomIn" data-wow-delay="0.6s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center h-100">
                    <div class="service-icon">
                        <i class="fa fa-layer-group text-white"></i>
                    </div>
                    <h4 class="mb-3">Fully customizable and scalable products</h4>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 wow zoomIn" data-wow-delay="0.9s">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center h-100">
                    <div class="service-icon">
                        <i class="fa fa-cloud text-white"></i>
                    </div>
                    <h4 class="mb-3">Online, offline and Hybrid deployment options</h4>
                    
                </div>
            </div>
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



    <!-- Testimonial Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h1 class="mb-0">What We Do</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">
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
    <!-- Testimonial End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5 mb-5">
            <div class="bg-white">
                <div class="owl-carousel vendor-carousel">
                    <?php
                    $vendorFolder = 'img/vendors/';
                    $vendorImages = glob($vendorFolder . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                    foreach ($vendorImages as $img): ?>
                        <img src="<?php echo $img; ?>" alt="Vendor">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->


    <!-- Footer Start -->
    <?php include('components/footer.php'); ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

    <?php include('components/scripts.php'); ?>
</body>

</html>