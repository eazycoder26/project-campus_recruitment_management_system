<?php
// $host = 'localhost';
// $user = 'root';
// $pass = '';
// $db = 'project';

// $con = mysqli_connect($host, $user, $pass, $db);

// if (!$con) {
//     die("Connection failed: " . mysqli_connect_error());
// }
require 'config.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM candidate_registration WHERE email='$email'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo 'false';
    } else {
        echo 'true';
    }
}
?>