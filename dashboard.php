<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
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

    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- reference your copy Font Awesome here (from our CDN or by hosting yourself) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<!--housing div-->
<div class="housing">
    <!--header container-->
    <div class="header_con sticky-top">
        <div class="row header d-flex justify-content-center mx-0">
            <div class="col-2 logo_con align-self-center px-0">
                <img src="images/logo.fw.png" class="logo">
            </div>
            <div class="col header_text_con mx-auto align-self-center px-0">
                <p class="header_text">welcome to Tanatech Labs LTD CMS</p>
            </div>
        </div>
    </div>
    <!--header container ENDS-->

    <!--dashboard container-->
    <div class="dashboard_con">
        <div class="row dashboard d-flex justify-content-between mx-0">
            <div class="col-2 dashboard_link_con d-flex flex-column px-0">
                <div class="dash_header_con d-flex justify-content-around">
                    <div class="dash_header_icon align-self-center"> <img src="images/user.png" class="dash_header_img"> </div>
                    <div class="align-self-center drop position-relative">
                        <p class="dash_header">Tanatech admin <span class="dash_header_icon2"> <i class="fa fa-angle-down"></i> </span> </p>
                        <div class="drop_con">
                            <a href="logout.php" class="text-decoration-none">
                                <p class="drop_link"> <i class="fa fa-power-off"></i> log out</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="">
                    <a href="dashboard.php" class="text-decoration-none">
                        <div class="dash_link_con dash_link_active d-flex">
                            <span class="dash_icon"> <i class="fa fa-home"></i> </span>
                            <p class="dash_link">home</p>
                        </div>
                    </a>
                    <a href="categories.php" class="text-decoration-none">
                        <div class="dash_link_con d-flex">
                            <span class="dash_icon"> <i class="fa fa-tags"></i> </span>
                            <p class="dash_link">categories</p>
                        </div>
                    </a>
                    <a href="post.php" class="text-decoration-none">
                        <div class="dash_link_con d-flex">
                            <span class="dash_icon"> <i class="fa fa-podcast"></i> </span>
                            <p class="dash_link">post</p>
                        </div>
                    </a>
                    <a href="banner.php" class="text-decoration-none">
                        <div class="dash_link_con d-flex">
                            <span class="dash_icon"> <i class="fa fa-sliders"></i> </span>
                            <p class="dash_link">slider / Banner</p>
                        </div>
                    </a>
                    <a href="page.php" class="text-decoration-none">
                        <div class="dash_link_con d-flex">
                            <span class="dash_icon"> <i class="fa fa-book"></i> </span>
                            <p class="dash_link">pages</p>
                        </div>
                    </a>
                    <a href="multimedia.php" class="text-decoration-none">
                        <div class="dash_link_con d-flex">
                            <span class="dash_icon"> <i class="fa fa-picture-o"></i> </span>
                            <p class="dash_link">multimedia</p>
                        </div>
                    </a>
                    <a href="faq.php" class="text-decoration-none">
                        <div class="dash_link_con d-flex">
                            <span class="dash_icon"> <i class="fa fa-question-circle"></i> </span>
                            <p class="dash_link">FAQ</p>
                        </div>
                    </a>
                    <a href="user.php" class="text-decoration-none">
                        <div class="dash_link_con d-flex">
                            <span class="dash_icon"> <i class="fa fa-users" aria-hidden="true"></i> </span>
                            <p class="dash_link">users</p>
                        </div>
                    </a>
                    <a href="setting.php" class="text-decoration-none">
                        <div class="dash_link_con d-flex">
                            <span class="dash_icon"> <i class="fa fa-cogs" aria-hidden="true"></i> </span>
                            <p class="dash_link">settings</p>
                        </div>
                    </a>
                </div>
                <p class="power mt-auto">powered by: <span class="power_name">Tanatech Labs</span> </p>
            </div>
            <div class="col dashboard_display_con">
                <p class="display_header">dashboard <span class="display_header_small">overview</span></p>
                <div class="display_content_con d-flex justify-content-around">

                    <a href="user.php" class="text-decoration-none">
                        <div class="display_content d-flex flex-column">
                            <div class="dis_img_con align-self-center">
                                <img src="images/user_icon.svg" class="display_content_img align-self-center">
                            </div>
                            <div class="dis_text_con">
                                <?php
                                $query = "SELECT count(*) AS users_row FROM users";
                                if ($query_run = mysqli_query($conn, $query)){
                                    while ($query_row = mysqli_fetch_assoc($query_run)){
                                        $user_row = $query_row['users_row'];
                                        ?>
                                        <p class="display_content_num"> <?php echo $user_row ?> </p>
                                        <?php
                                    }
                                }
                                else{
                                    echo mysqli_error($conn);
                                }
                                ?>
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
                                <?php
                                $query = "SELECT count(*) AS post_row FROM post";
                                if ($query_run = mysqli_query($conn, $query)){
                                    $query_row = mysqli_fetch_assoc($query_run);
                                        $post_row = $query_row['post_row'];
                                        ?>
                                        <p class="display_content_num"> <?php echo $post_row ?> </p>
                                        <?php

                                }
                                else{
                                    echo mysqli_error($conn);
                                }
                                ?>
                                <p class="display_content_name">post</p>
                            </div>
                        </div>
                    </a>

                    <a href="categories.php" class="text-decoration-none">
                        <div class="display_content d-flex flex-column">
                            <div class="dis_img_con align-self-center">
                                <img src="images/categories_icon.svg" class="display_content_img align-self-center">
                            </div>
                            <div class="dis_text_con">
                                <?php
                                $query2 = "SELECT count(*) AS category_row FROM category";
                                if ($query_run2 = mysqli_query($conn, $query2)){
                                    $query_row2 = mysqli_fetch_assoc($query_run2);
                                    $post_row2 = $query_row2['category_row'];
                                    ?>
                                    <p class="display_content_num"> <?php echo $post_row2 ?> </p>
                                    <?php

                                }
                                else{
                                    echo mysqli_error($conn);
                                }
                                ?>
                                <p class="display_content_name">categories</p>
                            </div>
                        </div>
                    </a>

                    <a href="writter.php" class="text-decoration-none">
                        <div class="display_content d-flex flex-column">
                            <div class="dis_img_con align-self-center">
                                <img src="images/writter_icon.svg" class="display_content_img align-self-center">
                            </div>
                            <div class="dis_text_con">
                                <?php
                                $query3 = "SELECT count(*) AS writter_row FROM writter";
                                if ($query_run3 = mysqli_query($conn, $query3)){
                                    $query_row3 = mysqli_fetch_assoc($query_run3);
                                    $post_row3 = $query_row3['writter_row'];
                                    ?>
                                    <p class="display_content_num"> <?php echo $post_row3 ?> </p>
                                    <?php

                                }
                                else{
                                    echo mysqli_error($conn);
                                }
                                ?>
                                <p class="display_content_name">writter</p>
                            </div>
                        </div>
                    </a>
                </div>
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