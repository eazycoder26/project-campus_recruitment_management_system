<?php
session_start();
require 'config.php';

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_title = $_POST['job_title'];
    $job_description = $_POST['job_description'];
    $company_name = $_POST['company_name'];
    $location = $_POST['location'];
    $requirements = $_POST['requirements'];
    $last_apply_date = $_POST['last_date']; // Corrected name here

    $sql = "INSERT INTO job_listing (job_title, job_description, company_name, location, requirements, last_apply_date) VALUES ('$job_title', '$job_description', '$company_name', '$location', '$requirements', '$last_apply_date')";

    if (mysqli_query($con, $sql)) {
        $message = '<div class="alert alert-success text-center mt-3">Job added successfully!</div>';
        echo $message;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add Jobs</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

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

<?php require 'navbar.php'; ?>
<div class="container-fluid">
    <div class="row">
        <?php include 'sidebar.php'; ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="container-fluid bg-white">
                <div class="col-md-6 offset-md-3">
                    <h2 class="text-center text-primary mt-3">Add Job Listing</h2>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="job_title" class="mt-3"><strong>Job Title</strong></label>
                            <input type="text" name="job_title" id="job_title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="job_description" class="mt-3"><strong>Job Description</strong></label>
                            <textarea name="job_description" id="job_description" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="company_name" class="mt-3"><strong>Company Name</strong></label>
                            <input type="text" name="company_name" id="company_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="location" class="mt-3"><strong>Location</strong></label>
                            <input type="text" name="location" id="location" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="requirements" class="mt-3"><strong>Requirements</strong></label>
                            <textarea name="requirements" id="requirements" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="last_date" class="mt-3"><strong>Last date to apply</strong></label>
                            <input type="date" name="last_date" id="last_date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-4">Add Job</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
<?php require 'footer.php'; ?>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
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
