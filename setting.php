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
//collect and send to database
if (isset($_POST['set_sub_btn'])){
    //collect form varables
    $site_url = mysqli_real_escape_string($conn, $_POST['site_url']);
    $chat_id = mysqli_real_escape_string($conn, $_POST['chat_id']);
    $google_any = mysqli_real_escape_string($conn, $_POST['google_any']);
    $kyc = $_POST['kyc'];
    $very_email = $_POST['very_email'];
    $facebook_url = $_POST['facebook_url'];
    $instagram_url = $_POST['instagram_url'];
    $twitter_url = $_POST['twitter_url'];
    $youtube_url = $_POST['youtube_url'];

    //send data to database
    $send_to_db = "INSERT INTO setting(site_url, chat_id, google_analytics, kyc_option, veryify_email, facebook_url, instagram_url, twitter_url, youtube_url, crt_date, up_date)
    VALUE('{$site_url}', '{$chat_id}', '{$google_any}', '{$kyc}', '{$very_email}', '{$facebook_url}', '{$instagram_url}', '{$twitter_url}', '{$youtube_url}', now(), now()) ";
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
$query = "SELECT * FROM setting ORDER BY setting_id=1";
if ($query_run = mysqli_query($conn, $query)){
    while($query_row = mysqli_fetch_assoc($query_run)){
        $site = $query_row['site_url'];
        $chat = $query_row['chat_id'];
        $google = $query_row['google_analytics'];
        $kyc_opt = $query_row['kyc_option'];
        $email = $query_row['veryify_email'];
        $facebook = $query_row['facebook_url'];
        $instagram = $query_row['instagram_url'];
        $twitter = $query_row['twitter_url'];
        $youtube = $query_row['youtube_url'];
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
                        <div class="dash_link_con dash_link_active d-flex">
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
                            <p class="tab_link">create new settings</p>
                        </a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-manage" aria-selected="false">
                            <p class=" tab_link d-none">manage your settings</p>
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
                                            <label class="form_label">site-URL:</label> <br>
                                            <input type="url" class="full" name="site_url" value="
                                            <?php 
                                            if (isset($site)){
                                                echo $site;
                                            } 
                                            ?>
                                            " required>
                                        </div>
                                        <div class="">
                                            <label class="form_label">chat-ID:</label> <br>
                                            <input type="text" class="full" name="chat_id" value="<?php 
                                            if (isset($chat)){
                                                echo $chat;
                                            } 
                                            ?>" required>
                                        </div>
                                        <div class="">
                                            <label class="form_label">google analytics:</label> <br>
                                            <input type="text" name="google_any" class="full" value="<?php 
                                            if (isset($google)){
                                                echo $google;
                                            } 
                                            ?>" required>
                                        </div>
                                        <div class="">
                                            <label class="form_label">KYC option:</label>
                                            <select name="kyc" class="full">
                                                <option class="form_opt" value=" <?php 
                                            if (isset($kyc_opt)){
                                                echo $kyc_opt;
                                            } 
                                            ?>
                                            ">

                                            <?php 
                                            if (isset($kyc_opt)){
                                                echo $kyc_opt;
                                            } 
                                            ?>

                                            </option>
                                                
                                            </select>
                                        </div>
                                        <div class="">
                                            <label class="form_label">veryify Email:</label> <br>
                                            <input type="text" name="very_email" class="full" value="<?php 
                                            if (isset($email)){
                                                echo $email;
                                            } 
                                            ?>" required>
                                        </div>
                                        <div class="">
                                            <button type="reset" name="set_reset_btn" class="post_reset_btn mr-3">reset post</button>
                                            <button type="submit" name="set_sub_btn" class="post_sub_btn">create post</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col post_2 px-0">
                                    <label class="form_label">social media accounts:</label>
                                    <div class="post_form_2">
                                        <div class="">
                                            <label class="form_label">facebook-URL:</label>
                                            <input type="url" class="full" name="facebook_url" value="
                                            <?php 
                                            if (isset($facebook)){
                                                echo $facebook;
                                            } 
                                            ?>
                                            " required>
                                        </div>
                                        <div class="">
                                            <label class="form_label">instagram-URL:</label>
                                            <input type="url" class="full" name="instagram_url" value="
                                            <?php 
                                            if (isset($instagram)){
                                                echo $instagram;
                                            } 
                                            ?>
                                            " required>
                                        </div>
                                        <div class="">
                                            <label class="form_label">twitter-URL:</label>
                                            <input type="url" class="full" name="twitter_url" value="
                                            <?php 
                                            if (isset($twitter)){
                                                echo $twitter;
                                            } 
                                            ?>
                                            " required>
                                        </div>
                                        <div class="">
                                            <label class="form_label">youtube-URL:</label>
                                            <input type="url" class="full" name="youtube_url" value="
                                            <?php 
                                            if (isset($youtube)){
                                                echo $youtube;
                                            } 
                                            ?>
                                            " required>
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
                                <tr>
                                    <td class="tbl_data"> <input type="checkbox" class="tbl_check align-self-center"> </td>
                                    <th class="tbl_head">1</th>
                                    <td class="tbl_title">Nnamani wants end to discrimination against women ....pays WAEC fees for girls in his constituency</td>
                                    <td class="tbl_data">music</td>
                                    <td class="tbl_data">12:48pm - 19/10/2019</td>
                                    <td class="tbl_data d-flex border-0">
                                        <a href="settingedit.php?<?php if (isset($id)) echo $id; ?>" class="text-decoration-none"> <i class="fa fa-edit"></i></a>
                                        <a href="#" class="text-decoration-none mx-2"> <i class="fa fa-eye"></i></a>
                                        <a href="#" class="text-decoration-none"> <i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
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
<script type="text/javascript" src="js/post.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</html>