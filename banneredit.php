<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

//setting your session
session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}

//actvie link
$bact = 1;
$query = mysqli_query($conn, "SELECT * FROM user WHERE id = $userid");
while ($query_run = mysqli_fetch_assoc($query)) {
    $uname = $query_run['username'];
    $user_img = $query_run['image'];
}

//collecting form data
if (isset($_POST['banner_sub_btn'])){
    $edit = $_GET['edit'];
    $banner_img = $_FILES['banner_img']['name'];
    $upload_folder = 'uploads/'.$banner_img;
    move_uploaded_file($_FILES['banner_img']['tmp_name'],$upload_folder);

    $banner_title = $_POST['banner_title'];
    $banner_desc = $_POST['banner_desc'];

    if (!empty($banner_img)){
        //sending date to datebase
        $send_to_db = "UPDATE banner SET image = '{$banner_img}', name = '{$banner_title}', description = '{$banner_desc}', up_date = now() WHERE id = '$edit'";
        $send_db = mysqli_query($conn, $send_to_db);

        if (!$send_db){
            $failed = "failed to edit your banner" . mysqli_error($conn);
        }
        else {
            $success = "banner edited successfully";
            //header("location:banneredit.php?edit=$edit");
        }
    }
    else{
        //sending date to datebase
        $send_to_db = "UPDATE banner SET name = '{$banner_title}', description = '{$banner_desc}', up_date = now() WHERE id = '$edit'";
        $send_db = mysqli_query($conn, $send_to_db);

        if (!$send_db){
            $failed = "failed to edit your banner" . mysqli_error($conn);
        }
        else {
            $success = "banner edited successfully";
            //header("location:banneredit.php?edit=$edit");
        }
    }

}

//getting banner data from database
if (isset($_GET['edit'])) {
    $edit = $_GET['edit'];

    $edit_query = "SELECT * FROM banner WHERE id = '$edit'";
    if ($edit_query_run = mysqli_query($conn, $edit_query)) {
        $edit_query_row = mysqli_fetch_assoc($edit_query_run);

        $img_edit = $edit_query_row['image'];
        $header_edit = $edit_query_row['name'];
        $desc_edit = $edit_query_row['description'];
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanatech Labs CMS / banner</title>
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
                        <a href="banner.php" class="text-decoration-none"> <img src="images/back_btn.png" class="back_btn"> </a>
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-create" aria-selected="true">
                            <p class="tab_link">Edit banner</p>
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-create" aria-labelledby="nav-create-tab">
                        <div class="tab_content">
                            <form action="#" enctype="multipart/form-data" method="post" class="d-flex justify-content-center">
                                <div class="col post_1 mr-3 px-0">
                                    <div class="post_form_1">
                                        <div class="mb-3">
                                            <label class="form_label">banner header:</label> <br>
                                            <input type="text" class="full" value="<?php if (isset($header_edit)) echo $header_edit; ?>" name="banner_title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form_label">banner image:</label> <br>
                                            <input type="file" class="full" name="banner_img" >
                                            <img src="uploads/<?php echo ".{$img_edit}"; ?>" class="edit_img">
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="col px-0">
                                                <label class="form_label">banner description:</label> <br>
                                                <textarea name="banner_desc" class="full_sum" required> <?php if (isset($desc_edit)) echo $desc_edit; ?> </textarea>
                                            </div>
                                        </div>
                                        <button type="submit" name="banner_sub_btn" class="post_sub_btn">Update banner</button>
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

    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/banner.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>


</body>

    </html>