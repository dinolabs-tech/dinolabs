<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include("db_connect.php");

$comment_id = $_GET["id"];

$sql = "SELECT * FROM comments WHERE id = $comment_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Comment not found";
    exit();
}

$comment = $result->fetch_assoc();
$post_id = $comment["post_id"];
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
                <h1 class="display-4 text-white animated zoomIn">Edit Comment</h1>
            </div>
        </div>
    </div>


    <!-- Quote Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
            <div class="bg-primary rounded p-5 wow zoomIn" data-wow-delay="0.9s">
                    <form action="update_comment.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $comment_id; ?>">
                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">

                        <div class="row g-3">
                            <div class="col-12">

                                <textarea class="form-control bg-light border-0" id="comment" name="comment"
                                    placeholder="Enter Post Comment" style="height: 150px;"
                                    required><?php echo htmlspecialchars($comment["content"]); ?></textarea>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-dark w-100 py-3">Update Comment</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
</div>
        </div>
    </div>

    <!-- Quote End -->





    <!-- Footer Start -->
    <?php include('components/footer.php'); ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

    <?php include('components/scripts.php'); ?>
</body>

</html>