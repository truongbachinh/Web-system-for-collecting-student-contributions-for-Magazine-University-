<?php
include "../../config.php";
$idFile = $_GET['idfile'];
$idStudent = $_GET['idst'];
$userFacultyId = $_SESSION["current_user"]["faculty_id"];
$userId = $_SESSION["current_user"]["u_id"];


// SELECT file_content.*, file_comment.*,file_submit_to_topic.* from `file_submit_to_topic`INNER JOIN file_content ON file_submit_to_topic.id = file_content.file_submit_id INNER JOIN file_comment ON file_comment.file_submited_id = file_submit_to_topic.id where `file_submit_Id` = '60'
// $fileSubmission = $conn->query("SELECT topic.*, file_submit_to_topic.*, file_content.*, file_comment.* from `topic` INNER JOIN file_submit_to_topic ON file_submit_to_topic.file_topic_uploaded = topic.id INNER JOIN file_content ON file_content.file_submit_id = file_submit_to_topic.id INNER JOIN file_comment ON file_comment.file_submited_id = file_submit_to_topic.id where `file_submit_Id` = '$idFile'");
// $topicContent = $conn->query("SELECT * from `topic` where `file_submit_Id` = '$idFile'");

// $fileSubmission = $conn->query("SELECT file_content.*, file_comment.* from `file_content` INNER JOIN file_comment ON file_comment.file_submited_id = file_content.file_submit_id where file_content.file_submit_id = '60' AND file_comment.file_submited_id = '60'");
// $fileSubmissionContent = array();
// while ($view = mysqli_fetch_array($fileSubmission)) {
//     $fileSubmissionContent[] = $view;
// }
// // $topicContent = mysqli_fetch_assoc($topic);

// // var_dump($fileSubmission);
// foreach ($fileSubmissionContent as $rowSb) {
//     var_dump($rowSb['file_comment_content']);
// }

// exit;


/** @var TYPE_NAME $conn */
$fileContent = $conn->query("SELECT file_content.* from `file_content` where `file_submit_Id` = '$idFile'");
$fileComment = $conn->query("SELECT file_comment.*,u.* from `file_comment` INNER JOIN user as u ON u.u_id = file_comment.file_comment_user where `file_submited_Id` = '$idFile'");
$fileSubmission = $conn->query("SELECT file_submit_to_topic.*, user.*,faculty.* FROM file_submit_to_topic INNER JOIN user ON file_submit_to_topic.file_userId_uploaded = user.u_id INNER JOIN faculty ON faculty.f_id = user.faculty_id WHERE user.role = 'student' AND user.faculty_id = '$userFacultyId'  ORDER BY id DESC LIMIT 1");


?>
<?php
if (isset($_POST['uploadCommnet'])) {

    $uploadCmt = $conn->query("INSERT INTO `file_comment` (`file_comment_id`, `file_comment_content`, `file_comment_time`, `file_comment_user`, `file_submited_id`) VALUES (NULL, '$_POST[commentContent]', '" . time() . "', '$userId', '$idFile'); ");
    $changeStatus = $conn->query("UPDATE `file_submit_to_topic` SET `file_status` = '$_POST[statusOfFile]' where `id` = '$idFile'");
    if ($uploadCmt == true) {
        ?>
        <script>
            alert("oke");
            location.reload();
            // window.location.replace("./listofreport.php?idfile=<?= $fileSubmission['id'] ?>&idst=<?= $fileSubmission['u_id'] ?>");
        </script>
        <?php

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta content="" name="author"/>
<meta content="atlas is Bootstrap 4 based admin panel.It comes with 100's widgets,charts and icons" name="description"/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="website"/>
<meta property="og:title"
      content="atlas is Bootstrap 4 based admin panel.It comes with 100's widgets,charts and icons"/>
<meta property="og:description"
      content="atlas is Bootstrap 4 based admin panel.It comes with 100's widgets,charts and icons"/>
<meta property="og:image"
      content="https://cdn.dribbble.com/users/180706/screenshots/5424805/the_sceens_-_mobile_perspective_mockup_3_-_by_tranmautritam.jpg"/>
<meta property="og:site_name" content="atlas "/>
<title>Home Page</title>
<link rel="icon" type="image/x-icon" href="assets/img/logo.png"/>
<link rel="icon" href="assets/img/logo.png" type="image/png" sizes="16x16">
<link rel='stylesheet'
      href='https://d33wubrfki0l68.cloudfront.net/css/478ccdc1892151837f9e7163badb055b8a1833a5/light/assets/vendor/pace/pace.css'/>
<script src='https://d33wubrfki0l68.cloudfront.net/js/3d1965f9e8e63c62b671967aafcad6603deec90c/light/assets/vendor/pace/pace.min.js'></script>
<!--vendors-->
<link rel='stylesheet' type='text/css'
      href='https://d33wubrfki0l68.cloudfront.net/bundles/291bbeead57f19651f311362abe809b67adc3fb5.css'/>
<link rel='stylesheet'
      href='https://d33wubrfki0l68.cloudfront.net/bundles/fc681442cee6ccf717f33ccc57ebf17a4e0792e1.css'/>


<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,600" rel="stylesheet">
<!--Material Icons-->
<link rel='stylesheet' type='text/css'
      href='https://d33wubrfki0l68.cloudfront.net/css/548117a22d5d22545a0ab2dddf8940a2e32c04ed/default/assets/fonts/materialdesignicons/materialdesignicons.min.css'/>
<!--Material Icons-->
<link rel='stylesheet' type='text/css'
      href='https://d33wubrfki0l68.cloudfront.net/css/0940f25997c8e50e65e95510b30245d116f639f0/light/assets/fonts/feather/feather-icons.css'/>
<!--Bootstrap + atmos Admin CSS-->
<link rel='stylesheet' type='text/css'
      href='https://d33wubrfki0l68.cloudfront.net/css/16e33a95bb46f814f87079394f72ef62972bd197/light/assets/css/atmos.min.css'/>
<link rel="stylesheet" href="../../assets/css/report_page.css">

<body>
<?php include '../partials/aside.php' ?>
<main class="admin-main">
    <?php include '../partials/header.php' ?>
    <div class="container m-t-30">
        <div class="row py-3">
            <div class="col-m-8 content-form">
                <?php
                $count = 1;
                if ($fileContent->num_rows > 0) {
                    while ($row = $fileContent->fetch_assoc()) {

                        $imageURL = '../student/file_library/' . $row["file_content_name"];
                        ?>
                        <div>
                            <p>File STT <?= $count++ ?></p>
                            <a href="<?= $row['file_content_name'] ?>"> <img src="<?php echo $imageURL; ?>" alt=""
                                                                             width="350" height="350  "
                                                                             class="img-fluid" id="img-view-details"/>
                            </a>

                        </div>

                    <?php }
                }
                ?>
            </div>
            <div class="col-m-4 feedback-form">


                <div class="infor-student-submission">
                    <?php
                    $count = 1;
                    if ($fileSubmission->num_rows > 0) {
                    while ($rowFile = $fileSubmission->fetch_assoc()) {
                    ?>
                    <div>
                        <b class="student-if">Submission information</b>
                        <hr>
                        <div>
                            <span class="student-ift">Student: </span><span
                                class="student-ifto"> <?= $rowFile['fullname'] ?></span>
                        </div>
                        <div>
                            <span class="student-ift">Email: </span><span
                                class="student-ifto"> <?= $rowFile['email'] ?></span>
                        </div>
                        <div>
                            <span class="student-ift">File name submitssion:</span><span
                                class="student-ifto"><?= $rowFile['file_name'] ?></span>
                        </div>
                        <div>
                            <span class="student-ift">File date upload:</span><span
                                class="student-ifto"> <?= $rowFile['file_date_uploaded'] ?></span>
                        </div>
                        <hr>
                        <?php
                        if (($rowFile["file_status"]) == "1") {
                            ?>
                            <div>
                                <span class="student-ift" style=" font-size: 17px !important;">Submission status:</span><span
                                    class="student-ifto">
                                                        Processing</span>
                            </div>
                            <?php


                        } else if (($rowFile["file_status"]) == "3") {
                            ?>
                            <div>
                                <span class="student-ift" style=" font-size: 17px !important;">Submission status:</span>
                                <b class="student-ifto" style="color:red !important; font-size:16px">Rejected</b>
                            </div>
                            <?php
                        } else if (($rowFile["file_status"]) == "2") {
                            ?>
                            <div>
                                <span class="student-ift" style=" font-size: 17px !important;">Submission status:</span>
                                <b class="student-ifto" style="color:green !important; font-size:16px">Approved</b>
                            </div>
                            <?php
                        }
                        ?>
                        </span>
                    </div>
                </div>

                <?php }
                }
                ?>


                <!--COMPLETED ACTIONS DONUTS CHART-->

                <div class="form-group">
                    <!-- <label for="inputName">Comment</label>
                                    <textarea type="text" class="form-control" id="inputName" name="commentContent" placeholder="Name of article"></textarea> -->
                    <h3>Feedback</h3>
                    <textarea disabled type="text" class="form-control" id="inputName" name="commentContent"
                              placeholder="Feedback to student"
                              style="width: 88%; height: 180px; border-radius: 3px; border-radius: 14px; resize: none; margin-bottom: 7% "></textarea>
                </div>
                <div class="form-group" style="text-align:center;">
                    <input  type="submit" name="uploadCommnet" class="btn btn-succecss" value="Read More"
                            style="font-size: 20px; background-color: yellowgreen; border-radius:16px; display: inline-block; "
                            id="uploadFile"></input>
                </div>
                </form>
            </div>

            <hr>

            <div class="feedback-submission">
                <b class="student-if">Feedback</b>
                <?php
                $count = 1;
                if ($fileComment->num_rows > 0) {
                    while ($rowFileComment = $fileComment->fetch_assoc()) {
                        ?>
                        <div>

                            <div>
                                <span class="student-ift">User comment: </span><span
                                    class="student-ifto"><?= $rowFileComment['fullname'] ?></span>
                            </div>
                            <div>
                                <span sclass="student-ift">Content comment: </span><span
                                    class="student-ifto"> <?= $rowFileComment['file_comment_content'] ?></span>
                            </div>
                            <div>
                                <span sclass="student-ift">Time feedback: </span><span
                                    class="student-ifto"> <?= date("Y-m-d H:i:s", $rowFileComment['file_comment_time']) ?></span>
                            </div>
                        </div>
                        <hr>
                    <?php }
                }
                ?>
            </div>
            <hr>
            <div class="feedback-submission">
                <a href="view_article.php.php?file_id=<?php echo $fileContent['file_content_id'] ?>">Download</a>
            </div>
            <?php
            if (isset($_GET['file_id'])) {
                $id = $_GET['file_id'];

                // fetch file to download from database

                $sql = "SELECT * from `file_content` where `file_submit_Id` = '$id'";
                $result = mysqli_query($conn, $sql);

                $file = mysqli_fetch_assoc($result);
                $filepath = '../student/file_library/' . $file['file_content_name'];

                if (file_exists($filepath)) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename=' . basename($filepath));
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize('uploads/' . $file['name']));
                    readfile('../student/file_library/' . $file['file_content_name']);
//
//                    // Now update downloads count
//                    $newCount = $file['downloads'] + 1;
//                    $updateQuery = "UPDATE file_content SET downloads=$newCount WHERE id=$id";
//                    mysqli_query($conn, $updateQuery);
                    exit;
                }

            }
            ?>
            <hr>

        </div>
    </div>
    </div>
    </div>

    </div>
    </section>
    </section>

</main>
</body>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

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