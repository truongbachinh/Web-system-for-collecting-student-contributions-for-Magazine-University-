<?php

include "../connect_db.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login For User</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    session_start();
    if (!empty($_SESSION['current_user_social'])) {
        $currentUser = $_SESSION['current_user_social'];

    ?>
        <script type="text/javascript">
            window.location = "../user/index.php";
        </script>
    <?php
    } else {
        include "../connect_db.php";
        include "./login_google/goole_connect.php";

    ?>
        <div class="d-lg-flex half">
            <div class="contents order-1 order-md-2">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7">
                            <div class="mb-4">
                                <h6>Welcome back!</h6>
                                <h3><b>Sign in to your account</b></h3>
                            </div>
                            <form class="form-vertical" action="" method="post">
                                <h6>Username or Email</h6>
                                <div class="form-group first" style="border: 1px solid  #868080 !important;height: 50px !important; border-radius: 8px;">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                                <h6 style="padding-top: 2% !important;">Password</h6>
                                <div class="form-group last mb-3" style="border: 1px solid  #868080 !important;height: 50px !important; border-radius: 8px;">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">

                                </div>

                                <div class="d-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                        <input type="checkbox" checked="checked" />
                                        <div class="control__indicator" style="border-radius: 11px !important;"></div>
                                    </label>
                                    <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password?</a></span>
                                </div>
                                <div class="alert alert-danger" id="failure" style="margin-top: 10px; display: none">
                                    <strong>Login false!</strong><br> The Username or passwrord error!
                                </div>
                                <input type="submit" value="Login" name="login" class="btn btn-block btn-success">
                                <?php
                                if (isset($authUrl)) {
                                ?>
                                    <div class="social-login" style="margin-top: 3%;">
                                        <a href="<?= $authUrl ?>" class="btn btn-dark d-flex justify-content-center align-items-center">
                                            Sign-in with Google <span class="icon-google ml-2"></span>
                                        </a>
                                    </div>
                                <?php
                                }

                                ?>
                                <div class="social-login" style="margin-top: 10%;">
                                    <span class="d-flex justify-content-center align-items-center">Dont have a account? <a href="register.php" class="ml-2 mt-2" style="color: #00bfff"> Sign Up</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg order-2 order-md-1" style="background-image: url('images/bg_1.jpg');"></div>
        </div>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    <?php
    }
    ?>
</body>


<?php
if (isset($_POST["login"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $count = 0;
    $res = mysqli_query($conn, "select * from user where username='$username' && password='$password'");
    $result = mysqli_query($conn, "select * from user where username='$username' && password='$password'");
    $count = mysqli_num_rows($res);
    while ($row = mysqli_fetch_array($result)) {
        $status = $row["status"];
        $role = $row["role"];
    }
    var_dump($status);
    var_dump($role);

    if ($count == 0) {
?>
        <script type="text/javascript">
            document.getElementById("failure").style.display = "block";
        </script>
    <?php


    } elseif ($status == "1" && $role == "student") {
        $user = mysqli_fetch_array($res);
        $userCurrent =  $_SESSION["current_user"] = $user;
    ?>
        <script type="text/javascript">
            window.location = "/user/index.php";
        </script>
    <?php
    } elseif ($status == "1" && $role == "manager-coordinator") {
        $user = mysqli_fetch_array($res);
        $userCurrent =  $_SESSION["current_user"] = $user;
    ?>
        <script type="text/javascript">
            window.location = "/user/index.php";
        </script>
    <?php
    } elseif ($status == "1" && $role == "admin") {
        $user = mysqli_fetch_assoc($res);
        $userCurrent =  $_SESSION["current_user"] = $user;
    ?>
        <script type="text/javascript">
            window.location = "/user/admin/";
        </script>
<?php
    }
}
?>


</div>

<script src="js/jquery.min.js"></script>
<script src="js/matrix.login.js"></script>

</body>

</html>