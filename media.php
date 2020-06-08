<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}

//active link
$mact = 1;
$query = mysqli_query($conn, "SELECT * FROM user WHERE id = $userid");
while ($query_run = mysqli_fetch_assoc($query)) {
    $uname = $query_run['username'];
    $user_img = $query_run['image'];
}

//collecting form data
if (isset($_POST['album_sub_btn'])){
    $album_name = mysqli_real_escape_string($conn, $_POST['album_title']);

    //processing image
    $album_cover_img = $_FILES['album_cover_img']['name'];
    $folder = "uploads/.$album_cover_img";
    move_uploaded_file($_FILES['album_cover_img']['tmp_name'],$folder);

    $album_desc = mysqli_real_escape_string($conn, $_POST['album_desc']);

    //sending date to database
    $send_to_db = "INSERT INTO media (name, image, description, crt_date, up_date) 
VALUES ('{$album_name}', '{$album_cover_img}', '{$album_desc}', now(), now())";
    $send_db = mysqli_query($conn, $send_to_db);

    if (!$send_db){
        $failed = "failed to create your Album" . mysqli_error($conn);
    }
    else {
        $success = "Album created successfully";
    }

}

?>


<?php
//collecting form data of gallery
if (isset($_POST['gall_btn'])){
    $gall_name1 = mysqli_real_escape_string($conn, $_POST['album_name']);

    //processing image
    $gall_img = $_FILES['gall_img']['name'];
    $folder = "uploads/.$gall_img";
    move_uploaded_file($_FILES['gall_img']['tmp_name'],$folder);

    $gall_name = mysqli_real_escape_string($conn, $_POST['gall_name']);

    //sending date to database
    $send_to_db = "INSERT INTO gallery (media_id, name, image, crt_date, up_date) 
VALUES ('{$gall_name1}', '{$gall_name}', '{$gall_img}', now(), now())";
    $send_db = mysqli_query($conn, $send_to_db);

    if (!$send_db){
        $failed = "failed to create your post" . mysqli_error($conn);
    }
    else {
        $success = "Image added to Album successfully";
    }

}
?>

<?php
//deleteing data from database

if(isset($_GET['id'])){

    //get delete variable
    $dodelete = $_GET['id'];

    //perform delete
    $sql = mysqli_query($conn,"DELETE FROM media WHERE id='$dodelete'");
    if (!$sql){
        $failed = "failed to delete your album" . mysqli_error($conn);
    }
    else {
        $success = "album deleted successfully";
    }
}
?>

<?PHP
$query1 = "SELECT * FROM media ORDER BY id DESC";
if ($query_run1 = mysqli_query($conn, $query1)){

}
?>

<?PHP
$query2 = "SELECT * FROM media ORDER BY id DESC";
if ($query_run2 = mysqli_query($conn, $query2)){

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanatech Labs CMS /Media</title>
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
                        <p class="tab_link">create new album</p>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-manage" aria-selected="false">
                            <p class="tab_link">manage your album</p>
                        </a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-create" aria-labelledby="nav-create-tab">
                    <div class="tab_content d-flex justify-content-between">
                        <form enctype="multipart/form-data" method="post" class="col-5 d-flex justify-content-center px-0">
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
                                        <label class="form_label">album description:</label> <br>
                                        <textarea name="album_desc" class="full_sum" required></textarea>
                                    </div>
                                    <button type="reset" name="album_reset_btn" class="post_reset_btn mr-3">reset</button>
                                    <button type="submit" name="album_sub_btn" class="post_sub_btn">create</button>
                                </div>
                            </div>
                        </form>
                        <form enctype="multipart/form-data" method="post" class="col-5 d-flex justify-content-center px-0">
                            <div class="col post_2 ml-3 px-0">
                                <div class="post_form_1">
                                    <div class="">
                                        <label class="form_label">select album to add image to:</label>
                                        <select name="album_name" class="full">
                                            <option class="form_opt" disabled selected>select album</option>
                                            <?php
                                            while ($query_row1 = mysqli_fetch_assoc($query_run1)){
                                                $id = $query_row1['id'];
                                                $sel_title = $query_row1['name'];
                                                ?>
                                                <option class="form_opt" value="<?php echo $id; ?>"> <?php echo $sel_title; ?> </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="">
                                        <label class="form_label">image title:</label> <br>
                                        <input type="text" class="full" name="gall_name" required>
                                    </div>
                                    <div class="">
                                        <label class="form_label">add image to album:</label> <br>
                                        <input type="file" class="full" name="gall_img" required>
                                    </div>
                                    <button type="reset" class="post_reset_btn mr-3">reset</button>
                                    <button type="submit" name="gall_btn" class="post_sub_btn">create</button>
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
                            while ($query_row2 = mysqli_fetch_assoc($query_run2)){
                                $alu_id = $query_row2['id'];
                                $alu_title = $query_row2['name'];
                                $alu_cover_img = $query_row2['image'];
                                $alu_desc = $query_row2['description'];
                                $crt_date = $query_row2['crt_date'];
                                $up_date = $query_row2['up_date'];
                                ?>
                                <tr>
                                    <td class="tbl_data"> <input type="checkbox" class="tbl_check align-self-center"> </td>
                                    <th class="tbl_head"> <?php echo $alu_id; ?> </th>
                                    <td class="tbl_title"> <?php echo $alu_title; ?> </td>
                                    <td class="tbl_data"> <img src="uploads/<?php echo $alu_cover_img; ?>" width="auto" height="60"> <?php echo $alu_cover_img; ?> </td>
                                    <td class="tbl_data"> <?php echo $alu_desc; ?> </td>
                                    <td class="tbl_data"> <?php echo $up_date; ?> </td>
                                    <td class="tbl_data d-flex border-0">
                                        <a href="mediaedit.php?edit=<?php if(isset($alu_id)) echo $alu_id; ?>" class="text-decoration-none"> <i class="fa fa-edit"></i></a>
                                        <a href="#" class="text-decoration-none mx-2"> <i class="fa fa-eye"></i></a>
                                        <a href="media.php?id=<?php if(isset($alu_id)) echo $alu_id; ?>" class="text-decoration-none"> <i class="fa fa-trash"></i></a>
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
    <!--housing div ENDS-->

</body>

<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/multimedia.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</html>