<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}

//active link
$pact = 1;
$query = mysqli_query($conn, "SELECT * FROM user WHERE id = $userid");
while ($query_run = mysqli_fetch_assoc($query)) {
    $user_id = $query_run['id'];
    $uname = $query_run['username'];
    $user_img = $query_run['image'];
}

//collect post form values
if (isset($_POST['post_sub_btn'])){
    $edit = $_GET['edit'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $url = mysqli_real_escape_string($conn, $_POST['url']);
    $summary = mysqli_real_escape_string($conn, $_POST['summary']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    //processing image
    $img = $_FILES['post_image']['name'];
    $folder = "uploads/.$img";
    move_uploaded_file($_FILES['post_image']['tmp_name'],$folder);

    $cate_id = mysqli_real_escape_string($conn, $_POST['category']);
    $sub_cate_id = mysqli_real_escape_string($conn, $_POST['sub_category']);
//  $tags = mysqli_real_escape_string($conn, $_POST['tags']);
    $pub_date = mysqli_real_escape_string($conn, $_POST['date']);

    if (empty($img)){
        //sending values to database

        $send_to_db = "UPDATE post SET title = '{$title}', slug = '{$url}', summary = '{$summary}', content = '{$content}', category_id = '{$cate_id}', subcategory_id = '{$sub_cate_id}', pub_date = '{$pub_date}', up_date = now() WHERE id = '$edit'";

        $send_db  = mysqli_query($conn, $send_to_db);
        if (!$send_db){
            $failed = "failed to edit your post " . mysqli_error($conn);
        }
        else {
            $success = "post edited successfully";
            //header("location: postedit.php?edit=$edit");
        }
    }
    else if (!empty($img)){
        //sending values to database

        $send_to_db = "UPDATE post SET title = '{$title}', slug = '{$url}', summary = '{$summary}', image = '{$img}', content = '{$content}', category_id = '{$cate_id}', subcategory_id = '{$sub_cate_id}', pub_date = '{$pub_date}', up_date = now() WHERE id = '$edit'";

        $send_db  = mysqli_query($conn, $send_to_db);
        if (!$send_db){
            $failed = "failed to edited your post " . mysqli_error($conn);
        }
        else {
            $success = "post edited successfully";
            //header("location: postedit.php?edit=$edit");
        }
    }
}

//getting post data from database
if (isset($_GET['edit'])){
    $edit = $_GET['edit'];

    $edit_query = "SELECT * FROM post WHERE id = '$edit'";
    if ($edit_query_run = mysqli_query($conn, $edit_query)) {
        $edit_query_row = mysqli_fetch_assoc($edit_query_run);

        $title_edit = $edit_query_row['title'];
        $url_edit = $edit_query_row['slug'];
        $summary_edit = $edit_query_row['summary'];
        $post_img = $edit_query_row['image'];
        $content_edit = $edit_query_row['content'];
        $category_edit = $edit_query_row['category_id'];
        $sub_category_edit = $edit_query_row['subcategory_id'];
        $pub_date = $edit_query_row['pub_date'];
    }
}

//fetching category from database
$query2 = "SELECT * FROM category";
if ($query_run2 = mysqli_query($conn, $query2)){

}

//fetching sub_category from database
$query3 = "SELECT * FROM subcategory";
if ($query_run3 = mysqli_query($conn, $query3)){

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
                                            <label class="form_label">Title:</label> <br>
                                            <input type="text" class="full" value="<?php if (isset($title_edit)) echo $title_edit; ?>" name="title" required>
                                        </div>
                                        <div class="">
                                            <label class="form_label">Slug / URl: (optional)</label> <br>
                                            <input type="url" class="full" value="<?php if (isset($url_edit)) echo $url_edit; ?>" name="url" >
                                        </div>
                                        <div class="">
                                            <label class="form_label">Summary:</label> <br>
                                            <textarea name="summary" class="full_sum" required><?php if (isset($summary_edit)) echo $summary_edit; ?></textarea>
                                        </div>
                                        <div class="">
                                            <label class="form_label">post image:</label> <br>
                                            <input type="file" class="full" name="post_image">
                                            <img src="uploads/<?php echo ".{$post_img}"; ?>" class="edit_img">
                                        </div>
                                        <div class="">
                                            <label class="form_label">Content:</label> <br>
                                            <textarea class="full_area" id="summernote" name="content"> <?php if (isset($content_edit)) echo $content_edit; ?> </textarea>
                                        </div>
                                        <button type="submit" name="post_sub_btn" class="post_sub_btn">Update</button>
                                    </div>
                                </div>
                                <div class="col post_2 px-0">
                                    <div class="post_form_2">
                                        <div class="d-flex justify-content-between">
                                            <div class="col pl-0">
                                                <label class="form_label">Categories:</label>
                                                <select name="category" class="full">
                                                    <?php
                                                    $query0 = "SELECT * FROM category WHERE id = $category_edit";
                                                    if ($query_run0 = mysqli_query($conn, $query0)){
                                                        while ($query_row0 = mysqli_fetch_assoc($query_run0)){
                                                            $main_cate_id = $query_row0['id'];
                                                            $main_cate = $query_row0['name'];
                                                            ?>
                                                            <option value="<?php if (isset($main_cate_id)) echo $main_cate_id; ?>" class="form_opt"> <?php if (isset($main_cate)) echo $main_cate; ?> </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                        while ($query_row2 = mysqli_fetch_assoc($query_run2)){
                                                            $cate_id = $query_row2['id'];
                                                            $cate = $query_row2['name'];
                                                            ?>
                                                            <option value="<?php if (isset($cate_id)) echo $cate_id; ?>" class="form_opt"> <?php if (isset($cate)) echo $cate; ?> </option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col pr-0">
                                                <label class="form_label">sub categories:</label>
                                                <select name="sub_category" class="full">
                                                    <?php
                                                    $query00 = "SELECT * FROM subcategory WHERE id = $sub_category_edit";
                                                    if ($query_run00 = mysqli_query($conn, $query00)){
                                                        while ($query_row00 = mysqli_fetch_assoc($query_run00)){
                                                            $main_cate_id = $query_row00['id'];
                                                            $main_cate = $query_row00['name'];
                                                            ?>
                                                            <option value="<?php if (isset($main_cate_id)) echo $main_cate_id; ?>" class="form_opt"> <?php if (isset($main_cate)) echo $main_cate; ?> </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    while ($query_row3 = mysqli_fetch_assoc($query_run3)){
                                                        $sub_cate_id = $query_row3['id'];
                                                        $sub_cate = $query_row3['name'];
                                                        ?>
                                                        <option class="form_opt" value="<?php if (isset($sub_cate_id)) echo $sub_cate_id; ?>"> <?php if (isset($sub_cate)) echo $sub_cate ; ?> </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form_label">tags: (Seprate with commas)</label> <br>
                                            <input type="text" name="tags" class="full" data-role="tagsinput">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form_label">Featured Date </label> <br>
                                            <input type="date" name="date" value="<?php if (isset($pub_date)) echo $pub_date; ?>" class="full">
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