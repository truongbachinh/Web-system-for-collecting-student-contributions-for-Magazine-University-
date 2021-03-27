<?php
include "../../config.php";

$date2 = strtotime("2018-09-21 10:44:01");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../partials/html_header.php"; ?>
</head>
<body class="sidebar-pinned ">
<?php include "../partials/aside.php"; ?>
<main class="admin-main">
    <?php include "../partials/header.php"; ?>

    <section class="admin-content">
        <div class="container m-t-30">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="m-b-0">
                        Create New Account
                    </h5>
                    <p class="m-b-0 text-muted">
                        Please input fullfill information.
                    </p>
                </div>
                <div class="card-body ">
                    <form action="">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputName1">First Name</label>
                                <input type="text" class="form-control" id="inputName1" name="firstName"
                                       placeholder="Thu Thuy" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputName2">Last Name</label>
                                <input type="text" class="form-control" id="inputName2" name="lastName"
                                       placeholder="Nguyen" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1">Email</label>
                            <input type="email" class="form-control" id="inputEmail1"
                                   placeholder="thuthuynguyen@gmail.com" name="inputEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="inputPass1">Password</label>
                            <input type="text" class="form-control" id="inputPass1" name="inputPass" required>
                        </div>
                        <div class="form-group">
                            <label for="inputPass2">Confirm Passs</label>
                            <input type="text" class="form-control" id="inputPass2" name="inputConfirmPass" required>
                        </div>
                        <div class="form-group">
                            <label for="inputRole1">Roles</label>
                            <select class="form-control" name="role">
                                <option selected value="student">Student</option>
                                <option value="manager-coordinator">Manager Coordinator</option>
                                <option value="manager-marketing">Manager Marketing</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress1">Address</label>
                            <input type="text" class="form-control" id="inputAddress1" name="inputAddress" required>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary float-right" value="Create Account"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
</body>


</body>


<script src='https://d33wubrfki0l68.cloudfront.net/bundles/85bd871e04eb889b6141c1aba0fedfa1a2215991.js'></script>
<!--page specific scripts for demo-->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-66116118-3"></script>
<script> window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'UA-66116118-3');</script>

<!--Additional Page includes-->
<script
        src='https://d33wubrfki0l68.cloudfront.net/js/c36248babf70a3c7ad1dcd98d4250fa60842eea9/light/assets/vendor/apexchart/apexcharts.min.js'></script>
<!--chart data for current dashboard-->
<script
        src='https://d33wubrfki0l68.cloudfront.net/js/d678dabfdc5c3131d492af7ef517fbe46fbbd8e4/light/assets/js/dashboard-01.js'></script>

</body>

</html>