<?php

include("../db_connect.php");

session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$threads_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $threads_per_page;

$search = isset($_GET['search']) ? $_GET['search'] : '';

try {
  $search = mysqli_real_escape_string($conn, $search);

  $sql = "SELECT * FROM threads WHERE title LIKE '%$search%' OR author LIKE '%$search%' ORDER BY created_at DESC LIMIT $start, $threads_per_page";
  $result = $conn->query($sql);

  $threads = array();
  while ($row = $result->fetch_assoc()) {
    $threads[] = $row;
  }

  $sql = "SELECT COUNT(*) FROM threads WHERE title LIKE :search OR author LIKE :search";
  $sql = "SELECT COUNT(*) FROM threads WHERE title LIKE '%$search%' OR author LIKE '%$search%'";
  $result = $conn->query($sql);
  $total_threads = $result->fetch_row()[0];
  $total_pages = ceil($total_threads / $threads_per_page);
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include('components/head.php'); ?>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <?php include('components/sidebar.php'); ?>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <?php include('components/logo_header.php'); ?>
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <?php include('components/navbar.php'); ?>
        <!-- End Navbar -->
      </div>

      <div class="container">
        <div class="page-inner">

          <?php
          if (isset($_GET['message'])) {
            echo "<div class='alert alert-success'>" . $_GET['message'] . "</div>";
          }
          ?>

          <div class="row">
            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">Threads</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

                      <p>

                      <form method="GET" action="community.php" class="mb-3">
                         
                          <div class="form-group">
                          <div class="input-icon">
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Search threads"
                              name="search"
                            />
                            <button class="input-icon-addon" type="submit" style="border: none; background: none;">
                              <i class="fa fa-search"></i>
                            </button>
                          </div>
                        </div>
                      </form>

                      </p>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <h4 class="card-title mb-4"> <a href="create_thread.php" class="btn btn-primary text-white">Create Thread</a></h4>

          <?php if ($threads): ?>
            <div class="row">
              <?php foreach ($threads as $thread): ?>
                <div class="col-md-4">
                  <div class="card card-round">
                    <div class="card-header">
                      <div class="card-head-row card-tools-still-right">
                        <h5 class="card-title">
                          <a href="view_thread.php?id=<?php echo $thread["id"]; ?>">
                            <?php echo htmlspecialchars($thread["title"]); ?>
                          </a>
                        </h5>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="table-responsive">
                            <p class="card-text">
                              Created by <?php echo htmlspecialchars($thread["author"]); ?> on <?php echo date('F j, Y, g:i a', strtotime($thread["created_at"])); ?>
                            </p>


                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <p>No threads yet.</p>
          <?php endif; ?>
        </div>
      </div>

      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <?php if ($total_pages > 1): ?>
            <?php if ($page > 1): ?>
              <li class="page-item">
                <a class="page-link" href="community.php?page=<?php echo $page - 1; ?>">Previous</a>
              </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
              <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                <a class="page-link" href="community.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
              </li>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
              <li class="page-item">
                <a class="page-link" href="community.php?page=<?php echo $page + 1; ?>">Next</a>
              </li>
            <?php endif; ?>
          <?php endif; ?>
        </ul>
      </nav>

      <?php include('components/footer.php'); ?>
    </div>


  </div>
  <?php include('components/scripts.php'); ?>
</body>

</html>