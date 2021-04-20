<?php
include "../config.php";
if (!empty($_SESSION)) {
    $userId = $_SESSION["current_user"]["u_id"];
    $resultInfor = mysqli_query($conn, "SELECT user.*, user_infor.*, faculty.f_name from user LEFT JOIN user_infor ON user_infor.user_id = user.u_id LEFT JOIN faculty ON faculty.f_id = user.faculty_id WHERE user.u_id = '$userId'");
    $rowUserInfor = mysqli_fetch_array($resultInfor, MYSQLI_ASSOC);
    $result = mysqli_query($conn, "select * from user_infor where user_id = '$userId'");

    if (isset($result)) {
        $rowInfor = mysqli_fetch_array($result, MYSQLI_ASSOC);
    };


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include "../partials/html_header.php" ?>
    </head>

    <body class="sidebar-pinned ">
        <?php include "../partials/aside.php" ?>
        <main class="admin-main">
            <!-- Header -->
            <?php include "../partials/header.php" ?>
            <!-- Session -->

            <section class="admin-content">
                <div class="container m-t-30">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-8">
                            <div class="card m-b-30">
                                <div class="card-media">
                                    <img class="card-img-top" src="../user/av/userbackgroup.jpg" height="250px" alt="banner">
                                </div>
                                <div class="card-body">
                                    <div class="text-center pull-up-sm">
                                        <div class="avatar avatar-xxl">

                                            <img class="avatar-img rounded-circle" src="../user/av/201818.png" alt="avatar">

                                        </div>
                                        <h4 class="text-center m-t-20">
                                            <div class="text text-center m-b-5"><?= $rowUserInfor["fullname"] ?></div>
                                        </h4>
                                    </div>
                                    <!-- Modal edit profile -->
                                    <div class="row justify-content-end p-r-40">
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                            Edit profile
                                        </button>


                                        <!-- Model edit -->
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit profile
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" name="forml" method="post" class="form-horizontal" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <label for="idCard">Card ID</label>
                                                                <input type="text" class="form-control" id="inputStudentId" name="idCard">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputAddress">Address</label>
                                                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputPhone">Phone</label>
                                                                <input type="text" class="form-control" id="inputPhone" name="phone">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputPhone">DOB</label>
                                                                <input type="date" class="form-control" id="inputDoB" name="DoB">
                                                            </div>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <input type="submit" class="btn btn-primary" name="updateProfile" value="Save changes">
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-9">
                                            <div class="tab-infor m-b-15">
                                                <ul class="nav nav-tabs" id="myTabInforStudent" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#inforStudent" role="tab" aria-controls="home" aria-selected="true">About</a>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="about-student">
                                                <div class="tab-content profile-tab" id="myTabContent">
                                                    <div class="tab-pane fade active show" id="inforStudent" role="tabpanel" aria-labelledby="home-tab">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Card ID</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                if (!empty($rowUserInfor["id_card"])) {
                                                                ?>
                                                                    <p><?= $rowUserInfor["id_card"] ?></p>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <p>Null</p>
                                                                <?php
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Full Name</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                if (!empty($rowUserInfor["fullname"])) {
                                                                ?>
                                                                    <p><?= $rowUserInfor["fullname"] ?></p>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <p>Null</p>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>D0B</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                if (!empty($rowUserInfor["DOB"])) {
                                                                ?>
                                                                    <p><?= $rowUserInfor["DOB"] ?></p>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <p>Null</p>
                                                                <?php
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Phone</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                if (!empty($rowUserInfor["phone"])) {
                                                                ?>
                                                                    <p><?= $rowUserInfor["phone"] ?></p>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <p>Null</p>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Email</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                if (!empty($rowUserInfor["email"])) {
                                                                ?>
                                                                    <p><?= $rowUserInfor["email"] ?></p>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <p>Null</p>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Role</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                if (!empty($rowUserInfor["role"])) {
                                                                ?>
                                                                    <p><?= $rowUserInfor["role"] ?></p>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <p>Null</p>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Faculty</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                if (!empty($rowUserInfor["f_name"])) {
                                                                ?>
                                                                    <p><?= $rowUserInfor["f_name"] ?></p>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <p>Null</p>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="myFaculty" role="tabpanel" aria-labelledby="profile-tab">
                                                        <ul class="list-group- list-group-flush p-0">
                                                            <li class="list-group-item list-group-item-action list-group-item-secondary">
                                                                <span>List of my faculty</span>
                                                            </li>
                                                            <a class="list-group-item list-group-item-action">Dapibus ac
                                                                facilisis in</a>
                                                            <a class="list-group-item list-group-item-action">Morbi leo
                                                                risus</a>
                                                            <a class="list-group-item list-group-item-action">Porta ac
                                                                consectetur ac</a>
                                                            <a class="list-group-item list-group-item-action">Vestibulum
                                                                at eros</a>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
    <script src="../partials/js_libs.php"></script>
    <script src='https://d33wubrfki0l68.cloudfront.net/bundles/85bd871e04eb889b6141c1aba0fedfa1a2215991.js'></script>
    <!--page specific scripts for demo-->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-66116118-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-66116118-3');
    </script>

    <!--Additional Page includes-->
    <script src='https://d33wubrfki0l68.cloudfront.net/js/c36248babf70a3c7ad1dcd98d4250fa60842eea9/light/assets/vendor/apexchart/apexcharts.min.js'></script>
    <!--chart data for current dashboard-->
    <script src='https://d33wubrfki0l68.cloudfront.net/js/d678dabfdc5c3131d492af7ef517fbe46fbbd8e4/light/assets/js/dashboard-01.js'></script>

    </body>

    </html>

<?php

} else {
    header('location: ../account/login.php');
}
?>

<?php
if (isset($_POST["updateProfile"])) {

    if ($result->num_rows == 0) {
        $addInfor = mysqli_query($conn, "INSERT INTO `user_infor` (`id`, `user_id`, `id_card`, `address`, `phone`, `DOB`) VALUES (NULL, '$userId', '$_POST[idCard]',  '$_POST[address]', '$_POST[phone]','$_POST[DoB]');");
    } elseif ($result->num_rows > 0) {
        $updateInfor = mysqli_query($conn, "UPDATE `user_infor` set  `id_card`  = '$_POST[idCard]', `address`  = '$_POST[address]', `phone`  = '$_POST[phone]', `DOB`  = '$_POST[DoB]' where `user_id` = '$userId'  ;");
    }



    if ($updateInfor == true) {
?>
        <script type="text/javascript">
            alert("update Infor successful");
            window.location.replace("./profile.php");
        </script>
    <?php
    } elseif ($addInfor == true) {
    ?>
        <script type="text/javascript">
            alert("add Infor successful");
            window.location.replace("./profile.php");
        </script>
    <?php
    } else {

    ?>

        <script type="text/javascript">
            alert("add Infor error");
            window.location = "./profile.php"
        </script>
<?php
    }
}
?>