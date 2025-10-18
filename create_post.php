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

<?php include('components/head.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
 
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
                <h1 class="display-4 text-white animated zoomIn">Create Post</h1>
            </div>
        </div>
    </div>


    <!-- Quote Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="bg-primary rounded p-5 wow zoomIn" data-wow-delay="0.9s">
                    <form action="save_post.php" method="post" enctype="multipart/form-data" class="row g-4" novalidate>
                        
                        <div class="col-12">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Post Title" required>
                        </div>

                        <div class="col-12">
                            <textarea class="form-control" id="content" name="content" placeholder="Content" rows="6" ></textarea>
                        </div>

                        <div class="col-12">
                            <label for="image" class="form-label text-white">Upload Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>

                        <div class="col-12">
                            <select class="form-select" id="category" name="category" required>
                                <option value="">Select Category</option>
                                <?php
                                $sql_categories = "SELECT id, name FROM categories";
                                $result_categories = $conn->query($sql_categories);
                                if ($result_categories->num_rows > 0) {
                                    while ($row_category = $result_categories->fetch_assoc()) {
                                        echo "<option value='" . $row_category["id"] . "'>" . htmlspecialchars($row_category["name"]) . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No categories available</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-light px-5 py-2">Save Post</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Quote End -->



    <script>
    tinymce.init({
      selector: '#content',
      menubar: false,
      toolbar: 'undo redo | formatselect | bold italic underline superscript subscript | alignleft aligncenter alignright | bullist numlist outdent indent | table',
      plugins: 'lists',
      branding: false
    });

    document.querySelector('form').addEventListener('submit', function(e) {
  if (tinymce.get('content').getContent({ format: 'text' }).trim() === '') {
    alert('Please enter some content.');
    e.preventDefault();
  }
});

  </script>

    <!-- Footer Start -->
    <?php include('components/footer.php'); ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

    <?php include('components/scripts.php'); ?>
</body>

</html>