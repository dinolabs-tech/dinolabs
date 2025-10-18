<? ?>
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
        <a href="index.php" class="navbar-brand p-0">
            <h3 style="color:dodgerblue;" class="m-0"><img src="./img/logo.png" alt="" width="45px">A Dinolabs Tech
                Services</h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link">Services</a>

                <?php if (isset($_SESSION["username"])) { ?>
                    <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'mod') { ?>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Blog</a>


                            <div class="dropdown-menu m-0">
                                <a href="blog.php" class="dropdown-item">Blog</a>
                                <a href="create_post.php" class="dropdown-item active">Create Post</a>
                                <a href="manage_categories.php" class="dropdown-item">Manage Categories</a>
                                <a href="dashboard.php" class="dropdown-item">Dashboard</a>
                            </div>
                             </div>
                        <?php } else { ?>
                              <a href="blog.php" class="nav-item nav-link">Blog</a>
                        <?php }?>
                       
                    <?php } else { ?>
                        
                            <a href="blog.php" class="nav-item nav-link">Blog</a>
                        
                    <?php } ?>
                

                <a href="academy.php" class="nav-item nav-link">Academy</a>
                <!-- <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="price.html" class="dropdown-item">Pricing Plan</a>
                        <a href="feature.html" class="dropdown-item">Our features</a>
                        <a href="team.html" class="dropdown-item">Team Members</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="quote.html" class="dropdown-item">Free Quote</a>
                    </div>
                </div> -->

                <a href="contact.php" class="nav-item nav-link">Contact</a>

                <?php
                if (isset($_SESSION['role'])) {
                    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff' || $_SESSION['role'] == 'sec')  { ?>
                        <a href="./backend/index.php" class="nav-item nav-link">Dashboard</a>
                   <?php } elseif ($_SESSION['role'] == 'client') { ?>
                        <a href="./backend/client_dashboard.php" class="nav-item nav-link">Dashboard</a>
                    <?php }
                }
                // If $_SESSION['role'] is not set, nothing will be displayed.
                ?>


            </div>

        </div>
    </nav>


</div>