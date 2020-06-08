<?php
include_once ("backend_script/connection.php");
$conn = mysqli_connect($server, $username, $password, $db_name);

session_start();
$userid = $_SESSION["cool"];
if(!$userid){
    header("location: index.php");
}

//active link
$uact = 1;
$query = mysqli_query($conn, "SELECT * FROM user WHERE id = $userid");
while ($query_run = mysqli_fetch_assoc($query)) {
    $uname = $query_run['username'];
    $user_img = $query_run['image'];
}

//collecting form data
if (isset($_POST['post_sub_btn'])){
    //collect form values
    $user_name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn,  $_POST['email']);
    $role = mysqli_real_escape_string($conn,  $_POST['role']);

    //processing image
    $profile_pic = $_FILES['image']['name'];
    $folder = "uploads/.$profile_pic";
    move_uploaded_file($_FILES['image']['tmp_name'],$folder);

    $biograph = mysqli_real_escape_string($conn, $_POST['biograph']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $password = password_hash($pass,PASSWORD_DEFAULT);
    $c_pass = mysqli_real_escape_string($conn, $_POST['c_password']);
    $comfirm_password = password_verify($c_pass,PASSWORD_DEFAULT);

    if ($pass == $c_pass){
        //sending values to database
        $send_to_db = "INSERT INTO user(username, password, image, role, status, biograph, crt_date, up_date)
        VALUE ('{$user_name}', '{$password}', '{$profile_pic}', '{$role}', 1, '{$biograph}',  now(), now())";
        $send_db  = mysqli_query($conn, $send_to_db);
        $last_id = mysqli_insert_id($conn);
        if (!$send_db){
            $failed = "failed to create your user " . mysqli_error($conn);
        }
        else {

            $email_data = "INSERT INTO email (email, user_id, crt_date, up_date) VALUES ('{$email}', '{$last_id}', now(), now())";
            mysqli_query($conn, $email_data);
            $success = "user created successfully";
        }
    }
    else{
        $failed = "Password Mismatch";
    }

}


//delecting data from database

if (isset($_GET['id'])) {

    //get delete variable
    $dodelete = $_GET['id'];

    //perform delete
    mysqli_query($conn, "DELETE FROM email WHERE User_id = '$dodelete'");
    $sql = mysqli_query($conn, "DELETE FROM user WHERE id='$dodelete'");
    if (!$sql) {
        $failed = "failed to delect your user" . mysqli_error($conn);
    } else {
        $success = "user delected successfully";
    }
}

?>

<?php
$query = "SELECT * FROM user ORDER BY id DESC ";

if ($query_run = mysqli_query($conn, $query)){

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanatech Labs CMS / User</title>
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
                        <p class="tab_link">create new user</p>
                    </a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#nav-manage" aria-selected="false">
                        <p class="tab_link">manage your users</p>
                    </a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-create" aria-labelledby="nav-create-tab">
                    <div class="tab_content">
                        <form action="" enctype="multipart/form-data" method="post" class="d-flex justify-content-between">
                            <div class="col post_1 mr-3 px-0">
                                <div class="post_form_1">
                                    <div class="d-flex">
                                        <div class="col">
                                            <label class="form_label">username:</label> <br>
                                            <input type="text" class="full" name="username" required>
                                        </div>
                                        <div class="col">
                                            <label class="form_label">email:</label> <br>
                                            <input type="email" class="full" name="email" required>
                                        </div>
                                        <div class="col ">
                                            <label class="form_label">Role</label> <br>
                                            <select class="form_sel" name="role">
                                                <option value="user" class="">User</option>
                                                <option value="writter" class="">Writter</option>
                                                <option value="admin" class="">Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="col ">
                                            <label class="form_label">profile picture:</label> <br>
                                            <input type="file" class="full" name="image">
                                        </div>
                                        <div class="col ">
                                            <label class="form_label">password:</label> <br>
                                            <input type="password" class="full" name="password" required>
                                        </div>
                                        <div class="col ">
                                            <label class="form_label">comfirm password:</label> <br>
                                            <input type="password" class="full" name="c_password" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="form_label">biograph:</label> <br>
                                        <textarea name="biograph" class="full_sum" required></textarea>
                                    </div>
                                    <div class="col ">
                                        <button type="reset" name="post_reset_btn" class="post_reset_btn mr-3">reset</button>
                                        <button type="submit" name="post_sub_btn" class="post_sub_btn">create</button>
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
                                <th class="tbl_header">Username</th>
                                <th class="tbl_header">Email</th>
                                <th class="tbl_header">Password</th>
                                <th class="tbl_header">Role</th>
                                <th class="tbl_header">Date / Time</th>
                                <th class="tbl_header">manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($query_row = mysqli_fetch_assoc($query_run)){
                                $id = $query_row['id'];
                                $username = $query_row['username'];
                                $pass = $query_row['password'];
                                $role = $query_row['role'];
                                $date = $query_row['up_date'];
                                ?>

                                <tr>
                                    <td class="tbl_data"> <input type="checkbox" class="tbl_check align-self-center"> </td>
                                    <td class="tbl_head"> <?Php echo $id?> </td>
                                    <td class="tbl_title"> <?Php echo $username?> </td>
                                    <td class="tbl_data">
                                        <?php
                                        $query2 = "SELECT * FROM email WHERE User_id = $id ";
                                        if ($query_run2 = mysqli_query($conn, $query2))
                                            while ($query_row2 = mysqli_fetch_assoc($query_run2)) {
                                                $email = $query_row2['email'];

                                                echo $email;

                                            }

                                        ?>
                                    </td>
                                    <td class="tbl_data"> <?Php echo $pass?> </td>
                                    <td class="tbl_data"> <?Php echo $role?> </td>
                                    <td class="tbl_data"> <?Php echo $date?> </td>
                                    <td class="tbl_data d-flex border-0">
                                        <a href="useredit.php?edit=<?php if (isset($id)) echo $id; ?>" class="text-decoration-none"> <i class="fa fa-edit"></i></a>
                                        <a href="#" class="text-decoration-none mx-2"> <i class="fa fa-eye"></i></a>
                                        <a href="user.php?id=<?php if (isset($id)) echo $id; ?>" class="text-decoration-none"> <i class="fa fa-trash"></i></a>
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
<script type="text/javascript" src="js/post.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</html>