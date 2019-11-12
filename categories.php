<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanatech Labs CMS / Categories</title>
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
                            <a href="index.php" class="text-decoration-none">
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
                    <a href="post.php" class="text-decoration-none">
                        <div class="dash_link_con d-flex">
                            <span class="dash_icon"> <i class="fa fa-podcast"></i> </span>
                            <p class="dash_link">post</p>
                        </div>
                    </a>
                    <a href="categories.php" class="text-decoration-none">
                        <div class="dash_link_con dash_link_active d-flex">
                            <span class="dash_icon"> <i class="fa fa-tags"></i> </span>
                            <p class="dash_link">categories</p>
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
                        <div class="dash_link_con d-flex">
                            <span class="dash_icon"> <i class="fa fa-cogs" aria-hidden="true"></i> </span>
                            <p class="dash_link">settings</p>
                        </div>
                    </a>
                </div>
                <p class="power mt-auto">powered by: <span class="power_name">Tanatech Labs</span> </p>
            </div>
            <div class="col dashboard_display_con px-0">
                <div class="">
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
                            <div class="tab_content">
                                <form action="#" enctype="multipart/form-data" method="post" class="d-flex justify-content-center">
                                    <div class="col post_1 mr-3 px-0">
                                        <div class="post_form_1">
                                            <div class="">
                                                <label class="form_label">category name:</label> <br>
                                                <input type="text" class="full" name="catename" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form_label">link to:</label> <br>
                                                <input type="url" class="full" name="URl" required>
                                            </div>
                                            <label class="form_label"> <input type="checkbox" class="form_check" checked> dropdown icon</label> <br>
                                            <label class="form_label">(optional)</label>
                                            <div class="col border py-3">
                                                <div class="">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col pl-0">
                                                            <label class="form_label">sub categories: (1st)</label>
                                                            <input type="text" class="full">
                                                        </div>
                                                        <div class="col pl-0">
                                                            <label class="form_label">sub categories: (2nd)</label>
                                                            <input type="text" class="full">
                                                        </div>
                                                        <div class="col px-0">
                                                            <label class="form_label">sub categories: (3rd)</label>
                                                            <input type="text" class="full">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col pl-0">
                                                            <label class="form_label">link to: (1st)</label> <br>
                                                            <input type="url" class="full" name="URl" required>
                                                        </div>
                                                        <div class="col px-0">
                                                            <label class="form_label">link to: (2nd)</label> <br>
                                                            <input type="url" class="full" name="URl" required>
                                                        </div>
                                                        <div class="col pr-0">
                                                            <label class="form_label">link to: (3rd)</label> <br>
                                                            <input type="url" class="full" name="URl" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col pl-0">
                                                            <label class="form_label">sub categories: (4th)</label>
                                                            <input type="text" class="full">
                                                        </div>
                                                        <div class="col pl-0">
                                                            <label class="form_label">sub categories: (5th)</label>
                                                            <input type="text" class="full">
                                                        </div>
                                                        <div class="col px-0">
                                                            <label class="form_label">sub categories: (6th)</label>
                                                            <input type="text" class="full">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col pl-0">
                                                            <label class="form_label">link to: (4th)</label> <br>
                                                            <input type="url" class="full" name="URl" required>
                                                        </div>
                                                        <div class="col px-0">
                                                            <label class="form_label">link to: (5th)</label> <br>
                                                            <input type="url" class="full" name="URl" required>
                                                        </div>
                                                        <div class="col pr-0">
                                                            <label class="form_label">link to: (6th)</label> <br>
                                                            <input type="url" class="full" name="URl" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="col px-0">
                                                    <label class="form_label">description: (optional)</label> <br>
                                                    <textarea name="summary" class="full_sum" required></textarea>
                                                </div>
                                                <div class="col pr-0">
                                                    <label class="form_label">date:</label> <br>
                                                    <input type="date" class="full" required>
                                                </div>
                                            </div>
                                            <button type="reset" class="post_reset_btn mr-3">reset category</button>
                                            <button type="submit" class="post_sub_btn">create category</button>
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
                                        <th class="tbl_header"></th>
                                        <th class="tbl_header">ID</th>
                                        <th class="tbl_header">category name</th>
                                        <th class="tbl_header">link to</th>
                                        <th class="tbl_header">Description</th>
                                        <th class="tbl_header">sub category</th>
                                        <th class="tbl_header">manage</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="tbl_data"> <input type="checkbox" class="tbl_check align-self-center"> </td>
                                        <th class="tbl_head">1</th>
                                        <td class="tbl_title">about us</td>
                                        <td class="tbl_data">http://localhost:63342/Tanatech%20Labs%20CMS/categories.html</td>
                                        <td class="tbl_data">click for all you need to know about us</td>
                                        <td class="tbl_data">1st, 2nd, 3rd, 4th</td>
                                        <td class="tbl_data d-flex border-0">
                                            <a href="#" class="text-decoration-none"> <i class="fa fa-edit"></i></a>
                                            <a href="#" class="text-decoration-none mx-2"> <i class="fa fa-eye"></i></a>
                                            <a href="#" class="text-decoration-none"> <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tbl_data"> <input type="checkbox" class="tbl_check align-self-center"> </td>
                                        <th class="tbl_head">2</th>
                                        <td class="tbl_title">about us</td>
                                        <td class="tbl_data">http://localhost:63342/Tanatech%20Labs%20CMS/categories.html</td>
                                        <td class="tbl_data">click for all you need to know about us</td>
                                        <td class="tbl_data">1st, 2nd, 3rd, 4th</td>
                                        <td class="tbl_data d-flex border-0">
                                            <a href="#" class="text-decoration-none"> <i class="fa fa-edit"></i></a>
                                            <a href="#" class="text-decoration-none mx-2"> <i class="fa fa-eye"></i></a>
                                            <a href="#" class="text-decoration-none"> <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tbl_data"> <input type="checkbox" class="tbl_check align-self-center"> </td>
                                        <th class="tbl_head">3</th>
                                        <td class="tbl_title">about us</td>
                                        <td class="tbl_data">http://localhost:63342/Tanatech%20Labs%20CMS/categories.html</td>
                                        <td class="tbl_data">click for all you need to know about us</td>
                                        <td class="tbl_data">1st, 2nd, 3rd, 4th</td>
                                        <td class="tbl_data d-flex border-0">
                                            <a href="#" class="text-decoration-none"> <i class="fa fa-edit"></i></a>
                                            <a href="#" class="text-decoration-none mx-2"> <i class="fa fa-eye"></i></a>
                                            <a href="#" class="text-decoration-none"> <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tbl_data"> <input type="checkbox" class="tbl_check align-self-center"> </td>
                                        <th class="tbl_head">4</th>
                                        <td class="tbl_title">about us</td>
                                        <td class="tbl_data">http://localhost:63342/Tanatech%20Labs%20CMS/categories.html</td>
                                        <td class="tbl_data">click for all you need to know about us</td>
                                        <td class="tbl_data">1st, 2nd, 3rd, 4th</td>
                                        <td class="tbl_data d-flex border-0">
                                            <a href="#" class="text-decoration-none"> <i class="fa fa-edit"></i></a>
                                            <a href="#" class="text-decoration-none mx-2"> <i class="fa fa-eye"></i></a>
                                            <a href="#" class="text-decoration-none"> <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tbl_data"> <input type="checkbox" class="tbl_check align-self-center"> </td>
                                        <th class="tbl_head">5</th>
                                        <td class="tbl_title">about us</td>
                                        <td class="tbl_data">http://localhost:63342/Tanatech%20Labs%20CMS/categories.html</td>
                                        <td class="tbl_data">click for all you need to know about us</td>
                                        <td class="tbl_data">1st, 2nd, 3rd, 4th</td>
                                        <td class="tbl_data d-flex border-0">
                                            <a href="#" class="text-decoration-none"> <i class="fa fa-edit"></i></a>
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