<?php include('logic/courses_logic.php'); ?>

<!DOCTYPE html>
<html lang="en">
<?php include('components/head.php'); ?>
<!-- Load TinyMCE CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
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




          <div class="row">
            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">Register Courses</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">

                      <p>
                        <?php
                        if (isset($_GET['message'])) {
                          echo "<div class='alert alert-success'>" . $_GET['message'] . "</div>";
                        }
                        ?>
                      <form action="process_courses.php" method="post" class="row g-3">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fa fa-building"></i>
                            </span>
                            <input type="text" id="course_name" name="course_name"
                              value="<?php echo $course_name; ?>" required class="form-control"
                              placeholder="Course Name" />
                          </div>
                        </div>

                        

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-money-bill-wave"></i>
                            </span>
                            <input type="text" id="price" name="price" value="<?php echo $price; ?>" required
                              class="form-control" placeholder="Price" />
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-clock"></i>
                            </span>
                            <input type="text" id="duration" name="duration" value="<?php echo $duration; ?>" required
                              class="form-control" placeholder="Duration" />
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fas fa-file-alt"></i>
                            </span>
                            <!-- <input type="text" id="description" name="description" value="<?php echo $description; ?>" required
                              class="form-control" placeholder="Course Description" /> -->
                            <textarea name="description" id="description" class="form-control" placeholder="Course Description" required><?php echo $description; ?></textarea>

                          </div>
                        </div>

                        <div class="col-md-2">
                          <button type="submit" name="<?php echo isset($_GET['id']) ? 'update' : 'register'; ?>"
                            class="btn btn-primary"><?php echo isset($_GET['id']) ? 'Update' : 'Register'; ?></button>
                        </div>
                      </form>

                      </p>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">Course List</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">


                      <div class="table-responsive">
                        <table id="basic-datatables" class="table table-striped table-bordered">
                          <thead class="table-dark">
                            <tr>
                              <th>ID</th>
                              <th>Course Name</th>
                              <th>Description</th>
                              <th>Price</th>
                              <th>Duration</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if ($result->num_rows > 0): ?>
                              <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                  <td><?= htmlspecialchars($row["id"]) ?></td>
                                  <td><?= htmlspecialchars($row['course_name']) ?></td>
                                  <td><?= $row['description'] ?></td>
                                  <td><?= htmlspecialchars($row['price']) ?></td>
                                  <td><?= htmlspecialchars($row['duration']) ?></td>
                                  <td>
                                    <a href="courses.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <!-- <a href="delete_course.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                      onclick="return confirm('Are you sure?')">Delete</a> -->
                                  </td>
                                </tr>
                              <?php endwhile; ?>
                            <?php else: ?>
                              <tr>
                                <td colspan="4" class="text-center text-muted">No Courses registered yet.</td>
                              </tr>
                            <?php endif; ?>
                            <?php $conn->close(); ?>
                          </tbody>
                        </table>
                      </div>



                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <?php include('components/footer.php'); ?>
    </div>


  </div>
  <?php include('components/scripts.php'); ?>

      <!-- TinyMCE Initialization -->
    <script>
        tinymce.init({
            selector: '#description',
            menubar: false,
            toolbar: 'undo redo | formatselect | bold italic underline superscript subscript | alignleft aligncenter alignright | bullist numlist outdent indent | table | tableprops tablecellprops tableinsertrowbefore tableinsertrowafter tabledeleterow tableinsertcolbefore tableinsertcolafter tabledeletecol',
            plugins: 'lists table',
            branding: false,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });

        document.querySelector('form').addEventListener('submit', function() {
            tinymce.triggerSave();
            // Debugging: Log TinyMCE content
            console.log("Question: ", tinymce.get('description').getContent());
        });
    </script>
</body>

</html>
