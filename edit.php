<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

//setting your session
session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanatech Labs CMS / banner</title>
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

    <!--editing container-->
    <div class="edit_con position-absolute d-block">
        <div class="container edit px-0">
            <div class="d-flex justify-content-end"> <button type="button" class="close_edit"> &times; </button> </div>
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
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-edit" aria-selected="true">
                            <p class="tab_link">create new banner</p>
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-edit" aria-labelledby="nav-create-tab">
                        <div class="tab_content">

                            <form action="#" enctype="multipart/form-data" method="post" class="d-flex justify-content-center">
                                <div class="col post_1 mr-3 px-0">
                                    <div class="post_form_1">
                                        <?php
                                        if (isset($_GET['edit'])){
                                            $edit = $_GET['edit'];
                                        }
                                        //perform edit
                                        $query2 = "SELECT * FROM banner WHERE banner_id = $edit ";
                                        if ($query_run2 = mysqli_query($conn, $query2)){
                                            $query_row2 = mysqli_fetch_assoc($query_run2);
                                            $b_page = $query_row2['webpage'];
                                            $b_img = $query_row2['banner_img'];
                                            $b_name = $query_row2['banner_header'];
                                            $b_desc = $query_row2['banner_description'];
                                            $b_date = $query_row2['up_date'];
                                        ?>
                                            <div class="">
                                                <label class="form_label">web page:</label>
                                                <select name="webpage" class="full">
                                                    <option class="form_opt" value="<?php echo $b_page; ?> "> <?php echo $b_page; ?> </option>
                                                </select>
                                            </div>
                                            <div class="">
                                                <label class="form_label">banner image:</label> <br>
                                                <input type="file" class="full" name="banner_img" value="<?php echo $b_img; ?>" required>
                                            </div>
                                            <div class="">
                                                <label class="form_label">banner header:</label> <br>
                                                <input type="text" class="full" name="banner_title" value="<?php echo $b_name; ?>" required>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="col px-0">
                                                    <label class="form_label">banner description:</label> <br>
                                                    <textarea name="banner_desc" class="full_sum" required> <?php echo $b_desc; ?> </textarea>
                                                </div>
                                            </div>
                                            <button type="reset"name="banner_reset_btn" class="post_reset_btn mr-3"> reset post</button>
                                            <button type="submit" name="banner_sub_btn" class="post_sub_btn">create post</button>

                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--editing container ENDS-->

    </div>
    <!--housing div ENDS-->

</body>

<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/banner.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</html>