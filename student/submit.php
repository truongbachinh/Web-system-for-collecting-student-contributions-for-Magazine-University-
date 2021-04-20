<?php

include "../config.php";
require_once '../mailer/class.phpmailer.php';
require_once '../mail_process.php';
if (!empty($_SESSION)) {
    $userId = $_SESSION["current_user"]["u_id"];
    $facultyId = $_SESSION["current_user"]["faculty_id"];
    $facultyMail  = $conn->query("SELECT user.email from user where faculty_id =  $facultyId and `role` = 'manager-coordinator'");
    $sendMailFaculty = $facultyMail->fetch_assoc();
    $mailF = $sendMailFaculty['email'];

    $idSubmission = $_GET["idt"];

    $submission = $conn->query("SELECT * from submission where id = '$idSubmission' ");
    $submissionSubmit = mysqli_fetch_assoc($submission);
    $userInfor = $conn->query("SELECT faculty.*,user.* from faculty INNER JOIN user ON faculty.f_id = user.faculty_id where u_id = '$userId' ");
    $userInforFaculty = mysqli_fetch_assoc($userInfor);

    // while ($rowInfor = mysqli_fetch_array($userInfor)) {
    //     $userInforFaculty[] = $rowInfor;
    // }

    //$file = $conn->query("SELECT * from file_submit_to_submission where file_userId_uploaded = '$userId' AND `file_submission_uploaded` = '$idSubmission' AND `id` = (SELECT MAX(id) from `file_submit_to_submission` where `file_userId_uploaded` = '$userId' ) ");
    $file = $conn->query("SELECT * from file_submit_to_submission where file_userId_uploaded = '$userId' AND `file_submission_uploaded` = '$idSubmission' ORDER BY id DESC LIMIT 1 ");
    if ($file == true) {
        $fileSubmit = mysqli_fetch_assoc($file);
    }



    $selected_date = ($submissionSubmit["submission_deadline"]);
    // echo $selected_date, "a ";
    $duration = 14;
    $duration_type = 'day';
    $deadline = date('Y/m/d H:i:s', strtotime($selected_date . ' +' . $duration . ' ' . $duration_type));
    $secondDeadline = date('Y/m/d H:i:s', strtotime($deadline  . ' +' . $duration . ' ' . $duration_type));




    $current = new DateTime("now", new DateTimeZone('Asia/Ho_Chi_Minh'));

    $timeSubmitFile = $current->format('Y/m/d H:i:s');
    $diff = abs(strtotime($deadline) - strtotime($timeSubmitFile));

    $years = floor($diff / (365 * 60 * 60 * 24));
    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
    $minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
    $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));

    if ($years != 0) {
        $checkTimeSubmit = $years . " years, " . $months . " months, " . $days . " days, " . $hours . " hours, " . $minutes . " minutes, " . $seconds . " seconds";
    } else if ($months != 0) {
        $checkTimeSubmit = $months . " months, " . $days . " days, " . $hours . " hours, " . $minutes . " minutes, " . $seconds . " seconds";
    } else {
        $checkTimeSubmit =  $days . " days, " . $hours . " hours, " . $minutes . " minutes, " . $seconds . " seconds";
    }

    // var_dump(($timeSubmitFile));
    // $timeSubmitFile = new DateTime('2022-10-11 12:12:00');
    // var_dump(($deadline));
    // var_dump(($secondDeadline));
    // var_dump(($deadline > $secondDeadline));
    // var_dump(($timeSubmitFile < $deadline));
    // exit;


?>


    <?php
    if (isset($_POST['uploadCommnet'])) {
        // var_dump($_POST);
        // exit;
        $uploadCmt = $conn->query("INSERT INTO `file_comment` (`file_comment_id`, `file_comment_content`, `file_comment_time`, `file_comment_user`, `file_submited_id`) VALUES (NULL, '$_POST[commentContent]', '" . time() . "', '$userId', '$fileSubmit[id]'); ");

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


    <?php
    if (isset($_POST['uploadFile'])) {
        $fileType = "";
        $count = 0;
        $res = mysqli_query($conn, "SELECT * from file_submit_to_submission where file_submit_to_submission.file_userId_uploaded = '$userId' AND file_submit_to_submission.file_submission_uploaded = '$idSubmission'");
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            $delete_query = $conn->query("DELETE FROM file_submit_to_submission where file_submit_to_submission.file_userId_uploaded = '$userId' AND file_submit_to_submission.file_submission_uploaded = '$idSubmission' ");
        }


        $upload_query = $conn->query("INSERT INTO `file_submit_to_submission` (`id`, `file_name`, `file_authod`, `file_status`, `file_date_uploaded`,  `file_submission_uploaded`, `file_userId_uploaded`) VALUES (NULL, '$_POST[nameArticle]', '$userInforFaculty[fullname]', '1', '" . $timeSubmitFile . "', '$idSubmission', '$userId')");
        $tm = md5(time());
        $uploadPath = "./file_library/";

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'docx', 'DOCX', 'doc', 'pdf', 'application/pdf');

        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';

        $fileNames = array_filter($_FILES['inputFileArticle']['name']);
        $targetFilePath = "";
        $fileType = "";
        if (!empty($fileNames)) {
            foreach ($_FILES['inputFileArticle']['name'] as $key => $val) {
                $fileName =  $tm . basename($_FILES['inputFileArticle']['name'][$key]);
                $targetFilePath = $uploadPath . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                if (in_array($fileType, $allowTypes)) {


                    if (move_uploaded_file($_FILES["inputFileArticle"]["tmp_name"][$key], $targetFilePath)) {

                        if ($fileType == "docx") {

                            // $url = 'https://api2.docconversionapi.com/jobs/create';
                            // $fields = array(
                            //     'inputFile' => file_get_contents($targetFilePath, FILE_USE_INCLUDE_PATH),
                            //     'conversionParameters' => '{}',
                            //     'outputFormat' => 'pdf',
                            //     'async' => 'false'
                            // );
                            // $fields_string = '';
                            // //url-ify the data for the POST
                            // foreach ($fields as $key => $value) {
                            //     $fields_string .= $key . '=' . $value . '&';
                            // }
                            // $fields_string = rtrim($fields_string, '&');
                            // // print_r($fields_string);
                            // //open connection
                            // $ch = curl_init();
                            // //set the url, number of POST vars, POST data
                            // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            //     'X-ApplicationID: 6c278907-e2a6-4f49-a929-6d08d0284786',
                            //     'X-SecretKey: a8de0281-c61e-440f-94f0-dcb72fca6816'
                            // ));
                            // curl_setopt($ch, CURLOPT_URL, $url);
                            // curl_setopt($ch, CURLOPT_POST, count($fields));
                            // curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                            // //execute post
                            // $result = curl_exec($ch);

                            // print_r($result);
                            // exit;



                            // $fileType = "pdf";
                            // $targetFilePath =  str_replace('docx', $fileType, $targetFilePath);



                            // function parseWord($userDoc)
                            // {
                            //     $fileHandle = fopen($userDoc, "r");
                            //     $line = @fread($fileHandle, filesize($userDoc));
                            //     $lines = explode(chr(0x0D), $line);
                            //     $outtext = "";
                            //     foreach ($lines as $thisline) {
                            //         $pos = strpos($thisline, chr(0x00));
                            //         if (($pos !== FALSE) || (strlen($thisline) == 0)) {
                            //         } else {
                            //             $outtext .= $thisline . " ";
                            //         }
                            //     }
                            //     $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/", "", $outtext);
                            //     return $outtext;
                            // }

                            // $userDoc = $targetFilePath;

                            // $text = parseWord($userDoc);
                            // print_r($text);
                            // exit;
                        } elseif ($fileType == "doc") {
                            // Save the document in PDF format.
                            // $fieleType = "pdf";
                            // $targetFilePath =  str_replace('doc', $fileType, $targetFilePath);
                        }
                        $insertId = $conn->insert_id;
                        $insertValuesSQL .= "(NULL, ' $insertId', '" . $fileName . "', '" . time() . "')";
                        if ($key != count($_FILES["inputFileArticle"]["tmp_name"]) - 1) {
                            $insertValuesSQL .=  ",";
                        }
                    } else {
                        $errorUpload .= $_FILES['inputFileArticle']['name'][$key] . ' | ';
                    }
                } else {
    ?>
                    <script>
                        alert("Error");
                    </script>
            <?php
                }
            }

            if (!empty($insertValuesSQL)) {

                $insertFileSubmit = $conn->query("INSERT INTO `file_content` (`file_content_id`, `file_submit_id`, `file_content_name`, `file_content_update_name`) VALUES $insertValuesSQL");
                if ($insertFileSubmit) {
                    $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                    $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                    $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                    $statusMsg = "Files are uploaded successfully." . $errorMsg;
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
        }

        if ($upload_query == true) {

            $mail = new PHPMailer(true);
            $email = $mailF;
            $message = $_SESSION['current_user']['username'] . ' has submitted papers';
            $subject = "Notification from Contribution Submission Web Application";
            $text_message    =   $userInforFaculty['f_name'];

            send_mail($email, $message, $subject, $text_message)

            ?>
            <script>
                window.location.replace("./submit.php?idt=<?= $idSubmission ?>")
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
    <!-- Additional library for page -->
    <?php include '../partials/aside.php' ?>


    <body class="sidebar-pinned ">
        <?php include '../partials/aside.php' ?>
        <main class="admin-main">
            <!-- Header -->
            <?php include '../partials/header.php' ?>
            <?php include '../partials/html_header.php' ?>
            <!-- Session -->

            <section class="admin-content">
                <div class="container m-t-30">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <br>
                            <br>
                            <h5>
                                This is submission <span style="color:red"> <?= $submissionSubmit['submission_name'] ?></span>
                            </h5>
                            <p class="m-b-0 text-muted">
                            </p>
                        </div>

                        <div class="card-body p-b-0">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Submission</td>
                                        <td><?php

                                            if ($fileSubmit == NULL) {
                                            ?>
                                                <span>Not Submitted</span>
                                            <?php
                                            } else {
                                            ?>
                                                <span>Submitted for grading</span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Grading status</td>
                                        <td><?php

                                            if (($fileSubmit == NULL)) {
                                            ?>
                                                <span>Not Graded</span>
                                            <?php
                                            } else if (($fileSubmit["file_status"]) == "1") {
                                            ?>
                                                <span>Processing</span>
                                            <?php

                                            } else if (($fileSubmit["file_status"]) == "2") {
                                            ?>
                                                <span style="color:blue; font-size:16px">Approved</span>
                                            <?php

                                            } else if (($fileSubmit["file_status"]) == "3") {
                                            ?>
                                                <span style="color:red; font-size:16px">Rejected</span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Deadline date</td>
                                        <td>
                                            <?php echo (!empty($submissionSubmit["submission_deadline"]) ?  $deadline : "Not submited");
                                            ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Time remaining</td>
                                        <td> <?php echo (!empty($fileSubmit["file_date_uploaded"]) ? $checkTimeSubmit : "Not submited"); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Last modified</td>
                                        <td>
                                            <?php
                                            if (isset($fileSubmit["file_date_uploaded"]) && strtotime($fileSubmit["file_date_uploaded"]) != '-62169987208') {
                                            ?>
                                                <span><?= $fileSubmit["file_date_uploaded"] ?></span>
                                            <?php
                                            } else {
                                            ?>
                                                <span>Not update</span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>File submited name</td>
                                        <td> <?php echo (!empty($fileSubmit["file_name"]) ? $fileSubmit["file_name"] : "Not submited"); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Comment of report</td>
                                        <td>
                                            <?php
                                            $fileInfor = $conn->query("SELECT file_comment.*, user.*,file_submit_to_submission.* FROM (( user INNER JOIN file_comment ON file_comment.file_comment_user = user.u_id) INNER JOIN file_submit_to_submission ON file_submit_to_submission.id = file_comment.file_submited_id) WHERE `file_userId_uploaded` = '$userId' AND `file_submission_uploaded` = '$idSubmission'");

                                            $commentContentFile = array();
                                            while ($rowCmt =  mysqli_fetch_array($fileInfor)) {
                                                $commentContentFile[] = $rowCmt;
                                            }
                                            foreach ($commentContentFile as $rowComment) {
                                            ?>
                                                <p> <b><?= $rowComment['role'] ?></b><?= ": ", $rowComment['fullname'] ?></p>

                                                <p>Content: <?= $rowComment['file_comment_content'] ?></p>
                                                <p>Time: <?= date("Y-M-d H:i:s", $rowComment['file_comment_time']) ?></p>
                                                <hr>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Submission comments</td>
                                        <td>
                                            <div>
                                                <!--                        <form action="" method="post" enctype="multipart/form-data">-->
                                                <!--                            <div class="form-group">-->
                                                <!-- <label for="inputName">Comment</label>
                                                <textarea type="text" class="form-control" id="inputName" name="commentContent" placeholder="Name of article"></textarea> -->
                                                <!--                                <h3>Feedback</h3>-->
                                                <!--                                <textarea type="text" class="form-control" id="inputName" name="commentContent" placeholder="Feedback to student" style="width: 88%; height: 50px; border-radius: 3px; border-radius: 14px; resize: none; margin-bottom: 7% "></textarea>-->
                                                <!--                            </div>-->
                                                <!--                            <div class="form-group" style="text-align:center;">-->
                                                <!--                                <input type="submit" name="uploadCommnet" class="btn btn-succecss" value="Feedback" style="font-size: 20px; background-color: yellowgreen; border-radius:16px; display: inline-block; " id="uploadFile">-->
                                                <!--                            </div>-->
                                                <!--                        </form>-->
                                                <!--                    </div>-->
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <div class="input-group m-b-10">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">With textarea</span>
                                                        </div>
                                                        <!-- <textarea type="text" class="form-control" style="width: 88%; height: 50px; border-radius: 3px; border-radius: 14px; resize: none; margin-bottom: 7% "></textarea> -->
                                                        <textarea class="form-control" aria-label="With textarea" spellcheck="false" id="inputName" name="commentContent"></textarea>
                                                        <grammarly-extension data-grammarly-shadow-root="true" style="position: absolute; top: 0px; left: 0px; pointer-events: none; z-index: 3;" class="cGcvT"></grammarly-extension>
                                                    </div>
                                                    <div class="button-comment float-right">
                                                        <button type="submit" name="uploadCommnet" class="btn btn-warning">Comments</button>
                                                        <button class="btn btn-danger">Cancle</button>
                                                    </div>
                                                </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class=" card-footer button-submit text-center">

                            <?php
                            if ($timeSubmitFile < $deadline && $file->num_rows == 0) {
                            ?>
                                <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target=".modal-submit-artical">Add Submission
                                </button>
                            <?php
                            }
                            if ($timeSubmitFile < $deadline && $file->num_rows > 0) {
                            ?>
                                <button type="button" class="btn btn-lg btn-info" data-toggle="modal" data-target=".modal-submit-artical">Edit Submission
                                </button>
                            <?php
                            } elseif ($timeSubmitFile > $deadline && $timeSubmitFile < $secondDeadline && ($file->num_rows > 0)) {
                            ?>
                                <button type="button" class="btn btn-lg btn-warning" data-toggle="modal" data-target=".modal-submit-artical">Edit Submission
                                </button>
                            <?php
                            } elseif ($timeSubmitFile > $deadline && ($file->num_rows == 0)) {
                            ?>
                                <h5 style="color:red">Deadline for submission and correction has expired</h5>
                                <!-- <button type="button" class="btn btn-lg btn-warning" data-toggle="modal" data-target=".modal-submit-artical" disableds>Sdss Submission
                            </button> -->
                            <?php
                            }
                            ?>
                        </div>

                        <!--                    <form method="post">-->
                        <!--                        <input type="submit" name="uploadFile" class="btn btn-primary" value="uploadFile" id="uploadFile" />-->
                        <!--                    </form>-->

                        <!-- Modal -->

                        <div class="modal fade modal-submit-artical" tabindex="-1" role="dialog" aria-labelledby="submissionModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="submissionModal">Upload Article</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="upload-file" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="card-header">
                                                <p class="m-b-0 text-muted">
                                                    Students are need to provide complete information prior to submitting an
                                                    article.
                                                </p>
                                            </div>
                                            <!-- <form action="" method="post" enctype="multipart/form-data"> -->
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputName">Name of article</label>
                                                    <input type="text" class="form-control" id="inputName" name="nameArticle" placeholder="Name of article">
                                                </div>
                                                <!-- <div class="form-group col-md-6">
                                                    <label for="inputAuthor">Author</label>
                                                    <input type="text" class="form-control" id="inputAuthor" name="nameAuthor" value="<?= $userInforFaculty["fullname"] ?>" readonly>
                                                </div> -->
                                            </div>
                                            <div class="form-group">
                                                <div>

                                                    <div class="form-group">
                                                        <div>
                                                            <p class=" font-secondary">File Uploads</p>
                                                            <div class="input-group mb-3">
                                                                <div onload="GetFileInfo ()">
                                                                    <input type="file" class="custom-file-input" id="inputFile" name="inputFileArticle[]" multiple onchange="GetFileInfo ()">
                                                                    <label class="custom-file-label" for="inputFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                            <div id="info" style="margin-top:10px"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <label class="form-check-label" for="gridCheck">
                                                                <input class="form-check-input" type="checkbox" id="gridCheck" name="agree">
                                                                I agree to the Terms and Conditions
                                                            </label>
                                                        </div>
                                                        <label for="agree" class="error"></label>
                                                    </div>
                                                    <div class="form-group  float-right">
                                                        <input type="submit" name="uploadFile" class="btn btn-primary" value="uploadFile" id="uploadFile"></input>
                                                        <!--                                    <button type="submit" value="Upload" name="uploadFile" class="btn btn-primary" value="uploadFile" id="uploadFile" onclick="onUploadI()">Submit</button>--> <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                            Close
                                                        </button>
                                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </section>
        </main>
        </section>

        <head>
            <script type="text/javascript">
                var mess = "";
                var count = 0;

                function GetFileInfo() {
                    var fileInput = document.getElementById("inputFile");
                    var message = "";
                    if ('files' in fileInput) {
                        if (fileInput.files.length == 0) {
                            message = "Please browse for one or more files.";
                        } else {
                            for (var i = 0; i < fileInput.files.length; i++) {
                                count = count + 1;
                                message += "<br /><b>File" + count + "</b><br />";
                                var file = fileInput.files[i];
                                if ('name' in file) {
                                    message += "Name of file: " + file.name + "<br />";
                                } else {
                                    message += "Name of file: " + file.fileName + "<br />";
                                }
                                if ('size' in file) {
                                    message += "Size of file: " + file.size + " bytes <br />";
                                } else {
                                    message += "Size of file: " + file.fileSize + " bytes <br />";
                                }
                                if ('mediaType' in file) {
                                    message += "Type: " + file.mediaType + "<br />";
                                }
                            }
                        }
                    } else {
                        if (fileInput.value == "") {
                            message += "Please browse for one or more files!";
                            message += "<br />Use the Control or Shift key for multiple selection.";
                        } else {
                            message += "Your browser doesn't support the files property!";
                            message += "<br />The path of the selected file: " + fileInput.value;
                        }
                    }
                    mess = mess + message;
                    var info = document.getElementById("info");
                    info.innerHTML = mess;

                }
            </script>
        </head>

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
        <script src="../assets/vendor/jquery.validate/jquery.validate.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#upload-file").validate({
                    rules: {
                        nameArticle: {
                            required: true,
                            minlength: 3,
                        },
                        'inputFileArticle[]': {
                            required: true,
                        },
                        agree: {
                            required: true,
                        },
                    },
                    messages: {
                        nameArticle: {
                            required: "Please provide information.",
                            minlength: "Please provide information.",
                        },
                        'inputFileArticle[]': {
                            required: "Please provide information.",
                        },
                        agree: {
                            required: "Please agree Terms before submit."
                        }
                    },
                })
            });
        </script>
    </body>

    </html>
<?php

} else {
    header('location: ../account/login.php');
}
?>