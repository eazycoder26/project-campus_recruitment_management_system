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
                    require_once('config.php');
                // require_once('a_checksession.php');
                ?>
                
                    <div class="container">
                    <h1 class="text-center text-success">All Deperment</h1>
                <?php
                    if(isset($_SESSION['msg'])){
                        ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['msg']; ?>
                        </div>
                        <?php
                        unset($_SESSION['msg']);
                    }
                    if(isset($_SESSION['err'])){
                        ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['err']; ?>
                        </div>
                        <?php
                        unset($_SESSION['err']);
                    }
                ?>
                <body class="sb-nav-fixed">
                    <div id="layoutSidenav_content" class=" bg-body-secondary">
                        
                    <div class="container fluid">
                    <div class="row">
                        <div class=" d-flex justify-content-end mb-3 mt-3">
                                        <a href="#" class="btn btn-success">Add New Deperment </a>
                        </div>
                        



                            <div class="table-container table-bordered">

                            <?php
                                $src = "SELECT d.dept_type, 
                                COUNT(s.id) AS Total_Candidates
                            FROM department d
                            LEFT JOIN candidate_registration s ON d.dept_id = s.dept_id
                            GROUP BY d.dept_type";
                            
                                //run query
                                $rs = mysqli_query($con, $src) or die(mysqli_error($con));
                                
                                if (mysqli_num_rows($rs) > 0) {
                                ?>
                                <div id="search_table"></div>
                                <div id="main_table">
                                    <table id="dataTable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Depertment</th>
                                                <th class=" text-center">Total Students</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i = 1;
                                            while ($rec = mysqli_fetch_assoc($rs)) {
                                            ?>
                                            <tr>
                                                <td>
                                                <?php echo $rec['dept_type']; ?>
                                                </td>

                                                <td class=" text-center">
                                                <?php echo $rec['Total_Candidates']; ?>
                                                </td>
                                                
                                                

                                            
                                            </tr>
                                            
                                            <?php
                                                $i++;
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){

                            $("#searchInput").keyup(function(){

                                var input = $(this).val();
                                
                                // search button giv input
                                if(input != ""){
                                    $.ajax({
                                        url:"dept_search.php",
                                        method:"POST",
                                        data:{input},

                                        success:function(data){
                                            $("#search_table").html(data).show();
                                        },
                                        
                                    });
                                    $("#main_table").hide();
                                    
                                }else{
                                    $("#search_table").hide();
                                    $("#main_table").show();
                                }
                            });
                            
                        });
                        </script>

                    
    
        </main>
    </div>
</div>
<?php require 'footer.php';?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>   
   

  