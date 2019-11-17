<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}

if (isset($_POST['post_sub_btn'])){
    //collect form values
    $title = $_POST['title'];
    $url = $_POST['url'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $sub_category = $_POST['sub_category'];
    $tags = $_POST['tags'];
    $crt_date = $_POST['date'];

//sending values to database
    $send_to_db = "INSERT INTO post(post_title, post_slug_url, post_summary, post_content, author, category, sub_category, tags, crt_date, up_date)
VALUE ('{$title}', '{$url}', '{$summary}', '{$content}', '{$author}', '{$category}', '{$sub_category}', '{$tags}', '{$crt_date}', now())";
    $send_db  = mysqli_query($conn, $send_to_db);
    if (!$send_db){
        $failed = "failed to create your post" . mysqli_error($conn);
    }
    else {
        $success = "post created successfully";
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
    <!--editing container-->
    <div class="edit_con position-absolute">
        <div class="container edit px-0">
            <div class="d-flex justify-content-end"> <button type="button" class="close_edit"> &times; </button> </div>
            <div class="col dashboard_display_con px-0">
                <nav class="tab_con">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-create2" aria-selected="true">
                            <p class="tab_link">update post</p>
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-create2" aria-labelledby="nav-create-tab">
                        <div class="tab_content">
                            <form action="" enctype="multipart/form-data" method="post" class="d-flex justify-content-between">
                                <div class="col-8 post_1 mr-3 px-0">
                                    <?php
                                    $edit_query = "SELECT * FROM post ";
                                    if ($edit_query_run = mysqli_query($conn, $edit_query)){
                                    $edit_query_row = mysqli_fetch_assoc($edit_query_run);
                                    $title_edit = $edit_query_row['post_title'];
                                    ?>

                                    <div class="post_form_1">
                                        <div class="">
                                            <label class="form_label">title:</label> <br>
                                            <input type="text" class="full" name="edit_title" value="<?php echo $title_edit; ?>" required>
                                        </div>
                                        <div class="">
                                            <label class="form_label">slug / URl: (optional)</label> <br>
                                            <input type="url" class="full" name="edit_url" >
                                        </div>
                                        <div class="">
                                            <label class="form_label">summary:</label> <br>
                                            <textarea name="edit_summary" class="full_sum" required></textarea>
                                        </div>
                                        <div class="">
                                            <label class="form_label">post image:</label> <br>
                                            <input type="file" class="full" name="edit_banner_image">
                                        </div>
                                        <div class="">
                                            <label class="form_label">content:</label> <br>
                                            <textarea class="full_area" id="summernote2" name="edit_content"></textarea>
                                        </div>
                                        <button type="reset" name="edit_post_reset_btn" class="post_reset_btn mr-3">reset post</button>
                                        <button type="submit" name="edit_post_sub_btn" class="post_sub_btn">update post</button>
                                    </div>
                                </div>
                                <div class="col post_2 px-0">
                                    <div class="post_form_2">
                                        <div class="">
                                            <label class="form_label">author:</label>
                                            <input type="text" name="edit_author" class="full" required>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="col pl-0">
                                                <label class="form_label">categories:</label>
                                                <select name="edit_category" class="full">
                                                    <option class="form_opt"></option>
                                                    <option class="form_opt">music</option>
                                                    <option class="form_opt">video</option>
                                                    <option class="form_opt">news</option>
                                                    <option class="form_opt">status</option>
                                                    <option class="form_opt">stories</option>
                                                </select>
                                            </div>
                                            <div class="col pr-0">
                                                <label class="form_label">sub categories:</label>
                                                <select name="edit_sub_category" class="full">
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
                                            <textarea name="edit_tags" class="full_sum"></textarea>
                                        </div>
                                        <div class="">
                                            <label class="form_label">date:</label> <br>
                                            <input type="date" name="edit_date" class="full">
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--editing container ENDS-->

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
                    <a href="categories.php" class="text-decoration-none">
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
                                <div class="col-8 post_1 mr-3 px-0">
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
                                            <label class="form_label">summary:</label> <br>
                                            <textarea name="summary" class="full_sum" required></textarea>
                                        </div>
                                        <div class="">
                                            <label class="form_label">post image:</label> <br>
                                            <input type="file" class="full" name="banner_image">
                                        </div>
                                        <div class="">
                                            <label class="form_label">content:</label> <br>
                                            <textarea class="full_area" id="summernote" name="content"></textarea>
                                        </div>
                                        <button type="reset" name="post_reset_btn" class="post_reset_btn mr-3">reset post</button>
                                        <button type="submit" name="post_sub_btn" class="post_sub_btn">create post</button>
                                    </div>
                                </div>
                                <div class="col post_2 px-0">
                                    <div class="post_form_2">
                                        <div class="">
                                            <label class="form_label">author:</label>
                                            <input type="text" name="author" class="full" required>
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
                                                            <option class="form_opt"> <?php echo $main_cate ; ?> </option>
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
                                            <textarea name="tags" class="full_sum"></textarea>
                                        </div>
                                        <div class="">
                                            <label class="form_label">date:</label> <br>
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
                                    <th class="tbl_header"> <input type="checkbox" class="tbl_check align-self-center"> </th>
                                    <th class="tbl_header">ID</th>
                                    <th class="tbl_header">Title</th>
                                    <th class="tbl_header">Category</th>
                                    <th class="tbl_header">Date / Time</th>
                                    <th class="tbl_header">manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = "SELECT * FROM post ORDER BY post_id DESC ";
                                if ($query_run = mysqli_query($conn, $query)){
                                    while ($query_row = mysqli_fetch_assoc($query_run)){
                                        $id = $query_row['post_id'];
                                        $title = $query_row['post_title'];
                                        $cate = $query_row['category'];
                                        $date = $query_row['up_date'];
                                        ?>

                                <tr>
                                    <td class="tbl_data"> <input type="checkbox" class="tbl_check align-self-center"> </td>
                                    <td class="tbl_head"> <?Php echo $id?> </td>
                                    <td class="tbl_title"> <?Php echo $title?> </td>
                                    <td class="tbl_data"> <?Php echo $cate?> </td>
                                    <td class="tbl_data"> <?Php echo $date?> </td>
                                    <td class="tbl_data d-flex border-0">
                                        <a href="#"  class="text-decoration-none edit_btn"> <i class="fa fa-edit"></i></a>
                                        <a href="#" class="text-decoration-none mx-2"> <i class="fa fa-eye"></i></a>
                                        <a href="#" class="text-decoration-none"> <i class="fa fa-trash"></i></a>
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
    <!--dashboard container-->

</div>
<!--housing div ENDS-->

    <!-- include summernote css/js -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/post.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

</body>
</html>