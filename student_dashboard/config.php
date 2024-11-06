<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'project';

// Create a connection
$con = new mysqli($host, $user, $password, $db);

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
