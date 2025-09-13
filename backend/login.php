<?php include('../database_schema.php'); ?>

<!DOCTYPE html>
<html lang="en">
<?php include('components/head.php'); ?>
<!-- Custom Styles -->
<style>
    body {
        background-image: url('../img/ad1.png');
        background-size: cover;
        background-position: center;
        height: 100vh;
        margin: 0;
    }

    .card {
        background-color: rgba(0, 0, 0, 0.7);
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        animation: fadeIn 1s ease-in;
        max-width: 400px;
        width: 100%;
    }

    .card-body {
        padding: 2.5rem;
    }

    .error {
        color: #dc3545;
        margin-bottom: 1.5rem;
        font-weight: 500;
        text-align: center;
    }

    .input-group-text {
        background-color: rgba(255, 255, 255, 0.1);
        border: none;
        color: white;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.1);
        border: none;
        color: white;
        border-radius: 5px;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.2);
        box-shadow: none;
        color: white;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 0.75rem;
        font-size: 1.1rem;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }

    .login-title {
        color: white;
        font-family: 'Public Sans', sans-serif;
        font-weight: 600;
        font-size: 2rem;
    }

    .back-link {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .back-link:hover {
        color: white;
        text-decoration: underline;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<body>
    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="login-title text-center mb-4">Login</h2>

                                    <?php
                                    if (isset($_GET['error'])) {
                                        echo "<div class='alert alert-danger'>" . $_GET['error'] . "</div>";
                                    }
                                    ?>

                                    <form method="post" action="process_login.php">
                                        <div class="input-group mb-3">
                                            <label for="yourUsername" class="visually-hidden">Username</label>
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" name="username" class="form-control" id="yourUsername"
                                                placeholder="Enter Username...">
                                        </div>
                                        <div class="input-group mb-4">
                                            <label for="yourPassword" class="visually-hidden">Password</label>
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" placeholder="Password">
                                        </div>
                                        <button class="btn btn-primary w-100" type="submit">Login</button>
                                    </form>
                                    <div class="text-center mt-3">
                                        <a href="../index.php" class="back-link">Back to Homepage</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>


    <!-- Core JS Files -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- jQuery Sparkline -->
    <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="assets/js/kaiadmin.min.js"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="assets/js/setting-demo.js"></script>
</body>

</html>
