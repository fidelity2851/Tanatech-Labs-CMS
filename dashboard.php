<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}

//active link
$dact = 1;
$query = mysqli_query($conn, "SELECT * FROM user WHERE id = $userid");
while ($query_run = mysqli_fetch_assoc($query)) {
    $uname = $query_run['username'];
    $user_img = $query_run['image'];
}

//fetching users from database
$query = "SELECT count(*) AS user_row FROM user";
if ($query_run = mysqli_query($conn, $query)) {
    while ($query_row = mysqli_fetch_assoc($query_run)) {
        $user_row = $query_row['user_row'];
    }
}
else {
    echo mysqli_error($conn);
}
//fetching post from database
$query1 = "SELECT count(*) AS post_row FROM post";
if ($query_run1 = mysqli_query($conn, $query1)) {
    while ($query_row1 = mysqli_fetch_assoc($query_run1)) {
        $post_row = $query_row1['post_row'];
    }
} else {
    echo mysqli_error($conn);
}
//fetching category from database
$query2 = "SELECT count(*) AS category_row FROM category";
if ($query_run2 = mysqli_query($conn, $query2)){
    while ($query_row2 = mysqli_fetch_assoc($query_run2)){
        $post_row2 = $query_row2['category_row'];
    }
}
else{
    echo mysqli_error($conn);
}
//fetching writter from database
$query3 = "SELECT count(*) AS writter_row FROM user WHERE role = 'writter'";
if ($query_run3 = mysqli_query($conn, $query3)){
    while ($query_row3 = mysqli_fetch_assoc($query_run3)){
        $post_row3 = $query_row3['writter_row'];
    }
}
else{
    echo mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanatech Labs CMS</title>
    <!--google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- reference your copy Font Awesome here (from our CDN or by hosting yourself) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<!--housing div-->
<div class="housing">

    <!--dashboard container-->
    <div class="dashboard position-absolute d-flex justify-content-between mx-0">
        <?php include("header.php") ?>
        <div class="col-10 dashboard_display_con position-absolute px-0">
            <div class="col header px-0 mb-5">
                <p class="header_text">welcome to Tanatech Labs LTD CMS</p>
            </div>
            <p class="display_header">dashboard <span class="display_header_small">overview</span></p>
            <div class="display_content_con d-flex justify-content-around">

                <a href="user.php" class="text-decoration-none">
                    <div class="display_content d-flex flex-column">
                        <div class="dis_img_con align-self-center">
                            <img src="images/user_icon.svg" class="display_content_img align-self-center">
                        </div>
                        <div class="dis_text_con">
                            <p class="display_content_num"> <?php if(isset($user_row)) echo $user_row ?> </p>
                            <p class="display_content_name">users</p>
                        </div>
                    </div>
                </a>

                <a href="post.php" class="text-decoration-none">
                    <div class="display_content d-flex flex-column">
                        <div class="dis_img_con align-self-center">
                            <img src="images/post_icon.png" class="display_content_img align-self-center">
                        </div>
                        <div class="dis_text_con">
                            <p class="display_content_num"> <?php if(isset($post_row)) echo $post_row ?> </p>
                            <p class="display_content_name">post</p>
                        </div>
                    </div>
                </a>

                <a href="category.php" class="text-decoration-none">
                    <div class="display_content d-flex flex-column">
                        <div class="dis_img_con align-self-center">
                            <img src="images/categories_icon.svg" class="display_content_img align-self-center">
                        </div>
                        <div class="dis_text_con">
                            <p class="display_content_num"> <?php if(isset($post_row2)) echo $post_row2 ?> </p>
                            <p class="display_content_name">categories</p>
                        </div>
                    </div>
                </a>

                <a href="user.php" class="text-decoration-none">
                    <div class="display_content d-flex flex-column">
                        <div class="dis_img_con align-self-center">
                            <img src="images/writter_icon.svg" class="display_content_img align-self-center">
                        </div>
                        <div class="dis_text_con">
                            <p class="display_content_num"> <?php if(isset($post_row3)) echo $post_row3 ?> </p>
                            <p class="display_content_name">writter</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!--dashboard container ENDS-->

</div>
<!--housing div ENDS-->

</body>

<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/dashboard.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</html>