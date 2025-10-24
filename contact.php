<?php session_start();?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Contact</title>
</head>
<?php include('components/head.php'); ?>

<body>
   <!-- Topbar Start -->
   <?php include('components/topbar.php'); ?>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <?php include('components/navbar.php'); ?>
    <!-- Navbar End -->

    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Contact Us</h1>
            </div>
        </div>
    </div>


    <!-- Contact Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Contact Us</h5>
                <h1 class="mb-0">If You Have Any Query, Feel Free To Contact Us</h1>
            </div>
            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.1s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Call to ask any question</h5>
                            <h6 class="text-primary mb-0">+234 704 324 7461</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.4s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Email</h5>
                            <h6 class="text-primary mb-0">enquiries@dinolabstech.com</h6>
                            <!--<h6 class="text-primary mb-0">dinolabs.tech@gmail.com</h6>-->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.8s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Visit our office</h5>
                            <h6 class="text-primary mb-0">5th Floor Wing-B, TISCO Building, Alagbaka Akure, Ondo State, Nigeria.</h6>
                            <!--<h6 class="text-primary mb-0">Plot 2 ireti Ayo street off Aule GRA, Ondo State, Nigeria</h6>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">


                <!-- Success or Error Message Section -->
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success" style="margin-top: 20px;">
                        <?php 
                        echo $_SESSION['success_message']; 
                         unset($_SESSION['success_message']);
                        ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger" style="margin-top: 20px;">
                        <?php 
                        echo $_SESSION['error_message']; 
                         unset($_SESSION['error_message']);
                        ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="send-message.php">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control border-0 bg-light px-4"  id="name" name="name" placeholder="Your Name" style="height: 55px;" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control border-0 bg-light px-4"  id="email" name="email" placeholder="Your Email" style="height: 55px;" email>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control border-0 bg-light px-4"  id="subject" name="subject" placeholder="Subject" style="height: 55px;" required>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control border-0 bg-light px-4 py-3" rows="4" id="message" name="message" placeholder="Message" required></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>

                    
                </div>
                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d640.6690182300736!2d5.2145191194978935!3d7.252504593673251!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sng!4v1745751141530!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <?php include('components/footer.php'); ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

    <?php include('components/scripts.php'); ?>   

</body>

</html>