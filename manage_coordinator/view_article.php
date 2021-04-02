<?php

include "../config.php";
$idFile = $_GET['idfile'];
$idStudent = $_GET['idst'];
$userFacultyId = $_SESSION["current_user"]["faculty_id"];
$userId = $_SESSION["current_user"]["u_id"];


// SELECT file_content.*, file_comment.*,file_submit_to_submission.* from `file_submit_to_submission`INNER JOIN file_content ON file_submit_to_submission.id = file_content.file_submit_id INNER JOIN file_comment ON file_comment.file_submited_id = file_submit_to_submission.id where `file_submit_Id` = '60'
// $fileSubmission = $conn->query("SELECT submission.*, file_submit_to_submission.*, file_content.*, file_comment.* from `submission` INNER JOIN file_submit_to_submission ON file_submit_to_submission.file_submission_uploaded = submission.id INNER JOIN file_content ON file_content.file_submit_id = file_submit_to_submission.id INNER JOIN file_comment ON file_comment.file_submited_id = file_submit_to_submission.id where `file_submit_Id` = '$idFile'");
// $submissionContent = $conn->query("SELECT * from `submission` where `file_submit_Id` = '$idFile'");

// $fileSubmission = $conn->query("SELECT file_content.*, file_comment.* from `file_content` INNER JOIN file_comment ON file_comment.file_submited_id = file_content.file_submit_id where file_content.file_submit_id = '60' AND file_comment.file_submited_id = '60'");
// $fileSubmissionContent = array();
// while ($view = mysqli_fetch_array($fileSubmission)) {
//     $fileSubmissionContent[] = $view;
// }
// // $submissionContent = mysqli_fetch_assoc($submission);

// // var_dump($fileSubmission);
// foreach ($fileSubmissionContent as $rowSb) {
//     var_dump($rowSb['file_comment_content']);
// }

// exit;






$fileContent = $conn->query("SELECT file_content.* from `file_content` where `file_submit_Id` = '$idFile'");
$fileComment = $conn->query("SELECT file_comment.*,u.* from `file_comment` INNER JOIN user as u ON u.u_id = file_comment.file_comment_user where `file_submited_Id` = '$idFile'");
$fileSubmission = $conn->query("SELECT file_submit_to_submission.*, user.*,faculty.* FROM file_submit_to_submission INNER JOIN user ON file_submit_to_submission.file_userId_uploaded = user.u_id INNER JOIN faculty ON faculty.f_id = user.faculty_id WHERE user.role = 'student' AND user.faculty_id = '$userFacultyId'  ORDER BY id DESC LIMIT 1");




?>
<?php
if (isset($_POST['uploadCommnet'])) {

    $uploadCmt = $conn->query("INSERT INTO `file_comment` (`file_comment_id`, `file_comment_content`, `file_comment_time`, `file_comment_user`, `file_submited_id`) VALUES (NULL, '$_POST[commentContent]', '" . time() . "', '$userId', '$idFile'); ");
    $changeStatus = $conn->query("UPDATE `file_submit_to_submission` SET `file_status` = '$_POST[statusOfFile]' where `id` = '$idFile'");
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
<meta content="" name="author" />
<meta content="atlas is Bootstrap 4 based admin panel.It comes with 100's widgets,charts and icons" name="description" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="atlas is Bootstrap 4 based admin panel.It comes with 100's widgets,charts and icons" />
<meta property="og:description" content="atlas is Bootstrap 4 based admin panel.It comes with 100's widgets,charts and icons" />
<meta property="og:image" content="https://cdn.dribbble.com/users/180706/screenshots/5424805/the_sceens_-_mobile_perspective_mockup_3_-_by_tranmautritam.jpg" />
<meta property="og:site_name" content="atlas " />
<title>Home Page</title>
<link rel="icon" type="image/x-icon" href="assets/img/logo.png" />
<link rel="icon" href="assets/img/logo.png" type="image/png" sizes="16x16">
<link rel='stylesheet' href='https://d33wubrfki0l68.cloudfront.net/css/478ccdc1892151837f9e7163badb055b8a1833a5/light/assets/vendor/pace/pace.css' />
<script src='https://d33wubrfki0l68.cloudfront.net/js/3d1965f9e8e63c62b671967aafcad6603deec90c/light/assets/vendor/pace/pace.min.js'></script>
<!--vendors-->
<link rel='stylesheet' type='text/css' href='https://d33wubrfki0l68.cloudfront.net/bundles/291bbeead57f19651f311362abe809b67adc3fb5.css' />
<link rel='stylesheet' href='https://d33wubrfki0l68.cloudfront.net/bundles/fc681442cee6ccf717f33ccc57ebf17a4e0792e1.css' />


<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,600" rel="stylesheet">
<!--Material Icons-->
<link rel='stylesheet' type='text/css' href='https://d33wubrfki0l68.cloudfront.net/css/548117a22d5d22545a0ab2dddf8940a2e32c04ed/default/assets/fonts/materialdesignicons/materialdesignicons.min.css' />
<!--Material Icons-->
<link rel='stylesheet' type='text/css' href='https://d33wubrfki0l68.cloudfront.net/css/0940f25997c8e50e65e95510b30245d116f639f0/light/assets/fonts/feather/feather-icons.css' />
<!--Bootstrap + atmos Admin CSS-->
<link rel='stylesheet' type='text/css' href='https://d33wubrfki0l68.cloudfront.net/css/16e33a95bb46f814f87079394f72ef62972bd197/light/assets/css/atmos.min.css' />
<link rel="stylesheet" href="../assets/css/report_page.css">

<body>
    <?php include '../partials/aside.php' ?>
    <main class="admin-main">
        <?php include '../partials/header.php' ?>
        <section>
            <div class="container m-t-30">
                <div class="row py-3">
                    <div class="col-m-8 content-form">
                        <?php
                        $count = 1;


                        $fileContentArray = array();
                        while ($rowFile = mysqli_fetch_array($fileContent)) {
                            $fileContentArray[] = $rowFile;
                        }
                        if ($fileContent->num_rows > 0) {
                            foreach ($fileContentArray as $row) {

                                $fileURL = "";
                                $fileType = "";
                                $allowTypes = array('docx', 'doc', 'pdf', 'application/pdf');
                                $fileURL = '../student/file_library/' . $row["file_content_name"];
                                $fileType = pathinfo($fileURL, PATHINFO_EXTENSION);


                                if ($fileType === "docx") {
                                    // $fields_string = "";
                                    // $url = '';
                                    // $fields = array(
                                    //     'inputFile' => file_get_contents($fileURL),
                                    //     'conversionParameters' => '{}',
                                    //     'outputFormat' => 'pdf',
                                    //     'async' => 'false'
                                    // );
                                    // // var_dump($fields);
                                    // //url-ify the data for the POST
                                    // foreach ($fields as $key => $value) {
                                    //     $fields_string .= $key . '=' . $value . '&';
                                    // }
                                    // // print_r("``````````````````````````````````````````````");
                                    // $fields_string = rtrim($fields_string, '&');
                                    // // var_dump($fields_string);
                                    // //open connection
                                    // $ch = curl_init();
                                    // //set the url, number of POST vars, POST data
                                    // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                    //     'X-ApplicationID: 6c278907-e2a6-4f49-a929-6d08d0284786',
                                    //     'X-SecretKey: ba3bf94f-f83e-405b-8104-ad4fc84f43bc'
                                    // ));
                                    // curl_setopt($ch, CURLOPT_URL, $url);
                                    // curl_setopt($ch, CURLOPT_POST, count($fields));
                                    // curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                                    // //execute post
                                    // $result = curl_exec($ch);
                                    // print_r($result);




                                    $fileType = "pdf";
                                    $a =  str_replace('docx', $fileType, $fileURL);
                                    $fileURL = preg_replace('/\s+/', '', $a);
                                } elseif ($fileType === "doc") {
                                    // $fileType = "pdf";
                                    // $fileURL =  str_replace('doc', $fileType, $fileURL);
                                }

                                var_dump($fileURL);
                                if (in_array($fileType, $allowTypes)) {
                                    // var_dump($fileURL);
                                    // exit;

                        ?>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js">
                                    </script>
                                    <p style="font-weight: bold; color:red;">No. <?= $count++ ?></p>
                                    <hr>
                                    <div id="my_pdf_viewer">
                                        <div id="canvas_container" style="width: 800px;
        height: 600px;
        overflow: auto;">
                                            <canvas id="pdf_renderer"></canvas>
                                        </div>

                                        <div id="navigation_controls">
                                            <button id="go_previous">Previous</button>
                                            <input id="current_page" value="1" type="number" />
                                            <button id="go_next">Next</button>
                                        </div>

                                        <div id="zoom_controls">
                                            <button id="zoom_out">-</button>
                                            <button id="zoom_in">+</button>
                                        </div>
                                    </div>
                                    <script>
                                        var myState = {
                                            pdf: null,
                                            currentPage: 1,
                                            zoom: 1
                                        }

                                        pdfjsLib.getDocument('<?php echo $fileURL ?>').then((pdf) => {

                                            myState.pdf = pdf;
                                            render();

                                        });

                                        function render() {
                                            myState.pdf.getPage(myState.currentPage).then((page) => {

                                                var canvas = document.getElementById("pdf_renderer");
                                                var ctx = canvas.getContext('2d');

                                                var viewport = page.getViewport(myState.zoom);

                                                canvas.width = viewport.width;
                                                canvas.height = viewport.height;

                                                page.render({
                                                    canvasContext: ctx,
                                                    viewport: viewport
                                                });
                                            });
                                        }
                                        document.getElementById('go_previous')
                                            .addEventListener('click', (e) => {
                                                if (myState.pdf == null || myState.currentPage == 1)
                                                    return;

                                                myState.currentPage -= 1;
                                                document.getElementById("current_page").value = myState.currentPage;
                                                render();
                                            });
                                        document.getElementById('go_next')
                                            .addEventListener('click', (e) => {
                                                if (myState.pdf == null || myState.currentPage > myState.pdf._pdfInfo.numPages)
                                                    return;

                                                myState.currentPage += 1;
                                                document.getElementById("current_page").value = myState.currentPage;
                                                render();
                                            });
                                        document.getElementById('current_page')
                                            .addEventListener('keypress', (e) => {
                                                if (myState.pdf == null) return;

                                                // Get key code
                                                var code = (e.keyCode ? e.keyCode : e.which);

                                                // If key code matches that of the Enter key
                                                if (code == 13) {
                                                    var desiredPage = document.getElementById('current_page').valueAsNumber;

                                                    if (desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                                                        myState.currentPage = desiredPage;
                                                        document.getElementById("current_page").value = desiredPage;
                                                        render();
                                                    }
                                                }
                                            });
                                        document.getElementById('zoom_in')
                                            .addEventListener('click', (e) => {
                                                if (myState.pdf == null) return;
                                                myState.zoom += 0.5;

                                                render();
                                            });
                                        document.getElementById('zoom_out')
                                            .addEventListener('click', (e) => {
                                                if (myState.pdf == null) return;
                                                myState.zoom -= 0.5;

                                                render();
                                            });
                                    </script>

                                <?php
                                } elseif (!in_array($fileType, $allowTypes)) {
                                    $imageURL = '../student/file_library/' . $row["file_content_name"];
                                ?>
                                    <div>
                                        <p style="font-weight: bold; color:red; margin:10px 0px">No. <?= $count++ ?></p>
                                        <hr>
                                        <a href="<?= $row['file_content_name'] ?>"> <img src="<?php echo $imageURL; ?>" alt="" width="350" height="350  " class="img-fluid" id="img-view-details" />
                                        </a>

                                    </div>

                        <?php
                                }
                            }
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
                                            <span class="student-ift">Student: </span><span class="student-ifto"> <?= $rowFile['fullname'] ?></span>
                                        </div>
                                        <div>
                                            <span class="student-ift">Email: </span><span class="student-ifto"> <?= $rowFile['email'] ?></span>
                                        </div>
                                        <div>
                                            <span class="student-ift">File name submitssion:</span><span class="student-ifto"><?= $rowFile['file_name'] ?></span>
                                        </div>
                                        <div>
                                            <span class="student-ift">File date upload:</span><span class="student-ifto"> <?= $rowFile['file_date_uploaded'] ?></span>
                                        </div>
                                        <hr>
                                        <?php
                                        if (($rowFile["file_status"]) == "1") {
                                        ?>
                                            <div>
                                                <span class="student-ift" style=" font-size: 17px !important;">Submission status:</span><span class="student-ifto">
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
                <div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-6" style="padding: 0; font-weight:bold;">Update status</label>
                            <select name="statusOfFile" class="form-select" style="width:90%; height: 34px;border-color: #D4D2D2;border-radius: 5px">
                                <option selected>--Select status--</option>
                                <option value="2">Approved</option>
                                <option value="3">Reject</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <!-- <label for="inputName">Comment</label>
                                            <textarea type="text" class="form-control" id="inputName" name="commentContent" placeholder="Name of article"></textarea> -->
                            <h3>Feedback</h3>
                            <textarea type="text" class="form-control" id="inputName" name="commentContent" placeholder="Feedback to student" style="width: 88%; height: 50px; border-radius: 3px; border-radius: 14px; resize: none; margin-bottom: 7% "></textarea>
                        </div>
                        <div class="form-group" style="text-align:center;">
                            <input type="submit" name="uploadCommnet" class="btn btn-succecss" value="Feedback" style="font-size: 20px; background-color: yellowgreen; border-radius:16px; display: inline-block; " id="uploadFile"></input>
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
                                    <span class="student-ift">User comment: </span><span class="student-ifto"><?= $rowFileComment['fullname'] ?></span>
                                </div>
                                <div>
                                    <span sclass="student-ift">Content comment: </span><span class="student-ifto"> <?= $rowFileComment['file_comment_content'] ?></span>
                                </div>
                                <div>
                                    <span sclass="student-ift">Time feedback: </span><span class="student-ifto"> <?= date("Y-m-d H:i:s", $rowFileComment['file_comment_time']) ?></span>
                                </div>
                            </div>
                            <hr>
                    <?php }
                    }
                    ?>
                </div>
                <hr>

                    </div>
                </div>
            </div>




        </section>

    </main>
</body>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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