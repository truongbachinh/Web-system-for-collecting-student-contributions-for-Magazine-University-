<?php
include "../connect_db.php"
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Register Now</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <div class="d-lg-flex half">
        <div class="contents order-1 order-md-2">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <div class="mb-4">
                            <h3><b>Register your account</b></h3>
                        </div>
                        <form class="form-vertical" action="" method="post">
                            <h6>Username</h6>
                            <div class="form-group first" style="border: 1px solid  #868080 !important;height: 50px !important; border-radius: 8px;">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <h6>Email</h6>
                            <div class="form-group first" style="border: 1px solid  #868080 !important;height: 50px !important; border-radius: 8px;">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <h6 style="padding-top: 2% !important;">Password</h6>
                            <div class="form-group last mb-3" style="border: 1px solid  #868080 !important;height: 50px !important; border-radius: 8px;">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password">

                            </div>
                            <div class="alert alert-success" id="success" style="margin-top: 10px; display: none">
                                <strong>Success!</strong> Account Registration Successfully.
                            </div>
                            <div class="alert alert-danger" id="failure" style="margin-top: 10px; display: none">
                                <strong>Already exist!</strong> The Username Alreadly Exits!
                            </div>
                            <input type="submit" value="Register" name="register" class="btn btn-block btn-success">


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
    $button = '';
    if (isset($_POST["register"])) {
        $count = 0;
        $res = mysqli_query($conn, "select * from user where username ='$_POST[username]'") or die(mysqli_error($link));
        $count = mysqli_num_rows($res);

        if ($count > 0) {
    ?>
            <script type="text/javascript">
                document.getElementById("success").style.display = "none";
                document.getElementById("failure").style.display = "block";
            </script>
        <?php
        } else {
            mysqli_query($conn, "insert into user (username, password, email) values('$_POST[username]','$_POST[password]','$_POST[email]')");
        ?>
            <script type="text/javascript">
                const a = document.getElementById("success")
                document.getElementById("success").style.display = "block";
                document.getElementById("failure").style.display = "none";
                if (a.style.display == "block") {
                    window.location.href = "./login.php"
                }
            </script>
    <?php
        }
    }
    ?>



</body>

</html>