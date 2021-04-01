<?php
include "../../config.php";
//include "../../connect_db.php";
require "../../Chart/src/AntoineAugusti/EasyPHPCharts/Chart.php";
use Antoineaugusti\EasyPHPCharts\Chart;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../Chart/examples/chart.css">
    <style>
        *{margin: 0; padding: 0;}
        @import url(http://fonts.googleapis.com/css?family=Roboto);
        body{background: #FFF; font-family: 'Roboto', sans-serif;font-weight: 400}
        #content{background: #FFF; width: 1000px; padding: 20px; margin: 0 auto}
        h2{color: #4081BD; margin-bottom: 20px; font-weight: 400}
        .clearBoth:after{width: 300px; border: 1px solid #EEE; margin: 50px 0; display: block;}
        .containerChartLegend{width: 480px;padding-left: 20px}
    </style>
    <script src="../../Chart/examples/ChartJS.min.js"></script>
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
                                <p class="text-muted text-overline m-0">Amount of User</p>
                                <h3 class="fw-400">400 Users</h3>
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
                                <p class="text-muted text-overline m-0">Amount of contribution</p>
                                <h3 class="fw-400">40 Contributions</h3>
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
                                <p class="text-muted text-overline m-0">Amount of article</p>
                                <h3 class="fw-400">80 Articles</h3>
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
                                <p class="text-muted text-overline m-0">Amount of Approved Article</p>
                                <h3 class="fw-400">30 Articles</h3>
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
                            <h3>Chart 1</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            /** @var TYPE_NAME $conn */
                            $chartTopicbyYear = $conn->query("select faculty.f_id, faculty.f_name, year(topic.topic_deadline) as year, count(*) as contributions from faculty join topic on faculty.f_id = topic.faculty_id group by year(topic.topic_deadline), faculty.f_id");

//                            var_dump($chartTopicbyYear);
                            $yearTopicbyYear = array();
                            $keyTopicbyYear = array();

                            while ($rowSt = mysqli_fetch_array($chartTopicbyYear)) {
                                $yearTopicbyYear[$rowSt["year"]][] = $rowSt;
                                $keyTopicbyYear[$rowSt["f_id"]] = $rowSt["f_name"];
                            }

                            $dataTopicbyYear = array();
                            foreach ($keyTopicbyYear as $f_id => $row) {
                                $falcutyData = array();
                                foreach ($yearTopicbyYear as $yearData) {
                                    $hasData = false;
                                    foreach ($yearData as $facultyInYearData) {
                                        if ($facultyInYearData["f_id"] == $f_id) {
                                            $falcutyData[] = $facultyInYearData["contributions"];
                                            $hasData = true;
                                            break;
                                        }
                                    }
                                    if (!$hasData) {
                                        $falcutyData[] = "0";
                                    }
                                }
                                $dataTopicbyYear[] = $falcutyData;
                            }

                            $barChart = new Chart('bar', 'examplebar');

                            $barChart->set('data', $dataTopicbyYear);
                            $barChart->set('legend', array_keys($yearTopicbyYear));
                            // We don't to use the x-axis for the legend so we specify the name of each dataset
                            $barChart->set('legendData', $keyTopicbyYear);
                            $barChart->set('displayLegend', true);
                            echo $barChart->returnFullHTML();
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">

                    <div class="card m-b-30">
                        <div class="card-header">
                            <h3>Chart 2</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            $pieChart = new Chart('pie', 'examplePie');
                            $pieChart->set('data', array_values($dataTopicbyYear)[0]);
                            $pieChart->set('legend', array_values($keyTopicbyYear));
                            $pieChart->set('displayLegend', true);
                            echo $pieChart->returnFullHTML();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h3>Chart 3</h3>
                        </div>
                        <div class="card-body">
<!--                            Code in here-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</body>