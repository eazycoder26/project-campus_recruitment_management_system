<!-- new php start -->

<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'project';

    $con = mysqli_connect($host, $user, $pass, $db);

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $sql = "SELECT * FROM candidate_registration WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $candidate = mysqli_fetch_assoc($result);
        $_SESSION['candidate_info'] = $candidate;

        // Redirect to the student dashboard
        // header("Location: student_dashboard.php");
        header("Location: student_dashboard/index.php");
        exit();
    } else {
        $login_error = '<div class="alert alert-danger text-center mt-3">Invalid email or password. Please try again.</div>';
        echo "$login_error";
    }

    mysqli_close($con);
}
?>


<!-- new php end -->


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Candidate Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">


</head>
<body>
    
<!-- navbar start -->

    <?php require 'navbar.php'; ?>

<!-- navbar end -->

<div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-12">
            <div class="bg" style="background-image: url('https://ijritcc.org/public/journals/1/submission_7655_7601_coverImage_en_US.jpg');">
                <div class="container d-flex justify-content-center align-items-center " style="min-height: 100vh;">
                    <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
                        <h2 class="text-center text-primary">Student Login</h2>
                        <form method="post" action="login_student.php">
                            <div class="form-group">
                                <label for="email">Enter Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Enter Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                            <div class="text-center mt-3">
                                <a href="forgot_password.php">Forgot Password?</a></a>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>

<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-0 wow fadeIn"
                                data-wow-delay="0.1s">
                                <div class="container py-5">
                                    <div class="row g-5">

                                        <div class="col-lg-3 col-md-6">
                                            <h5 class="text-white mb-4">Quick Links</h5>
                                            <a class="btn btn-link text-white-50" href="">About Us</a>
                                            <a class="btn btn-link text-white-50" href="">Contact Us</a>
                                            <a class="btn btn-link text-white-50" href="">Our Services</a>
                                            <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                                            <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <h5 class="text-white mb-4">Contact</h5>
                                            <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, Kolkata
                                                West Bengal</p>
                                            <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                                            <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                                            <div class="d-flex pt-2">
                                                <a class="btn btn-outline-light btn-social" href=""><i
                                                        class="fab fa-twitter"></i></a>
                                                <a class="btn btn-outline-light btn-social" href=""><i
                                                        class="fab fa-facebook-f"></i></a>
                                                <a class="btn btn-outline-light btn-social" href=""><i
                                                        class="fab fa-youtube"></i></a>
                                                <a class="btn btn-outline-light btn-social" href=""><i
                                                        class="fab fa-linkedin-in"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Footer End -->


                            <!-- Back to Top -->
                            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
                                    class="bi bi-arrow-up"></i></a>
                        </div>

                        <!-- JavaScript Libraries -->
                        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                        <script
                            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
                        <script src="lib/wow/wow.min.js"></script>
                        <script src="lib/easing/easing.min.js"></script>
                        <script src="lib/waypoints/waypoints.min.js"></script>
                        <script src="lib/owlcarousel/owl.carousel.min.js"></script>

                        <!-- Template Javascript -->
                        <script src="js/main.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
