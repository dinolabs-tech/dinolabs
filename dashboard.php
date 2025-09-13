<?php
// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    // Redirect to the login page
    header("Location: index.php");
    exit();
}

// Include the database connection file
include("db_connect.php");
?>

<!DOCTYPE html>
<!--
dashboard.php

This file serves as the blog dashboard for authenticated users.
It displays key statistics such as total posts and total comments.
Additionally, it features a carousel of trending blog posts, allowing users to view and edit them.
The page handles user authentication, redirecting unauthenticated users to the index page.
Modular components for head, topbar, navbar, footer, and scripts are included for consistency.
-->
<html lang="en">

<head>
    <!-- Set the title of the page, which appears in the browser tab. -->
    <title>Dashboard</title>
</head>
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
  <?php 
  // Include the navbar component.
  include('components/navbar.php'); ?>
  <!-- Navbar End -->

  <!-- Page Header for Blog Dashboard -->
  <!-- This div creates a styled header section specifically for the "Blog Dashboard" page,
       featuring a background image/color and the main page title. -->
  <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <!-- Display the "Blog Dashboard" heading, animated to zoom in. -->
                <h1 class="display-4 text-white animated zoomIn">Blog Dashboard</h1>
            </div>
        </div>
    </div>

    <!-- Statistics Section Start -->
    <!-- This section displays key statistics related to the blog, such as total posts and total comments. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="row g-5">
        <!-- Total Posts Card -->
        <!-- Displays the total number of blog posts. -->
        <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.3s">
          <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
            <div class="service-icon">
              <i class="fa fa-shield-alt text-white"></i>
            </div>
            <h4 class="mb-3">Total Posts</h4>
            <?php
            // SQL query to count the total number of entries in the 'posts' table.
            $sql_posts = "SELECT COUNT(*) AS total_posts FROM posts";
            // Execute the query.
            $result_posts = $conn->query($sql_posts);
            // Fetch the result as an associative array.
            $posts_data = $result_posts->fetch_assoc();
            // Extract the total number of posts.
            $total_posts = $posts_data["total_posts"];
            ?>
            <!-- Display the fetched total number of posts. -->
            <p class="card-text"><?php echo $total_posts; ?></p>
          </div>
        </div>
        <!-- Total Comments Card -->
        <!-- Displays the total number of comments across all blog posts. -->
        <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.3s">
          <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
            <div class="service-icon">
              <i class="fa fa-shield-alt text-white"></i>
            </div>
            <h4 class="mb-3">Total Comments</h4>
            <?php
            // SQL query to count the total number of entries in the 'comments' table.
            $sql_comments = "SELECT COUNT(*) AS total_comments FROM comments";
            // Execute the query.
            $result_comments = $conn->query($sql_comments);
            // Fetch the result as an associative array.
            $comments_data = $result_comments->fetch_assoc();
            // Extract the total number of comments.
            $total_comments = $comments_data["total_comments"];
            ?>
            <!-- Display the fetched total number of comments. -->
            <p class="card-text"><?php echo $total_comments; ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Statistics Section End -->

  <!-- Trending Posts Section Start -->
  <!-- This section displays a carousel of trending blog posts, ordered by the number of comments. -->
  <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <!-- Section title for trending posts. -->
        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
            <h1 class="mb-0">Trending Posts</h1>
        </div>
        <!-- Owl Carousel for displaying trending blog posts. -->
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">
            <?php
            // --- Pagination Setup for Trending Posts ---
            // Get the current page number from the URL, defaulting to 1 if not set.
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            // Define the number of posts to display per page in the carousel.
            $posts_per_page = 5;
            // Calculate the offset for the SQL query to retrieve posts for the current page.
            $offset = ($page - 1) * $posts_per_page;

            // SQL query to fetch trending posts.
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
                    // Inner div for aligning content within the testimonial item.
                    echo "  <div class='d-flex align-items-center border-bottom pt-5 pb-4 px-5'>";
                    // Display the post image if available, otherwise a default image.
                    if ($trending_post['image_path']) {
                        echo "      <img class='img-fluid rounded' src='assets/images/" . $trending_post['image_path'] . "' style='width: 60px; height: 60px; object-fit: cover;'>";
                    } else {
                        echo "      <img class='img-fluid rounded' src='img/default.jpg' style='width: 60px; height: 60px; object-fit: cover;'>"; // fallback image
                    }
                    // Div for post details (title, date, comments, links).
                    echo "      <div class='ps-4'>";
                    // Display the post title, ensuring special characters are properly escaped.
                    echo "          <h4 class='text-primary mb-1'>" . htmlspecialchars($trending_post['title']) . "</h4>";
                    // Display the post creation date, formatted.
                    echo "          <small>Created: " . date('jS F Y', strtotime($trending_post['created_at'])) . "</small><br>";
                    // Display the total number of comments for the post.
                    echo "          <small>Total Comments: " . $trending_post['total_comments'] . "</small><br>";
                    // Links to view the full post and edit the post.
                    echo "          <a href='post.php?id=" . $trending_post['id'] . "' class='btn btn-sm btn-outline-primary mt-2'>View Post</a> ";
                    echo "          <a href='edit_post.php?id=" . $trending_post['id'] . "' class='btn btn-sm btn-primary mt-2'>Edit Post</a>";
                    echo "      </div>";
                    echo "  </div>";
                    echo "</div>";
                }
            } else {
                // Message displayed if no trending posts are found.
                echo "<p>No trending posts found.</p>";
            }
            ?>
        </div>
    </div>
</div>
  <!-- Trending Posts Section End -->

  <!-- Pagination Navigation -->
  <!-- Displays pagination links for the trending posts section if there is more than one page. -->
  <nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php if ($total_pages > 1): ?>
            <?php
            // "Previous" button for pagination.
            if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="dashboard.php?page=<?php echo $page - 1; ?>">Previous</a></li>
            <?php endif; ?>

            <?php
            // Numeric page links.
            for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>"><a class="page-link" href="dashboard.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>

            <?php
            // "Next" button for pagination.
            if ($page < $total_pages): ?>
                <li class="page-item"><a class="page-link" href="dashboard.php?page=<?php echo $page + 1; ?>">Next</a></li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
  </nav>

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
