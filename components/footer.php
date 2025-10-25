<div class="container-fluid bg-dark text-light mt-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gx-5">

            <div class="col-lg-4 col-md-6 footer-about">

            </div>

            <div class="col-lg-12 col-md-6">
                <div class="row gx-5">
                    <div class="col-lg-4 col-md-12 pt-5 mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="text-light mb-0">Get In Touch</h3>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-geo-alt text-primary me-2"></i>
                            <p class="mb-0">5th floor, Wing-B Tisco Building, Alagbaka Akure, Ondo State, Nigeria.</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-envelope-open text-primary me-2"></i>
                            <p class="mb-0">enquiries@dinolabstech.com</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-telephone text-primary me-2"></i>
                            <p class="mb-0">+234 704 324 7461</p>
                        </div>
                        <!-- <div class="d-flex mt-4">
                                <a class="btn btn-primary btn-square me-2" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-primary btn-square me-2" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-primary btn-square me-2" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                                <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram fw-normal"></i></a>

                                <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram fw-normal"></i></a>
                            </div> -->
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="text-light mb-0">Quick Links</h3>
                        </div>
                        <div class="link-animated d-flex flex-column justify-content-start">


                            <a class="text-light mb-2" href="service.php"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Our
                                Services</a>
                            <a class="text-light mb-2" href="blog.php"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Blog</a>
                            <a class="text-light mb-2" href="Contact.php"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>

                            <?php if (isset($_SESSION["username"])) { ?>
                                <a class="text-light mb-2" href="logout.php"><i
                                        class="bi bi-arrow-right text-primary me-2"></i>Logout</a>
                            <?php } else { ?>
                                <a class="text-light mb-2" href="./backend/login.php"><i
                                        class="bi bi-arrow-right text-primary me-2"></i>Login</a>
                            <?php } ?>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="text-light mb-0">Popular Links</h3>
                        </div>
                        <div class="link-animated d-flex flex-column justify-content-start">
                            <a class="text-light mb-2" href="about.php"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>About
                                Us</a>
                            <a class="text-light mb-2" href="terms_conditions.php"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Terms & Conditions</a>
                            <a class="text-light mb-2" href="privacy_policy.php"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Privacy  Policy</a>
                            <a class="text-light mb-2" href="refund_policy.php"><i
                                    class="bi bi-arrow-right text-primary me-2"></i>Refund Policy</a>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid text-white" style="background: #061429;">
    <div class="container text-center">
        <div class="row justify-content-end">
            <div class="col-lg-12 col-md-6">
                <div class="d-flex align-items-center justify-content-center" style="height: 75px;">
                    <p class="mb-0">Copyright &copy; <?= date('Y'); ?> Dinolabs Tech Services. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>