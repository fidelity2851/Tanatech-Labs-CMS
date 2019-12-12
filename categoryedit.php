<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}

if (isset($_GET['edit'])){
   $edit = $_GET['edit'];

    //get value from database
    $query = "SELECT * FROM category WHERE category_id = '$edit'";
    $query_run = mysqli_query($conn, $query);
    $query_row = mysqli_fetch_assoc($query_run);
    $edit_name = $query_row['cate_name'];
    $edit_url = $query_row['cate_url'];
    $edit_check = $query_row['cate_check'];
    $edit_desc = $query_row['cate_desc'];

}

//collecting form values
if (isset($_POST['cate_sub_btn'])){
    $cate_name = mysqli_real_escape_string($conn, $_POST['cate_name']);
    $cate_url = mysqli_real_escape_string($conn, $_POST['cate_url']);
    $cate_check = mysqli_real_escape_string($conn, $_POST['cate_check']);
    $cate_desc = mysqli_real_escape_string($conn, $_POST['cate_desc']);

    //sending value to the database
    $send_to_db = "UPDATE category SET cate_name = '{$cate_name}', cate_url = '{$cate_url}', cate_check = '{$cate_check}', cate_desc = '{$cate_desc}', up_date = now() WHERE category_id = $edit";
    $send_db = mysqli_query($conn, $send_to_db);

    if (!$send_db){
        echo $failed = "failed to edit your post" . mysqli_error($conn);
    }
    else{
        $success = "post edited successfully";
    }

}
else{

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanatech Labs CMS / Categories</title>
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
                        <div class="dash_link_con dash_link_active d-flex">
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
            <div class="col dashboard_display_con px-0">
                <div class="">
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
                            <a href="category.php" class="text-decoration-none"> <img src="images/back_btn.png" class="back_btn"> </a>
                            <a class="nav-item nav-link active" data-toggle="tab" href="#nav-create" aria-selected="true">
                                <p class="tab_link">edit category</p>
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
                                                <label class="form_label">category name:</label> <br>
                                                <input type="text" class="full" value="<?php if (isset($edit_name)) echo $edit_name; ?>" name="cate_name" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form_label">link to:</label> <br>
                                                <input type="url" class="full" value="<?php if (isset($edit_url)) echo $edit_url; ?>" name="cate_url" required>
                                            </div>
                                            <label class="form_label"> <input type="checkbox" value="<?php if (isset($edit_check)) echo $edit_check; ?>" name="cate_check" class="form_check"> dropdown icon</label> <br>
                                            <div class="d-flex justify-content-between">
                                                <div class="col px-0">
                                                    <label class="form_label">description: (optional)</label> <br>
                                                    <textarea name="cate_desc" class="full_sum" required> <?php if (isset($edit_desc)) echo $edit_desc; ?> </textarea>
                                                </div>
                                            </div>
                                            <button type="reset" name="cate_reset_btn" class="post_reset_btn mr-3">reset category</button>
                                            <button type="submit" name="cate_sub_btn" class="post_sub_btn">create category</button>
                                        </div>
                                    </div>
                                </form>
                                <form action="#" enctype="multipart/form-data" method="post" class="col d-flex justify-content-center px-0">
                                    <div class="col post_2 ml-3 px-0">
                                        <div class="post_form_2">
                                            <label class="form_label">add sub category: (optional)</label>
                                            <div class="col border py-3">
                                                <div class="">
                                                    <label class="form_label">main categories:</label>
                                                    <select name="category" class="full">
                                                        <?php
                                                        $query1 = "SELECT * FROM category ORDER BY category_id";
                                                        if ($query_run1 = mysqli_query($conn, $query1)){
                                                            while ($query_row1 = mysqli_fetch_assoc($query_run1)){
                                                                $main_menu = $query_row1['cate_name'];
                                                                ?>
                                                                <option class="form_opt"> <?php echo $main_menu; ?> </option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="">
                                                    <label class="form_label">sub category:</label>
                                                    <input type="text" name="author" class="full" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form_label">link to:</label> <br>
                                                    <input type="url" class="full" name="URl" required>
                                                </div>
                                                <div class="">
                                                    <label class="form_label">description: (optional)</label> <br>
                                                    <textarea name="tags" class="full_sum"></textarea>
                                                </div>
                                                <button type="reset" class="post_reset_btn mr-3">reset sub category</button>
                                                <button type="submit" class="post_sub_btn">create sub category</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
<script type="text/javascript" src="js/categories.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</html>