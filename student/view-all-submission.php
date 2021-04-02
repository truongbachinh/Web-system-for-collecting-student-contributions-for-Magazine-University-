<?php
include "../config.php";
$userId = $_SESSION["current_user"]["u_id"];

$result = mysqli_query($conn, "SELECT user.*, submission.*,faculty.* FROM submission INNER JOIN user ON faculty.f_id = user.faculty_id WHERE user.u_id = '$userId' AND user.role = 'student'");
$faculty = $conn->query("SELECT user.*, faculty.* FROM user INNER JOIN faculty ON faculty.f_id = user.faculty_id WHERE user.u_id = '$userId' AND user.role = 'student'");
$studentFacultyInfor = mysqli_fetch_assoc($faculty);


// $submissionInfor = $conn->query("SELECT file_submit_to_submission.*, submission.* FROM file_submit_to_submission RIGHT JOIN submission ON submission.id = file_submit_to_submission.file_submission_uploaded RIGHT JOIN user ON user.u_id = user.u_id WHERE user.u_id = '$userId' AND user.role = 'student' ");
// $submissionStudentInfor = array();
// while ($tInfor = mysqli_fetch_array($submissionInfor)) {
//     $submissionStudentInfor[] = $tInfor;
// }


// var_dump($submissionSubmitInfor);
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
                                    <h4>LIST SUBMISSION</h4>
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

                                                <th>Submission name</th>
                                                <th>Submission description</th>
                                                <th>Submission Start deadline</th>
                                                <th>Submission End deadline</th>
                                                <th>Status Submited</th>
                                                <th>Select Submission To submit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            // $submissionInfor = $conn->query("SELECT faculty.*,user.*, submission.* FROM (( faculty INNER JOIN submission ON faculty.f_id = submission.faculty_id) INNER JOIN user ON faculty.f_id = user.faculty_id) WHERE user.u_id = '$userId' AND user.role = 'student'");
                                            // foreach ($submissionStudentInfor as $row) {
                                            $submissionInfor = $conn->query("SELECT submission.* FROM submission");
                                            while ($row = mysqli_fetch_array($submissionInfor)) {
                                                $submissionIdSubmit = ($row["id"]);
                                                $selected_date = ($row["submission_deadline"]);
                                                // echo $selected_date, "a ";
                                                $duration = 14;
                                                $duration_type = 'day';
                                                $deadline = date('Y/m/d H:i:s', strtotime($selected_date . ' +' . $duration . ' ' . $duration_type));
                                            ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>

                                                    <td><?php echo $row["submission_name"]; ?></td>
                                                    <td><?php echo $row["submission_description"]; ?></td>
                                                    <td><?php echo $row["submission_deadline"] ?></td>
                                                    <td><?= $deadline ?></td>
                                                    <td>
                                                        <?php

                                                        $submissionSubmit = $conn->query("SELECT submission.*, file_submit_to_submission.*,user.* from file_submit_to_submission INNER JOIN submission ON submission.id = file_submit_to_submission.file_submission_uploaded INNER JOIN user ON user.u_id = file_submit_to_submission.file_userId_uploaded WHERE user.u_id = '$userId' and file_submit_to_submission.file_submission_uploaded = '$submissionIdSubmit'");
                                                        // $submissionSubmit = $conn->query("SELECT * from file_submit_to_submission where file_userId_uploaded = '$userId'");
                                                        $submissionSubmitInfor = array();
                                                        while ($tpInfor = mysqli_fetch_array($submissionSubmit)) {
                                                            $submissionSubmitInfor[] = $tpInfor;
                                                        }


                                                        foreach ($submissionSubmitInfor as $rowSBIF) {

                                                            if (($rowSBIF["file_status"]) == "1") {
                                                        ?>
                                                                <span style="color:green; font-size:16px;font-weight:bold;">Submited</span>
                                                            <?php
                                                            } elseif (($rowSBIF["file_status"]) == "2") {
                                                            ?>
                                                                <span style="color:blue; font-size:16px;font-weight:bold;">Approved</span>
                                                            <?php
                                                            } elseif (($rowSBIF["file_status"]) == "3") {
                                                            ?>
                                                                <span style="color:red; font-size:16px;font-weight:bold;">Rejected</span>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span style="color:black; font-size:16px;font-weight:bold;">Not Graded</span>
                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </td>
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