<?php
include "../config.php";
// $idFaculty = $_GET['idl'];
$userFacultyId = $_SESSION["current_user"]["faculty_id"];
$userId = $_SESSION["current_user"]["u_id"];


$submission = $conn->query("SELECT faculty.*,user.*, submission.* FROM (( faculty INNER JOIN submission ON faculty.f_id = submission.faculty_id) INNER JOIN user ON faculty.f_id = user.faculty_id) WHERE user.u_id = '$userId' AND user.role = 'manager-coordinator'");
$submission = $conn->query("SELECT * FROM submission");
$submissionSubmit = mysqli_fetch_assoc($submission);

if ($submissionSubmit != NULL) {

    $selected_date = ($submissionSubmit["submission_deadline"]);
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
                                    <table class="table text-center">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Submission name</th>
                                                <th>Submission description</th>
                                                <th>Submission Start deadline</th>
                                                <th>Submission End deadline</th>
                                                <th>Quantity student submit</th>
                                                <th>View Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            // $submissionInfor = $conn->query("SELECT faculty.*,user.*, submission.* FROM (( faculty INNER JOIN submission ON faculty.f_id = submission.faculty_id) INNER JOIN user ON faculty.f_id = user.faculty_id) WHERE user.u_id = '$userId' AND user.role = 'manager-coordinator'");
                                            $submissionInfor = $conn->query("SELECT user.*, submission.*, faculty.* FROM submission INNER JOIN user ON user.u_id = user.u_id INNER JOIN faculty ON faculty.f_id = user.faculty_id WHERE user.u_id = '$userId' AND user.role = 'manager-coordinator'");

                                            $submissionFacultyInfor = array();
                                            while ($tInfor = mysqli_fetch_array($submissionInfor)) {
                                                $submissionFacultyInfor[] = $tInfor;
                                            }
                                            foreach ($submissionFacultyInfor as $row) {
                                                $submissionIdAll = $row['id'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>

                                                    <td><?php echo $row["submission_name"]; ?></td>
                                                    <td><?php echo $row["submission_description"]; ?></td>
                                                    <td><?php echo $row["submission_deadline"] ?></td>
                                                    <td><?= $deadline ?></td>
                                                    <?php
                                                    $countSubmit = $conn->query("SELECT COUNT(file_submit_to_submission.id) from file_submit_to_submission INNER JOIN submission ON submission.id = file_submit_to_submission.file_submission_uploaded WHERE file_submit_to_submission.file_submission_uploaded = ' $submissionIdAll'");

                                                    $studentSubmitCount = mysqli_fetch_assoc($countSubmit);
                                                    if ($studentSubmitCount["COUNT(file_submit_to_submission.id)"]) {
                                                    ?>
                                                        <td>
                                                            <button class="btn btn-info"> <?= $studentSubmitCount["COUNT(file_submit_to_submission.id)"] ?></button>
                                                        </td>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <td>
                                                            <?= $studentSubmitCount["COUNT(file_submit_to_submission.id)"] ?>
                                                        </td>

                                                    <?php
                                                    }

                                                    ?>
                                                    <td><a type="button" class="btn btn-primary" href="listofreport.php?idt=<?= $row["id"] ?>">Select</a>
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
    </main>

    <script src='https://d33wubrfki0l68.cloudfront.net/bundles/85bd871e04eb889b6141c1aba0fedfa1a2215991.js'></script>
    <!--page specific scripts for demo-->
    <script async src="https://www.googletagmanager.com/gtag/js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->

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
if (isset($_POST["addSubmission"])) {
    var_dump($_POST);

    $count = 0;
    $sql_user = "SELECT * from submission where submission_id ='$_POST[submissionId]'";
    $res = mysqli_query($conn, $sql_user) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res);

    if ($count > 0) {
?>
        <script type="text/javascript">
            alert("Submission Id exits !");
            window.location.replace("./add-submission.php?idl=<?= $idFaculty ?>");
        </script>
    <?php
    } else {
        $addFaculty = mysqli_query($conn, "INSERT INTO `submission` (`id`, `submission_id`, `submission_name`, `submission_description`, `submission_deadline`, `submission_of_faculty`) VALUES (NULL, '$_POST[submissionId]', '$_POST[submissionName]', '$_POST[submissionDescription]', '$_POST[startDeadLine]', '$idFaculty');");
    ?>
        <script type="text/javascript">
            alert("add faculty success !");
            window.location.replace("./add-submission.php?idl=<?= $idFaculty ?>");
        </script>
<?php
    }
}
?>