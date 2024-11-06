<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Job apply</title>
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

    $student_id = $_POST['student_id'];
    $job_id = $_POST['job_id'];

    // Fetch the last apply date for the job
    $job_query = "SELECT last_apply_date FROM job_listing WHERE job_id = '$job_id'";
    $job_result = mysqli_query($con, $job_query);
    $job_row = mysqli_fetch_assoc($job_result);
    $last_apply_date = $job_row['last_apply_date'];
    $application_date = date('Y-m-d');

    // Compare current date with last apply date
    if ($application_date > $last_apply_date) {
        echo '<div class="alert alert-danger text-center mt-3">The last date to apply for this job is over. You cannot apply for this job.<a href="job_listing.php"> Click here</a></div>';
        

    } else {
        $application_date = date('Y-m-d');

        $sql = "INSERT INTO applications (candidate_id, job_id, application_date) VALUES ('$student_id', '$job_id', '$application_date')";

        if (mysqli_query($con, $sql)) {
            echo '<div class="alert alert-success text-center mt-3">Application successful.<a href="job_listing.php"> Click here</a> to go back to the jobs page.</div>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }

    mysqli_close($con);
} else {
    header("Location: job_listing.php");
    exit();
}
?>



</body>
</html>