


<?php
require 'config.php';


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $languages = implode(',', $_POST['languages']);
    $address = $_POST['address'];
    $city = $_POST['city'];
    $dept_name = $_POST['dept_name'];
    $dept_id = $_POST['dept_id'];

    $sql = "INSERT INTO candidate_registration (name, email, password, dob, gender, languages, address, city, dept_name, dept_id) VALUES ('$name', '$email', '$password', '$dob', '$gender', '$languages', '$address', '$city', '$dept_name', '$dept_id')";

    if (mysqli_query($con, $sql)) {
        $login_registration = '<div class="alert alert-success text-center mt-3">Your Registration is Successful! <a href="index.php">Click Here</a></div>';
        echo $login_registration;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<?php require 'navbar.php'; ?>
<div class="container-fluid">
    <div class="row">
        <?php include 'sidebar.php'; ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="container">

    <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-primary">Candidate Registration</h2>
        <form id="reg-form" method="post" enctype="multipart/form-data" action="">
            <div class="form-group">
                <label for="name">Enter Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Enter Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
                <div id="email-error" class="text-danger"></div>
            </div>
            <div class="form-group">
                <label for="password">Enter Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="dob">Select Date of Birth</label>
                <input type="date" name="dob" id="dob" class="form-control" required>
            </div>
            <label for="gender" class="mb-0">Select Gender</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="female" value="female" required>
                <label class="form-check-label" for="female">Female</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="others" value="others" required>
                <label class="form-check-label" for="others">Others</label>
            </div>
            <br><label class="form-check-label" for="languages">Specify Programming Languages</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="languages[]" id="c" value="C">
                <label class="form-check-label" for="c">C</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="languages[]" id="cpp" value="C++">
                <label class="form-check-label" for="cpp">C++</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="languages[]" id="python" value="Python">
                <label class="form-check-label" for="python">Python</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="languages[]" id="java" value="Java">
                <label class="form-check-label" for="java">Java</label>
            </div>
            <div class="form-group">
                <label for="address" class="mt-2">Address</label>
                <textarea name="address" id="address" rows="5" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="city">Select City</label>
                <select name="city" id="city" class="form-control" required>
                    <option value="" selected>Select City</option>
                    <option value="Kolkata">Kolkata</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Bangalore">Bangalore</option>
                    <option value="Mumbai">Mumbai</option>
                </select>
            </div>
            <div class="form-group">
                <label for="dept_name">Enter Department</label>
                <input type="text" name="dept_name" id="dept_name" class="form-control" required>
            </div>
            <div class="form-group mt-2">
                <label for="dept_id">Enter Department ID</label>
                <input type="text" name="dept_id" id="dept_id" class="form-control" required>
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">Register</button>
            </div>
        </form>
    </div>
</div>

<?php require 'footer.php'; ?>

<!-- JavaScript Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

<!-- AJAX Validation Script -->
<script>
$(document).ready(function() {
    $("#email").on('blur', function() {
        var email = $(this).val();
        $.ajax({
            url: 'validate_email.php',
            method: 'POST',
            data: {email: email},
            success: function(response) {
                if (response == 'false') {
                    $("#email-error").text('Email already exists. Please use a different email.');
                } else {
                    $("#email-error").text('');
                }
            }
        });
    });

    $("#reg-form").on('submit', function(e) {
        if ($("#email-error").text() != '') {
            e.preventDefault();
            alert('Please fix the errors in the form.');
        }
    });
});
</script>
    
        </main>
    </div>
</div>
<?php require 'footer.php';?>



</body>
</html>
