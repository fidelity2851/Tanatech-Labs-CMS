<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}

//active link
$uact = 1;
$query = mysqli_query($conn, "SELECT * FROM user WHERE id = $userid");
while ($query_run = mysqli_fetch_assoc($query)) {
    $uname = $query_run['username'];
    $user_img = $query_run['image'];
}


//collecting form data
if (isset($_POST['post_sub_btn'])){
    $edit = $_GET['edit'];

    //collect form values
    $user_name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn,  $_POST['email']);

    //processing image
    $profile_pic = $_FILES['profile_image']['name'];
    $folder = "uploads/.$profile_pic";
    move_uploaded_file($_FILES['profile_image']['tmp_name'],$folder);

    $biograph = mysqli_real_escape_string($conn, $_POST['biograph']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $password = password_hash($pass,PASSWORD_DEFAULT);

//sending values to database
    if (empty($profile_pic) AND empty($password)){
        $send_to_db = "UPDATE user SET username = '{$user_name}', biograph = '{$biograph}', role = '{$role}', up_date = now() WHERE id = '$edit'";
        $send_db  = mysqli_query($conn, $send_to_db);
        if (!$send_db){
            $failed = "failed to update your user " .mysqli_error($conn);
        }
        else {
            $send_to_db = "UPDATE email SET email = '{$email}', up_date = now() WHERE user_id = '$edit'";
            mysqli_query($conn, $send_to_db);
            $success = "user updated successfully";
            //header("location: useredit.php?edit=$edit");
        }
    }
    elseif (empty($profile_pic)){
        $send_to_db = "UPDATE user SET username = '{$user_name}', biograph = '{$biograph}', password = '{$password}', role = '{$role}', up_date = now() WHERE id = '$edit'";
        $send_db  = mysqli_query($conn, $send_to_db);
        if (!$send_db){
            $failed = "failed to update your user " .mysqli_error($conn);
        }
        else {
            $send_to_db = "UPDATE email SET email = '{$email}', up_date = now() WHERE user_id = '$edit'";
            mysqli_query($conn, $send_to_db);
            $success = "user updated successfully";
            //header("location: useredit.php?edit=$edit");
        }
    }
    elseif (empty($password)){
        $send_to_db = "UPDATE user SET username = '{$user_name}', image = '{$profile_pic}', biograph = '{$biograph}', role = '{$role}', up_date = now() WHERE id = '$edit'";
        $send_db  = mysqli_query($conn, $send_to_db);
        if (!$send_db){
            $failed = "failed to update your user " .mysqli_error($conn);
        }
        else {
            $send_to_db = "UPDATE email SET email = '{$email}', up_date = now() WHERE user_id = '$edit'";
            mysqli_query($conn, $send_to_db);
            $success = "user updated successfully";
            //header("location: useredit.php?edit=$edit");
        }
    }
    else{
        $send_to_db = "UPDATE user SET username = '{$user_name}', image = '{$profile_pic}', password = '{$password}', biograph = '{$biograph}', role = '{$role}', up_date = now() WHERE id = '$edit'";
        $send_db  = mysqli_query($conn, $send_to_db);
        if (!$send_db){
            $failed = "failed to update your user " .mysqli_error($conn);
        }
        else {
            $send_to_db = "UPDATE email SET email = '{$email}', up_date = now() WHERE user_id = '$edit'";
            mysqli_query($conn, $send_to_db);
            $success = "user updated successfully";
            //header("location: useredit.php?edit=$edit");
        }
    }
}

//getting data from database
if (isset($_GET['edit'])){
    $edit = $_GET['edit'];

    $edit_query = "SELECT * FROM user WHERE id = '$edit'";
    if ($edit_query_run = mysqli_query($conn, $edit_query)) {
        $edit_query_row = mysqli_fetch_assoc($edit_query_run);

        $user_edit_id = $edit_query_row['id'];
        $user_edit = $edit_query_row['username'];
        $img_edit = $edit_query_row['image'];
        $bio_edit = $edit_query_row['biograph'];
        $edit_role = $edit_query_row['role'];
        //$pass_edit = $edit_query_row['password'];

    }
    $edit_query1 = "SELECT * FROM email WHERE user_id = '$edit'";
    if ($edit_query_run1 = mysqli_query($conn, $edit_query1)) {
        $edit_query_row1 = mysqli_fetch_assoc($edit_query_run1);

        $edit_email = $edit_query_row1['email'];

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
    <div class="dashboard_con">
        <div class="row dashboard d-flex justify-content-between mx-0">
            <?php include("header.php") ?>
            <div class="col-10 dashboard_display_con position-absolute px-0">
                <div class="col header px-0">
                    <p class="header_text">welcome to Tanatech Labs LTD CMS</p>
                </div>
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
                                            <input type="email" class="full" value="<?php if (isset($edit_email)) echo $edit_email; ?>" name="email" required>
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
                                <div class="col-4 post_2 px-0">
                                    <div class="col px-0">
                                        <label class="form_label">Role</label> <br>
                                        <select class="form_sel" name="role">
                                            <option value="<?php if (isset($edit_role)) echo $edit_role; ?>" class=""><?php if (isset($edit_role)) echo $edit_role; ?></option>
                                            <option value="user" class="">User</option>
                                            <option value="writter" class="">Writter</option>
                                            <option value="admin" class="">Admin</option>
                                        </select>
                                    </div>
                                    <div class="post_form_2">
                                        <div class="">
                                            <label class="form_label">password:</label> <br>
                                            <input type="password" class="full" name="password">
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