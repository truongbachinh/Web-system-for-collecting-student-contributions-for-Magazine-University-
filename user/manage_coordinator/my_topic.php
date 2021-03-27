<?php
include "../../config.php";
// $idFaculty = $_GET['idl'];
$userFacultyId = $_SESSION["current_user"]["faculty_id"];
$userId = $_SESSION["current_user"]["u_id"];


$topic = $conn->query("SELECT faculty.*,user.*, topic.* FROM (( faculty INNER JOIN topic ON faculty.f_id = topic.faculty_id) INNER JOIN user ON faculty.f_id = user.faculty_id) WHERE user.u_id = '$userId' AND user.role = 'manager-coordinator'");
$topic = $conn->query("SELECT * FROM topic");
$topicSubmit = mysqli_fetch_assoc($topic);

if ($topicSubmit != NULL) {

    $selected_date = ($topicSubmit["topic_deadline"]);
    // echo $selected_date, "a ";
    $duration = 14;
    $duration_type = 'day';
    $date1 = ("2021/05/06 22:00:00");
    $deadline = date('Y/m/d H:i:s', strtotime($selected_date . ' +' . $duration . ' ' . $duration_type));
}


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
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Topic name</th>
                                        <th>Topic description</th>
                                        <th>Topic Start deadline</th>
                                        <th>Topic End deadline</th>
                                        <th>View Detail</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    // $topicInfor = $conn->query("SELECT faculty.*,user.*, topic.* FROM (( faculty INNER JOIN topic ON faculty.f_id = topic.faculty_id) INNER JOIN user ON faculty.f_id = user.faculty_id) WHERE user.u_id = '$userId' AND user.role = 'manager-coordinator'");
                                    $topicInfor = $conn->query("SELECT user.*, topic.*, faculty.* FROM topic INNER JOIN user ON user.u_id = user.u_id INNER JOIN faculty ON faculty.f_id = user.faculty_id WHERE user.u_id = '$userId' AND user.role = 'manager-coordinator'");

                                    $topicFacultyInfor = array();
                                    while ($tInfor = mysqli_fetch_array($topicInfor)) {
                                        $topicFacultyInfor[] = $tInfor;
                                    }
                                    foreach ($topicFacultyInfor as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>

                                            <td><?php echo $row["topic_name"]; ?></td>
                                            <td><?php echo $row["topic_description"]; ?></td>
                                            <td><?php echo $row["topic_deadline"] ?></td>
                                            <td><?= $deadline ?></td>
                                            <td ><a type="button" class="btn btn-primary" href="listofreport.php?idt=<?= $row["id"] ?>">Select</a>
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
        </section>
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
<?php
if (isset($_POST["addTopic"])) {
    var_dump($_POST);

    $count = 0;
    $sql_user = "SELECT * from topic where topic_id ='$_POST[topicId]'";
    $res = mysqli_query($conn, $sql_user) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        ?>
        <script type="text/javascript">
            alert("Topic Id exits !");
            window.location.replace("./add-topic.php?idl=<?= $idFaculty ?>");
        </script>
        <?php
    } else {
        $addFaculty = mysqli_query($conn, "INSERT INTO `topic` (`id`, `topic_id`, `topic_name`, `topic_description`, `topic_deadline`, `topic_of_faculty`) VALUES (NULL, '$_POST[topicId]', '$_POST[topicName]', '$_POST[topicDescription]', '$_POST[startDeadLine]', '$idFaculty');");
        ?>
        <script type="text/javascript">
            alert("add faculty success !");
            window.location.replace("./add-topic.php?idl=<?= $idFaculty ?>");
        </script>
        <?php
    }
}
?>