<?php
$server = "localhost";
$username = "root";
$password = "fidelity2851";
$db_name = "tanatechblog";

//sql connection
$conn = mysqli_connect($server, $username, $password, $db_name);
if (!$conn){
    die("connection failed: " . mysqli_connect_error());
}

?>