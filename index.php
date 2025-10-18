<?php
session_start();

include("db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<?php include('components/head.php');?>

<body>
<?php include('components/topbar.php');?>

    <!-- Navbar & Carousel Start -->
    <div class="container-fluid position-relative p-0">
    <?php include('components/navbar.php');?>

        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">

            
            <div class="carousel-item active">
                    <img class="w-100" src="img/ad1.png" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <!-- <h5 class="text-white text-uppercase mb-3 animated slideInDown">Creative & Innovative</h5> -->
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Your Growth, Our Technology.</h1>
                            <!-- <a href="quote.html" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Free Quote</a>
                            <a href="contact.php" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contact Us</a> -->
                        </div>
                    </div>
                </div>


                <div class="carousel-item">
                    <img class="w-100" src="img/ad2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <!-- <h5 class="text-white text-uppercase mb-3 animated slideInDown">Creative & Innovative</h5> -->
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Creative & Innovative Digital Solution</h1>
                            <!-- <a href="quote.html" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Free Quote</a>
                            <a href="contact.php" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contact Us</a> -->
                        </div>
                    </div>
                </div>
                

                <div class="carousel-item">
                    <img class="w-100" src="img/ad4.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <!-- <h5 class="text-white text-uppercase mb-3 animated slideInDown">Creative & Innovative</h5> -->
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Empowering Growth with Innovation</h1>
                            <!-- <a href="quote.html" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Free Quote</a>
                            <a href="contact.php" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contact Us</a> -->
                        </div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Navbar & Carousel End -->


    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->


    <!-- Facts Start -->
    <div class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-users text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Happy Clients AA</h5>
                            <h1 class="text-white mb-0" data-toggle="counter-up">85</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.3s">
                    <div class="bg-light shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-check text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-primary mb-0">Projects Done</h5>
                            <h1 class="mb-0" data-toggle="counter-up">117</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-award text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Hours of Support</h5>
                            <h1 class="text-white mb-0" data-toggle="counter-up">17,530</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts Start -->


    <!-- About Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <!-- <h5 class="fw-bold text-primary text-uppercase">About Us</h5> -->
                        <h1 class="mb-0">The Best IT Solution</h1>
                    </div>
                    <p class="mb-4">At Dinolabs Tech Services, we provide a wide range of IT services, including software development, web design, Web development, IT consulting, and tailored technology solutions for educational and business needs. Our expertise is focused on delivering reliable, user-friendly, and scalable solutions that empower our clients to achieve their goals and stay ahead in today’s competitive landscape.</p>
                    <div class="row g-0 mb-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Quality</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Professional Staff</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>24/7 Support</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Fair Prices</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Call to ask any question</h5>
                            <h4 class="text-primary mb-0">+234 813 772 6887</h4>
                        </div>
                    </div>
                    <!-- <a href="quote.html" class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.9s">Request A Quote</a> -->
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="img/about.jpg" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Features Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Why Choose Us</h5>
                <h1 class="mb-0">We Are Here to Grow Your Business Exponentially</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.2s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fa fa-star text-white"></i>
                            </div>
                            <h4>Quality</h4>
                            <p class="mb-0">Our products are crafted with the Latest frameworks and rigorous quality control processes, ensuring reliability and durability. Clients can trust that they are investing in products that will perform consistently over time</p>
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.6s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fa fa-lightbulb text-white"></i>
                            </div>
                            <h4>Innovation</h4>
                            <p class="mb-0">We prioritize cutting-edge technology and design in our offerings, continuously updating our product line to meet the evolving needs of our clients. This commitment to innovation helps clients stay ahead in their industries.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  wow zoomIn" data-wow-delay="0.9s" style="min-height: 350px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.1s" src="img/feature.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.4s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fa fa-headset text-white"></i>
                            </div>
                            <h4>Support</h4>
                            <p class="mb-0">We provide exceptional customer support, offering guidance and assistance at every stage of the purchasing process and beyond. Our dedicated team is always available to address inquiries and ensure a smooth experience for our clients.</p>
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.8s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fa fa-trophy text-white"></i>
                            </div>
                            <h4>Excellence</h4>
                            <p class="mb-0">Our commitment to excellence ensures that each service meets the highest standards, providing you with reliable performance and durability.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features Start -->


    <!-- Service Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Our Services</h5>
                <h1 class="mb-0">Custom IT Solutions for Your Successful Business</h1>
            </div>
            <div class="row g-5">
           
                <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <a href="service.php">
                    <div class="service-item bg-dark rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fas fa-database text-white"></i>
                        </div>
                        <h4 class="mb-3 text-white">Database Management</h4>
                    </div></a>
                </div>

                <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                <a href="service.php">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-chart-pie text-white"></i>
                        </div>
                        <h4 class="mb-3">Data Analytics</h4>
                    </div></a>    
                </div>

                <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                <a href="service.php">
                <div class="service-item bg-dark rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-code text-white"></i>
                        </div>
                        <h4 class="mb-3 text-white">Web Development</h4>
                    </div></a>    
                </div>

               <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                <a href="service.php">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-desktop text-white"></i>
                        </div>
                        <h4 class="mb-3">Desktop Development</h4>
                    </div></a>    
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- blog post Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
            <h1 class="mb-0">Trending Posts</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">
            <?php
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $posts_per_page = 5;
            $offset = ($page - 1) * $posts_per_page;

            $sql_trending_posts = "SELECT posts.id, posts.title, posts.created_at, posts.image_path, COUNT(comments.id) AS total_comments FROM posts LEFT JOIN comments ON posts.id = comments.post_id GROUP BY posts.id ORDER BY total_comments DESC LIMIT $posts_per_page OFFSET $offset";
            $result_trending_posts = $conn->query($sql_trending_posts);

            $sql_total_posts = "SELECT COUNT(*) AS total FROM posts";
            $result_total_posts = $conn->query($sql_total_posts);
            $total_posts = $result_total_posts->fetch_assoc()['total'];
            $total_pages = ceil($total_posts / $posts_per_page);

            if ($result_trending_posts->num_rows > 0) {
                while($trending_post = $result_trending_posts->fetch_assoc()) {
                    echo "<div class='testimonial-item bg-light my-4'>";
                    echo "  <div class='d-flex align-items-center border-bottom pt-5 pb-4 px-5'>";
                    if ($trending_post['image_path']) {
                        echo "      <img class='img-fluid rounded' src='assets/images/" . $trending_post['image_path'] . "' style='width: 60px; height: 60px; object-fit: cover;'>";
                    } else {
                        echo "      <img class='img-fluid rounded' src='img/default.jpg' style='width: 60px; height: 60px; object-fit: cover;'>"; // fallback image
                    }
                    echo "      <div class='ps-4'>";
                    echo "          <h4 class='text-primary mb-1'>" . htmlspecialchars($trending_post['title']) . "</h4>";
                    echo "          <small>Created: " . $trending_post['created_at'] . "</small><br>";
                    echo "          <small>Total Comments: " . $trending_post['total_comments'] . "</small><br>";
                    echo "          <a href='post.php?id=" . $trending_post['id'] . "' class='btn btn-sm btn-outline-primary mt-2'>View Post</a> ";
                    // echo "          <a href='edit_post.php?id=" . $trending_post['id'] . "' class='btn btn-sm btn-primary mt-2'>Edit Post</a>";
                    echo "      </div>";
                    echo "  </div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No trending posts found.</p>";
            }
            ?>
        </div>
    </div>
</div>

  <!-- blog post End -->



    <!-- Vendor Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5 mb-5">
            <div class="bg-white">
                <div class="owl-carousel vendor-carousel">
                    <?php
                    $vendorFolder = 'img/vendors/';
                    $vendorImages = glob($vendorFolder . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                    foreach($vendorImages as $img): ?>
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