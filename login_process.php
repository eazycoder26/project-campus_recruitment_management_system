<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'project';

    $con = mysqli_connect($host, $user, $pass, $db);

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $sql = "SELECT * FROM candidate_registration WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $candidate = mysqli_fetch_assoc($result);
        $_SESSION['candidate_id'] = $candidate['id'];
        $_SESSION['candidate_name'] = $candidate['name'];
        header("Location: dashboard_student.php");
        exit();
    } else {
        echo '<div class="alert alert-danger text-center mt-3">Invalid email or password. Please try again.</div>';
    }

    mysqli_close($con);
}




?>
