<!-- php code to upload resume start  -->

<?php
session_start();
require 'config.php'; // Include your database connection file

if (!isset($_SESSION['candidate_info'])) {
    header("Location: login_student.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $candidate_id = $_SESSION['candidate_info']['id'];
    $upload_dir = 'uploads/';

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_name = $_FILES['resume']['name'];
    $file_tmp = $_FILES['resume']['tmp_name'];
    $file_size = $_FILES['resume']['size'];
    $file_error = $_FILES['resume']['error'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $allowed = array('pdf', 'doc', 'docx');

    if (in_array($file_ext, $allowed)) {
        if ($file_error === 0) {
            if ($file_size < 5000000) { // 5MB limit
                $file_new_name = uniqid('', true) . "." . $file_ext;
                $file_destination = $upload_dir . $file_new_name;

                // Check if the student has already uploaded a resume
                $sql = "SELECT path FROM resume_details WHERE std_id = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $candidate_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Fetch the existing resume path
                    $row = $result->fetch_assoc();
                    $existing_resume_path = $row['path'];

                    // Delete the existing resume file
                    if (file_exists($existing_resume_path)) {
                        unlink($existing_resume_path);
                    }

                    // Delete the existing resume entry from the database
                    $sql_delete = "DELETE FROM resume_details WHERE std_id = ?";
                    $stmt_delete = $con->prepare($sql_delete);
                    $stmt_delete->bind_param("i", $candidate_id);
                    $stmt_delete->execute();
                }

                // Move the new file to the destination and update the database
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $sql_insert = "INSERT INTO resume_details (path, std_id) VALUES (?, ?)";
                    $stmt_insert = $con->prepare($sql_insert);
                    $stmt_insert->bind_param("si", $file_destination, $candidate_id);

                    if ($stmt_insert->execute()) {
                        echo '<div class="alert alert-success text-center mt-3">Resume uploaded successfully!</div>';
                    } else {
                        echo '<div class="alert alert-danger text-center mt-3">Database update failed!</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger text-center mt-3">Error moving the uploaded file!</div>';
                }
            } else {
                echo '<div class="alert alert-danger text-center mt-3">Your file is too big!</div>';
            }
        } else {
            echo '<div class="alert alert-danger text-center mt-3">There was an error uploading your file!</div>';
        }
    } else {
        echo '<div class="alert alert-danger text-center mt-3">You cannot upload files of this type!</div>';
    }
}
?>

<!-- php code to upload resume end -->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Student Dashboard</title>
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
    require 'navbar.php'; 
?>

<!-- upload resume start -->

<div class="container-fluid">
    <div class="row">
        <?php 
        include 'sidebar.php';
         ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <!-- <div class="container mt-5"> -->
            <div class="container card p-4 mt-5 " style="width: 100%; max-width: 800px;">
                <h2 class="text-center text-primary">Upload / Update Resume</h2>
                
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row justify-content-center">
                        <div class="col-md-6"> <!--Adjust the width as needed  -->
                            <!-- <form action="" method="post" enctype="multipart/form-data"> -->
                                <div class="form-group">
                                    <label for="resume">Choose Resume</label>
                                    <input type="file" name="resume" id="resume" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block mt-3 col-12">Upload</button>
                            <!-- </form> -->
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<!-- upload resume end -->

<?php include 'footer.php'; ?>    

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
