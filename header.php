<?php
    if (isset($_POST['Logout'])){
        session_destroy();
        header("location: index.php");
    }
?>

<div class="col-2 dashboard_link_con position-fixed d-flex flex-column px-0">
    <div class="logo_con d-flex">
        <img src="images/logo.fw.png" class="logo align-self-center mx-auto">
    </div>
    <div class="dash_header_con d-flex justify-content-start">
        <div class="dash_header_icon align-self-center mr-3"> <img src="../uploads/<?php if (isset($user_img)) echo $user_img ?>" class="dash_header_img"> </div>
        <div class="align-self-center">
            <p class="dash_header"> <?php if (isset($uname)) echo $uname ?> <span class="dash_header_icon2"> <i class="fa fa-angle-down"></i> </span> </p>
            <form method="post">
                <button type="submit" name="Logout" class="drop_link"> <i class="fa fa-power-off"></i> logout</button>
            </form>
        </div>
    </div>
    <div class="">
        <a href="dashboard.php" class="text-decoration-none">
            <p class=<?php if (isset($dact)){echo "dash_link_active";}else{echo "dash_link";} ?> > <i class="fa fa-home mr-2"></i> Dashboard</p>
        </a>
        <a href="category.php" class="text-decoration-none">
            <p class="<?php if (isset($cact)){echo "dash_link_active";}else{echo "dash_link";} ?>"> <i class="fa fa-home mr-2"></i> Category</p>
        </a>
        <a href="post.php" class="text-decoration-none">
            <p class="<?php if (isset($pact)){echo "dash_link_active";}else{echo "dash_link";} ?>"> <i class="fa fa-home mr-2"></i> Post</p>
        </a>
        <a href="banner.php" class="text-decoration-none">
            <p class="<?php if (isset($bact)){echo "dash_link_active";}else{echo "dash_link";} ?>"> <i class="fa fa-home mr-2"></i> Banner</p>
        </a>
        <a href="media.php" class="text-decoration-none">
            <p class="<?php if (isset($mact)){echo "dash_link_active";}else{echo "dash_link";} ?>"> <i class="fa fa-home mr-2"></i> Madia</p>
        </a>
        <a href="faq.php" class="text-decoration-none">
            <p class="<?php if (isset($fact)){echo "dash_link_active";}else{echo "dash_link";} ?>"> <i class="fa fa-question-circle mr-2"></i> Faq</p>
        </a>
        <a href="user.php" class="text-decoration-none">
            <p class="<?php if (isset($uact)){echo "dash_link_active";}else{echo "dash_link";} ?>"> <i class="fa fa-users mr-2"></i> User</p>
        </a>
        <a href="setting.php" class="text-decoration-none">
            <p class="<?php if (isset($sact)){echo "dash_link_active";}else{echo "dash_link";} ?>"> <i class="fa fa-cogs mr-2"></i> Setting</p>
        </a>
    </div>
    <p class="power mt-auto">powered by: <span class="power_name">Tanatech Labs</span> </p>
</div>