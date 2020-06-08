<?php
$server = "localhost";
$username = "root";
$password = "";
$db_name = "Tanatechcms";

//sql connection
$conn = mysqli_connect($server, $username, $password);

if (!$conn){
    die("connection failed: " . mysqli_connect_error());
}

?>