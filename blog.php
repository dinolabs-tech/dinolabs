<?php 
session_start();
include('db_connect.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog</title>
</head>
<?php
include('components/head.php');

// Pagination settings
$posts_per_page = 6;
$page = isset($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $posts_per_page;

// Get filters
$search   = isset($_GET['search'])   ? trim($_GET['search'])   : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

// Build WHERE clause
$where = [];
$params = [];
if ($search !== '') {
    $where[]  = "title LIKE ?";
    $params[] = "%{$search}%";
}
if ($category !== '') {
    $where[]  = "category_id = ?";
    $params[] = $category;
}
$where_clause = $where ? 'WHERE ' . implode(' AND ', $where) : '';

// MAIN POSTS QUERY
$sql = "SELECT * FROM posts {$where_clause} ORDER BY created_at DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);

// Combine params + pagination
$params_all = $params;
$params_all[] = $posts_per_page;
$params_all[] = $offset;

// Build types string: 's' for each filter + 'ii' for limit offset
$types = str_repeat('s', count($params)) . 'ii';
array_unshift($params_all, $types);

// Convert to references
$refs = array();
foreach ($params_all as $key => $value) {
    $refs[$key] = & $params_all[$key];
}

// Bind and execute
call_user_func_array([$stmt, 'bind_param'], $refs);
$stmt->execute();
$result = $stmt->get_result();

// Close statement (result is buffered)
$stmt->close();

// COUNT TOTAL POSTS FOR PAGINATION
$sql_count = "SELECT COUNT(*) AS total FROM posts {$where_clause}";
$stmt2 = $conn->prepare($sql_count);
if ($params) {
    $types_count = str_repeat('s', count($params));
    $params_count = $params;
    array_unshift($params_count, $types_count);
    $refs2 = array();
    foreach ($params_count as $key => $value) {
        $refs2[$key] = & $params_count[$key];
    }
    call_user_func_array([$stmt2, 'bind_param'], $refs2);
}
$stmt2->execute();
$total = $stmt2->get_result()->fetch_assoc()['total'];
$total_pages = ceil($total / $posts_per_page);
$stmt2->close();
?>

<style>
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
    <?php include('components/topbar.php'); ?>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <?php include('components/navbar.php'); ?>
    <!-- Navbar End -->

    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Blog Posts</h1>
            </div>
        </div>
    </div>

    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">

                <!-- Blog list Start -->
                <div class="col-lg-8">
                    <div class="row g-5">
                        <?php if ($result->num_rows): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <?php
                                // Fetch category name
                                $cat_stmt = $conn->prepare("SELECT name FROM categories WHERE id = ?");
                                $cat_stmt->bind_param('i', $row['category_id']);
                                $cat_stmt->execute();
                                $cat = $cat_stmt->get_result()->fetch_assoc();
                                $category_name = $cat['name'] ?? 'Uncategorized';
                                $cat_stmt->close();
                                ?>
                                <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
                                    <div class="blog-item bg-light rounded overflow-hidden">
                                        <div class="blog-img position-relative overflow-hidden">
                                            <?php if ($row['image_path']): ?>
                                                <img class="img-fluid blog-image" src="assets/images/<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                                            <?php else: ?>
                                                <img class="img-fluid blog-image" src="img/default-image.jpg" alt="Default Image">
                                            <?php endif; ?>
                                            <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="blog.php?category=<?php echo $row['category_id']; ?>">
                                                <?php echo htmlspecialchars($category_name); ?>
                                            </a>
                                        </div>
                                        <div class="p-4">
                                            <div class="d-flex mb-3">
                                                <!-- <small class="me-3"><i class="far fa-user text-primary me-2"></i>Admin</small> -->
                                                <small><i class="far fa-calendar-alt text-primary me-2"></i><?php echo date('d M, Y', strtotime($row['created_at'])); ?></small>
                                            </div>
                                            <h4 class="mb-3"><?php echo htmlspecialchars($row['title']); ?></h4>
                                            <?php
                                                $content = $row['content'];
                                                $words = explode(' ', $content);
                                                $excerpt = implode(' ', array_slice($words, 0, 40));
                                                echo '<p>' . nl2br($excerpt) . (count($words) > 50 ? '...' : '') . '</p>';
                                            ?>
                                            <a class="text-uppercase" href="post.php?id=<?php echo $row['id']; ?>" target="_blank">Read More <i class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No posts found.</p>
                        <?php endif; ?>
                    </div> <!-- /.row g-5 -->

<p></p>

                    <!-- Pagination -->
                    <?php if ($total_pages > 1): ?>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <?php if ($page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="blog.php?page=<?php echo $page-1; ?><?php echo $search? '&search='.urlencode($search): ''; ?><?php echo $category? '&category='.urlencode($category): ''; ?>">Previous</a>
                                    </li>
                                <?php endif; ?>
                                <?php for ($i=1; $i<=$total_pages; $i++): ?>
                                    <li class="page-item <?php echo $i==$page? 'active':''; ?>">
                                        <a class="page-link" href="blog.php?page=<?php echo $i; ?><?php echo $search? '&search='.urlencode($search): ''; ?><?php echo $category? '&category='.urlencode($category): ''; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                <?php if ($page < $total_pages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="blog.php?page=<?php echo $page+1; ?><?php echo $search? '&search='.urlencode($search): ''; ?><?php echo $category? '&category='.urlencode($category): ''; ?>">Next</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div> <!-- /.col-lg-8 -->

                <!-- Sidebar Start -->
                <div class="col-lg-4">
                    <!-- Search Form -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <form method="GET" action="blog.php" class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control p-3" placeholder="Search Posts..." name="search" value="<?php echo htmlspecialchars($search); ?>">
                                <button class="btn btn-primary px-4" type="submit"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <!-- Categories -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Categories</h3>
                        </div>
                        <ul class="list-unstyled link-animated d-flex flex-column">
                            <?php
                            $cats = $conn->query("SELECT c.id, c.name, COUNT(p.id) AS count FROM categories c LEFT JOIN posts p ON p.category_id=c.id GROUP BY c.id ORDER BY c.name");
                            while($rc = $cats->fetch_assoc()): ?>
                                <li>
                                    <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2 d-flex align-items-center" href="blog.php?category=<?php echo $rc['id']; ?>">
                                        <i class="bi bi-arrow-right me-2"></i>
                                        <span><?php echo htmlspecialchars($rc['name']); ?> (<?php echo $rc['count']; ?>)</span>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>

                    <!-- Recent Posts -->
                    <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="mb-0">Recent Posts</h3>
                        </div>
                        <ul class="list-unstyled link-animated d-flex flex-column">
                            <?php
                            $recent = $conn->query("SELECT id,title,image_path FROM posts ORDER BY created_at DESC LIMIT 5");
                            while($rp = $recent->fetch_assoc()):
                                $img = $rp['image_path']? 'assets/images/'.htmlspecialchars($rp['image_path']): 'img/placeholder.jpg';
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
                </div>
                <!-- Sidebar End -->

            </div> <!-- /.row g-5 -->
        </div> <!-- /.container py-5 -->
    </div> <!-- /.container-fluid -->
    <!-- Blog End -->



    <!-- Footer Start -->
    <?php include('components/footer.php'); ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

    <?php include('components/scripts.php'); ?>
</body>

</html>
