<?php

//connect to database
include_once("connection.php");

$conn = mysqli_connect($server, $username, $password, $db_name);


//create post table
$post_tb = "CREATE TABLE IF NOT EXISTS post (post_id INT NOT NULL AUTO_INCREMENT, post_title VARCHAR(400), post_slug_url VARCHAR(200), post_summary TEXT, post_content TEXT, author VARCHAR(100), category VARCHAR(100), sub_category VARCHAR(100), tags VARCHAR(300), crt_date TIMESTAMP(6), up_date TIMESTAMP(6), PRIMARY KEY(post_id))";
$post = mysqli_query($conn, $post_tb);
if (!$post){
    echo "error creating post table: " . mysqli_error($conn);
}

//create category table
$category_tb = "CREATE TABLE IF NOT EXISTS category (category_id INT NOT NULL AUTO_INCREMENT, cate_name VARCHAR(200), category_url VARCHAR(500), icon BOOLEAN, crt_date TIMESTAMP(6), up_date TIMESTAMP(6), PRIMARY KEY (category_id))";
$category = mysqli_query($conn, $category_tb);
if (!$category){
    echo "error creating category tables: " . mysqli_error($conn);
}

//create banner table
$banner_tb = "CREATE TABLE IF NOT EXISTS banner (banner_id INT NOT NULL AUTO_INCREMENT, webpage VARCHAR(200), banner_img VARCHAR(500), banner_header VARCHAR(100), banner_description TEXT, crt_date TIMESTAMP(6), up_date TIMESTAMP(6), PRIMARY KEY (banner_id))";
$banner = mysqli_query($conn, $banner_tb);
if (!$banner){
    echo "error creating subcategory table: " . mysqli_error($conn);
}

//create page table
$page_tb = "CREATE TABLE IF NOT EXISTS pages (page_id INT NOT NULL AUTO_INCREMENT, page_title VARCHAR(400), page_slug_url VARCHAR(200), page_summary TEXT, page_content TEXT, author VARCHAR(100), category VARCHAR(100), sub_category VARCHAR(100), tags VARCHAR(300), crt_date TIMESTAMP(6), up_date TIMESTAMP(6), PRIMARY KEY(page_id))";
$page = mysqli_query($conn, $page_tb);
if (!$page){
    echo "error creating post table: " . mysqli_error($conn);
}

//create faq table
$faq_tb = "CREATE TABLE IF NOT EXISTS faq (faq_id INT NOT NULL AUTO_INCREMENT, question VARCHAR(400), answer VARCHAR(200), crt_date TIMESTAMP(6), up_date TIMESTAMP(6), PRIMARY KEY(faq_id))";
$faq = mysqli_query($conn, $faq_tb);
if (!$faq){
    echo "error creating post table: " . mysqli_error($conn);
}

//create multimedia table
$multimedia_tb = "CREATE TABLE IF NOT EXISTS multimedia (multimedia_id INT NOT NULL AUTO_INCREMENT, album_title VARCHAR(200), album_cover_img VARCHAR(300), album_url VARCHAR(300), album_description VARCHAR(400),  crt_date TIMESTAMP(6), up_date TIMESTAMP(6), PRIMARY KEY(multimedia_id))";
$multimedia = mysqli_query($conn, $multimedia_tb);
if (!$multimedia){
    echo "error creating users table: " . mysqli_error($conn);
}

//create setting table
$setting_tb = "CREATE TABLE IF NOT EXISTS setting (setting_id INT NOT NULL AUTO_INCREMENT, site_url VARCHAR(400), chat_id VARCHAR(100), google_analytics VARCHAR(100), kyc_option VARCHAR(100), veryify_email VARCHAR(100), facebook_url VARCHAR(100), instagram_url VARCHAR(100), twitter_url VARCHAR(100), youtube_url VARCHAR(100), crt_date TIMESTAMP(6), up_date TIMESTAMP(6), PRIMARY KEY(setting_id))";
$setting = mysqli_query($conn, $setting_tb);
if (!$setting){
    echo "error creating post table: " . mysqli_error($conn);
}









mysqli_close($conn);