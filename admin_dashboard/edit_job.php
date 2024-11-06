<?php
session_start();
require 'config.php';

// Check if job_id is set
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];

    // Fetch job details from database
    $sql = "SELECT * FROM job_listing WHERE job_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $job = $result->fetch_assoc();

    if (!$job) {
        echo "Job not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

// Handle form submission for updating job details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_title = $_POST['job_title'];
    $job_description = $_POST['job_description'];
    $company_name = $_POST['company_name'];
    $location = $_POST['location'];
    $requirements = $_POST['requirements'];
    $last_apply_date = $_POST['last_apply_date'];

    $sql = "UPDATE job_listing SET job_title = ?, job_description = ?, company_name = ?, location = ?, requirements = ?, last_apply_date = ? WHERE job_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssi", $job_title, $job_description, $company_name, $location, $requirements, $last_apply_date, $job_id);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success text-center mt-3">Job updated successfully!</div>';
    } else {
        echo "Error updating job: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Edit Job</title>
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
            <div class="container">
            <h2 class="text-center text-primary mt-3">Edit Job Listing</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="job_title"><strong>Job Title</strong></label>
                    <input type="text" name="job_title" id="job_title" class="form-control" value="<?php echo htmlspecialchars($job['job_title']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="job_description"><strong>Job Description</strong></label>
                    <textarea name="job_description" id="job_description" rows="5" class="form-control" required><?php echo htmlspecialchars($job['job_description']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="company_name"><strong>Company Name</strong></label>
                    <input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo htmlspecialchars($job['company_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="location"><strong>Location</strong></label>
                    <input type="text" name="location" id="location" class="form-control" value="<?php echo htmlspecialchars($job['location']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="requirements"><strong>Requirements</strong></label>
                    <textarea name="requirements" id="requirements" rows="5" class="form-control" required><?php echo htmlspecialchars($job['requirements']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="last_apply_date"><strong>Last Date to Apply</strong></label>
                    <input type="date" name="last_apply_date" id="last_apply_date" class="form-control" value="<?php echo htmlspecialchars($job['last_apply_date']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4 col-12">Update Job</button>
            </form>
        </div>

    
        </main>
    </div>
</div>
        <?php require 'footer.php';?>
</body>
</html>
