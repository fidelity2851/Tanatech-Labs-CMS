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

//collecting form data of Album
if (isset($_POST['album_sub_btn'])){
    $edit = $_GET['edit'];

    $album_name = mysqli_real_escape_string($conn, $_POST['album_title']);

    //processing image
    $album_cover_img = $_FILES['album_cover_img']['name'];
    $folder = "uploads/.$album_cover_img";
    move_uploaded_file($_FILES['album_cover_img']['tmp_name'],$folder);

    $album_desc = mysqli_real_escape_string($conn, $_POST['album_desc']);

    if (empty($album_cover_img)){
        $send_to_db = "UPDATE media SET name = '{$album_name}', description = '{$album_desc}', up_date = now() WHERE id = $edit";
        $send_db = mysqli_query($conn, $send_to_db);

        if (!$send_db){
            $failed = "failed to edit your album" . mysqli_error($conn);
        }
        else {
            $success = "album edited successfully";
            //header("location: mediaedit.php?edit=$edit");
        }

    }
    else{
        $send_to_db = "UPDATE media SET name = '{$album_name}', image = '$album_cover_img', description = '{$album_desc}', up_date = now() WHERE id = $edit";
        $send_db = mysqli_query($conn, $send_to_db);

        if (!$send_db){
            $failed = "failed to edit your album" . mysqli_error($conn);
        }
        else {
            $success = "album edited successfully";
            //header("location: mediaedit.php?edit=$edit");
        }

    }
}

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

//deleting gallery
if (isset($_GET['del'])){
    $del = $_GET['del'];
    $query3 = "DELETE FROM gallery WHERE id = '$del'";
    $query3_del = mysqli_query($conn, $query3);
    if (!$query3){
        $failed = "Failed to DELETE your IMAGE" . mysqli_error($conn);
    }
    else{
        $success = "Image DELETED Successfully";
    }
}

if (isset($_GET['edit'])){
    $edit = $_GET['edit'];

    //get value from database
    $query = "SELECT * FROM media WHERE id = '$edit'";
    $query_run = mysqli_query($conn, $query);
    $query_row = mysqli_fetch_assoc($query_run);
    $edit_name = $query_row['name'];
    $edit_img = $query_row['image'];
    $edit_desc = $query_row['description'];
}


$query1 = "SELECT * FROM media WHERE id = '$edit'";
if ($query_run1 = mysqli_query($conn, $query1)){
    $query_row1 = mysqli_fetch_assoc($query_run1);
    $id = $query_row1['id'];
    $name = $query_row1['name'];
}

$query2 = "SELECT * FROM gallery WHERE media_id = '$edit'";
$count =0;
if ($query_run2 = mysqli_query($conn, $query2)){
    while ($query_row2 = mysqli_fetch_assoc($query_run2)){
        $idd[] = $query_row2['id'];
        $title[] = $query_row2['name'];
        $img[] = $query_row2['image'];
        $count++;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanatech Labs CMS /media</title>
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
                        <a href="media.php" class="text-decoration-none"> <img src="images/back_btn.png" class="back_btn"> </a>
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-create" aria-selected="true">
                            <p class="tab_link">edit album</p>
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-create" aria-labelledby="nav-create-tab">
                        <div class="tab_content d-flex justify-content-between">
                            <form action="#" enctype="multipart/form-data" method="post" class="col-6 d-flex justify-content-center px-0">
                                <div class="col post_1 mr-3 px-0">
                                    <div class="post_form_1">
                                        <div class="mb-3">
                                            <label class="form_label">album title:</label> <br>
                                            <input type="text" class="full" value="<?php if (isset($edit_name)) echo $edit_name; ?>" name="album_title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form_label">album cover image:</label> <br>
                                            <input type="file" class="full mb-3" name="album_cover_img">
                                            <img src="uploads/<?php echo ".$edit_img" ; ?>" class="edit_img">
                                        </div>
                                        <div class="">
                                            <label class="form_label">album description:</label> <br>
                                            <textarea name="album_desc"  class="full_sum" required> <?php if (isset($edit_desc)) echo $edit_desc; ?></textarea>
                                        </div>
                                        <button type="submit" name="album_sub_btn" class="post_sub_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                            <form action="#" enctype="multipart/form-data" method="post" class="col-5 d-flex justify-content-center px-0">
                                <div class="col post_2 ml-3 px-0">
                                    <div class="post_form_1">
                                        <div class="">
                                            <label class="form_label">Select Album</label>
                                            <select name="album_name" class="full">
                                                <option value="<?php if (isset($id)) echo $id; ?>" class="form_opt"><?php if (isset($name)) echo $name; ?></option>
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
                                        <div class="row mx-0">
                                            <?php
                                            for ($i=0; $i<$count; $i++){
                                                ?>
                                                <div class="position-relative p-3">
                                                    <a href="mediaedit.php?edit=<?php if (isset($edit)) echo $edit; ?>&del=<?php if (isset($idd[$i])) echo $idd[$i]; ?>" class="text-decoration-none"><span class="close_btn">&times;</span></a>
                                                    <img class="edit_img" src="uploads/<?php if (isset($img[$i])) echo ".$img[$i]"; ?>"/>
                                                    <p class="form_label"><?php if (isset($title[$i])) echo $title[$i]; ?></p>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <button type="submit" name="gall_btn" class="post_sub_btn">Update</button>
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

</body>

<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/multimedia.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</html>