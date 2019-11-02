<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanatech Labs CMS / login</title>
    <!--google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- reference your copy Font Awesome here (from our CDN or by hosting yourself) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="housing">

  <div class=" over_all d-flex justify-content-center mx-0">
      <div class="container main_login_con d-flex justify-content-center px-0">
          <!--login container-->
          <div class="col-11 col-sm-8 col-md-6 col-lg-4 col-xl-3 login_con align-self-center">
              <div class="login_main_con">
                  <a href="#" class="text-decoration-none"> <button type="button" class="login_back_btn">go back</button> </a>
                  <p class="login_header">login</p>
                  <form action="dashboard.php"  method="post" enctype="multipart/form-data" class="login_form">
                      <div class="mb-2">
                          <label class="login_label">email:</label>
                          <div class="d-flex">
                              <span class="login_icon">&#10095;</span>
                              <input type="email" name="email" class="login_box" required>
                          </div>
                      </div>
                      <div class="mb-2">
                          <label class="login_label">password:</label>
                          <div class="d-flex">
                              <span class="login_icon">&#10095;</span>
                              <input type="password" name="password" class="login_box" required>
                          </div>
                      </div>
                      <div class="">
                          <button type="submit" name="login_sub_btn" class="login_sub_btn">login</button>
                          <button type="button" class="forget_btn">reset password</button>
                      </div>
                  </form>
              </div>
              <div class="forget_con">
                  <button type="button" class="close_forget_con">&times;</button>
                  <p class="login_header">RESET PASSWORD</p>
                  <div class="forget_hint_con">
                      <p class="forget_hint"> <i class="fa fa-info"></i> enter your recovery email address so we can send you a reset password link</p>
                  </div>
                  <form action="#" method="post" enctype="multipart/form-data" class="">
                      <label class="login_label">email:</label>
                      <div class="">
                          <input type="email" name="email" class="forget_box" required>
                      </div>
                      <button type="submit" class="forget_sub_btn">reset</button>
                  </form>
              </div>
          </div>
          <!--login container ENDS-->
      </div>
  </div>

</div>

</body>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</html>