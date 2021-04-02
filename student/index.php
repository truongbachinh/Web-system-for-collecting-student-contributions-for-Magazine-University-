<?php
include "../config.php";

// path to content file
$mainContent = "";
$pageTitle = "CMS";


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

        <!-- PLACE CODE INSIDE THIS AREA -->
        <section class="admin-content">
            <div class="container m-t-30">
                <div class="row">
                    <div class="col-md-12 p-15">
                        <div class="card m-b-30">
                            <img class="card-img-top" src="https://www.balmerlawrie.com/img/main_images/inside_banner/travel-banner1.jpg" alt="Card image cap">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 p-15">
                        <div class="col-md-12 col-log-8 p-15">
                            <div class="col-12 m-b-30">
                                <h3><i class="icon-placeholder fe fe-folder "></i>
                                    <span>Faculty</span>
                                </h3>
                            </div>
                        </div>
                        <!-- Name of submission -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card m-b-30">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-12 m-b-10 m-t-10">
                                                <h4 class="text-dark">7 Skills of Highly Effective Programmers</h4>
                                            </div>
                                        </div>
                                        <div class="progress" style="height: 5px">
                                            <div class="progress-bar" role="progressbar" style="width: 37%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="row m-t-10">
                                            <div class="col-md-7">
                                                <p class="text-muted">
                                                    PUBLISHED
                                                </p>
                                            </div>
                                            <div class="col-md-5 text-right">
                                                <p class="text-primary">3 days ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->

                            <div class="col-md-6">
                                <div class="card m-b-30">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-12 m-b-10 m-t-10">
                                                <h4 class="text-dark">7 Skills of Highly Effective Programmers</h4>
                                            </div>
                                        </div>
                                        <div class="progress" style="height: 5px">
                                            <div class="progress-bar" role="progressbar" style="width: 37%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="row m-t-10">
                                            <div class="col-md-7">
                                                <p class="text-muted">
                                                    PUBLISHED
                                                </p>
                                            </div>
                                            <div class="col-md-5 text-right">
                                                <p class="text-primary">3 days ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card m-b-30">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-12 m-b-10 m-t-10">
                                                <h4 class="text-dark">7 Skills of Highly Effective Programmers</h4>
                                            </div>
                                        </div>
                                        <div class="progress" style="height: 5px">
                                            <div class="progress-bar" role="progressbar" style="width: 37%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="row m-t-10">
                                            <div class="col-md-7">
                                                <p class="text-muted">
                                                    PUBLISHED
                                                </p>
                                            </div>
                                            <div class="col-md-5 text-right">
                                                <p class="text-primary">3 days ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->

                            <div class="col-md-6">
                                <div class="card m-b-30">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-md-12 m-b-10 m-t-10">
                                                <h4 class="text-dark">7 Skills of Highly Effective Programmers</h4>
                                            </div>
                                        </div>
                                        <div class="progress" style="height: 5px">
                                            <div class="progress-bar" role="progressbar" style="width: 37%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="row m-t-10">
                                            <div class="col-md-7">
                                                <p class="text-muted">
                                                    PUBLISHED
                                                </p>
                                            </div>
                                            <div class="col-md-5 text-right">
                                                <p class="text-primary">3 days ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-15">
                        <div class="col-md-12 col-log-8 p-15">
                            <div class="col-12 m-b-30">
                                <h3><i class="icon-placeholder fe fe-calendar "></i>
                                    <span>Calender</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

</body>

</html>