<?php session_start();
include('db_connect.php');

// Fetch clients
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">


<?php include('components/head.php'); ?>
<?php include('backend/components/head.php'); ?>

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
                <h1 class="display-4 text-white animated zoomIn">Academy</h1>

            </div>
        </div>
    </div>

    <div class="container-fluid py-1 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-1">

            <div class="row mb-3">
                <?php if ($result->num_rows): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>

                        <div class="col-md-4 mb-3">
                            <a href="register_course.php?id=<?php echo $row['id']; ?>">
                                <div class="card card-primary card-round" style="border-radius: 10px;">
                                    <div class="card-header bg-success rounded">
                                        <div class="card-head-row">
                                            <div class="card-title text-white" style="color:black;"><strong><?= htmlspecialchars($row['course_name'])?></strong></div>
                                        </div>
                                    </div>
                                    <div class="card-body pb-0">
                                        <div class="mb-4 mt-2 text-dark">
                                            <?=$row['description']?>
                                            <p class="mt-2">Duration: <?= htmlspecialchars($row['duration'])?></p>
                                        </div>
                                    </div>
                                    <div class="card-footer pb-0">
                                        <div style="text-align: right;color:black;" class="mb-4 mt-2">
                                           <strong> &#8358; <?= number_format($row['price'])?></strong>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No posts found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Footer Start -->
        <?php include('components/footer.php'); ?>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

        <?php include('components/scripts.php'); ?>

</body>

</html>
