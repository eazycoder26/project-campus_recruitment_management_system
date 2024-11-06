<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applications</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
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
    <!-- old code -->
    

    <!-- old code end -->
<?php 
session_start();
if (!isset($_SESSION['candidate_info'])) {
    header("Location: login_student.php");
    exit();
}
require 'navbar.php'; 
?>
<div class="container-fluid">
    <div class="row">
        <?php include 'sidebar.php'; ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class=" d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-success ">Your Details</h1>
            </div>
            <div class="container d-flex flex-row justify-content-center align-items-center" style="min-height: 100vh;">
                <div class="container-fluid bg-white" style="width: 100%; max-width: 900px;">
                    <div class="container mt-5">
                        <?php
                        // Database connection
                        $host = 'localhost';
                        $user = 'root';
                        $pass = '';
                        $db = 'project';

                        $con = new mysqli($host, $user, $pass, $db);

                        if ($con->connect_error) {
                            die("Connection failed: " . $con->connect_error);
                        }

                        // Get candidate ID from session
                        $candidate_id = $_SESSION['candidate_info']['id'];

                        // Fetch candidate details
                        $sql = "SELECT id, name, email, dob, gender, languages, address, city, dept_name FROM candidate_registration WHERE id = ?";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param("i", $candidate_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            // Output data of the specific row
                            $row = $result->fetch_assoc();
                        ?>
                        <form>
                            <div class="mb-3">
                                <label for="candidateId" class="form-label"><strong>ID</strong></label>
                                <input type="text" class="form-control" id="candidateId" value="<?php echo $row['id']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="candidateName" class="form-label"><strong>Name</strong></label>
                                <input type="text" class="form-control" id="candidateName" value="<?php echo $row['name']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="candidateEmail" class="form-label"><strong>Email</strong></label>
                                <input type="email" class="form-control" id="candidateEmail" value="<?php echo $row['email']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="candidateDob" class="form-label"><strong>Date of Birth</strong></label>
                                <input type="text" class="form-control" id="candidateDob" value="<?php echo $row['dob']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="candidateGender" class="form-label"><strong>Gender</strong></label>
                                <input type="text" class="form-control" id="candidateGender" value="<?php echo $row['gender']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="candidateLanguages" class="form-label"><strong>Languages</strong></label>
                                <input type="text" class="form-control" id="candidateLanguages" value="<?php echo $row['languages']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="candidateAddress" class="form-label"><strong>Address</strong></label>
                                <input type="text" class="form-control" id="candidateAddress" value="<?php echo $row['address']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="candidateCity" class="form-label"><strong>City</strong></label>
                                <input type="text" class="form-control" id="candidateCity" value="<?php echo $row['city']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="candidateDeptName" class="form-label"><strong>Department Name</strong></label>
                                <input type="text" class="form-control" id="candidateDeptName" value="<?php echo $row['dept_name']; ?>" readonly>
                            </div>
                        </form>
                        <?php
                            // Fetch resume details
                            $resume_sql = "SELECT path FROM resume_details WHERE std_id = ?";
                            $resume_stmt = $con->prepare($resume_sql);
                            $resume_stmt->bind_param("i", $candidate_id);
                            $resume_stmt->execute();
                            $resume_result = $resume_stmt->get_result();

                            if ($resume_result->num_rows > 0) {
                                $resume_row = $resume_result->fetch_assoc();
                                ?>
                                <div class="mb-3">
                                    <label for="candidateResume" class="form-label"><strong>Resume</strong></label>
                                    <a href="<?php echo $resume_row['path']; ?>" class="form-control" id="candidateResume" target="_blank">View Resume</a>
                                </div>
                                <?php
                            } else {
                                echo "<div class='alert alert-warning text-center'>No resume uploaded</div>";
                            }

                            $resume_stmt->close();
                        ?>
                        <?php
                        } else {
                            echo "<div class='alert alert-danger text-center'>No candidate details found</div>";
                        }

                        $stmt->close();
                        $con->close();
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php require 'footer.php';?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>

