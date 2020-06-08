<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}
?>

<?php

//active link
$sact = 1;
$query = mysqli_query($conn, "SELECT * FROM user WHERE id = $userid");
while ($query_run = mysqli_fetch_assoc($query)) {
    $uname = $query_run['username'];
    $user_img = $query_run['image'];
}

//collect and send to database
if (isset($_POST['set_sub_btn'])){
    //collect form varables
    $chat_id = mysqli_real_escape_string($conn, $_POST['chat_id']);
    $google_any = mysqli_real_escape_string($conn, $_POST['google_any']);
    $facebook_url = mysqli_real_escape_string($conn, $_POST['facebook_url']);
    $instagram_url = mysqli_real_escape_string($conn, $_POST['instagram_url']);
    $twitter_url = mysqli_real_escape_string($conn, $_POST['twitter_url']);
    $youtube_url = mysqli_real_escape_string($conn, $_POST['youtube_url']);

    //send data to database
    $send_to_db = "INSERT INTO setting(chat_id, google_analytics, facebook, instagram, twitter, youtube, crt_date, up_date)
    VALUE('{$chat_id}', '{$google_any}', '{$facebook_url}', '{$instagram_url}', '{$twitter_url}', '{$youtube_url}', now(), now()) ";
    $send_db = mysqli_query($conn, $send_to_db);
    if (!$send_db){
        $failed = "failed to submit" . mysqli_error($conn);
    }
    else{
        $success = "submited successfully";
    }


}
?>

<?php
//manage your settings
$query = "SELECT * FROM setting ORDER BY id";
if ($query_run = mysqli_query($conn, $query)){
    while($query_row = mysqli_fetch_assoc($query_run)){
        $chat = $query_row['chat_id'];
        $google = $query_row['google_analytics'];
        $facebook = $query_row['facebook'];
        $instagram = $query_row['instagram'];
        $twitter = $query_row['twitter'];
        $youtube = $query_row['youtube'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanatech Labs CMS / Settings</title>
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
                        <p class="tab_link">create new settings</p>
                    </a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-create" aria-labelledby="nav-create-tab">
                    <div class="tab_content">
                        <form action="#" enctype="multipart/form-data" method="post" class="d-flex justify-content-between">
                            <div class="col post_1 mr-3 px-0">
                                <div class="post_form_1">
                                    <div class="">
                                        <label class="form_label">chat-ID:</label> <br>
                                        <input type="text" class="full" name="chat_id" value="<?php
                                        if (isset($chat)){
                                            echo $chat;
                                        }
                                        ?>" >
                                    </div>
                                    <div class="">
                                        <label class="form_label">google analytics:</label> <br>
                                        <input type="text" name="google_any" class="full" value="<?php
                                        if (isset($google)){
                                            echo $google;
                                        }
                                        ?>" >
                                    </div>
                                    <div class="">
                                        <label class="form_label">facebook-URL:</label>
                                        <input type="url" class="full" name="facebook_url" value="
                                            <?php
                                        if (isset($facebook)){
                                            echo $facebook;
                                        }
                                        ?>
                                            " >
                                    </div>
                                    <div class="">
                                        <label class="form_label">instagram-URL:</label>
                                        <input type="url" class="full" name="instagram_url" value="
                                            <?php
                                        if (isset($instagram)){
                                            echo $instagram;
                                        }
                                        ?>
                                            " >
                                    </div>
                                    <div class="">
                                        <label class="form_label">twitter-URL:</label>
                                        <input type="url" class="full" name="twitter_url" value="
                                            <?php
                                        if (isset($twitter)){
                                            echo $twitter;
                                        }
                                        ?>
                                            " >
                                    </div>
                                    <div class="">
                                        <label class="form_label">youtube-URL:</label>
                                        <input type="url" class="full" name="youtube_url" value="
                                            <?php
                                        if (isset($youtube)){
                                            echo $youtube;
                                        }
                                        ?>
                                            " >
                                    </div>
                                    <div class="">
                                        <button type="reset" name="set_reset_btn" class="post_reset_btn mr-3">reset</button>
                                        <button type="submit" name="set_sub_btn" class="post_sub_btn">create</button>
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
    <!--housing div ENDS-->

</body>

<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/post.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</html>