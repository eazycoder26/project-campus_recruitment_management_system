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
<?php require 'navbar.php'; ?>
<div class="container-fluid">
    <div class="row">
        <?php include 'sidebar.php'; ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <?php 
            require('config.php');
        ?>
        <?php 
            // require('side_navbar.php');  
        ?>
        <div class="container fluid">
            <div class="row">
                <div class=" d-flex justify-content-end mb-1 mt-3">
                                <a href="company_reg.php" class="btn btn-success">Add New Company </a>
                </div>
            </div>
        </div>

            <div class="container">
                <h1 class="text-center text-primary">All Companies</h1>
                <?php
                $src="SELECT * FROM company_reg";
                $rs=mysqli_query($con, $src);
                // echo mysqli_num_rows($rs) //Count number of record in record set
                if(mysqli_num_rows($rs)>0){
                    ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Company ID</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Address</th>
                                <th>City</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($rec=mysqli_fetch_assoc($rs)){
                                // $dob= strtotime($rec['dob']);

                                // $dob=date("d-M-Y", $dob);
                                ?>
                                <tr>
                                    <td><?php echo $rec['c_name'] ?></td>
                                    <td><?php echo $rec['c_id'] ?></td>
                                    <td><?php echo $rec['email'] ?></td>
                                    <td><?php echo $rec['password'] ?></td>                          
                                    <td><?php echo $rec['address'] ?></td>
                                    <td><?php echo $rec['city'] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                }else{
                    ?>
                    <h3 class="text-center text-danger">Sorry no user details found</h3>
                    <?php
                }
                ?>
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








</body>
</html>