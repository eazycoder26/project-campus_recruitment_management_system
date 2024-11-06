<!-- php code starts -->

<?php
require("config.php");
if (isset($_POST['submit'])) {
    $C_name = $_POST['c_name'];
    $c_id = $_POST['c_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    // Insert data into the database
                    $sql = "INSERT INTO company_reg (c_name, c_id , email, 
                    password, address, city)
                     VALUES ('$C_name','$c_id', '$email', '$password', '$address', '$city')";

                    if (mysqli_query($con, $sql)) {
                        echo "Registration successful!";
                    }
                    else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($con);
                    }
//                 } else {
//                     echo "There was an error uploading your file!";
//                 }
//             } else {
//                 echo "Your file is too big!";
//             }
//         } else {
//             echo "There was an error uploading your file!";
//         }
//     } else {
//         echo "You cannot upload files of this type!";
//     }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Campus Ricuirtment System</title>
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
<?php require 'navbar.php'; ?>
<div class="container-fluid">
    <div class="row">
        <?php include 'sidebar.php'; ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="container-xxl bg-white p-0">
                <div class="container">
                    <div class="col-md-6 offset-md-3">
                        <h2 class="text-center text-primary">Company Registration</h2>
                        <form id="reg-form" method="post" enctype="multipart/form-data" action="">
                            <div class="form-group">
                                <label for="C_name">Enter Company Name</label>
                                <input type="text" name="C_name" id="C_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="c_id">Enter Company ID</label>
                                <input type="number" name="c_id" id="c_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Enter Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Enter Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
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
                            <div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block col-12 mt-3">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<!-- Footer Start -->
<?php require'footer.php'?>     
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
