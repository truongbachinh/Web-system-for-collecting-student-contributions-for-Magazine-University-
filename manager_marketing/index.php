<?php
include "../config.php";

// path to content file
$mainContent = "";
$pageTitle = "Home Page";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/html_header.php"; ?>
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.png" />
    <link rel="icon" href="../assets/img/logo.png" type="image/png" sizes="16x16">


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--    <link href="/assets/landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="../assets/landing/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="../assets/landing/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/homepage.css">

</head>

<body class="sidebar-pinned ">
    <?php include "../partials/aside.php"; ?>
    <main class="admin-main">
        <?php include "../partials/header.php"; ?>

        <!-- PLACE CODE INSIDE THIS AREA -->
        <section class="admin-content">
            <div class="container m-t-20">
                <div class="row">
                    <div class="col-md-12 p-15">
                        <div class="card m-b-30" style="  width: 100%; overflow: hidden;">
                            <img class="card-img-top" src="../user/av/backgroud.PNG" height="300px" alt="Card image cap">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="features-introduce">
                        <h4 class="p-15">Features introduce</h4>
                        <section id="contribution" class="why-us">
                            <div class="container" data-aos="fade-up">
                                <div class="row">
                                    <div class="col-lg-4 d-flex align-items-stretch card-introduce">
                                        <div class="content">
                                            <h5>Faculty management</h5>
                                            <p>
                                                The Faculty Manager can view all the articles that students have submitted for each submission.
                                                <br />
                                                <br />
                                                The system allows the user to act as a department manager, to view all of the system's posts according to each submission. In addition, students can filter articles by post status such as: passed, failed, not marked, not feedbac.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-flex align-items-stretch">
                                        <div class="content">
                                            <h5>Statistics data</h5>
                                            <p>
                                                The system allows managing all faculties to track statistics of the system's articles and human resources.
                                                <br>
                                                <br>
                                                <br>
                                                A special function of the administration of all faculties is that they can view statistical data such as the total number of articles annually, the rate of articles accepted, the rate of the paper failed, etc. This makes it easier for them to comment on the students of the school.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-flex align-items-stretch">
                                        <div class="content">
                                            <h5>Download article</h5>
                                            <p>
                                                The system allows to manage all faculties that download student papers.
                                                <br>
                                                <br>
                                                <br>
                                                Besides the function of viewing articles, all faculties can directly download that article. This helps to manage all faculties that have their featured student papers as material for other students.
                                        </div>
                                    </div>
                                </div>
                        </section><!-- End Section -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 p-15">
                        <h4 class="m-b-30 m-t-30">Contribution</h4>

                        <!-- Name of topic -->
                        <div class="row">
                            <div class="col-md-4">
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
                                                    DEADLINE
                                                </p>
                                            </div>
                                            <div class="col-md-5 text-right">
                                                <p class="text-primary">20/12/2020</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->

                            <div class="col-md-4">
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
                                                    DEADLINE
                                                </p>
                                            </div>
                                            <div class="col-md-5 text-right">
                                                <p class="text-primary">20/12/2020</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->

                            <div class="col-md-4">
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
                                                    DEADLINE
                                                </p>
                                            </div>
                                            <div class="col-md-5 text-right">
                                                <p class="text-primary">20/12/2020</p>
                                            </div>
                                        </div>
                                    </div>
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