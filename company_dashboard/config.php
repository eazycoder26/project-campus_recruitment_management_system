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
}
?>