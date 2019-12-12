<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

//setting your session
session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}

//geting data from database
if (isset($_GET['edit'])) {
    $edit = $_GET['edit'];

    $edit_query = "SELECT * FROM banner WHERE banner_id = '$edit'";
    if ($edit_query_run = mysqli_query($conn, $edit_query)) {
        $edit_query_row = mysqli_fetch_assoc($edit_query_run);

        $page_edit = $edit_query_row['webpage'];
        $img_edit = $edit_query_row['banner_img'];
        $header_edit = $edit_query_row['banner_header'];
        $desc_edit = $edit_query_row['banner_description'];
    }
}

//collecting form data
if (isset($_POST['banner_sub_btn'])){
    $webpage = $_POST['webpage'];

    $banner_img = $_FILES['banner_img']['name'];
    $upload_folder = 'uploads/'.$banner_img;
    move_uploaded_file($_FILES['banner_img']['tmp_name'],$upload_folder);

    $banner_title = $_POST['banner_title'];
    $banner_desc = $_POST['banner_desc'];

    //sending date to datebase
    $send_to_db = "UPDATE banner SET webpage = '{$webpage}', banner_img = '{$banner_img}', banner_header = '{$banner_title}', banner_description = '{$banner_desc}', up_date = now() WHERE banner_id = '$edit'";
    $send_db = mysqli_query($conn, $send_to_db);

    if (!$send_db){
        $failed = "failed to create your post" . mysqli_error($conn);
    }
    else {
        $success = "post created successfully";
        header("location:banneredit.php?edit=$edit");
    }

}

?>

<?php
//delecting data from database

if(isset($_GET['id'])){

    //get delete variable
    $dodelete = $_GET['id'];

    //perform delete
    $sql = mysqli_query($conn,"DELETE FROM banner WHERE banner_id='$dodelete'");
    if (!$sql){
        $failed = "failed to delect your banner" . mysqli_error($conn);
    }
    else {
        $success = "banner delected successfully";
        //header("location: banner.php");
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
                        <div class="dash_link_con dash_link_active d-flex">
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
                        <a href="banner.php" class="text-decoration-none"> <img src="images/back_btn.png" class="back_btn"> </a>
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-create" aria-selected="true">
                            <p class="tab_link">create new banner</p>
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-create" aria-labelledby="nav-create-tab">
                        <div class="tab_content">
                            <form action="#" enctype="multipart/form-data" method="post" class="d-flex justify-content-center">
                                <div class="col post_1 mr-3 px-0">
                                    <div class="post_form_1">
                                        <div class="">
                                            <label class="form_label">web page:</label>
                                            <select name="webpage" class="full">
                                                <option class="form_opt" > <?php if (isset($page_edit)) echo $page_edit; ?> </option>

                                            </select>
                                        </div>
                                        <div class="">
                                            <label class="form_label">banner image:</label> <br>
                                            <input type="file" class="full" name="banner_img" >
                                            <img src="uploads/<?php echo ".{$img_edit}"; ?>" class="edit_img">
                                        </div>
                                        <div class="">
                                            <label class="form_label">banner header:</label> <br>
                                            <input type="text" class="full" value="<?php if (isset($header_edit)) echo $header_edit; ?>" name="banner_title" required>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="col px-0">
                                                <label class="form_label">banner description:</label> <br>
                                                <textarea name="banner_desc" class="full_sum" required> <?php if (isset($desc_edit)) echo $desc_edit; ?> </textarea>
                                            </div>
                                        </div>
                                        <button type="reset" name="banner_reset_btn" class="post_reset_btn mr-3">reset banner</button>
                                        <button type="submit" name="banner_sub_btn" class="post_sub_btn">update banner</button>
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