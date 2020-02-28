<?php

//connect to database
include_once("connection.php");

$conn = mysqli_connect($server, $username, $password, $db_name);


//create post table
$post_tb = "CREATE TABLE IF NOT EXISTS post (post_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, post_title VARCHAR(255), post_slug_url VARCHAR(255), post_summary TEXT, post_image VARCHAR (255), post_content TEXT, author VARCHAR(255), category VARCHAR(255), sub_category VARCHAR(255), tags VARCHAR(255), crt_date DATETIME, up_date DATETIME)";
$post = mysqli_query($conn, $post_tb);
if (!$post){
    echo "error creating post table: " . mysqli_error($conn);
}

//create user table
$post_tb = "CREATE TABLE IF NOT EXISTS users (user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, username VARCHAR(255), email VARCHAR(255), password VARCHAR(255), biograph VARCHAR(255), profile_img VARCHAR(255), status BOOLEAN, crt_date DATETIME, up_date DATETIME)";
$post = mysqli_query($conn, $post_tb);
if (!$post){
    echo "error creating users table: " . mysqli_error($conn);
}

//create writter table
$post_tb = "CREATE TABLE IF NOT EXISTS writter (writter_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, username VARCHAR(255), firstname VARCHAR(255), lastname VARCHAR(255), password VARCHAR(255) NOT NULL, profile_img VARCHAR(255), status BOOLEAN, crt_date DATETIME, up_date DATETIME)";
$post = mysqli_query($conn, $post_tb);
if (!$post){
    echo "error creating writter table: " . mysqli_error($conn);
}

//create category table
$category_tb = "CREATE TABLE IF NOT EXISTS category (category_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, cate_name VARCHAR(255), cate_url VARCHAR(255), cate_check BOOLEAN, cate_desc VARCHAR(255), crt_date DATETIME, up_date DATETIME)";
$category = mysqli_query($conn, $category_tb);
if (!$category){
    echo "error creating category tables: " . mysqli_error($conn);
}

//create sub-category
$sub_category_tb = "CREATE TABLE IF NOT EXISTS sub_category (sub_category_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, sub_cate_name VARCHAR(255), sub_cate_desc VARCHAR(255), crt_date DATETIME, up_date DATETIME)";
$sub_category = mysqli_query($conn, $sub_category_tb);
if (!$sub_category){
    echo "error creating category tables: " . mysqli_error($conn);
}

//create banner table
$banner_tb = "CREATE TABLE IF NOT EXISTS banner (banner_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, webpage VARCHAR(255), banner_img VARCHAR(255), banner_header VARCHAR(255), banner_description TEXT, crt_date DATETIME, up_date DATETIME)";
$banner = mysqli_query($conn, $banner_tb);
if (!$banner){
    echo "error creating banner table: " . mysqli_error($conn);
}

//create page table
$page_tb = "CREATE TABLE IF NOT EXISTS pages (page_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, page_title VARCHAR(255), page_slug_url VARCHAR(255), page_summary TEXT, page_content TEXT, author VARCHAR(100), category VARCHAR(100), sub_category VARCHAR(100), tags VARCHAR(300), crt_date DATETIME, up_date DATETIME)";
$page = mysqli_query($conn, $page_tb);
if (!$page){
    echo "error creating page table: " . mysqli_error($conn);
}

//create faq table
$faq_tb = "CREATE TABLE IF NOT EXISTS faq (faq_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, question VARCHAR(255), answer VARCHAR(255), crt_date DATETIME, up_date DATETIME)";
$faq = mysqli_query($conn, $faq_tb);
if (!$faq){
    echo "error creating faq table: " . mysqli_error($conn);
}

//create multimedia table
$multimedia_tb = "CREATE TABLE IF NOT EXISTS multimedia (multimedia_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, album_title VARCHAR(255), album_cover_img VARCHAR(255), album_url VARCHAR(255), album_description VARCHAR(255),  crt_date DATETIME, up_date DATETIME)";
$multimedia = mysqli_query($conn, $multimedia_tb);
if (!$multimedia){
    echo "error creating users table: " . mysqli_error($conn);
}

//create setting table
$setting_tb = "CREATE TABLE IF NOT EXISTS setting (setting_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, site_url VARCHAR(255), chat_id VARCHAR(255), google_analytics VARCHAR(255), kyc_option VARCHAR(255), veryify_email VARCHAR(255), facebook_url VARCHAR(255), instagram_url VARCHAR(255), twitter_url VARCHAR(255), youtube_url VARCHAR(255), crt_date DATETIME, up_date DATETIME)";
$setting = mysqli_query($conn, $setting_tb);
if (!$setting){
    echo "error creating setting table: " . mysqli_error($conn);
}

//create admin table
$admin_tb = "CREATE TABLE IF NOT EXISTS admin (admin_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255), password VARCHAR(255), crt_date DATETIME, up_date DATETIME)";

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