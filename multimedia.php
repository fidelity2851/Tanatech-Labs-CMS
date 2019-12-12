<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}

//collecting form data
if (isset($_POST['album_sub_btn'])){
    $album_name = $_POST['album_title'];

    //processing image
    $album_cover_img = $_FILES['album_cover_img']['name'];
    $folder = "uploads/.$album_cover_img";
    move_uploaded_file($_FILES['album_cover_img']['tmp_name'],$folder);

    $album_url = $_POST['album_url'];
    $album_desc = $_POST['album_desc'];

    //sending date to database
    $send_to_db = "INSERT INTO multimedia (album_title, album_cover_img, album_url, album_description, crt_date, up_date) 
VALUES ('{$album_name}', '{$album_cover_img}', '{$album_url}', '{$album_desc}', now(), now())";
    $send_db = mysqli_query($conn, $send_to_db);

    if (!$send_db){
        $failed = "failed to create your post" . mysqli_error($conn);
    }
    else {
        $success = "post created successfully";
    }

}


?>

<?php
//delecting data from database

if(isset($_GET['id'])){

    //get delete variable
    $dodelete = $_GET['id'];

    //perform delete
    $sql = mysqli_query($conn,"DELETE FROM multimedia WHERE multimedia_id='$dodelete'");
    if (!$sql){
        $failed = "failed to delect your album" . mysqli_error($conn);
    }
    else {
        $success = "album delected successfully";
        //header("location: banner.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanatech Labs CMS /multimedia</title>
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
                        <div class="dash_link_con dash_link_active d-flex">
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
                            <p class="tab_link">create new album</p>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-manage" aria-selected="false">
                            <p class="tab_link">manage your album</p>
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-create" aria-labelledby="nav-create-tab">
                        <div class="tab_content d-flex justify-content-between">
                            <form action="#" enctype="multipart/form-data" method="post" class="col d-flex justify-content-center px-0">
                                <div class="col post_1 mr-3 px-0">
                                    <div class="post_form_1">
                                        <div class="">
                                            <label class="form_label">album title:</label> <br>
                                            <input type="text" class="full" name="album_title" required>
                                        </div>
                                        <div class="">
                                            <label class="form_label">album cover image:</label> <br>
                                            <input type="file" class="full" name="album_cover_img">
                                        </div>
                                        <div class="">
                                            <label class="form_label">album URl:</label> <br>
                                            <input type="url" class="full" name="album_url">
                                        </div>
                                        <div class="">
                                            <label class="form_label">album description:</label> <br>
                                            <textarea name="album_desc" class="full_sum" required></textarea>
                                        </div>
                                        <button type="reset" name="album_reset_btn" class="post_reset_btn mr-3">reset album</button>
                                        <button type="submit" name="album_sub_btn" class="post_sub_btn">create album</button>
                                    </div>
                                </div>
                            </form>
                            <form action="#" enctype="multipart/form-data" method="post" class="col d-flex justify-content-center px-0">
                                <div class="col post_2 ml-3 px-0">
                                    <div class="post_form_1">
                                        <div class="">
                                            <label class="form_label">select album to add image to:</label>
                                            <select class="full">
                                                <option class="form_opt" disabled selected>select album</option>
                                                <?PHP
                                                $query1 = "SELECT * FROM multimedia ORDER BY multimedia_id DESC";
                                                if ($query_run1 = mysqli_query($conn, $query1)){
                                                    while ($query_row1 = mysqli_fetch_assoc($query_run1)){
                                                        $sel_title = $query_row1['album_title'];
                                                ?>
                                                        <option class="form_opt"> <?php echo $sel_title; ?> </option>
                                                <?php
                                                    }
                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="">
                                            <label class="form_label">add image to album:</label> <br>
                                            <input type="file" class="full" name="add_album_image" required>
                                        </div>
                                        <div class="">
                                            <label class="form_label">image title:</label> <br>
                                            <input type="text" class="full" name="album_image_title" required>
                                        </div>
                                        <div class="">
                                            <label class="form_label">image URl: (optional)</label> <br>
                                            <input type="url" class="full" name="add_album_image_url" required>
                                        </div>
                                        <div class="">
                                            <label class="form_label">image description:</label> <br>
                                            <textarea name="album_description" class="full_sum" required></textarea>
                                        </div>
                                        <button type="reset" class="post_reset_btn mr-3">reset album image</button>
                                        <button type="submit" class="post_sub_btn">create album image</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-manage" aria-labelledby="nav-manage-tab">
                        <div class="tab_content">
                            <div class="man_search_con d-flex justify-content-start">
                                <form class="col-4 man_search_form px-0">
                                    <div class="col man_search d-flex justify-content-center px-0">
                                        <input type="search" name="man_search_box" class="man_search_box" placeholder="Quick Search">
                                        <select class="man_select mr-3">
                                            <option class="">categories</option>
                                            <option class="">all</option>
                                            <option class="">musics</option>
                                            <option class="">videos</option>
                                            <option class="">news</option>
                                            <option class="">status</option>
                                            <option class="">stories</option>
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
                                    <th class="tbl_header">album Title</th>
                                    <th class="tbl_header">album cover image</th>
                                    <th class="tbl_header">album description</th>
                                    <th class="tbl_header">Date / Time</th>
                                    <th class="tbl_header">manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?PHP
                                $query = "SELECT * FROM multimedia ORDER BY multimedia_id DESC";
                                if ($query_run = mysqli_query($conn, $query)){
                                    while ($query_row = mysqli_fetch_assoc($query_run)){
                                        $alu_id = $query_row['multimedia_id'];
                                        $alu_title = $query_row['album_title'];
                                        $alu_cover_img = $query_row['album_cover_img'];
                                        $alu_url = $query_row['album_url'];
                                        $alu_desc = $query_row['album_description'];
                                        $crt_date = $query_row['crt_date'];
                                        $up_date = $query_row['up_date'];
                                ?>
                                        <tr>
                                            <td class="tbl_data"> <input type="checkbox" class="tbl_check align-self-center"> </td>
                                            <th class="tbl_head"> <?php echo $alu_id; ?> </th>
                                            <td class="tbl_title"> <?php echo $alu_title; ?> </td>
                                            <td class="tbl_data"> <?php echo $alu_cover_img; ?> </td>
                                            <td class="tbl_data"> <?php echo $alu_desc; ?> </td>
                                            <td class="tbl_data"> <?php echo $up_date; ?> </td>
                                            <td class="tbl_data d-flex border-0">
                                                <a href="multimediaedit.php?edit=<?php if (isset($alu_id)) echo $alu_id; ?>" class="text-decoration-none"> <i class="fa fa-edit"></i></a>
                                                <a href="#" class="text-decoration-none mx-2"> <i class="fa fa-eye"></i></a>
                                                <a href="multimedia.php?id=<?php if(isset($alu_id))echo $alu_id; ?>" class="text-decoration-none"> <i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                <?php
                                    }
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
<script type="text/javascript" src="js/multimedia.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</html>