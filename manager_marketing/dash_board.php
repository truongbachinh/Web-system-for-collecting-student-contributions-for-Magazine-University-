<?php

include "../config.php";


if (!empty($_SESSION)) {
    //include "../../connect_db.php";

    $facultyId = ($_SESSION['current_user']["faculty_id"]);



    $_countStudent = $conn->query("SELECT COUNT( * ) AS count FROM `user` where role = 'student' and status = '1'");
    $countStudent = null;
    while ($rowSt = mysqli_fetch_array($_countStudent)) {
        $countStudent = $rowSt["count"];
        $countStudent = $rowSt;
    }

    $_countsubmission = $conn->query("SELECT COUNT( * ) AS count FROM `file_submit_to_submission`");
    $countsubmission = null;
    while ($rowSt = mysqli_fetch_array($_countsubmission)) {
        $countsubmission = $rowSt;
    }

    $_countPass = $conn->query("SELECT COUNT( * ) AS count FROM `file_submit_to_submission` where file_status = '2'");
    $countPass = null;
    while ($rowSt = mysqli_fetch_array($_countPass)) {
        $countPass = $rowSt;
    }

    $_countFail = $conn->query("SELECT COUNT( * ) AS count FROM `file_submit_to_submission` where file_status = '3'");
    $countFail = null;
    while ($rowSt = mysqli_fetch_array($_countFail)) {
        $countFail = $rowSt;
    }

    $_countProcessing = $conn->query("SELECT COUNT( * ) AS count FROM `file_submit_to_submission` where file_status = '1'");
    $countProcessing = null;
    while ($rowSt = mysqli_fetch_array($_countProcessing)) {
        $countProcessing = $rowSt;
    }



    $top3Array = array();
    $dataPoints = array();

    $queryChart = ("SELECT COUNT(file_submit_to_submission.id) as file_pass_amount, user.*, faculty.* FROM file_submit_to_submission INNER JOIN user ON user.u_id = file_submit_to_submission.file_userId_uploaded INNER JOIN faculty ON faculty.f_id = user.faculty_id WHERE file_submit_to_submission.file_status = '2' GROUP BY file_submit_to_submission.file_userId_uploaded ORDER BY COUNT(file_submit_to_submission.id) DESC LIMIT 3");
    $top3Faculty = $conn->query($queryChart);
    while ($rowTop = mysqli_fetch_array($top3Faculty)) {
        $top3Array[] =  $rowTop;
    }

    foreach ($top3Array as $value) {
        list($dataPoints[])  = array(
            array("y" =>  $value['file_pass_amount'], "label" => $value['f_name']),
        );
    }


    //  $chartsubmissionbyYear = $conn->query("SELECT faculty.f_id, faculty.f_name, year(submission.submission_deadline) as year, count(*) as contributions from faculty join submission on faculty.f_id = submission.id group by year(submission.submission_deadline), faculty.f_id");

    // $yearsubmissionbyYear = array();
    // $keysubmissionbyYear = array();

    // while ($rowSt = mysqli_fetch_array($chartsubmissionbyYear)) {
    //     $yearsubmissionbyYear[$rowSt["year"]][] = $rowSt;
    //     $keysubmissionbyYear[$rowSt["f_id"]] = $rowSt["f_name"];
    // }

    // $datasubmissionbyYear = array();
    // foreach ($keysubmissionbyYear as $f_id => $row) {
    //     $falcutyData = array();
    //     foreach ($yearsubmissionbyYear as $yearData) {
    //         $hasData = false;
    //         foreach ($yearData as $facultyInYearData) {
    //             if ($facultyInYearData["f_id"] == $f_id) {
    //                 $falcutyData[] = $facultyInYearData;
    //                 $hasData = true;
    //                 break;
    //             }
    //         }
    //         if (!$hasData) {
    //             $falcutyData[] = "0";
    //         }
    //     }
    //     $datasubmissionbyYear[] = $falcutyData;
    // }


    $chartsubmissionbyYear = $conn->query("SELECT COUNT(file_submit_to_submission.id) as file_amount,  year(submission.submission_deadline) as year, user.*, faculty.* FROM file_submit_to_submission
     INNER JOIN user ON user.u_id = file_submit_to_submission.file_userId_uploaded 
     INNER JOIN submission ON submission.id = file_submit_to_submission.file_submission_uploaded 
     INNER JOIN faculty ON faculty.f_id = user.faculty_id 
     GROUP BY faculty.f_id, year(submission.submission_deadline) 
     ORDER BY COUNT(file_submit_to_submission.id)");
    $pieDataByYear = array();
    $sum = 0;
    while ($rowPieData = mysqli_fetch_array($chartsubmissionbyYear)) {
        $pieDataByYear[] =  $rowPieData;
        $sum +=  ($rowPieData['file_amount']);
    }
    $amoutFaculty = $chartsubmissionbyYear->num_rows;

    $dataPie = array();
    foreach ($pieDataByYear as  $value) {
        list($dataPie[])  = array(
            array("label" => $value["f_name"], "y" => ($value['file_amount'] / $sum * 100)),
        );
    }


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" href="../Chart/examples/chart.css">
        <style>
            * {
                margin: 0;
                padding: 0;
            }

            @import url(http://fonts.googleapis.com/css?family=Roboto);

            body {
                background: #FFF;
                font-family: 'Roboto', sans-serif;
                font-weight: 400
            }

            #content {
                background: #FFF;
                width: 1000px;
                padding: 20px;
                margin: 0 auto
            }

            h2 {
                color: #4081BD;
                margin-bottom: 20px;
                font-weight: 400
            }

            .clearBoth:after {
                width: 300px;
                border: 1px solid #EEE;
                margin: 50px 0;
                display: block;
            }

            .containerChartLegend {
                width: 480px;
                padding-left: 20px
            }
        </style>
        <script src="../Chart/examples/ChartJS.min.js"></script>
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
                        <div class="col-12 m-b-20">
                            <h3> <i class="fe fe-zap"></i>Statistic System</h3>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="pb-2">
                                        <div class="avatar avatar-lg">
                                            <div class="avatar-title bg-soft-primary rounded-circle">
                                                <i class="fe fe-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-muted text-overline m-0">Amount of Student</p>
                                        <h3 class="fw-400"><?= $countStudent["count"] ?> Student</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="pb-2">
                                        <div class="avatar avatar-lg">
                                            <div class="avatar-title bg-soft-primary rounded-circle">
                                                <i class="icon-placeholder fe fe-folder"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-muted text-overline m-0">Amount of File Submission</p>
                                        <h3 class="fw-400"><?= $countsubmission["count"] ?> File</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="pb-2">
                                        <div class="avatar avatar-lg">
                                            <div class="avatar-title bg-soft-primary rounded-circle">
                                                <i class="fe fe-file-text"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-muted text-overline m-0">Amount of submission processing</p>
                                        <h3 class="fw-400"><?= $countProcessing["count"] ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="pb-2">
                                        <div class="avatar avatar-lg">
                                            <div class="avatar-title bg-soft-primary rounded-circle">
                                                <i class="fe fe-file-text"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-muted text-overline m-0">Amount of submission rejected</p>
                                        <h3 class="fw-400"><?= $countPass["count"] ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="pb-2">
                                        <div class="avatar avatar-lg">
                                            <div class="avatar-title bg-soft-primary rounded-circle">
                                                <i class="fe fe-file"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-muted text-overline m-0">Amount of Approved</p>
                                        <h3 class="fw-400"><?= $countFail["count"] ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 m-b-20">
                            <h3> <i class="fe fe-activity"></i> Chart</h3>
                        </div>
                        <div class="col-lg-6">

                            <div class="card m-b-30">
                                <div class="card-header">
                                    <h3>Chart top 3 faculty best</h3>
                                </div>
                                <div class="card-body">
                                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">

                            <div class="card m-b-30">
                                <div class="card-header">
                                    <h3>Chart 2</h3>
                                </div>
                                <div class="card-body">
                                    <div id="chartPieContainer" style="height: 370px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </main>
        <?php include "../partials/js_libs.php"; ?>
        <script>
            window.onload = function() {
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "light2",
                    title: {
                        text: "Contribution Application"
                    },
                    axisY: {
                        title: "Submission pass"
                    },
                    data: [{
                        type: "column",
                        yValueFormatString: "#,##0.## ",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }]

                });
                chart.render();




                var chart = new CanvasJS.Chart("chartPieContainer", {
                    animationEnabled: true,
                    title: {
                        text: "Contribution of faculty"
                    },
                    subtitles: [{
                        text: "2021"
                    }],
                    data: [{
                        type: "pie",
                        yValueFormatString: "#,##0.00\"%\"",
                        indexLabel: "{label} ({y})",
                        dataPoints: <?php echo json_encode($dataPie, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart.render();

            }
        </script>
    </body>
<?php
} else {
    header('location: ../account/login.php');
}

?>