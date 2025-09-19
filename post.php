<?php

/**
 * post.php
 *
 * This file displays a single blog post in detail, including its content, author,
 * publication date, views, and likes. It also features a comment section where
 * users can leave new comments, and authenticated users (admins/mods) can edit or delete comments.
 * Social sharing buttons are provided for WhatsApp, Twitter, and Facebook.
 * The page increments the post's view count upon loading.
 * Modular components for head, topbar, navbar, footer, and scripts are included for consistency.
 */


session_start();
include("db_connect.php");

$post_id = $_GET["id"];

$sql = "SELECT posts.*, users.username FROM posts INNER JOIN users ON posts.author_id = users.id WHERE posts.id = $post_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Post not found";
    exit();
}

$post = $result->fetch_assoc();

$update_views_sql = "UPDATE posts SET views = views + 1 WHERE id = $post_id";
$conn->query($update_views_sql);



// Retrieve the 'id' of the post from the GET request parameters.
// This ID is crucial for fetching the correct blog post.
$post_id = $_GET["id"];

// SQL query to fetch the post details along with the author's username.
// It joins the 'posts' table with the 'users' table on 'author_id'.
// Note: Direct use of GET parameters in SQL queries can be a security risk (SQL injection).
// For production, prepared statements should be used.
$sql = "SELECT posts.*, users.username FROM posts INNER JOIN users ON posts.author_id = users.id WHERE posts.id = $post_id";
// Execute the query.
$result = $conn->query($sql);

// Check if no post was found with the given ID.
if ($result->num_rows == 0) {
    // If the post does not exist, display an error message and terminate.
    echo "Post not found";
    exit();
}

// Fetch the post details as an associative array.
$post = $result->fetch_assoc();

// SQL query to increment the 'views' count for the current post.
// This tracks how many times the post has been viewed.
$update_views_sql = "UPDATE posts SET views = views + 1 WHERE id = $post_id";
// Execute the update query. Error handling for this query is omitted but recommended in production.
$conn->query($update_views_sql);

?>

<!DOCTYPE html>
<!--
post.php

This file displays a single blog post in detail. It fetches the post content, author,
publication date, view count, and like count from the database.
It also includes a section for comments, allowing users to add new comments.
Authenticated users (admins/moderators) have options to edit or delete the post and its comments.
Social sharing buttons are provided for WhatsApp, Twitter, and Facebook.
The page increments the post's view count each time it is loaded.
Modular components for head, topbar, navbar, footer, and scripts are included for consistency.
-->
<html lang="en">

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

    <!-- Page Header for Blog Post -->
    <!-- This div creates a styled header section specifically for the individual blog post,
         featuring a background image/color and the post's title. -->
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <!-- Display the post title, animated to zoom in. -->
                <h1 class="display-4 text-white animated zoomIn"><?php echo htmlspecialchars($post["title"]); ?></h1>
            </div>
        </div>
    </div>

    <!-- Blog Post Content Section Start -->
    <!-- This is the main content area for the blog post, divided into the post detail and a sidebar. -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-8">
                    <!-- Blog Detail Start -->
                    <!-- This section displays the full content of the blog post. -->
                    <div class="mb-5">
                        <section id="main">
                            <article class="mb-3 p-3 border rounded">
                                <!-- Post Title -->
                                <h2><?php echo htmlspecialchars($post["title"]); ?></h2>
                                <!-- Post Meta Information (Date and Author) -->
                                <p>Posted on: <?php echo date('jS F Y, h:i a', strtotime($post["created_at"])); ?> &nbsp; by: <strong><?php echo htmlspecialchars($post["username"]); ?> </strong></p>
                                <?php
                                // Display the post's feature image if available.
                                if ($post["image_path"]) { ?>
                                    <img src="assets/images/<?php echo htmlspecialchars($post["image_path"]); ?>" alt="Blog Image"
                                        class="img-fluid w-100 rounded mb-5" style="max-width: 100%;">
                                <?php } ?>
                                <!-- Post Content -->
                                <p><?php echo nl2br(htmlspecialchars($post["content"])); ?></p>

                                <!-- Additional Post Information -->
                                <p>Post created by: <?php echo htmlspecialchars($post["username"]); ?></p>
                                <p>Views: <?php echo htmlspecialchars($post['views']); ?> | Likes: <?php echo htmlspecialchars($post['likes']); ?></p>
                                <?php
                                // Like Button Logic: Display "Like" or "Liked" based on user's session and previous likes.
                                if (isset($_SESSION['user_id'])) {
                                    $user_id = $_SESSION['user_id'];
                                    $post_id_check = $post['id'];
                                    // Prepare a statement to check if the current user has liked this post.
                                    $stmt = $conn->prepare("SELECT * FROM likes WHERE user_id = ? AND post_id = ?");
                                    $stmt->bind_param("ii", $user_id, $post_id_check);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows == 0) {
                                        // If not liked, show a "Like" button.
                                        echo '<a href="like_post.php?id=' . htmlspecialchars($post['id']) . '" class="btn btn-success"><i class="fas fa-thumbs-up me-1"></i>Like</a>';
                                    } else {
                                        // If already liked, show a disabled "Liked" button.
                                        echo '<button class="btn btn-success" disabled><i class="fas fa-thumbs-up me-1"></i>Liked</button>';
                                    }
                                    $stmt->close();
                                }
                                ?>
                                <!-- Social Sharing Buttons -->
                                <!-- WhatsApp Share Button -->
                                <a href="https://wa.me/?text=<?php echo urlencode($post['title'] . ' - ' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="btn btn-success"> <i class="fab fa-whatsapp"></i></a>
                                <!-- Twitter (X) Share Button -->
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($post['title']); ?>" target="_blank" class="btn btn-primary"><i class="fab fa-twitter"></i> Share on X</a>
                                <!-- Facebook Share Button -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="btn btn-primary"><i class="fab fa-facebook"></i></a>

                                <?php
                                // Admin/Moderator Actions: Edit and Delete Post buttons.
                                if (isset($_SESSION["username"])) { ?>
                                    <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'mod') { ?>
                                        <a href="edit_post.php?id=<?php echo htmlspecialchars($post["id"]); ?>"
                                            class="btn btn-sm btn-primary">Edit Post</a>
                                        <a href="delete_post.php?id=<?php echo htmlspecialchars($post["id"]); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</a>
                                    <?php } ?>
                                <?php } ?>
                            </article>
                        </section>
                    </div>
                    <!-- Blog Detail End -->

                    <!-- Comment List Start -->
                    <!-- This section displays all comments associated with the current blog post. -->
                    <div class="mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Comments</h3>
                        </div>
                        <?php
                        // SQL query to fetch all comments for the current post, ordered by creation date (newest first).
                        $sql = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY created_at DESC";
                        // Execute the query.
                        $comments_result = $conn->query($sql);

                        // Check if there are any comments for this post.
                        if ($comments_result->num_rows > 0) {
                            // Loop through each comment and display its details.
                            while ($comment = $comments_result->fetch_assoc()) {
                                echo "<div class='d-flex mb-4'>";
                                // Display a generic user icon for the commenter.
                                echo '<div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                <i class="fas fa-user"></i>
                                </div>';
                                echo "<div class='ps-3'>";
                                // Display commenter's name.
                                echo "<h6><strong>" . htmlspecialchars($comment["name"]) . "</strong>";
                                // If the user is an admin, display the commenter's email.
                                if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == true) {
                                    echo " <small>(" . htmlspecialchars($comment["email"]) . ")</small>";
                                }
                                // Display comment creation date.
                                echo " <small><i>" . date('jS F Y, h:i a', strtotime($comment["created_at"])) . "</i></small></h6>";

                                // Display comment content.
                                echo "<p>" . nl2br(htmlspecialchars($comment["content"])) . "</p>";
                                // Admin/Moderator actions for comments: Edit and Delete.
                                if (isset($_SESSION["username"])) {
                                      if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'mod') { 
                                    echo "<a href='edit_comment.php?id=" . htmlspecialchars($comment["id"]) . "' class='btn btn-sm btn-primary me-2'>Edit</a>";
                                    echo "<a href='delete_comment.php?id=" . htmlspecialchars($comment["id"]) . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this comment?\")'>Delete</a>";
                                }
                                echo "</div>"; // Close ps-3 div
                                echo "</div>"; // Close d-flex mb-4 div
                                }
                            }
                        } else {
                            // Message displayed if no comments are found for this post.
                            echo "<p>No comments yet.</p>";
                        }

                        ?>
                    </div>
                    <!-- Comment List End -->

                    <!-- Comment Form Start -->
                    <!-- This section provides a form for users to leave new comments on the post. -->
                    <div class="bg-light rounded p-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Leave A Comment</h3>
                        </div>
                        <!-- Form to add a new comment. It uses POST method and submits data to 'add_comment.php'. -->
                        <form action="add_comment.php" method="post">
                            <!-- Hidden input field to pass the post ID to the comment submission script. -->
                            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_id); ?>">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <!-- Input field for the commenter's name. -->
                                        <input type="text" class="form-control bg-white border-0" id="name" name="name"
                                            placeholder="Your Name" required style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <!-- Input field for the commenter's email. -->
                                        <input type="email" class="form-control bg-white border-0" id="email"
                                            name="email" placeholder="Your Email" required style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <!-- Textarea for the comment content. -->
                                        <textarea class="form-control bg-white border-0" id="comment" name="comment"
                                            rows="5" placeholder="Comment" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- Submit button for the comment form. -->
                                    <button class="btn btn-primary w-100 py-3" type="submit">Leave Your Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Comment Form End -->
                </div>

                <!-- Sidebar Start -->
                <!-- This column contains the sidebar with categories and recent posts. -->
                <div class="col-lg-4">
                    <!-- Category Section Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
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
                            while ($rc = $cats->fetch_assoc()): ?>
                                <li>
                                    <!-- Category link, showing the category name and post count. -->
                                    <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2 d-flex align-items-center" href="blog.php?category=<?php echo htmlspecialchars($rc['id']); ?>">
                                        <i class="bi bi-arrow-right me-2"></i>
                                        <span><?php echo htmlspecialchars($rc['name']); ?> (<?php echo htmlspecialchars($rc['count']); ?>)</span>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <!-- Category Section End -->

                    <!-- Recent Post Section Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Recent Posts</h3>
                        </div>
                        <!-- List of recent posts, dynamically fetched from the database. -->
                        <ul class="list-unstyled link-animated d-flex flex-column">
                            <?php
                            // Query to fetch the 5 most recent posts, ordered by creation date.
                            $recent = $conn->query("SELECT id,title,image_path FROM posts ORDER BY created_at DESC LIMIT 5");
                            // Loop through each recent post.
                            while ($rp = $recent->fetch_assoc()):
                                // Determine the image path for the recent post, using a placeholder if no image is available.
                                $img = $rp['image_path'] ? 'assets/images/' . htmlspecialchars($rp['image_path']) : 'img/placeholder.jpg';
                            ?>
                                <li>
                                    <!-- Recent post link, displaying a small image and the post title. -->
                                    <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2 d-flex align-items-center" href="post.php?id=<?php echo htmlspecialchars($rp['id']); ?>">
                                        <img src="<?php echo htmlspecialchars($img); ?>" class="rounded-circle me-2" style="width:40px;height:40px;object-fit:cover;" alt="<?php echo htmlspecialchars($rp['title']); ?>">
                                        <span><?php echo htmlspecialchars($rp['title']); ?></span>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <!-- Recent Post Section End -->
                </div>
                <!-- Sidebar End -->
            </div>
        </div>
    </div>
    <!-- Blog Post Content Section End -->

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
