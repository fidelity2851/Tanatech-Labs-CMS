<?php

//connect to database
include_once("connection.php");

$conn = mysqli_connect($server, $username, $password, $db_name);

//create table for category
$category_tb = "CREATE TABLE IF NOT EXISTS category (category_id INT NOT NULL AUTO_INCREMENT, name VARCHAR(200), description VARCHAR(500), icon VARCHAR(100), created_date TIMESTAMP(6), update_date TIMESTAMP (6), PRIMARY KEY (category_id))";
$category = mysqli_query($conn, $category_tb);
if (!$category){
    echo "error creating category tables: " . mysqli_error($conn);
}

//create subcategory table
$subcategory_tb = "CREATE TABLE IF NOT EXISTS subcategory (subcategory_id INT NOT NULL AUTO_INCREMENT, category_id INT NOT NULL, name VARCHAR (200), description VARCHAR(500), icon VARCHAR(100), created_date TIMESTAMP(6), update_date TIMESTAMP(6), PRIMARY KEY (subcategory_id))";
$subcategory = mysqli_query($conn, $subcategory_tb);
if (!$subcategory){
    echo "error creating subcategory table: " . mysqli_error($conn);
}

//create post table
$post_tb = "CREATE TABLE IF NOT EXISTS post (post_id INT NOT NULL AUTO_INCREMENT, title VARCHAR(400), postimg VARCHAR(600), post_description TEXT, post_content TEXT, tags VARCHAR(100), status BOOLEAN, created_date TIMESTAMP(6), update_date TIMESTAMP(6), PRIMARY KEY(post_id))";
$post = mysqli_query($conn, $post_tb);
if (!$post){
    echo "error creating post table: " . mysqli_error($conn);
}

//create users table
$user_tb = "CREATE TABLE IF NOT EXISTS users (user_id INT NOT NULL AUTO_INCREMENT, name VARCHAR(200), email VARCHAR(300), password VARCHAR(300), biography VARCHAR(400), status BOOLEAN, passport VARCHAR(600), created_date TIMESTAMP(6), update_date TIMESTAMP(6), PRIMARY KEY(user_id))";
$user = mysqli_query($conn, $user_tb);
if (!$user){
    echo "error creating users table: " . mysqli_error($conn);
}



















mysqli_close($conn);