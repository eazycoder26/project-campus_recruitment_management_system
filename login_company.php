<!-- new php start -->

<?php
session_start();
require 'config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email and password match with the database
    $sql = "SELECT * FROM company_reg WHERE email = ? AND password = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $company = $result->fetch_assoc();
        $_SESSION['company_info'] = $company;
        
        header('Location: company_dashboard/index.php');
        exit();
    } else {
        echo '<div class="alert alert-danger text-center mt-3">Invalid email or password!</div>';
    }
    
    $stmt->close();
    $con->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar Start -->
    <?php require 'navbar.php'; ?>
    <!-- Navbar End -->

    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-12">
                <div class="" style="background-image: url('');">
                    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
                        <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
                            <h2 class="text-center text-primary">Company Login</h2>
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="email">Enter Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Enter Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                                <div class="text-center mt-3">
                                    <a href="forgot_password.php">Forgot Password?</a> | <a href="company_reg.php">New Registration?</a> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <?php require 'footer.php'; ?>
    <!-- Footer End -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
