<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}

//active link
$fact = 1;
$query = mysqli_query($conn, "SELECT * FROM user WHERE id = $userid");
while ($query_run = mysqli_fetch_assoc($query)) {
    $uname = $query_run['username'];
    $user_img = $query_run['image'];
}

//collecting form data
if (isset($_POST['que_sub_btn'])){
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $question_ans = mysqli_real_escape_string($conn, $_POST['question_ans']);

    //sending date to database
    $send_to_db = "INSERT INTO faq (question, answer, crt_date, up_date) 
VALUES ('{$question}', '{$question_ans}', now(), now())";
    $send_db = mysqli_query($conn, $send_to_db);

    if (!$send_db){
        $failed = "failed to create your FAQ" . mysqli_error($conn);
    }
    else {
        $success = "FAQ created successfully";
    }

}

?>

<?php
//delecting data from database

if(isset($_GET['id'])){

    //get delete variable
    $dodelete = $_GET['id'];

    //perform delete
    $sql = mysqli_query($conn,"DELETE FROM faq WHERE id='$dodelete'");
    if (!$sql){
        $failed = "failed to delete your FAQ " . mysqli_error($conn);
    }
    else {
        $success = "FAQ deleted successfully";
    }
}
?>

<?PHP
$query = "SELECT * FROM faq ORDER BY id DESC";
if ($query_run = mysqli_query($conn, $query)){

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanatech Labs CMS / Faq</title>
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
                        <form action="#" enctype="multipart/form-data" method="post" class="d-flex justify-content-between">
                            <div class="col post_1 mr-3 px-0">
                                <div class="post_form_1">
                                    <div class="">
                                        <label class="form_label">question:</label>
                                        <input type="text" name="question" class="full" required>
                                    </div>
                                    <div class="">
                                        <label class="form_label">question answer:</label> <br>
                                        <textarea name="question_ans" class="full_area" required></textarea>
                                    </div>
                                    <div class="">
                                        <button type="reset" name="que_reset_btn" class="post_reset_btn mr-3">reset question</button>
                                        <button type="submit" name="que_sub_btn" class="post_sub_btn">create question</button>
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
                                <th class="tbl_header">questions</th>
                                <th class="tbl_header">answers</th>
                                <th class="tbl_header">Date / Time</th>
                                <th class="tbl_header">manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?PHP
                            while ($query_row = mysqli_fetch_assoc($query_run)){
                                $faq_id = $query_row['id'];
                                $question1 = $query_row['question'];
                                $question_ans2 = $query_row['answer'];
                                $crt_date = $query_row['crt_date'];
                                ?>
                                <tr>
                                    <td class="tbl_data"> <input type="checkbox" class="tbl_check align-self-center"> </td>
                                    <th class="tbl_head"> <?php echo $faq_id; ?> </th>
                                    <td class="tbl_data"> <?php echo $question1; ?> </td>
                                    <td class="tbl_data"> <?php echo $question_ans2; ?> </td>
                                    <td class="tbl_data"> <?php echo $crt_date; ?> </td>
                                    <td class="tbl_data d-flex border-0">
                                        <a href="faqedit.php?edit=<?php if (isset($faq_id)) echo $faq_id; ?>" class="text-decoration-none"> <i class="fa fa-edit"></i></a>
                                        <a href="#" class="text-decoration-none mx-2"> <i class="fa fa-eye"></i></a>
                                        <a href="faq.php?id=<?php if (isset($faq_id)) echo $faq_id; ?>" class="text-decoration-none"> <i class="fa fa-trash"></i></a>
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
<script type="text/javascript" src="js/faq.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</html>