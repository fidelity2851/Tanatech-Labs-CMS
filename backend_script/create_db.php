<?php

//include connection
include_once("connection.php");

//creating database
$sql = mysqli_query($conn,"CREATE DATABASE $db_name");
if(!$sql){
    echo "Server busy try again later " . mysqli_error($conn);
}


mysqli_close($conn);