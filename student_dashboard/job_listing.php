<?php
session_start();
if (!isset($_SESSION['candidate_info'])) {
    header("Location: login_student.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Campus Recruitment System</title>
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
    <?php include 'navbar.php'; ?>
<div class="container-fluid">
    <div class="row">
        <?php include 'sidebar.php'; ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

            <!-- job listing -->

            <?php
            $host = 'localhost';
            $user = 'root';
            $pass = '';
            $db = 'project';

            $con = mysqli_connect($host, $user, $pass, $db);

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $student_id = $_SESSION['candidate_info']['id'];

            $sql = "SELECT job_id, job_title, job_description, company_name, location, requirements, 
                    DATE_FORMAT(last_apply_date, '%d-%m-%Y') AS formatted_last_apply_date 
                    FROM job_listing";
            $result = mysqli_query($con, $sql);

            echo "<h2>Available Jobs</h2>";
            echo "<table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Job Description</th>
                            <th>Company Name</th>
                            <th>Location</th>
                            <th>Requirements</th>
                            <th>Last Apply Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['job_title']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['job_description']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['company_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['requirements']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['formatted_last_apply_date']) . "</td>";
                    echo "<td>
                            <form action='apply_job.php' method='post'>
                                <input type='hidden' name='job_id' value='" . htmlspecialchars($row['job_id']) . "'>
                                <input type='hidden' name='student_id' value='" . htmlspecialchars($student_id) . "'>
                                <input type='submit' name='apply' value='Apply' class='btn btn-primary'>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No jobs available at the moment.</td></tr>";
            }

            echo "</tbody></table>";

            mysqli_close($con);
            ?>

            <!-- job listing ends -->

        </main>
    </div>
</div>

<!-- footer start -->
<?php include 'footer.php'; ?>
<!-- footer end -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
