<?php
include "../../config.php";
$userId = $_SESSION["current_user"]["u_id"];

$result = mysqli_query($conn, "SELECT user.*, topic.*,faculty.* FROM topic INNER JOIN user ON faculty.f_id = user.faculty_id WHERE user.u_id = '$userId' AND user.role = 'student'");
$faculty = $conn->query("SELECT user.*, faculty.* FROM user INNER JOIN faculty ON faculty.f_id = user.faculty_id WHERE user.u_id = '$userId' AND user.role = 'student'");
$studentFacultyInfor = mysqli_fetch_assoc($faculty);


// $topicInfor = $conn->query("SELECT file_submit_to_topic.*, topic.* FROM file_submit_to_topic RIGHT JOIN topic ON topic.id = file_submit_to_topic.file_topic_uploaded RIGHT JOIN user ON user.u_id = user.u_id WHERE user.u_id = '$userId' AND user.role = 'student' ");
// $topicStudentInfor = array();
// while ($tInfor = mysqli_fetch_array($topicInfor)) {
//     $topicStudentInfor[] = $tInfor;
// }

//$topicSubmit = $conn->query("SELECT topic.*, file_submit_to_topic.*,user.* from file_submit_to_topic INNER JOIN topic ON topic.id = file_submit_to_topic.file_topic_uploaded INNER JOIN user ON usser.u_id = file_submit_to_topic.file_userId_uploaded");
//$topicSubmit = $conn->query("SELECT * from file_submit_to_topic where ");
// $topicSubmit = $conn->query("SELECT * from file_submit_to_topic where file_userId_uploaded = '$userId'");
// $topicSubmitInfor = array();
// while ($tpInfor = mysqli_fetch_array($topicSubmit)) {
//     $topicSubmitInfor[] = $tpInfor;
// }


// var_dump($topicSubmitInfor);
// exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/html_header.php"; ?>
</head>

<body class="sidebar-pinned ">
    <?php include '../partials/aside.php' ?>
    <main class="admin-main">
        <!-- Header -->
        <?php include '../partials/header.php' ?>
        <!-- Session -->

        <section class="admin-content">
            <div class="container m-t-30">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4>LIST TOPIC</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group has-search">
                                            <span class="fa fa-search form-control-feedback"></span>
                                            <input type="text" class="form-control" placeholder="Search">
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive p-t-10">
                                    <table id="example" class="table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>

                                                <th>Topic name</th>
                                                <th>Topic description</th>
                                                <th>Topic Start deadline</th>
                                                <th>Topic End deadline</th>
                                                <th>Select Topic To submit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            // $topicInfor = $conn->query("SELECT faculty.*,user.*, topic.* FROM (( faculty INNER JOIN topic ON faculty.f_id = topic.faculty_id) INNER JOIN user ON faculty.f_id = user.faculty_id) WHERE user.u_id = '$userId' AND user.role = 'student'");
                                            // foreach ($topicStudentInfor as $row) {
                                            $topicInfor = $conn->query("SELECT topic.* FROM topic");
                                            while ($row = mysqli_fetch_array($topicInfor)) {
                                                $selected_date = ($row["topic_deadline"]);
                                                // echo $selected_date, "a ";
                                                $duration = 14;
                                                $duration_type = 'day';
                                                $deadline = date('Y/m/d H:i:s', strtotime($selected_date . ' +' . $duration . ' ' . $duration_type));
                                            ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>

                                                    <td><?php echo $row["topic_name"]; ?></td>
                                                    <td><?php echo $row["topic_description"]; ?></td>
                                                    <td><?php echo $row["topic_deadline"] ?></td>
                                                    <td><?= $deadline ?></td>
                                                    <!-- <td><?php
                                                                if (($row["file_status"]) == "1") {
                                                                ?>
                                        <span style="color:green; font-size:16px;font-weight:bold;">Submited</span>
                                    <?php
                                                                } else if (($row["file_status"]) == "2") {
                                    ?>
                                        <span style="color:blue; font-size:16px;font-weight:bold;">Approved</span>
                                    <?php
                                                                } else if (($row["file_status"]) == "3") {
                                    ?>
                                        <span style="color:red; font-size:16px;font-weight:bold;">Rejected</span>
                                    <?php
                                                                } else {
                                    ?>
                                        <span style="color:black; font-size:16px;font-weight:bold;">Not Graded</span>
                                    <?php
                                                                }
                                    ?>
                                </td> -->
                                                    <!-- <td><a href="submit.php?idf=<?= $row["faculty_id"] ?>&idt=<?= $row['id'] ?>">Select</a></td> -->
                                                    <td><a class="btn btn-primary" role="button" href="submit.php?idt=<?= $row['id'] ?>">Select</a></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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

</body>

</html>