<?php
// Start a new session or resume the existing session.
session_start();

// Include the database connection file. This file is responsible for establishing a connection to the database.
include("db_connect.php");
?>

<!DOCTYPE html>
<!--
This is the main index page for the Dinolabs Tech Services website.
It serves as the entry point for visitors, showcasing key features, services, and trending blog posts.
The page is structured using Bootstrap for responsive design and includes various sections like a carousel,
fact counters, about us, features, services, and a blog post display.
PHP includes are used to modularize the page components such as head, topbar, navbar, footer, and scripts.
-->
<html lang="en">

<?php
// Include the head component. This file typically contains:
// - Meta tags for character set, viewport, and compatibility.
// - Page title.
// - Favicon link.
// - Google Web Fonts (e.g., Open Sans, Poppins).
// - Icon font libraries (e.g., Font Awesome, Bootstrap Icons).
// - Vendor CSS files (e.g., Animate.css, Owl Carousel).
// - Bootstrap CSS framework.
// - Custom CSS styles for the website.
include('components/head.php');
?>

<body>
    <?php
    // Include the topbar component. This section usually contains:
    // - Contact information (email, phone).
    // - Social media links.
    // - A small navigation or utility links.
    include('components/topbar.php');
    ?>

    <!-- Navbar & Carousel Start -->
    <!-- This section encompasses the main navigation bar and a dynamic image carousel. -->
    <div class="container-fluid position-relative p-0">
        <?php
        // Include the navbar component. This file typically contains:
        // - The main navigation menu with links to different sections of the website (e.g., Home, About, Services, Blog, Contact).
        // - Branding or logo.
        // - Responsive navigation toggler for mobile devices.
        include('components/navbar.php');
        ?>

        <!-- Header Carousel -->
        <!-- The main carousel container. It uses Bootstrap's carousel component to cycle through a series of images
             with captions, providing an engaging visual introduction to the website. -->
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <!-- Carousel Inner -->
            <!-- This div holds all the individual carousel items. -->
            <div class="carousel-inner">

                <!-- First Carousel Item -->
                <!-- This is the first slide in the carousel, marked as 'active' to be displayed by default. -->
                <div class="carousel-item active">
                    <!-- Carousel Image -->
                    <img class="w-100" src="img/ad1.png" alt="Image">
                    <!-- Carousel Caption -->
                    <!-- This overlay contains text content displayed on top of the carousel image. -->
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <!-- Main heading for the first carousel item, animated to zoom in. -->
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Your Growth, Our Technology.</h1>
                        </div>
                    </div>
                </div>

                <!-- Second Carousel Item -->
                <!-- This is the second slide in the carousel. -->
                <div class="carousel-item">
                    <!-- Carousel Image -->
                    <img class="w-100" src="img/ad2.jpg" alt="Image">
                    <!-- Carousel Caption -->
                    <!-- This overlay contains text content displayed on top of the carousel image. -->
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <!-- Main heading for the second carousel item, animated to zoom in. -->
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Creative & Innovative Digital Solution</h1>
                        </div>
                    </div>
                </div>

                <!-- Third Carousel Item -->
                <!-- This is the third slide in the carousel. -->
                <div class="carousel-item">
                    <!-- Carousel Image -->
                    <img class="w-100" src="img/ad4.jpg" alt="Image">
                    <!-- Carousel Caption -->
                    <!-- This overlay contains text content displayed on top of the carousel image. -->
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <!-- Main heading for the third carousel item, animated to zoom in. -->
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Empowering Growth with Innovation</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel Control - Previous Button -->
            <!-- Button to navigate to the previous carousel item. -->
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <!-- Carousel Control - Next Button -->
            <!-- Button to navigate to the next carousel item. -->
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Navbar & Carousel End -->


    <!-- Full Screen Search Start -->
    <!-- This modal component provides a full-screen overlay for search functionality.
         It allows users to type in search keywords and submit a query. -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <!-- Button to close the search modal, positioned in the header. -->
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <!-- Input field for entering search keywords. -->
                        <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
                        <!-- Search button with a Bootstrap icon. -->
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->


    <!-- Facts Start -->
    <!-- This section displays key statistics or "facts" about the company, such as happy clients,
         projects done, and hours of support. It uses a counter-up animation for numbers. -->
    <div class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <!-- Fact Item: Happy Clients -->
                <!-- Displays the number of happy clients with an icon and a counter-up animation. -->
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-users text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Happy Clients</h5>
                            <!-- Counter-up animation for the number of happy clients. -->
                            <h1 class="text-white mb-0" data-toggle="counter-up">85</h1>
                        </div>
                    </div>
                </div>
                <!-- Fact Item: Projects Done -->
                <!-- Displays the number of projects completed with an icon and a counter-up animation. -->
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.3s">
                    <div class="bg-light shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-check text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-primary mb-0">Projects Done</h5>
                            <!-- Counter-up animation for the number of projects completed. -->
                            <h1 class="mb-0" data-toggle="counter-up">117</h1>
                        </div>
                    </div>
                </div>
                <!-- Fact Item: Hours of Support -->
                <!-- Displays the total hours of support provided with an icon and a counter-up animation. -->
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <i class="fa fa-award text-primary"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Hours of Support</h5>
                            <!-- Counter-up animation for the total hours of support provided. -->
                            <h1 class="text-white mb-0" data-toggle="counter-up">17,530</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->


    <!-- About Start -->
    <!-- This section provides detailed information about the company, its mission, and what it offers.
         It includes a descriptive text, a list of key features, a call-to-action for support, and an image. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <!-- Main heading for the About section. -->
                        <h1 class="mb-0">The Best IT Solution</h1>
                    </div>
                    <!-- Description of the company's services and philosophy. -->
                    <p class="mb-4">At Dinolabs Tech Services, we provide a wide range of IT services, including software development, web design, Web development, IT consulting, and tailored technology solutions for educational and business needs. Our expertise is focused on delivering reliable, user-friendly, and scalable solutions that empower our clients to achieve their goals and stay ahead in today’s competitive landscape.</p>
                    <div class="row g-0 mb-3">
                        <!-- Feature list item: Quality and Professional Staff. -->
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Quality</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Professional Staff</h5>
                        </div>
                        <!-- Feature list item: 24/7 Support and Fair Prices. -->
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>24/7 Support</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Fair Prices</h5>
                        </div>
                    </div>
                    <!-- Call to action for phone support, including an icon and phone number. -->
                    <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Call to ask any question</h5>
                            <h4 class="text-primary mb-0">+234 813 772 6887</h4>
                        </div>
                    </div>
                </div>
                <!-- Image display for the About section, providing a visual element. -->
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
    <!-- This section highlights the key features or unique selling propositions of the company's services.
         It is structured with a central image and features listed on either side. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Why Choose Us</h5>
                <h1 class="mb-0">We Are Here to Grow Your Business Exponentially</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="row g-5">
                        <!-- Feature Item: Quality -->
                        <!-- Describes the quality aspect of the company's products/services. -->
                        <div class="col-12 wow zoomIn" data-wow-delay="0.2s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fa fa-star text-white"></i>
                            </div>
                            <h4>Quality</h4>
                            <p class="mb-0">Our products are crafted with the Latest frameworks and rigorous quality control processes, ensuring reliability and durability. Clients can trust that they are investing in products that will perform consistently over time</p>
                        </div>
                        <!-- Feature Item: Innovation -->
                        <!-- Describes the innovation aspect, focusing on cutting-edge technology. -->
                        <div class="col-12 wow zoomIn" data-wow-delay="0.6s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fa fa-lightbulb text-white"></i>
                            </div>
                            <h4>Innovation</h4>
                            <p class="mb-0">We prioritize cutting-edge technology and design in our offerings, continuously updating our product line to meet the evolving needs of our clients. This commitment to innovation helps clients stay ahead in their industries.</p>
                        </div>
                    </div>
                </div>
                <!-- Image display for the Features section, centrally located. -->
                <div class="col-lg-4  wow zoomIn" data-wow-delay="0.9s" style="min-height: 350px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.1s" src="img/feature.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-5">
                        <!-- Feature Item: Support -->
                        <!-- Describes the customer support services offered. -->
                        <div class="col-12 wow zoomIn" data-wow-delay="0.4s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fa fa-headset text-white"></i>
                            </div>
                            <h4>Support</h4>
                            <p class="mb-0">We provide exceptional customer support, offering guidance and assistance at every stage of the purchasing process and beyond. Our dedicated team is always available to address inquiries and ensure a smooth experience for our clients.</p>
                        </div>
                        <!-- Feature Item: Excellence -->
                        <!-- Describes the commitment to high standards and reliable performance. -->
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
    <!-- Features End -->


    <!-- Service Start -->
    <!-- This section showcases the various IT services offered by the company, presented as clickable cards. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Our Services</h5>
                <h1 class="mb-0">Custom IT Solutions for Your Successful Business</h1>
            </div>
            <div class="row g-5">
           
                <!-- Service Item: Database Management -->
                <!-- Card linking to the service page for Database Management. -->
                <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <a href="service.php">
                    <div class="service-item bg-dark rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fas fa-database text-white"></i>
                        </div>
                        <h4 class="mb-3 text-white">Database Management</h4>
                    </div></a>
                </div>

                <!-- Service Item: Data Analytics -->
                <!-- Card linking to the service page for Data Analytics. -->
                <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                <a href="service.php">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-chart-pie text-white"></i>
                        </div>
                        <h4 class="mb-3">Data Analytics</h4>
                    </div></a>    
                </div>

                <!-- Service Item: Web Development -->
                <!-- Card linking to the service page for Web Development. -->
                <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                <a href="service.php">
                <div class="service-item bg-dark rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-code text-white"></i>
                        </div>
                        <h4 class="mb-3 text-white">Web Development</h4>
                    </div></a>    
                </div>

               <!-- Service Item: Desktop Development -->
               <!-- Card linking to the service page for Desktop Development. -->
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


    <!-- Blog Post Start -->
    <!-- This section displays trending blog posts in a dynamic carousel format.
         It fetches post data from the database, including titles, creation dates, images, and comment counts. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
            <h1 class="mb-0">Trending Posts</h1>
        </div>
        <!-- Owl Carousel for displaying blog posts. -->
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">
            <?php
            // Get the current page number from the URL, defaulting to 1 if not set.
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            // Define the number of posts to display per page in the carousel.
            $posts_per_page = 5;
            // Calculate the offset for the SQL query to retrieve posts for the current page.
            $offset = ($page - 1) * $posts_per_page;

            // SQL query to select trending posts.
            // It joins the 'posts' table with the 'comments' table to count comments for each post.
            // Posts are ordered by the total number of comments in descending order to show trending posts.
            // The LIMIT and OFFSET clauses are used for pagination.
            $sql_trending_posts = "SELECT posts.id, posts.title, posts.created_at, posts.image_path, COUNT(comments.id) AS total_comments FROM posts LEFT JOIN comments ON posts.id = comments.post_id GROUP BY posts.id ORDER BY total_comments DESC LIMIT $posts_per_page OFFSET $offset";
            // Execute the SQL query to fetch trending posts.
            $result_trending_posts = $conn->query($sql_trending_posts);

            // SQL query to get the total number of posts in the database.
            // This is used to calculate the total number of pages for pagination purposes.
            $sql_total_posts = "SELECT COUNT(*) AS total FROM posts";
            // Execute the query to get the total post count.
            $result_total_posts = $conn->query($sql_total_posts);
            // Fetch the total number of posts from the query result.
            $total_posts = $result_total_posts->fetch_assoc()['total'];
            // Calculate the total number of pages required based on posts per page.
            $total_pages = ceil($total_posts / $posts_per_page);

            // Check if there are any trending posts returned from the database.
            if ($result_trending_posts->num_rows > 0) {
                // Loop through each trending post fetched from the database.
                while($trending_post = $result_trending_posts->fetch_assoc()) {
                    // Start a new testimonial item div for each post.
                    echo "<div class='testimonial-item bg-light my-4'>";
                    echo "  <div class='d-flex align-items-center border-bottom pt-5 pb-4 px-5'>";
                    // Check if an image path exists for the post.
                    if ($trending_post['image_path']) {
                        // Display the post image if available.
                        echo "      <img class='img-fluid rounded' src='assets/images/" . $trending_post['image_path'] . "' style='width: 60px; height: 60px; object-fit: cover;'>";
                    } else {
                        // Display a fallback default image if no specific image is provided.
                        echo "      <img class='img-fluid rounded' src='img/default.jpg' style='width: 60px; height: 60px; object-fit: cover;'>"; // fallback image
                    }
                    echo "      <div class='ps-4'>";
                    // Display the post title, ensuring special characters are properly escaped.
                    echo "          <h4 class='text-primary mb-1'>" . htmlspecialchars($trending_post['title']) . "</h4>";
                    // Display the post creation date.
                    echo "          <small>Created: " . $trending_post['created_at'] . "</small><br>";
                    // Display the total number of comments for the post.
                    echo "          <small>Total Comments: " . $trending_post['total_comments'] . "</small><br>";
                    // Provide a link to view the full post, passing the post ID as a GET parameter.
                    echo "          <a href='post.php?id=" . $trending_post['id'] . "' class='btn btn-sm btn-outline-primary mt-2'>View Post</a> ";
                    echo "      </div>";
                    echo "  </div>";
                    echo "</div>";
                }
            } else {
                // If no trending posts are found, display a message.
                echo "<p>No trending posts found.</p>";
            }
            ?>
        </div>
    </div>
</div>

  <!-- Blog Post End -->


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
                    foreach($vendorImages as $img): ?>
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
