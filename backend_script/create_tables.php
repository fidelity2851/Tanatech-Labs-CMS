<?php

//connect to database
include_once("connection.php");

$conn = mysqli_connect($server, $username, $password, $db_name);


//create post table
$post_tb = "CREATE TABLE IF NOT EXISTS post (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id INT,
category_id INT,
subcategory_id INT,
title VARCHAR(255),
slug VARCHAR(255),
summary TEXT,
image VARCHAR (255),
content TEXT,
status VARCHAR(255),
pub_date DATE,
crt_date DATETIME,
up_date DATETIME,
FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE SET NULL ,
FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE SET NULL ,
FOREIGN KEY (subcategory_id) REFERENCES subcategory(id) ON DELETE SET NULL 
)";
$post = mysqli_query($conn, $post_tb);
if (!$post){
    echo "error creating post table: " . mysqli_error($conn);
}

//create user table
$post_tb = "CREATE TABLE IF NOT EXISTS user (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255),
password VARCHAR(255),
image VARCHAR(255),
role VARCHAR(255),
status VARCHAR(255),
biograph VARCHAR(255),
crt_date DATETIME,
up_date DATETIME)";
$post = mysqli_query($conn, $post_tb);
if (!$post){
    echo "error creating user table: " . mysqli_error($conn);
}

//create email table
$post_tb = "CREATE TABLE IF NOT EXISTS email (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
User_id INT,
email VARCHAR(255),
crt_date DATETIME,
up_date DATETIME,
FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE SET NULL
)";
$post = mysqli_query($conn, $post_tb);
if (!$post){
    echo "error creating email table: " . mysqli_error($conn);
}

//create category table
$category_tb = "CREATE TABLE IF NOT EXISTS category (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255),
description VARCHAR(255),
crt_date DATETIME,
up_date DATETIME)";
$category = mysqli_query($conn, $category_tb);
if (!$category){
    echo "error creating category tables: " . mysqli_error($conn);
}

//create sub-category
$sub_category_tb = "CREATE TABLE IF NOT EXISTS subcategory (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
category_id INT,
name VARCHAR(255),
description VARCHAR(255),
crt_date DATETIME,
up_date DATETIME,
FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE SET NULL 
)";
$sub_category = mysqli_query($conn, $sub_category_tb);
if (!$sub_category){
    echo "error creating category tables: " . mysqli_error($conn);
}

//create banner table
$banner_tb = "CREATE TABLE IF NOT EXISTS banner (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255),
image VARCHAR(255),
description VARCHAR(255),
crt_date DATETIME,
up_date DATETIME)";
$banner = mysqli_query($conn, $banner_tb);
if (!$banner){
    echo "error creating banner table: " . mysqli_error($conn);
}

//create tag table
$page_tb = "CREATE TABLE IF NOT EXISTS tag (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
post_id INT,
name VARCHAR(300),
crt_date DATETIME,
up_date DATETIME,
FOREIGN KEY (post_id) REFERENCES post(id) ON DELETE SET NULL 
)";
$page = mysqli_query($conn, $page_tb);
if (!$page){
    echo "error creating tag table: " . mysqli_error($conn);
}

//create faq table
$faq_tb = "CREATE TABLE IF NOT EXISTS faq (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
question VARCHAR(255),
answer VARCHAR(255),
crt_date DATETIME,
up_date DATETIME)";
$faq = mysqli_query($conn, $faq_tb);
if (!$faq){
    echo "error creating faq table: " . mysqli_error($conn);
}

//create media table
$multimedia_tb = "CREATE TABLE IF NOT EXISTS media (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255),
image VARCHAR(255),
description VARCHAR(255), 
crt_date DATETIME,
up_date DATETIME)";
$multimedia = mysqli_query($conn, $multimedia_tb);
if (!$multimedia){
    echo "error creating media table: " . mysqli_error($conn);
}

//create gallery table
$gallery_tb = "CREATE TABLE IF NOT EXISTS gallery (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
media_id INT,
name VARCHAR(255),
image VARCHAR(255),
crt_date DATETIME,
up_date DATETIME,
FOREIGN KEY (media_id) REFERENCES media(id) ON DELETE SET NULL)";
$gallery = mysqli_query($conn, $gallery_tb);
if (!$gallery){
    echo "error creating gallery table: " . mysqli_error($conn);
}

//create setting table
$setting_tb = "CREATE TABLE IF NOT EXISTS setting (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
chat_id VARCHAR(255),
google_analytics VARCHAR(255),
facebook VARCHAR(255),
instagram VARCHAR(255),
twitter VARCHAR(255),
youtube VARCHAR(255),
crt_date DATETIME,
up_date DATETIME)";
$setting = mysqli_query($conn, $setting_tb);
if (!$setting){
    echo "error creating setting table: " . mysqli_error($conn);
}

//create admin table
$admin_tb = "CREATE TABLE IF NOT EXISTS admin (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(255),
password VARCHAR(255),
crt_date DATETIME,
up_date DATETIME)";

$admin = mysqli_query($conn, $admin_tb);
if (!$admin){
    echo "error creating admin table" . mysqli_error($conn);
}

//insert default values to admin table
$email = "user@gmail.com";
$password = "12345";
$admin_add = "INSERT INTO admin (email, password, crt_date, up_date) VALUES ('$email', '$password', now(), now())";
$admin_add_run = mysqli_query($conn, $admin_add);
if (!$admin_add_run){
    echo "error inserting into admin table" . mysqli_error($conn);
}






mysqli_close($conn);