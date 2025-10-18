<?php
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

?>

<!DOCTYPE html>
<html lang="en">

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
                <h1 class="display-4 text-white animated zoomIn"><?php echo $post["title"]; ?></h1>
            </div>
        </div>
    </div>

    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-8">
                    <!-- Blog Detail Start -->
                    <div class="mb-5">
                        <section id="main">
                            <article class="mb-3 p-3 border rounded">
                                <h2><?php echo $post["title"]; ?></h2>
                                <p>Posted on: <?php echo date('jS F Y, h:i a', strtotime($post["created_at"])); ?> &nbsp; by: <strong><?php echo $post["username"]; ?> </strong></p>
                                <?php if ($post["image_path"]) { ?>
                                    <img src="assets/images/<?php echo $post["image_path"]; ?>" alt="Blog Image"
                                        class="img-fluid w-100 rounded mb-5" style="max-width: 100%;">
                                <?php } ?>
                                <p><?php echo $post["content"]; ?></p>


                                <p>Post created by: <?php echo $post["username"]; ?></p>
                                <p>Views: <?php echo $post['views']; ?> | Likes: <?php echo $post['likes']; ?></p>
                                <?php
                                if (isset($_SESSION['user_id'])) {
                                    $user_id = $_SESSION['user_id'];
                                    $post_id_check = $post['id'];
                                    $stmt = $conn->prepare("SELECT * FROM likes WHERE user_id = ? AND post_id = ?");
                                    $stmt->bind_param("ii", $user_id, $post_id_check);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows == 0) {
                                        echo '<a href="like_post.php?id=' . $post['id'] . '" class="btn btn-success"><i class="fas fa-thumbs-up me-1"></i>Like</a>';
                                    } else {
                                        echo '<button class="btn btn-success" disabled><i class="fas fa-thumbs-up me-1"></i>Liked</button>';
                                    }
                                    $stmt->close();
                                }
                                ?>
                                <!-- Sharing buttons -->
                                <a href="https://wa.me/?text=<?php echo urlencode($post['title'] . ' - ' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="btn btn-success"> <i class="fab fa-whatsapp"></i></a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($post['title']); ?>" target="_blank" class="btn btn-primary"><i class="fab fa-twitter"></i> Share on X</a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="btn btn-primary"><i class="fab fa-facebook"></i></a>



                                <?php if (isset($_SESSION["username"])) { ?>
                                    <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'mod') { ?>
                                        <a href="edit_post.php?id=<?php echo $post["id"]; ?>"
                                            class="btn btn-sm btn-primary">Edit Post</a>
                                        <a href="delete_post.php?id=<?php echo $post["id"]; ?>" class="btn btn-sm btn-danger">Delete Post</a>
                                    <?php } ?>
                                <?php } ?>
                            </article>
                        </section>
                    </div>
                    <!-- Blog Detail End -->

                    <!-- Comment List Start -->
                    <div class="mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Comments</h3>
                        </div>
                        <?php
                        $sql = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY created_at DESC";
                        $comments_result = $conn->query($sql);

                        if ($comments_result->num_rows > 0) {
                            while ($comment = $comments_result->fetch_assoc()) {
                                echo "<div class='d-flex mb-4'>";
                                echo '<div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                <i class="fas fa-user"></i>
                                </div>';
                                echo "<div class='ps-3'>";
                                echo "<h6><strong>" . htmlspecialchars($comment["name"]) . "</strong>";
                                if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == true) {
                                    echo " <small>(" . htmlspecialchars($comment["email"]) . ")</small>";
                                }
                                echo " <small><i>" . date('jS F Y, h:i a', strtotime($comment["created_at"])) . "</i></small></h6>";

                                echo "<p>" . htmlspecialchars($comment["content"]) . "</p>";
                                if (isset($_SESSION["username"])) {
                                      if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'mod') { 
                                    echo "<a href='edit_comment.php?id=" . $comment["id"] . "' class='btn btn-sm btn-primary me-2'>Edit</a>";
                                    echo "<a href='delete_comment.php?id=" . $comment["id"] . "' class='btn btn-sm btn-danger'>Delete</a>";
                                }
                                echo "</div>";
                                echo "</div>";
                                }
                            }
                        } else {
                            echo "<p>No comments yet.</p>";
                        }

                        ?>
                    </div>

                    <!-- Comment List End -->

                    <!-- Comment Form Start -->
                    <div class="bg-light rounded p-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Leave A Comment</h3>
                        </div>
                        <form action="add_comment.php" method="post">
                            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control bg-white border-0" id="name" name="name"
                                            placeholder="Your Name" required style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control bg-white border-0" id="email"
                                            name="email" placeholder="Your Email" required style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control bg-white border-0" id="comment" name="comment"
                                            rows="5" placeholder="Comment" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Leave Your Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Comment Form End -->
                </div>


                <!-- Sidebar Start -->
                <div class="col-lg-4">
                    <!-- Category Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Categories</h3>
                        </div>
                        <ul class="list-unstyled link-animated d-flex flex-column">
                            <?php
                            $cats = $conn->query("SELECT c.id, c.name, COUNT(p.id) AS count FROM categories c LEFT JOIN posts p ON p.category_id=c.id GROUP BY c.id ORDER BY c.name");
                            while ($rc = $cats->fetch_assoc()): ?>
                                <li>
                                    <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2 d-flex align-items-center" href="blog.php?category=<?php echo $rc['id']; ?>">
                                        <i class="bi bi-arrow-right me-2"></i>
                                        <span><?php echo htmlspecialchars($rc['name']); ?> (<?php echo $rc['count']; ?>)</span>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <!-- Category End -->

                    <!-- Recent Post Start -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Recent Posts</h3>
                        </div>
                        <ul class="list-unstyled link-animated d-flex flex-column">
                            <?php
                            $recent = $conn->query("SELECT id,title,image_path FROM posts ORDER BY created_at DESC LIMIT 5");
                            while ($rp = $recent->fetch_assoc()):
                                $img = $rp['image_path'] ? 'assets/images/' . htmlspecialchars($rp['image_path']) : 'img/placeholder.jpg';
                            ?>
                                <li>
                                    <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2 d-flex align-items-center" href="post.php?id=<?php echo $rp['id']; ?>">
                                        <img src="<?php echo $img; ?>" class="rounded-circle me-2" style="width:40px;height:40px;object-fit:cover;" alt="<?php echo htmlspecialchars($rp['title']); ?>">
                                        <span><?php echo htmlspecialchars($rp['title']); ?></span>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <!-- Recent Post End -->

                </div>
                <!-- Sidebar End -->
            </div>
        </div>
    </div>
    <!-- Blog End -->

    <!-- Footer Start -->
    <?php include('components/footer.php'); ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

    <?php include('components/scripts.php'); ?>
</body>

</html>