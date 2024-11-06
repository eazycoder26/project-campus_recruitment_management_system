<?php
require 'config.php';
session_start();
?>
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
                <?php
                if (isset($_POST['submit'])) {
                    $fileName = $_FILES['file']['tmp_name'];
                    if ($_FILES['file']['size'] > 0) {
                        $file = fopen($fileName, "r");
                        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                            $sql = "INSERT INTO candidate_registration (name, gender, languages, address, city, dept_id) 
                                    VALUES ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "')";
                            $result = mysqli_query($con, $sql);
                        }
                        if (!empty($result)) {
                            $type = "success";
                            $message = "CSV Data Imported into the Database";
                        } else {
                            $type = "error";
                            $message = "Problem in Importing CSV Data";
                        }
                    }
                }
                ?>
                <div id="response" class="<?php if (!empty($type)) { echo $type . " display-block"; } ?>">
                    <?php if (!empty($message)) { echo $message; } ?>
                </div>
                <div class="container">
                    <h1 class="text-center text-success bg-light mt-3">All Students</h1>
                    <form class="form-horizontal" action="" method="post" name="uploadCsv" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label>Choose CSV File</label>
                            <input type="file" name="file" accepts=".csv" class="form-control">
                            <button type="submit" name="submit" class="btn btn-primary mt-3">Upload</button>
                        </div>
                    </form>
                    <div class="d-flex justify-content-end mb-1">
                        <a href="candidate_registration.php" class="btn btn-success">Add New Students</a>
                    </div>
                    <div class="search-container mb-4">
                        <input type="text" id="searchInput" placeholder="Search by department" class="form-control" />
                    </div>
                    <div id="search_table"></div>
                    <div id="main_table" class="table-responsive">
                        <?php
                        $src = "SELECT s.*, d.dept_type FROM candidate_registration s INNER JOIN department d ON s.dept_id = d.dept_id";
                        $rs = mysqli_query($con, $src) or die(mysqli_errno($con));
                        if (mysqli_num_rows($rs) > 0) {
                        ?>
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Language</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Department Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($rs)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['gender']; ?></td>
                                    <td><?php echo $row['languages']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['city']; ?></td>
                                    <td><?php echo $row['dept_type']; ?></td>
                                    <td>
                                        <form name="edit-<?php echo $i; ?>" method="post" action="update_st.php"
                                            enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?php echo $row['id'];?> ">
                                            <button class="btn btn-primary mb-1" type="submit" name="ok"><i
                                                    class="fas fa-edit"></i></button>
                                        </form>
                                        <form name="delete-<?php echo $i; ?>" method="post" action="delete_student.php"
                                            enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button class="btn btn-danger" type="submit" name="ok"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                        <?php } else {
                            echo "<div class='alert alert-warning text-center'>No data found</div>";
                        } ?>
                    </div>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $("#searchInput").keyup(function() {
                            var input = $(this).val();
                            if (input != "") {
                                $.ajax({
                                    url: "candidate_search.php",
                                    method: "POST",
                                    data: {
                                        input: input
                                    },
                                    success: function(data) {
                                        $("#search_table").html(data).show();
                                    }
                                });
                                $("#main_table").hide();
                            } else {
                                $("#search_table").hide();
                                $("#main_table").show();
                            }
                        });
                    });
                </script>
            </main>
        </div>
    </div>
    <?php require 'footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>

</html>
