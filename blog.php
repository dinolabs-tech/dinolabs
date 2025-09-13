<?php 
// Start the session
session_start();

// Include the database connection
include('db_connect.php');
?>
<!DOCTYPE html>
<!--
blog.php

This file serves as the main blog page, displaying a list of blog posts with pagination,
search functionality, and category filtering. It fetches posts and categories from the database,
presenting them in a user-friendly layout. The page also includes a sidebar with search,
category list, and recent posts sections.
Modular components for head, topbar, navbar, footer, and scripts are included for consistency.
-->
<html lang="en">
<head>
    <!-- Set the title of the page, which appears in the browser tab. -->
    <title>Blog</title>
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
include('components/head.php');

// --- Pagination Settings ---
// Define the number of posts to display per page.
$posts_per_page = 6;
// Get the current page number from the URL. Default to 1 if not set or invalid (less than or equal to 0).
$page = isset($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;
// Calculate the offset for the SQL query, determining where to start fetching posts.
$offset = ($page - 1) * $posts_per_page;

// --- Filter Settings ---
// Retrieve the search query from the URL, trimming any leading/trailing whitespace.
$search   = isset($_GET['search'])   ? trim($_GET['search'])   : '';
// Retrieve the category filter from the URL, trimming any leading/trailing whitespace.
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

// Initialize arrays to build the WHERE clause and store parameters for prepared statements.
$where = [];
$params = [];
// Add a search condition if the search query is not empty.
// The 'LIKE ?' placeholder will be replaced by a wildcard search term.
if ($search !== '') {
    $where[]  = "title LIKE ?";
    $params[] = "%{$search}%"; // Add wildcards for partial matching.
}
// Add a category condition if a category filter is provided.
// The 'category_id = ?' placeholder will be replaced by the specific category ID.
if ($category !== '') {
    $where[]  = "category_id = ?";
    $params[] = $category; // Add the category ID.
}
// Construct the full WHERE clause string. If there are conditions, prepend 'WHERE' and join them with ' AND '.
$where_clause = $where ? 'WHERE ' . implode(' AND ', $where) : '';

// --- Main Posts Query ---
// SQL query to fetch blog posts, incorporating dynamic WHERE clause, ordering by creation date, and applying pagination.
$sql = "SELECT * FROM posts {$where_clause} ORDER BY created_at DESC LIMIT ? OFFSET ?";
// Prepare the SQL statement to prevent SQL injection.
$stmt = $conn->prepare($sql);

// Combine all parameters for binding: filter parameters, then limit, then offset.
$params_all = $params;
$params_all[] = $posts_per_page; // Add the limit for pagination.
$params_all[] = $offset;         // Add the offset for pagination.

// Build the types string for `bind_param`. 's' for string, 'i' for integer.
// `str_repeat('s', count($params))` creates 'sss...' for search/category parameters.
// 'ii' is for the two integer parameters: LIMIT and OFFSET.
$types = str_repeat('s', count($params)) . 'ii';
// Prepend the types string to the beginning of the parameters array.
array_unshift($params_all, $types);

// Create references for `bind_param` as it requires parameters to be passed by reference.
$refs = array();
foreach ($params_all as $key => $value) {
    $refs[$key] = & $params_all[$key];
}

// Dynamically bind parameters and execute the prepared statement.
call_user_func_array([$stmt, 'bind_param'], $refs);
$stmt->execute();
// Get the result set from the executed statement.
$result = $stmt->get_result();

// Close the prepared statement to free up resources.
$stmt->close();

// --- Count Total Posts for Pagination ---
// SQL query to count the total number of posts matching the current filters.
$sql_count = "SELECT COUNT(*) AS total FROM posts {$where_clause}";
// Prepare the SQL statement for counting.
$stmt2 = $conn->prepare($sql_count);
// If there are filter parameters, bind them to the count query.
if ($params) {
    $types_count = str_repeat('s', count($params)); // Types string for filter parameters.
    $params_count = $params;
    array_unshift($params_count, $types_count); // Prepend types string.
    $refs2 = array();
    foreach ($params_count as $key => $value) {
        $refs2[$key] = & $params_count[$key];
    }
    call_user_func_array([$stmt2, 'bind_param'], $refs2);
}
// Execute the count query.
$stmt2->execute();
// Fetch the total number of posts.
$total = $stmt2->get_result()->fetch_assoc()['total'];
// Calculate the total number of pages required for pagination.
$total_pages = ceil($total / $posts_per_page);
// Close the prepared statement.
$stmt2->close();
?>

<style>
  /* Custom styling for blog post images to ensure consistent sizing and centering. */
  .blog-image {
    width: 100%;       /* Ensures it takes up the available width */
    max-width: 800px;  /* Adjust to your preferred max width */
    height: 300px;      /* Maintain aspect ratio */
    display: block;    /* Remove any space below the image */
    margin: 0 auto;    /* Center the image horizontally */
  }
</style>

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

    <!-- Page Header for Blog Posts -->
    <!-- This div creates a styled header section specifically for the "Blog Posts" page,
         featuring a background image/color and the main page title. -->
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <!-- Display the "Blog Posts" heading, animated to zoom in. -->
                <h1 class="display-4 text-white animated zoomIn">Blog Posts</h1>
            </div>
        </div>
    </div>

    <!-- Blog Section Start -->
    <!-- This is the main content area for the blog, divided into a blog post list and a sidebar. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">

                <!-- Blog List Start (Main Content Area) -->
                <!-- This column displays the list of blog posts, arranged in a grid. -->
                <div class="col-lg-8">
                    <div class="row g-5">
                        <?php
                        // Check if there are any blog posts returned from the database query.
                        if ($result->num_rows): ?>
                            <?php
                            // Loop through each blog post and display its details.
                            while ($row = $result->fetch_assoc()): ?>
                                <?php
                                // --- Fetch Category Name for the current post ---
                                // Prepare a statement to select the category name based on category_id.
                                $cat_stmt = $conn->prepare("SELECT name FROM categories WHERE id = ?");
                                // Bind the category ID parameter to the prepared statement.
                                $cat_stmt->bind_param('i', $row['category_id']);
                                // Execute the statement.
                                $cat_stmt->execute();
                                // Get the result and fetch the associative array.
                                $cat = $cat_stmt->get_result()->fetch_assoc();
                                // Get the category name, defaulting to 'Uncategorized' if no category is found.
                                $category_name = $cat['name'] ?? 'Uncategorized';
                                // Close the category statement.
                                $cat_stmt->close();
                                ?>
                                <!-- Individual Blog Item -->
                                <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
                                    <div class="blog-item bg-light rounded overflow-hidden">
                                        <div class="blog-img position-relative overflow-hidden">
                                            <?php
                                            // Display the post image if available, otherwise a default image.
                                            if ($row['image_path']): ?>
                                                <img class="img-fluid blog-image" src="assets/images/<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                                            <?php else: ?>
                                                <img class="img-fluid blog-image" src="img/default-image.jpg" alt="Default Image">
                                            <?php endif; ?>
                                            <!-- Category link overlay on the image. -->
                                            <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="blog.php?category=<?php echo $row['category_id']; ?>">
                                                <?php echo htmlspecialchars($category_name); ?>
                                            </a>
                                        </div>
                                        <div class="p-4">
                                            <div class="d-flex mb-3">
                                                <!-- <small class="me-3"><i class="far fa-user text-primary me-2"></i>Admin</small> -->
                                                <!-- Display the post creation date. -->
                                                <small><i class="far fa-calendar-alt text-primary me-2"></i><?php echo date('d M, Y', strtotime($row['created_at'])); ?></small>
                                            </div>
                                            <!-- Display the post title. -->
                                            <h4 class="mb-3"><?php echo htmlspecialchars($row['title']); ?></h4>
                                            <?php
                                                // Generate a short excerpt from the post content.
                                                $content = $row['content'];
                                                $words = explode(' ', $content);
                                                $excerpt = implode(' ', array_slice($words, 0, 40)); // Take the first 40 words.
                                                echo '<p>' . nl2br($excerpt) . (count($words) > 50 ? '...' : '') . '</p>'; // Add ellipsis if content is longer than 50 words.
                                            ?>
                                            <!-- Link to read the full post. -->
                                            <a class="text-uppercase" href="post.php?id=<?php echo $row['id']; ?>" target="_blank">Read More <i class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <!-- Message displayed if no posts are found matching the criteria. -->
                            <p>No posts found.</p>
                        <?php endif; ?>
                    </div> <!-- End of .row g-5 for blog items -->

                    <p></p>

                    <!-- Pagination Navigation -->
                    <!-- Displays pagination links if there is more than one page of posts. -->
                    <?php if ($total_pages > 1): ?>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <?php
                                // "Previous" button for pagination.
                                if ($page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="blog.php?page=<?php echo $page-1; ?><?php echo $search? '&search='.urlencode($search): ''; ?><?php echo $category? '&category='.urlencode($category): ''; ?>">Previous</a>
                                    </li>
                                <?php endif; ?>
                                <?php
                                // Numeric page links.
                                for ($i=1; $i<=$total_pages; $i++): ?>
                                    <li class="page-item <?php echo $i==$page? 'active':''; ?>">
                                        <a class="page-link" href="blog.php?page=<?php echo $i; ?><?php echo $search? '&search='.urlencode($search): ''; ?><?php echo $category? '&category='.urlencode($category): ''; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                <?php
                                // "Next" button for pagination.
                                if ($page < $total_pages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="blog.php?page=<?php echo $page+1; ?><?php echo $search? '&search='.urlencode($search): ''; ?><?php echo $category? '&category='.urlencode($category): ''; ?>">Next</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div> <!-- End of .col-lg-8 (Blog list) -->

                <!-- Sidebar Start -->
                <!-- This column contains the sidebar with search, categories, and recent posts. -->
                <div class="col-lg-4">
                    <!-- Search Form Section -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <!-- Form for searching blog posts by title. -->
                        <form method="GET" action="blog.php" class="mb-3">
                            <div class="input-group">
                                <!-- Input field for search keywords. -->
                                <input type="text" class="form-control p-3" placeholder="Search Posts..." name="search" value="<?php echo htmlspecialchars($search); ?>">
                                <!-- Search button with a Bootstrap icon. -->
                                <button class="btn btn-primary px-4" type="submit"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <!-- Categories Section -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <!-- Section title for categories. -->
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Categories</h3>
                        </div>
                        <!-- List of categories, dynamically fetched from the database with post counts. -->
                        <ul class="list-unstyled link-animated d-flex flex-column">
                            <?php
                            // Query to fetch all categories and the count of posts in each category.
                            // It performs a LEFT JOIN with the 'posts' table to include categories even if they have no posts.
                            $cats = $conn->query("SELECT c.id, c.name, COUNT(p.id) AS count FROM categories c LEFT JOIN posts p ON p.category_id=c.id GROUP BY c.id ORDER BY c.name");
                            // Loop through each category and display it as a link.
                            while($rc = $cats->fetch_assoc()): ?>
                                <li>
                                    <!-- Category link, showing the category name and post count. -->
                                    <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2 d-flex align-items-center" href="blog.php?category=<?php echo $rc['id']; ?>">
                                        <i class="bi bi-arrow-right me-2"></i>
                                        <span><?php echo htmlspecialchars($rc['name']); ?> (<?php echo $rc['count']; ?>)</span>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>

                    <!-- Recent Posts Section -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <!-- Section title for recent posts. -->
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Recent Posts</h3>
                        </div>
                        <!-- List of recent posts, dynamically fetched from the database. -->
                        <ul class="list-unstyled link-animated d-flex flex-column">
                            <?php
                            // Query to fetch the 5 most recent posts, ordered by creation date.
                            $recent = $conn->query("SELECT id,title,image_path FROM posts ORDER BY created_at DESC LIMIT 5");
                            // Loop through each recent post.
                            while($rp = $recent->fetch_assoc()):
                                // Determine the image path for the recent post, using a placeholder if no image is available.
                                $img = $rp['image_path']? 'assets/images/'.htmlspecialchars($rp['image_path']): 'img/placeholder.jpg';
                            ?>
                                <li>
                                    <!-- Recent post link, displaying a small image and the post title. -->
                                    <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2 d-flex align-items-center" href="post.php?id=<?php echo $rp['id']; ?>">
                                        <img src="<?php echo $img; ?>" class="rounded-circle me-2" style="width:40px;height:40px;object-fit:cover;" alt="<?php echo htmlspecialchars($rp['title']); ?>">
                                        <span><?php echo htmlspecialchars($rp['title']); ?></span>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
                <!-- Sidebar End -->

            </div> <!-- End of .row g-5 (Blog list and Sidebar) -->
        </div> <!-- End of .container py-5 -->
    </div> <!-- End of .container-fluid (Blog Section) -->
    <!-- Blog End -->


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
