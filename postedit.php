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

    $edit_query = "SELECT * FROM post WHERE post_id = '$edit'";
    if ($edit_query_run = mysqli_query($conn, $edit_query)) {
        $edit_query_row = mysqli_fetch_assoc($edit_query_run);
        
        $title_edit = $edit_query_row['post_title'];
        $url_edit = $edit_query_row['post_slug_url'];
        $summary_edit = $edit_query_row['post_summary'];
        $post_img = $edit_query_row['post_image'];
        $content_edit = $edit_query_row['post_content'];
        $author_edit = $edit_query_row['author'];
        $category_edit = $edit_query_row['category'];
        $sub_category_edit = $edit_query_row['sub_category'];
        $tag_edit = $edit_query_row['tags'];
    }
}

if (isset($_POST['post_sub_btn'])){
    //collect form values
    $title = mysqli_real_escape_string($conn,  $_POST['title']);
    $url = mysqli_real_escape_string($conn,  $_POST['url']);
    $summary = mysqli_real_escape_string($conn,  $_POST['summary']);

    //processing image
    $img = $_FILES['post_image']['name'];
    $folder = "uploads/.$img";
    move_uploaded_file($_FILES['post_image']['tmp_name'],$folder);

    $content = mysqli_real_escape_string($conn,  $_POST['content']);
    $author = mysqli_real_escape_string($conn,  $_POST['author']);
    $category = mysqli_real_escape_string($conn,  $_POST['category']);
    $sub_category = mysqli_real_escape_string($conn, $_POST['sub_category']);
    $tags = mysqli_real_escape_string($conn, $_POST['tags']);

    if (empty($_FILES['post_image'])){
        //sending values to database

        $send_to_db = "UPDATE post SET post_title = '{$title}', post_slug_url = '{$url}', post_summary = '{$summary}', post_content = '{$content}', author = '{$author}', category = '{$category}', sub_category = '{$sub_category}', tags = '{$tags}', up_date = now() WHERE post_id = '$edit'";

        $send_db  = mysqli_query($conn, $send_to_db);
        if (!$send_db){
            $failed = "failed to create your post" . mysqli_error($conn);
        }
        else {
            $success = "post created successfully";
            header("location: postedit.php?edit=$edit");
        }
    }
    else if (!empty($_FILES['post_image'])){
        //sending values to database

        $send_to_db = "UPDATE post SET post_title = '{$title}', post_slug_url = '{$url}', post_summary = '{$summary}', post_image = '{$img}', post_content = '{$content}', author = '{$author}', category = '{$category}', sub_category = '{$sub_category}', tags = '{$tags}', up_date = now() WHERE post_id = '$edit'";

        $send_db  = mysqli_query($conn, $send_to_db);
        if (!$send_db){
            $failed = "failed to create your post" . mysqli_error($conn);
        }
        else {
            $success = "post created successfully";
            header("location: postedit.php?edit=$edit");
        }
    }
}
/*else{
    //collect form values
    $title = mysqli_real_escape_string($conn,  $_POST['title']);
    $url = mysqli_real_escape_string($conn,  $_POST['url']);
    $summary = mysqli_real_escape_string($conn,  $_POST['summary']);

    //processing image
    $img = $_FILES['post_image']['name'];
    $folder = "uploads/.$img";
    move_uploaded_file($_FILES['post_image']['tmp_name'],$folder);

    $content = mysqli_real_escape_string($conn,  $_POST['content']);
    $author = mysqli_real_escape_string($conn,  $_POST['author']);
    $category = mysqli_real_escape_string($conn,  $_POST['category']);
    $sub_category = mysqli_real_escape_string($conn, $_POST['sub_category']);
    $tags = mysqli_real_escape_string($conn, $_POST['tags']);

    //sending values to database

    $send_to_db = "UPDATE post SET post_title = '{$title}', post_slug_url = '{$url}', post_summary = '{$summary}', post_content = '{$content}', author = '{$author}', category = '{$category}', sub_category = '{$sub_category}', tags = '{$tags}', up_date = now() WHERE post_id = '$edit'";

    $send_db  = mysqli_query($conn, $send_to_db);
    if (!$send_db){
        $failed = "failed to create your post" . mysqli_error($conn);
    }
    else {
        $success = "post created successfully";
    }
}*/




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
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script>
        var jQuery_3_4_1 = $.noConflict();
    </script>
    <!-- include summernote css -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>

</head>
<body>
<!--housing div-->
<div class="housing">

    <!--header container-->
    <div class="header_con">
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
                        <div class="dash_link_con dash_link_active d-flex">
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
                        <a href="post.php" class="text-decoration-none"> <img src="images/back_btn.png" class="back_btn"> </a>
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-create" aria-selected="true">
                            <p class="tab_link">edit post</p>
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-create" aria-labelledby="nav-create-tab">
                        <div class="tab_content">
                            <form action="" enctype="multipart/form-data" method="post" class="d-flex justify-content-between">
                                <div class="col-8 post_1 mr-3 px-0">
                                    <div class="post_form_1">
                                        <div class="">
                                            <label class="form_label">title:</label> <br>
                                            <input type="text" class="full" value="<?php if (isset($title_edit)) echo $title_edit; ?>" name="title" required>
                                        </div>
                                        <div class="">
                                            <label class="form_label">slug / URl: (optional)</label> <br>
                                            <input type="url" class="full" value="<?php if (isset($url_edit)) echo $url_edit; ?>" name="url" >
                                        </div>
                                        <div class="">
                                            <label class="form_label">summary:</label> <br>
                                            <textarea name="summary" class="full_sum" required> <?php if (isset($summary_edit)) echo $summary_edit; ?> </textarea>
                                        </div>
                                        <div class="">
                                            <label class="form_label">post image:</label> <br>
                                            <input type="file" class="full" name="post_image">
                                            <img src="uploads/<?php echo ".{$post_img}"; ?>" class="edit_img">
                                        </div>
                                        <div class="">
                                            <label class="form_label">content:</label> <br>
                                            <textarea class="full_area" id="summernote" name="content"> <?php if (isset($content_edit)) echo $content_edit; ?> </textarea>
                                        </div>
                                        <button type="reset" name="post_reset_btn" class="post_reset_btn mr-3">reset post</button>
                                        <button type="submit" name="post_sub_btn" class="post_sub_btn">create post</button>
                                    </div>
                                </div>
                                <div class="col post_2 px-0">
                                    <div class="post_form_2">
                                        <div class="">
                                            <label class="form_label">author:</label>
                                            <select name="author" class="full">
                                                <option class="form_opt" disabled selected>select author</option>
                                                <?php
                                                $query1 = "SELECT * FROM users ORDER BY user_id";
                                                if ($query_run1 = mysqli_query($conn, $query1)){
                                                    while ($query_row1 = mysqli_fetch_assoc($query_run1)){
                                                        $user_name = $query_row1['username'];
                                                        ?>
                                                        <option class="form_opt"> <?php if (isset($user_name)) echo $user_name; ?> </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="col pl-0">
                                                <label class="form_label">categories:</label>
                                                <select name="category" class="full">
                                                    <?php
                                                    $query1 = "SELECT * FROM category ORDER BY category_id";
                                                    if ($query_run1 = mysqli_query($conn, $query1)){
                                                        while ($query_row1 = mysqli_fetch_assoc($query_run1)){
                                                            $main_cate = $query_row1['cate_name'];
                                                            ?>
                                                            <option class="form_opt"> <?php if (isset($category_edit)) echo $category_edit; ?> </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col pr-0">
                                                <label class="form_label">sub categories:</label>
                                                <select name="sub_category" class="full">
                                                    <option class="form_opt"></option>
                                                    <option class="form_opt">music</option>
                                                    <option class="form_opt">video</option>
                                                    <option class="form_opt">news</option>
                                                    <option class="form_opt">status</option>
                                                    <option class="form_opt">stories</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="">
                                            <label class="form_label">tags:</label> <br>
                                            <textarea name="tags"  class="full_sum"> <?php if (isset($tag_edit)) echo $tag_edit; ?> </textarea>
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
    <!--dashboard container-->

</div>
<!--housing div ENDS-->

<!-- include summernote css/js -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/post.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

</body>
</html>