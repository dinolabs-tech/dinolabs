<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

include("db_connect.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
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
                <h1 class="display-4 text-white animated zoomIn">Blog Dashboard</h1>
                
            </div>
        </div>
    </div>



    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
    
      <div class="row g-5">
      <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.3s">
  <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
    <div class="service-icon">
      <i class="fa fa-shield-alt text-white"></i>
    </div>
    <h4 class="mb-3">Total Posts</h4>

    <?php
      $sql_posts = "SELECT COUNT(*) AS total_posts FROM posts";
      $result_posts = $conn->query($sql_posts);
      $posts_data = $result_posts->fetch_assoc();
      $total_posts = $posts_data["total_posts"];
    ?>
    <p class="card-text"><?php echo $total_posts; ?></p>

  </div>
</div>

<div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.3s">
  <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
    <div class="service-icon">
      <i class="fa fa-shield-alt text-white"></i>
    </div>
    <h4 class="mb-3">Total Comments</h4>
    
    <?php
      $sql_comments = "SELECT COUNT(*) AS total_comments FROM comments";
      $result_comments = $conn->query($sql_comments);
      $comments_data = $result_comments->fetch_assoc();
      $total_comments = $comments_data["total_comments"];
    ?>
    <p class="card-text"><?php echo $total_comments; ?></p>
    
  
  </div>
</div>

       
      </div>
    </div>
  </div>




  <!-- Testimonial Start -->
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
                    echo "          <small>Created: " . date('jS F Y', strtotime($trending_post['created_at'])) . "</small><br>";
                    echo "          <small>Total Comments: " . $trending_post['total_comments'] . "</small><br>";
                    echo "          <a href='post.php?id=" . $trending_post['id'] . "' class='btn btn-sm btn-outline-primary mt-2'>View Post</a> ";
                    echo "          <a href='edit_post.php?id=" . $trending_post['id'] . "' class='btn btn-sm btn-primary mt-2'>Edit Post</a>";
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

  <!-- Testimonial End -->

  <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($total_pages > 1): ?>
                    <?php if ($page > 1): ?>
                        <li class="page-item"><a class="page-link" href="dashboard.php?page=<?php echo $page - 1; ?>">Previous</a></li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>"><a class="page-link" href="dashboard.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item"><a class="page-link" href="dashboard.php?page=<?php echo $page + 1; ?>">Next</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </nav>



  <!-- Footer Start -->
  <?php include('components/footer.php'); ?>
  <!-- Footer End -->

  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

  <?php include('components/scripts.php'); ?>
</body>

</html>
