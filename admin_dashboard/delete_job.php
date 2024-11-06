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

            <?php
                session_start();
                require 'config.php';

                // Check if job_id is set
                if (isset($_GET['job_id'])) {
                    $job_id = $_GET['job_id'];

                    // Delete job from database
                    $sql = "DELETE FROM job_listing WHERE job_id = ?";
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("i", $job_id);

                    if ($stmt->execute()) {
                        echo '<div class="alert alert-success text-center mt-3">Job deleted successfully!
                        <a href ="job_listings.php"> click here</a>
                        </div>';
                    } else {
                        echo "Error deleting job: " . $con->error;
                    }
                } else {
                    echo "Invalid request.";
                }
                ?>
               
        </main>
    </div>
</div>
</body>
</html>


