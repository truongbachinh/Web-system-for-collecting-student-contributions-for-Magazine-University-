<?php
session_start();
include "../../connect_db.php";
$idFile = $_GET['idfile'];
$userFacultyId = $_SESSION["current_user"]["faculty_id"];
$userId = $_SESSION["current_user"]["u_id"];
$fileContent = $conn->query("SELECT * from `file_content` where `file_submit_Id` = '$idFile'");
// $viewFile = array();
// while ($view = mysqli_fetch_array($fileContent)) {
//     $viewFile[] = $view;
// }

?>
<?php
if (isset($_POST['uploadCommnet'])) {

    $uploadCmt = $conn->query("INSERT INTO `file_comment` (`file_comment_id`, `file_comment_content`, `file_comment_time`, `file_comment_user`, `file_submited_id`) VALUES (NULL, '$_POST[commentContent]', '" . time() . "', '$userId', '$idFile'); ");
    $changeStatus = $conn->query("UPDATE `file_submit_to_topic` SET `file_status` = '$_POST[statusOfFile]' where `id` = '$idFile'");
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

<body>
    <main class="admin-main">
        <section id="container">
            <?php include 'header.php' ?>
            <section>
                <section class="wrapper ">
                    <div class="row ">
                        <div class="col-lg-9 main-chart ">
                            <?php
                            $count = 1;
                            if ($fileContent->num_rows > 0) {
                                while ($row = $fileContent->fetch_assoc()) {

                                    $imageURL = '../student/file_library/' . $row["file_content_name"];
                            ?>
                                    <div>
                                        <p>File STT <?= $count++ ?></p>
                                        <a href="<?= $row['file_content_name'] ?>"> <img src="<?php echo $imageURL; ?>" alt="" width="70" height="70" class="img-fluid" id="img-view-details" />
                                        </a>

                                    </div>

                            <?php }
                            }
                            ?>
                        </div>

                        <div class="col-lg-3 ds " style="position: fixed; right: 0; z-index: 1;height: 100%; ">
                            <!--COMPLETED ACTIONS DONUTS CHART-->
                            <div class="donut-main row ">
                                <div class=" col-lg-12 text-right ">
                                    <a href="#!" class="mdi mdi-24px mdi-close text-muted"></a>
                                    <a class="iconify" data-icon="ion:close" data-inline="false"></a>
                                </div>
                                <div class=" col-lg-12 text-left row mt-1">
                                    <div class=" col-md-4 text-center">
                                        <img src="img/Rectangle 54.png ">
                                    </div>
                                    <div class="col-md-8 mt-1">
                                        <h5 style="color: #000; ">Nguyen Minh Phong</h5>
                                        <h5 style="color: #000; ">Topic Cloud computing</h6>
                                    </div>
                                </div>
                                <div class=" col-lg-12 text-left ">
                                    <h4 style="font-weight: bolder; color: #000; margin: 3% 1%;">Submission</h4>
                                </div>
                                <div class=" col-lg-12 text-left ">
                                    <div style="background-color: #06D6A0; height: 40px; ">
                                        <div style="margin-top: 4%; font-size: 18px; font-weight: 400;color: #000; padding-top: 2% !important; padding-left: 3%;">
                                            Submitted for approved</div>
                                    </div>
                                </div>
                                <div class=" col-lg-12 text-left ">
                                    <div style="color: #000;margin-top: 6%; font-size: 18px; font-weight: 400; ">Student cannot edit this submission
                                    </div>
                                </div>
                                <div class=" col-lg-12 text-left row mt-2">
                                    <div class=" col-lg-12 text-left row m-1">
                                        <hr class=" col-md-2 " style="margin: 3% 1% ;width: 1%;height: 2px;border-width: 0;color: gray;background-color: gray; flex: 0 0 2.66667%; ">
                                        </hr>
                                        <div class=" col-md-10 " style="color: #000; font-size: 12px; font-weight: 400; ">V1.0 PHONG98 - Validation Phong</div>
                                    </div>
                                    <div class=" col-lg-12 text-left row  m-1">
                                        <hr class=" col-md-2 " style="margin: 3% 1% ;width: 1%;height: 2px;border-width: 0;color: gray;background-color: gray; flex: 0 0 2.66667%; ">
                                        </hr>
                                        <div class=" col-lg-10" style="color: #000; font-size: 12px; font-weight: 400; ">V1.0 PHONG98 - Validation Phong</div>
                                    </div>
                                </div>
                                <div class=" col-md-12 col-lg-12 col-xs-12 text-left " style=" margin-top:7%; width: 80%; margin-left: 5%; border-radius: 15px ">
                                    <h3>Feedback</h3>
                                    <textarea style="width: 88%; height: 180px; border-radius: 3px; border-radius: 14px; resize: none; margin-bottom: 7% "></textarea>
                                </div>
                                <div class=" col-md-12 col-lg-12 col-xs-12 text-right row" style="margin-top: 4%; ">
                                    <div class="col-md-6 col-lg-6 col-xs-6 ">
                                        <button class="btn btn-primary ">Approved</button>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xs-6 text-left " style="padding-left: 12%">
                                        <button class="btn btn-danger ">Reject</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </section>
            </section>
            <hr>
            <br>
            <br>
            <div>
                <h5>Form comment</h5>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="form-group col-md-6">
                            <label for="inputName">Comment</label>
                            <textarea type="text" class="form-control" id="inputName" name="commentContent" placeholder="Name of article"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6" style="padding: 0">Status of file submited</label>
                            <select name="statusOfFile" class="form-select" style="width:50%; height: 34px;border-color: #D4D2D2;border-radius: 5px">
                                <option selected>--Select status--</option>
                                <option value="2">Approved</option>
                                <option value="3">Reject</option>

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="submit" name="uploadCommnet" class="btn btn-succecss" value="Comment" id="uploadFile"></input>
                        </div>
                    </div>
                </form>
                <footer class="site-footer " style="width: 75%; ">
                    <div class="text-center ">
                        <p>
                            &copy; Copyrights <strong>Dashio</strong>. All Rights Reserved
                        </p>
                        <div class="credits ">
                            Created with Dashio template by <a href="# ">TemplateMag</a>
                        </div>
                        <a href="index.html# " class="go-top ">
                            <i class="fa fa-angle-up "></i>
                        </a>
                    </div>
                </footer>
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