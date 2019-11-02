<?php
$server = "localhost";
$username = "root";
$password = "fidelity2851";
$db_name = "tanatechcms";

//sql connection
$conn = mysqli_connect($server, $username, $password);

if (!$conn){
    die("connection failed: " . mysqli_connect_error());
}

?>