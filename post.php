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

if (isset($_POST['post_sub_btn'])){
    //collect form values
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
    $tags = mysqli_real_escape_string($conn, $_POST['tags']);
    $pub_date = mysqli_real_escape_string($conn, $_POST['date']);

//sending values to database
    $send_to_db = "INSERT INTO post(user_id, category_id, subcategory_id, title, slug, summary, image, content, status, pub_date, crt_date, up_date)
VALUE ('$user_id', '$cate_id', '$sub_cate_id', '$title', '$url', '$summary', '$img', '$content', 1, '$pub_date', now(), now())";
    $send_db  = mysqli_query($conn, $send_to_db);
    if (!$send_db){
        $failed = "failed to create your post " . mysqli_error($conn);
    }
    else {
        $success = "post created successfully ";
    }
}

?>


<?php
//delecting data from database
if(isset($_GET['del'])){
    //get delete variable
    $dodelete = $_GET['del'];

    //perform delete
    $sql = mysqli_query($conn,"DELETE FROM post WHERE id='$dodelete' AND DELETE FROM tags where post_id = $dodelete");
    if (!$sql){
        $failed = "failed to delect your post" . mysqli_error($conn);
    }
    else {
        $success = "post delected successfully";
    }
}

//fetching category from database
$query1 = "SELECT * FROM category ORDER BY id";
if ($query_run1 = mysqli_query($conn, $query1)){

}

//fetching sub_category from database
$query3 = "SELECT * FROM subcategory ORDER BY id";
if ($query_run3 = mysqli_query($conn, $query3)){

}

//fetching posts from database
$query = "SELECT * FROM post ORDER BY id DESC ";
if ($query_run = mysqli_query($conn, $query)){

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanatech Labs CMS / Post</title>

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
    <div class="dashboard position-absolute d-flex justify-content-between mx-0">
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
                    <a class="nav-item nav-link active" data-toggle="tab" href="#nav-create" aria-selected="true">
                        <p class="tab_link">create new post</p>
                    </a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#nav-manage" aria-selected="false">
                        <p class="tab_link">manage your post</p>
                    </a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-create" aria-labelledby="nav-create-tab">
                    <div class="tab_content">
                        <form action="" enctype="multipart/form-data" method="post" class="d-flex justify-content-between">
                            <div class="col-7 post_1 mr-3 px-0">
                                <div class="post_form_1">
                                    <div class="">
                                        <label class="form_label">title:</label> <br>
                                        <input type="text" class="full" name="title" required>
                                    </div>
                                    <div class="">
                                        <label class="form_label">slug / URl: (optional)</label> <br>
                                        <input type="url" class="full" name="url" >
                                    </div>
                                    <div class="">
                                        <label class="form_label">summary: (optional)</label> <br>
                                        <textarea name="summary" class="full_sum"></textarea>
                                    </div>
                                    <div class="">
                                        <label class="form_label">post image:</label> <br>
                                        <input type="file" class="full" name="post_image">
                                    </div>
                                    <div class="">
                                        <label class="form_label">content:</label> <br>
                                        <textarea class="full_area" id="summernote" name="content"></textarea>
                                    </div>
                                    <button type="reset" name="post_reset_btn" class="post_reset_btn mr-3">reset</button>
                                    <button type="submit" name="post_sub_btn" class="post_sub_btn">create</button>
                                </div>
                            </div>
                            <div class="col post_2 px-0">
                                <div class="post_form_2">
                                    <!--<div class="">
                                            <label class="form_label">author:</label>
                                            <select name="author" class="full" >
                                                <option class="form_opt" disabled selected>select author</option>
                                                <?php
                                    /*                                                    while ($query_row2 = mysqli_fetch_assoc($query_run2)){
                                                                                            $user_name = $query_row2['username'];
                                                                                            */?>
                                                        <option class="form_opt"> <?php /*if (isset($user_name)) echo $user_name; */?> </option>
                                                        <?php
                                    /*                                                    }
                                                                                    */?>
                                            </select>
                                        </div>-->
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="col pl-0">
                                            <label class="form_label">categories:</label>
                                            <select name="category" class="full">
                                                <option class="form_opt" disabled selected>select category</option>
                                                <?php
                                                while ($query_row1 = mysqli_fetch_assoc($query_run1)){
                                                    $id = $query_row1['id'];
                                                    $main_cate = $query_row1['name'];
                                                    ?>
                                                    <option class="form_opt" value="<?php if (isset($id)) echo $id ; ?>"> <?php if (isset($main_cate)) echo $main_cate ; ?> </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col pr-0">
                                            <label class="form_label">sub categories:</label>
                                            <select name="sub_category" class="full">
                                                <option class="form_opt" disabled selected>Select sub category</option>
                                                <?php
                                                while ($query_row3 = mysqli_fetch_assoc($query_run3)){
                                                    $id = $query_row3['id'];
                                                    $sub_cate = $query_row3['name'];
                                                    ?>
                                                    <option class="form_opt" value="<?php if (isset($id)) echo $id ; ?> "> <?php if (isset($sub_cate)) echo $sub_cate ; ?> </option>
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
                                        <input type="date" name="date" class="full">
                                    </div>
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
                                    <select name="category" class="man_select mr-3">
                                        <option class="form_opt" disabled selected>category</option>
                                        <?php
                                        while ($query_row1 = mysqli_fetch_assoc($query_run1)){
                                            $id = $query_row1['id'];
                                            $main_cate = $query_row1['name'];
                                            ?>
                                            <option class="form_opt" value="<?php if (isset($id)) echo $id ; ?>"> <?php if (isset($main_cate)) echo $main_cate ; ?> </option>
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
                                <th class="tbl_header"> <input type="checkbox" class="tbl_check align-self-center"> </th>
                                <th class="tbl_header">ID</th>
                                <th class="tbl_header">Title</th>
                                <th class="tbl_header">Category</th>
                                <th class="tbl_header">Status</th>
                                <th class="tbl_header">Date / Time</th>
                                <th class="tbl_header">manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($query_row = mysqli_fetch_assoc($query_run)){
                                $id = $query_row['id'];
                                $title = $query_row['title'];
                                $summary = $query_row['summary'];
                                $status = $query_row['status'];
                                $date = $query_row['crt_date'];
                                ?>
                                <tr>
                                    <td class="tbl_data"> <input type="checkbox" class="tbl_check align-self-center"> </td>
                                    <td class="tbl_head"> <?Php echo $id?> </td>
                                    <td class="tbl_title"> <?Php echo $title?> </td>
                                    <td class="tbl_title"> <?Php echo $summary?> </td>
                                    <td class="tbl_data"> <?Php if ($status==1){echo "Active";} else{echo "Inactive";}?> </td>
                                    <td class="tbl_data"> <?Php echo $date?> </td>
                                    <td class="tbl_data d-flex border-0">
                                        <a href="postedit.php?edit=<?php if (isset($id)) echo $id; ?>"  class="text-decoration-none edit_btn"> <i class="fa fa-edit"></i></a>
                                        <a href="#" class="text-decoration-none mx-2"> <i class="fa fa-eye"></i></a>
                                        <a href="post.php?del=<?php if (isset($id)) echo $id; ?>" class="text-decoration-none"> <i class="fa fa-trash"></i></a>
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

    <!-- include summernote css/js -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/post.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

</body>
</html>