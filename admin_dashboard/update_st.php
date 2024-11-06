<?php
require_once('config.php');
// require_once('checksession.php');
session_start();
if (isset($_POST['ok'])) {
    $id = $_POST['id'];
    $_SESSION['id'] = $id;
} else {
    $id = $_SESSION['id'];
}

$src = "SELECT s.*, d.dept_type
FROM candidate_registration s
INNER JOIN department d ON s.dept_id = d.dept_id
WHERE s.id = $id";
$rs = mysqli_query($con, $src) or die(mysqli_errno($con));
$rec = mysqli_fetch_assoc($rs);
$languages=explode(',', $rec['languages']);
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
<?php require 'navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                
        
        <h2 class="text-center text-primary">Edit Student Details</h2>
            <form id="reg-form" method="post" enctype="multipart/form-data" action="">
                <div class="form-group">
                    <label for="name">Enter Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $rec['name'] ?>" class="form-control" required>
</div>
    <br>
                <label for="gender" class="mb-0">Select Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male"  value="Male" <?php if($rec['gender']==="Male") echo "checked";?>>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if($rec['gender']==="Female") echo "checked";?>>
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="others" value="others" <?php if($rec['gender']==="Otheer") echo "checked";?>>
                    <label class="form-check-label" for="others">Others</label>
                </div>
                <br>
                <label class="form-check-label" for="languages">Specify Programming Languages</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="languages[]" id="c" value="C"  <?php
                if(in_array('C',$languages)){
                    echo 'checked';
                }
                ?>>
                    <label class="form-check-label" for="c">C</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="languages[]" id="cpp" value="C++"  <?php
                if(in_array('C++', $languages)){
                    echo 'checked';
                }
                ?>>
                    <label class="form-check-label" for="cpp">C++</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="languages[]" id="python" value="Python"  <?php
                if(in_array('Python', $languages)){
                    echo 'checked';
                }
                ?>>
                    <label class="form-check-label" for="python">Python</label>
                </div>
                <div class="form-group">
                    <label for="address" class="mt-2">Address</label>
                    <textarea name="address" id="address" rows="5" cols="50" class="form-control" required><?php echo $rec['address']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="city">Select City</label>
                    <select name="city" id="city" class="form-control" required>
                        <option value="Kolkata" <?php if($rec['city']==="Kolkata") echo "selected";?>>Kolkata</option>
                        <option value="Delhi"<?php if($rec['city']==="Ddelhi") echo "selected";?>>Delhi</option>
                        <option value="Bangalore"<?php if($rec['city']==="Bangalore") echo "selected";?>>Bangalore</option>
                        <option value="Mumbai"<?php if($rec['city']==="Mumbai") echo "selected";?>>Mumbai</option>
                    </select>
                </div>
                 <label for="dept_type" class="mb-0">Select Department</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dept_type" id="bca" value="BCA" <?php if($rec['dept_type']==="BCA") echo "checked";?>>
                    <label class="form-check-label" for="bca">BCA</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dept_type" id="mca" value="MCA"<?php if($rec['dept_type']==="MCA") echo "checked";?>>
                    <label class="form-check-label" for="mca">MCA</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dept_type" id="cse" value="CSE" <?php if($rec['dept_type']==="CSE") echo "checked";?>>
                    <label class="form-check-label" for="cse">CSE</label>
                </div>
<br>
                            <input type="submit" name="submit" value="Update" class="btn btn-primary mt-2">
                        </form>
                        </div>
                </div>
            </div>
        </main>
      
 <?php

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    // $department = $_POST["department"];
    $gender = $_POST['gender'];
    $languages = implode(',', $_POST['languages']);
    $address = $_POST['address'];
    $city = $_POST['city'];
    $dept_type=$_POST['dept_type'];

                           
    
        $src = "SELECT * FROM candidate_registration WHERE name = '$name'";
        $rs = mysqli_query($con, $src) or die(mysqli_errno($con));

        if (mysqli_num_rows($rs) > 0) {
            $res=mysqli_fetch_assoc($rs);
            $Artist_Id=$res['id'];
        }else{
            $sql = "INSERT INTO candidate_registration";
            $src = "SELECT * FROM candidate_registration";
            $rs = mysqli_query($con, $src) or die(mysqli_errno($con));
            if (mysqli_num_rows($rs) > 0) {
                $res=mysqli_fetch_assoc($rs);
                $id=$res['id'];
            }
        
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

        $sql = "UPDATE candidate_registration SET name='$name',gender='$gender',languages='$languages',address='$address',city='$city',dept_id='$dept_id' WHERE id=$id" ;
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));
        if ($res == 1) {
            unset($_SESSION['id']);
        
    ?>
            <div class="alert alert-success">
                Updated Successfully
            </div>
        
            <script>
                window.location = 'candidate_view.php';
            </script>
            <?php  
             } else {
            unset($_SESSION['id']);
        ?>
            <div class="alert alert-danger">
                Details is not updated successfully
            </div>
    <?php
            header('location : candidate_view.php');
      
      }  }
    
    ?>     
        


        <?php require('footer.php') ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>