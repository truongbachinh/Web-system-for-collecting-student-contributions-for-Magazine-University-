<?php
include "../config.php";
$userId = $_SESSION["current_user"]["u_id"];

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php include "./partials/html_header.php"; ?>
        <style>
            label.error {
                margin-top: 10px;
                color: red;
            }
        </style>
    </head>

    <body class="sidebar-pinned ">
    <?php include './partials/aside.php' ?>
    <main class="admin-main">
        <!-- Header -->
        <?php include './partials/header.php' ?>
        <!-- Session -->

        <section class="admin-content">
            <div class="container m-t-30">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">
                            Change Password
                        </h5>
                        <p class="m-b-0 text-muted">
                            Please input fullfill box to change your password.
                        </p>
                    </div>
                    <div class="card-body ">
                        <form action="" id="changePass" name="formPassword" method="post" class="form-horizontal"
                              enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="inputOldPass1">Old Password</label>
                                <input type="text" class="form-control" id="inputOldPass1" name="oldPassword"
                                       placeholder="Enter old password." required>
                            </div>
                            <div class="form-group">
                                <label for="inputNewPass1">New Password</label>
                                <input type="text" class="form-control" id="inputNewPass1" name="newPassword"
                                       placeholder="Enter new password." required>
                            </div>
                            <div class="form-group">
                                <label for="inputNewPass2">Confirm New Password</label>
                                <input type="text" class="form-control" id="inputNewPass2" name="confirmPassword"
                                       placeholder="Comfirm new password." required>
                            </div>
                            <div class="alert alert-success" id="success" style="margin-top: 10px; display: none">
                                <strong>Success!</strong> Change password success!
                            </div>
                            <div class="alert alert-danger" id="failure" style="margin-top: 10px; display: none">
                                <strong>Error!</strong> The Old password wrong!
                            </div>
                            <div class="alert alert-danger" id="checkpass" style="margin-top: 10px; display: none">
                                <strong>Error!</strong> The password and confirm password wrong!
                            </div>

                            <div class="text-center">
                                <button type="submit" name="changePassword" class="btn btn-primary float-right">Change
                                    password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
    <script src="../assets/vendor/jquery.validate/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#changePass").validate({
                rules: {
                    oldPassword: {
                        required: true,
                    },
                    newPassword: {
                        required: true,
                        minlength: 6
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: "#newPassword",
                    }

                },
                messages: {
                    oldPassword: {
                        minLength: "Password consists of at least 6 characters"
                    },
                    newPassword: {
                        required: "Information required! Please enter full information..",
                        minLength: "Password consists of at least 6 characters!",
                    },
                    confirmPassword: {
                        required: "Information required! Please enter full information..",
                        equalTo: "Wrong confirm password!",
                    }
                },
            })
        })

    </script>
    </body>

    </html>


<?php
if (isset($_POST["changePassword"])) {
    $pOldPassword = $_POST['oldPassword'];
    $pNewPassword = $_POST['newPassword'];
    $pConfirmPassword = $_POST['confirmPassword'];
    $oldPassword = ($_SESSION["current_user"]['password']);


    if ($pOldPassword != $oldPassword) {

        ?>
        <script type="text/javascript">
            document.getElementById("checkpass").style.display = "none";
            document.getElementById("success").style.display = "none";
            document.getElementById("failure").style.display = "block"
        </script>
        <?php
    } elseif ($pNewPassword != $pConfirmPassword) {

        ?>
        <script type="text/javascript">
            document.getElementById("checkpass").style.display = "block";
            document.getElementById("success").style.display = "none";
            document.getElementById("failure").style.display = "none"
        </script>
        <?php
    } elseif (($pOldPassword == $oldPassword) && ($pNewPassword != $oldPassword)) {
        mysqli_query($conn, "update user set `password` = '$pNewPassword' where u_id =  '$userId'");
        unset($_SESSION['current_user']);
        ?>
        <script type="text/javascript">
            document.getElementById("success").style.display = "block";
            document.getElementById("failure").style.display = "none";
            document.getElementById("checkpass").style.display = "none";
            window.location = "https://ciliweb.vn/a/contribution_application/account/login.php";
        </script>
        <?php
    }
}
?>