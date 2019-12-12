<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}

//getting data from database
if (isset($_GET['edit'])){
    $edit = $_GET['edit'];

    $edit_query = "SELECT * FROM users WHERE user_id = '$edit'";
    if ($edit_query_run = mysqli_query($conn, $edit_query)) {
        $edit_query_row = mysqli_fetch_assoc($edit_query_run);

        $user_edit = $edit_query_row['username'];
        $email_edit = $edit_query_row['email'];
        $img_edit = $edit_query_row['profile_img'];
        $bio_edit = $edit_query_row['biograph'];
        $pass_edit = $edit_query_row['password'];

    }
}

//collecting form data
if (isset($_POST['post_sub_btn'])){
    //collect form values
    $user_name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn,  $_POST['email']);

    //processing image
    $profile_pic = $_FILES['profile_image']['name'];
    $folder = "uploads/.$profile_pic";
    move_uploaded_file($_FILES['profile_image']['tmp_name'],$folder);

    $biograph = mysqli_real_escape_string($conn, $_POST['biograph']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

//sending values to database
    $send_to_db = "UPDATE users SET username = '{$user_name}', email = '{$email}', profile_img = '{$profile_pic}', biograph = '{$biograph}', password = '{$password}', up_date = now() WHERE user_id = '$edit'";
    $send_db  = mysqli_query($conn, $send_to_db);
    if (!$send_db){
        $failed = "failed to update your user";
    }
    else {
        $success = "user updated successfully";
        header("location: useredit.php?edit=$edit");
    }
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
                        <div class="dash_link_con d-flex">
                            <span class="dash_icon"> <i class="fa fa-home"></i> </span>
                            <p class="dash_link">home</p>
                        </div>
                    </a>
                    <a href="category.php" class="text-decoration-none">
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
                        <div class="dash_link_con dash_link_active d-flex">
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
            <div class="col dashboard_display_con px-0">
                <?php
                if (isset($success)){
                    ?>
                    <div class="succ_msg">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <?php
                            if (isset($success)){
                                echo " <strong>" . $success . "</strong>";
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <?php
                if (isset($failed)){
                    ?>
                    <div class="succ_msg">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <?php
                            if (isset($failed)){
                                echo " <strong>" . $failed . "</strong>";
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <nav class="tab_con">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a href="user.php" class="text-decoration-none"> <img src="images/back_btn.png" class="back_btn"> </a>
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-create" aria-selected="true">
                            <p class="tab_link">edit user</p>
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-create" aria-labelledby="nav-create-tab">
                        <div class="tab_content">
                            <form action="" enctype="multipart/form-data" method="post" class="d-flex justify-content-between">
                                <div class="col post_1 mr-3 px-0">
                                    <div class="post_form_1">
                                        <div class="">
                                            <label class="form_label">username:</label> <br>
                                            <input type="text" class="full" value="<?php if (isset($user_edit)) echo $user_edit; ?>" name="username" required>
                                        </div>
                                        <div class="">
                                            <label class="form_label">email:</label> <br>
                                            <input type="email" class="full" value="<?php if (isset($email_edit)) echo $email_edit; ?>" name="email" required>
                                        </div>
                                        <div class="">
                                            <label class="form_label">profile picture:</label> <br>
                                            <input type="file" class="full" name="profile_image">
                                            <img src="uploads/<?php echo ".{$img_edit}"; ?>" class="edit_img">
                                        </div>
                                        <div class="">
                                            <label class="form_label">biograph:</label> <br>
                                            <textarea name="biograph" class="full_sum" required> <?php if (isset($bio_edit)) echo $bio_edit; ?> </textarea>
                                        </div>
                                        <button type="reset" name="post_reset_btn" class="post_reset_btn mr-3">reset post</button>
                                        <button type="submit" name="post_sub_btn" class="post_sub_btn">create post</button>
                                    </div>
                                </div>
                                <div class="col post_2 px-0">
                                    <div class="post_form_2">
                                        <div class="">
                                            <label class="form_label">password:</label> <br>
                                            <input type="password" class="full" value="<?php if (isset($pass_edit)) echo $pass_edit; ?>" name="password" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
<script type="text/javascript" src="js/post.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</html>