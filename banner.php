<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

//setting your session
session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}

//collecting form data
if (isset($_POST['banner_sub_btn'])){

    $banner_img = $_FILES['banner_img']['name'];
    $upload_folder = 'uploads/'.$banner_img;
    move_uploaded_file($_FILES['banner_img']['tmp_name'],$upload_folder);

    $banner_title = mysqli_real_escape_string($conn, $_POST['banner_title']);
    $banner_desc = mysqli_real_escape_string($conn, $_POST['banner_desc']);

    //sending date to datebase
    $send_to_db = "INSERT INTO banner (banner_img, banner_header, banner_description, crt_date, up_date)
VALUES ('{$banner_img}', '{$banner_title}', '{$banner_desc}', now(), now())";

    $send_db = mysqli_query($conn, $send_to_db);

    if (!$send_db){
        $failed = "failed to create your banner " . mysqli_error($conn);
    }
    else {
        $success = "banner created successfully";
    }

}

?>

<?php
//delecting data from database
if(isset($_GET['del'])){

    //get delete variable
    $dodelete = $_GET['del'];

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

//fetching category from database
$query1 = "SELECT * FROM category ORDER BY category_id";
if ($query_run1 = mysqli_query($conn, $query1)){

}

//fetching banner from database
$query = "SELECT * FROM banner ORDER BY banner_id DESC";
if ($query_run = mysqli_query($conn, $query)){

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
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-create" aria-selected="true">
                            <p class="tab_link">create new banner</p>
                        </a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-manage" aria-selected="false">
                            <p class="tab_link">manage your banner</p>
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
                                            <input type="text" class="full" name="banner_title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form_label">banner image:</label> <br>
                                            <input type="file" class="full" name="banner_img" required>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="col px-0">
                                                <label class="form_label">banner description:</label> <br>
                                                <textarea name="banner_desc" class="full_sum" required></textarea>
                                            </div>
                                        </div>
                                        <button type="reset" name="banner_reset_btn" class="post_reset_btn mr-3">reset banner</button>
                                        <button type="submit" name="banner_sub_btn" class="post_sub_btn">create banner</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-manage" aria-labelledby="nav-manage-tab">
                        <div class="tab_content">
                            <div class="man_search_con d-flex justify-content-start">
                                <form class=" man_search_form px-0">
                                    <div class="col man_search d-flex justify-content-center px-0">
                                        <input type="search" name="man_search_box" class="man_search_box" placeholder="Quick Search">
                                        <select class="man_select mr-3">
                                            <option class="" disabled selected>categories</option>
                                            <?php
                                            while ($query_row1 = mysqli_fetch_assoc($query_run1)){
                                                $cate_name = $query_row1['cate_name'];
                                                ?>
                                                <option class=""> <?php if (isset($cate_name)) echo $cate_name; ?> </option>
                                                <?php
                                            }
                                            ?>

                                        </select>
                                        <button type="submit" class="man_sub_btn"> <i class="fa fa-arrow-right"></i> </button>
                                    </div>
                                </form>
                            </div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="tbl_header"></th>
                                    <th class="tbl_header">ID</th>
                                    <th class="tbl_header">banner header</th>
                                    <th class="tbl_header">banner image</th>
                                    <th class="tbl_header">Date / Time</th>
                                    <th class="tbl_header">manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($query_row = mysqli_fetch_assoc($query_run)){
                                    $banner_id =  $query_row['banner_id'];
                                    $banner_header = $query_row['banner_header'];
                                    $banner_image =  $query_row['banner_img'];
                                    $up_date =  $query_row['up_date'];
                                    ?>
                                    <tr>
                                        <td class="tbl_data"> <input type="checkbox" class="tbl_check align-self-center"> </td>
                                        <th class="tbl_head"> <?php echo $banner_id; ?> </th>
                                        <td class="tbl_title"> <?php echo $banner_header; ?> </td>
                                        <td class="tbl_data"> <img src="uploads/<?php if(isset($banner_image)) echo $banner_image; ?>" width="75" height="50"> <?php echo $banner_image; ?> </td>
                                        <td class="tbl_data"> <?php echo $up_date; ?> </td>
                                        <td class="tbl_data d-flex border-0">
                                            <a href="banneredit.php?edit=<?php if(isset($banner_id)) echo $banner_id; ?>" class="text-decoration-none"> <i class="fa fa-edit"></i></a>
                                            <a href="banner_edit.php?id=<?php if(isset($banner_id)) echo $banner_id; ?>" class="text-decoration-none mx-2"> <i class="fa fa-eye"></i></a>
                                            <a href="banner.php?del=<?php if(isset($banner_id)) echo $banner_id; ?>" class="text-decoration-none"> <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
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
<script type="text/javascript" src="js/banner.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</html>