<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Admin Dashboard</title>
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
            <div class="d-flex justify-content-end mb-1">
                <a href="add_jobs.php" class="btn btn-success mt-3">Add New Job</a>
            </div>
            <?php

            require 'config.php';

            // Fetch job listings from the database
            $sql = "SELECT * FROM job_listing";
            $result = mysqli_query($con, $sql);
            ?>
            <?php
            // require 'config.php';

            // Fetch job listings and count of applications
            $sql = "SELECT j.*, COUNT(a.candidate_id) AS num_applications 
                    FROM job_listing j
                    LEFT JOIN applications a ON j.job_id = a.job_id
                    GROUP BY j.job_id";
            $result = mysqli_query($con, $sql);
            ?>
            <div class="container card p-4 mt-5" style="width: 100%; max-width: 1200px;">
                <h2 class="text-center text-primary">Job Listings</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Job ID</th>
                                <th>Job Title</th>
                                <th>Job Description</th>
                                <th>Company Name</th>
                                <th>Location</th>
                                <th>Requirements</th>
                                <th>Last Apply Date</th>
                                <th>Applications</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $formatted_date = (new DateTime($row['last_apply_date']))->format('d-m-Y');
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['job_id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['job_title']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['job_description']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['company_name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['requirements']) . "</td>";
                                    echo "<td>" . htmlspecialchars($formatted_date) . "</td>";
                                    echo "<td>" . $row['num_applications'] . "</td>";
                                    echo "<td>
                                            <a href='edit_job.php?job_id=" . htmlspecialchars($row['job_id']) . "' class='btn btn-warning btn-sm'>Edit</a>
                                            <a href='delete_job.php?job_id=" . htmlspecialchars($row['job_id']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this job?\")'>Delete</a>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>No job listings found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
<?php require 'footer.php';?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
