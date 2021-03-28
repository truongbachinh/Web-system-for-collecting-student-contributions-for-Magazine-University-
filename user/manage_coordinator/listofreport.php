<?php
include "../../config.php";
$idTopic = $_GET['idt'];
$userFacultyId = $_SESSION["current_user"]["faculty_id"];
$userId = $_SESSION["current_user"]["u_id"];

// Perform query

/** @var TYPE_NAME $conn */
// $result = mysqli_query($conn, "SELECT * FROM file_submit_to_system WHERE file_faculty_id = $file_faculty_id");
// $file_submit_to_system = mysqli_fetch_assoc($result);
// $faculty = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM faculty WHERE f_id = $file_faculty_id"), MYSQLI_ASSOC);

$studentSb = array();
//$res = $conn->query("SELECT files.*, u.*,f.* FROM file_submit_to_topic as files INNER JOIN user as u ON files.file_userId_uploaded = u.u_id INNER JOIN faculty.f_id = user.faculty_id WHERE u.role = 'student' AND files.file_topic_uploaded = '$idTopic' ORDER BY id DESC LIMIT 1");
$result = $conn->query("SELECT file_submit_to_topic.*, user.*,faculty.* FROM file_submit_to_topic INNER JOIN user ON file_submit_to_topic.file_userId_uploaded = user.u_id INNER JOIN faculty ON faculty.f_id = user.faculty_id WHERE user.role = 'student' AND user.faculty_id = '$userFacultyId' AND file_submit_to_topic.file_topic_uploaded = '$idTopic'  ");


while ($rowSt = mysqli_fetch_array($result)) {
    $studentSb[] = $rowSt;
}
// var_dump($studentSb);
// exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/html_header.php" ?>
</head>

<body class="sidebar-pinned ">
    <?php include "../partials/aside.php" ?>
    <main class="admin-main">
        <!-- Header -->
        <?php include "../partials/header.php" ?>
        <!-- Session -->

        <section class="admin-content">
            <div class="container m-t-30">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4>List Articles</h4>
                                    </h4>
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
                                    <table class="table table-bordered">
                                        <thead class="thead" style="background-color: #F4F7FC; text-align: center;">
                                            <tr style="color: black !important">
                                                <th style="color: black !important" scope="col">NO.</th>
                                                <th style="color: black !important" scope="col">AVATAR</th>
                                                <th style="color: black !important" scope="col">STUDENT OWNER</th>
                                                <th style="color: black !important" scope="col">EMAIL</th>
                                                <th style="color: black !important" scope="col">STATUS</th>
                                                <th style="color: black !important" scope="col">SUBMIT TIME</th>
                                                <th style="color: black !important" scope="col">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: center;">
                                            <?php
                                            $stt = 1;
                                            foreach ($studentSb as $stReport) {
                                                $a = $stReport['file_name'];
                                                $userId = $stReport['u_id'];
                                                $idFile = $stReport['id'];
                                                //                                    $user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user WHERE user.u_id = $userId"),MYSQLI_ASSOC );
                                                //                                    $value_file = mysqli_fetch_array($value, MYSQLI_ASSOC);
                                                //     


                                            ?>
                                                <tr>
                                                    <th scope="row"><?= $stt++ ?></th>
                                                    <td><img class="avatar avatar-lg" style="border-radius: 50%" src="../../assets/img/users/user-1.jpg"></td>
                                                    <td style="padding: 2.5%;"><?= $stReport["username"] ?></td>
                                                    <td style="padding: 2.5%;"><?= $stReport["email"] ?></td>
                                                    <td style="padding: 1.5%;">
                                                        <?php

                                                        if (($stReport["file_status"]) == "1") {
                                                        ?>
                                                            <span class="badge badge-secondary">Note Grade</span>
                                                            </button>
                                                        <?php

                                                        } else if (($stReport["file_status"]) == "2") {
                                                        ?>
                                                            <span class="badge badge-success">Approved</span>
                                                        <?php

                                                        } else if (($stReport["file_status"]) == "3") {
                                                        ?>
                                                            <span class="badge badge-danger">Rejected</span>
                                                        <?php
                                                        }
                                                        ?>

                                                    </td>
                                                    <td style="padding: 2.5%;"><?= $stReport["file_date_uploaded"] ?></td>

                                                    <td style="padding: 1.5%; color:red"><a type="button" class="btn btn-primary" href="view_article.php?idfile=<?= $idFile ?>&idst=<?= $userId ?>">Select </a>
                                                    </td>
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
</body>

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