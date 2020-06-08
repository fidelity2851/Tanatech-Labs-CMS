<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}

//active link
$cact = 1;
$query = mysqli_query($conn, "SELECT * FROM user WHERE id = $userid");
while ($query_run = mysqli_fetch_assoc($query)) {
    $uname = $query_run['username'];
    $user_img = $query_run['image'];
}


//collecting form values from main category
if (isset($_POST['cate_sub_btn'])){
    $cate_name = mysqli_real_escape_string($conn,  $_POST['cate_name']);
    $cate_desc = mysqli_real_escape_string($conn,  $_POST['cate_desc']);

    //sending value to the database
    $send_to_db = "INSERT INTO category (name, description, crt_date, up_date) 
    VALUES ('{$cate_name}', '{$cate_desc}', now(), now() )";

    $send_db = mysqli_query($conn, $send_to_db);
    $last_id = mysqli_insert_id($conn);

    if (!$send_db){
        echo $failed = "failed to create your category " . mysqli_error($conn);
    }
    else{
        $success = "category created successfully";
    }

}

//collecting form values from sub-category
if (isset($_POST['cate_sub_sub_btn'])){
    $cate_main_name = mysqli_real_escape_string($conn,  $_POST['main_cate']);
    $cate_sub_name = mysqli_real_escape_string($conn,  $_POST['sub_name']);
    $cate_sub_desc = mysqli_real_escape_string($conn,  $_POST['sub_desc']);

    //sending value to the database
    $send_to_db1 = "INSERT INTO subcategory (category_id, name, description, crt_date, up_date)
    VALUES ( '{$cate_main_name}','{$cate_sub_name}', '{$cate_sub_desc}', now(), now() )";

    $send_db1 = mysqli_query($conn, $send_to_db1);

    if (!$send_db1){
        echo $failed = "failed to create your sub_category" . mysqli_error($conn);
    }
    else{
        $success = "sub_category created successfully";
    }

}

?>

<?php
//delecting data from database
if(isset($_GET['del'])){

    //get delete variable
    $dodelete = $_GET['del'];

    //perform delete
    $sql = mysqli_query($conn,"DELETE FROM category WHERE id = $dodelete");
    if (!$sql){
        $failed = "failed to delect your category" . mysqli_error($conn);
    }

    else {
        $success = "category delected successfully";
    }
}

?>


<?php
//fetching main category from database for editing
$query = "SELECT * FROM category ORDER BY id DESC ";
if ($query_run = mysqli_query($conn, $query)){

}

//fetching main category from database
$query1 = "SELECT * FROM category ORDER BY id";
if ($query_run1 = mysqli_query($conn, $query1)){

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
    <div class="dashboard position-absolute d-flex justify-content-between mx-0">
        <?php include("header.php") ?>
        <div class="col-10 dashboard_display_con position-absolute px-0">
            <div class="col header px-0">
                <p class="header_text">welcome to Tanatech Labs LTD CMS</p>
            </div>
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
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-create" aria-selected="true">
                            <p class="tab_link">create new category</p>
                        </a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-manage" aria-selected="false">
                            <p class="tab_link">manage your category</p>
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-create" aria-labelledby="nav-create-tab">
                        <div class="tab_content d-flex justify-content-between">
                            <form enctype="multipart/form-data" method="post" class="col-5 d-flex justify-content-center px-0">
                                <div class="col post_1 mr-3 px-0">
                                    <p class="form_head">Add Category</p>
                                    <div class="post_form_1">
                                        <div class="mb-3">
                                            <label class="form_label">category name:</label> <br>
                                            <input type="text" class="full" name="cate_name" required>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="col px-0">
                                                <label class="form_label">description: (optional)</label> <br>
                                                <textarea name="cate_desc" class="full_sum" required></textarea>
                                            </div>
                                        </div>
                                        <button type="reset" name="cate_reset_btn" class="post_reset_btn mr-3">reset</button>
                                        <button type="submit" name="cate_sub_btn" class="post_sub_btn">create</button>
                                    </div>
                                </div>
                            </form>
                            <form enctype="multipart/form-data" method="post" class="col-5 d-flex justify-content-center px-0">
                                <div class="col post_2 ml-3 px-0">
                                    <div class="post_form_2">
                                        <p class="form_head">Add Sub-Category</p>
                                        <div class="col py-3">
                                            <div class="mb-3">
                                                <label class="form_label">main categories:</label>
                                                <select name="main_cate" class="full">
                                                    <option class="form_opt" disabled selected>select main category</option>
                                                    <?php
                                                        while ($query_row1 = mysqli_fetch_assoc($query_run1)) {
                                                            $id = $query_row1['id'];
                                                            $main_menu = $query_row1['name'];
                                                            ?>
                                                            <option class="form_opt" value=" <?php if (isset($id)) echo $id; ?> "> <?php if (isset($main_menu)) echo $main_menu; ?> </option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form_label">Sub Category:</label>
                                                <input type="text" name="sub_name" class="full" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form_label">Description:</label> <br>
                                                <textarea name="sub_desc" class="full_sum"></textarea>
                                            </div>
                                            <button type="reset" name="cate_sub_reset_btn" class="post_reset_btn mr-3">reset</button>
                                            <button type="submit" name="cate_sub_sub_btn" class="post_sub_btn">create</button>
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
                                            <option class="" disabled selected>categories</option>
                                        </select>
                                        <button type="submit" class="man_sub_btn"> <i class="fa fa-arrow-right"></i> </button>
                                    </div>
                                </form>
                            </div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="tbl_header"><input type="checkbox" class="form_check"> </th>
                                    <th class="tbl_header">ID</th>
                                    <th class="tbl_header">category </th>
                                    <th class="tbl_header">Description</th>
                                    <th class="tbl_header">date</th>
                                    <th class="tbl_header">manage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    while ($query_row = mysqli_fetch_assoc($query_run)){
                                        $id = $query_row['id'];
                                        $name = $query_row['name'];
                                        $desc = $query_row['description'];
                                        $date = $query_row['up_date'];
                                        ?>
                                        <tr>
                                            <td class="tbl_data"> <input type="checkbox" class="tbl_check align-self-center"> </td>
                                            <th class="tbl_head"> <?php if (isset($id)) echo $id; ?> </th>
                                            <td class="tbl_title"> <?php if (isset($name)) echo $name; ?> </td>
                                            <td class="tbl_data"> <?php if (isset($desc)) echo $desc; ?> </td>
                                            <td class="tbl_data"> <?php if (isset($date)) echo $date; ?> </td>
                                            <td class="tbl_data d-flex border-0">
                                                <a href="categoryedit.php?edit=<?php if (isset($id)) echo $id; ?>" class="text-decoration-none"> <i class="fa fa-edit"></i></a>
                                                <a href="#" class="text-decoration-none mx-2"> <i class="fa fa-eye"></i> </a>
                                                <a href="category.php?del=<?php if (isset($id)) echo $id; ?>" class="text-decoration-none"> <i class="fa fa-trash"></i></a>
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