<?php
session_start();
include "../connect_db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="author">
    <meta content="atlas is Bootstrap 4 based admin panel.It comes with 100's widgets,charts and icons" name="description">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="atlas is Bootstrap 4 based admin panel.It comes with 100's widgets,charts and icons">
    <meta property="og:description" content="atlas is Bootstrap 4 based admin panel.It comes with 100's widgets,charts and icons">
    <meta property="og:image" content="https://cdn.dribbble.com/users/180706/screenshots/5424805/the_sceens_-_mobile_perspective_mockup_3_-_by_tranmautritam.jpg">
    <meta property="og:site_name" content="atlas ">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="https://d33wubrfki0l68.cloudfront.net/css/478ccdc1892151837f9e7163badb055b8a1833a5/light/assets/vendor/pace/pace.css">
    <script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script>
    <script src="https://d33wubrfki0l68.cloudfront.net/js/3d1965f9e8e63c62b671967aafcad6603deec90c/light/assets/vendor/pace/pace.min.js"></script>
    <!--vendors-->
    <link rel="stylesheet" type="text/css" href="https://d33wubrfki0l68.cloudfront.net/bundles/291bbeead57f19651f311362abe809b67adc3fb5.css">

    <link rel="stylesheet" href="https://d33wubrfki0l68.cloudfront.net/bundles/fc681442cee6ccf717f33ccc57ebf17a4e0792e1.css">


    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,600" rel="stylesheet">
    <!--Material Icons-->
    <link rel="stylesheet" type="text/css" href="https://d33wubrfki0l68.cloudfront.net/css/548117a22d5d22545a0ab2dddf8940a2e32c04ed/default/assets/fonts/materialdesignicons/materialdesignicons.min.css">
    <!--Material Icons-->
    <link rel="stylesheet" type="text/css" href="https://d33wubrfki0l68.cloudfront.net/css/0940f25997c8e50e65e95510b30245d116f639f0/light/assets/fonts/feather/feather-icons.css">
    <!--Bootstrap + atmos Admin CSS-->
    <link rel="stylesheet" type="text/css" href="https://d33wubrfki0l68.cloudfront.net/css/16e33a95bb46f814f87079394f72ef62972bd197/light/assets/css/atmos.min.css">
    <!-- Additional library for page -->
    <link src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</head>

<body class="jumbo-page">

    <main class="admin-main  ">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-lg-4  bg-white">
                    <div class="row align-items-center m-h-100">
                        <div class="mx-auto col-md-8">
                            <div class="p-b-20 text-center">
                                <h3 class="admin-brand-content">
                                    LOGIN FOR ADMIN
                                </h3>
                            </div>
                            <form name="forml" class="form-vertical" action="" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputUsername">Username</label>
                                        <input type="text" id="inputUsername" required class="form-control" placeholder="Enter username" name="username">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Password</label>
                                        <input type="password" required class="form-control " placeholder="Enter password" name="password">
                                    </div>
                                </div>
                                <button type="submit" name="login" class="btn btn-primary btn-block btn-lg">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 d-none d-md-block bg-cover" style="background-image: url('https://image.freepik.com/free-vector/colorful-minimalist-background_23-2148909133.jpg');">

                </div>
            </div>
        </div>
    </main>
    <?php
    if (isset($_POST["login"])) {
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        $count = 0;
        $res = mysqli_query($conn, "select * from admin where username='$username' && password='$password'");
        $count = mysqli_num_rows($res);
        if ($count == 0) {
    ?>
            <script type="text/javascript">
                document.getElementById("failure").style.display = "block";
            </script>
        <?php
        } else {
            $user = mysqli_fetch_assoc($res);
            $currentUser = $_SESSION["current_user"] =  $user;

        ?>
            <script type="text/javascript">
                window.location = "./manage_users.php";
            </script>
    <?php
        }
    }
    ?>

    </div>
</body>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>