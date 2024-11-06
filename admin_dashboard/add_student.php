<?php 
require("config.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Admin Login Page"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">

    <title>Add Student</title>
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
        <div id="page-wrapper"> 
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        
                    </div>
                    
                    <div class="col-lg-6">
                        <form role="form" name="frmCSVImport" id="frmCSVImport" method="post" enctype="multipart/form-data">
                        <div class="container">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center text-primary">Add Student Details</h2>
            <form id="reg-form" method="post" enctype="multipart/form-data" action="">
                <div class="form-group">
                    <label for="name">Enter Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                
                <br>
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
                 <label for="dept_type" class="mb-0">Select Department</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dept_type" id="bca" value="BCA" required>
                    <label class="form-check-label" for="bca">BCA</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dept_type" id="mca" value="MCA" required>
                    <label class="form-check-label" for="mca">MCA</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dept_type" id="cse" value="CSE" required>
                    <label class="form-check-label" for="cse">CSE</label>
                </div>
            
                <div>
                <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
                </div>
            </form>
        </div>
    </div>
 <?php           
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    // $department = $_POST["department"];
    $gender = $_POST['gender'];
    $languages = implode(',', $_POST['languages']);
    $address = $_POST['address'];
    $city = $_POST['city'];
    $dept_type=$_POST['dept_type'];

   
    
    $src = "SELECT * FROM candidate_registration WHERE name='$name'";
    $rs = mysqli_query($con, $src) or die(mysqli_errno($con));
    if (mysqli_num_rows($rs) > 0) {
        ?>
        <div class="alert alert-warning">
            This Student det is already exist
        </div>
        <?php
    
    // } else {
        $src = "SELECT * FROM candidate_registration WHERE name = '$name'";
        $rs = mysqli_query($con, $src) or die(mysqli_errno($con));

    //     if (mysqli_num_rows($rs) > 0) {
    //         $res=mysqli_fetch_assoc($rs);
    //         $Artist_Id=$res['Artist_id'];
        }else{
            $sql = "INSERT INTO candidate_registration";
            $src = "SELECT * FROM candidate_registration";
            $rs = mysqli_query($con, $src) or die(mysqli_errno($con));
            if (mysqli_num_rows($rs) > 0) {
                $res=mysqli_fetch_assoc($rs);
                $id=$res['id'];
            }
        

        $src = "SELECT * FROM department WHERE dept_type = '$dept_type'";
        $rs = mysqli_query($con, $src) or die(mysqli_errno($con));
        if (mysqli_num_rows($rs) > 0) {
            $res=mysqli_fetch_assoc($rs);
            $dept_id=$res['dept_id'];
        }else{
            $sql = "INSERT INTO department (dept_type) VALUES ('$dept_type')";
            $rs = mysqli_query($con, $sql) or die(mysqli_error($con));
            $src = "SELECT * FROM department WHERE dept_type = '$dept_type'";
            $rs = mysqli_query($con, $src) or die(mysqli_errno($con));
            if (mysqli_num_rows($rs) > 0) {
                $res=mysqli_fetch_assoc($rs);
                $dept_id=$res['dept_id'];
            }

        }

        $sql = "INSERT INTO candidate_registration (name,gender,languages,address,city,dept_id) VALUES ('$name','$gender','$languages','$address','$city','$dept_id')";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));
        if ($res == 1) {
            ?>
            <div class="alert alert-success">
            Student details Loaded Successfully
            </div>
            <?php
                    
        } else {
            ?>
                <div class="alert alert-danger">
                    Student details load unsuccessfull
                </div>
            <?php
        }
            } 
        
        }



    
               
?>  
                       

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
    
    <!--  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>

   
