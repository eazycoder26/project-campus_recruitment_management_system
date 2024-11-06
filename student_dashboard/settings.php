<?php
// session_start();
// if (!isset($_SESSION['candidate_info'])) {
//     header("Location: login_student.php");
//     exit();
// }
?>

<!-- code for password change -->

<?php
session_start();
require 'config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Check if the email and old password match with the database
    $sql = "SELECT * FROM candidate_registration WHERE email = ? AND password = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $email, $old_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the password in the database
        $update_sql = "UPDATE candidate_registration SET password = ? WHERE email = ?";
        $update_stmt = $con->prepare($update_sql);
        $update_stmt->bind_param("ss", $new_password, $email);
        
        if ($update_stmt->execute()) {
            // Redirect to the login page after successful password change
            header("Location: /EUPHORIA/project_campus_management/campus_recruitment_management_system/login_student.php");
            exit();
        } else {
            echo '<div class="alert alert-danger text-center mt-3">Error updating password!</div>';
        }
    } else {
        echo '<div class="alert alert-danger text-center mt-3">Invalid email or old password!</div>';
    }
    
    $stmt->close();
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<head>
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
<?php include 'navbar.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php include 'sidebar.php'; ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

            <!-- settings starts -->
            <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
                    <div class="card p-4" style="width: 100%; max-width: 400px;">
                        <h2 class="text-center text-primary">Change Password</h2>
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="email">Enter Email</label>
                                <input type="email" name="email" id="email" class="form-control mb-2 " required>
                            </div>
                            <div class="form-group">
                                <label for="password">Enter Old Password</label>
                                <input type="password" name="old_password" id="old_password" class="form-control mb-2" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Enter New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control mb-2" required>
                            </div>
                            
                                <button type="submit" name="submit" class="btn btn-primary btn-block mt-3 col-12">Submit</button>
                            
                        </form>
                    </div>
                </div>

            <!-- settings ends  -->

            

    
        </main>
    </div>
</div>


<!-- footer starts -->

<?php include 'footer.php'; ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>