<?php
include "../config.php";

$isError = false;
$msg = "";

$submission = $conn->query("SELECT * from submission");
$submissionSubmit = mysqli_fetch_assoc($submission);

if ($submissionSubmit != NULL) {
    $submissionSubmit = mysqli_fetch_assoc($submission);
    $selected_date = ($submissionSubmit["submission_deadline"]);
    // echo $selected_date, "a ";
    $duration = 14;
    $duration_type = 'day';
    $date1 = ("2021/05/06 22:00:00");
    $deadline = date('Y/m/d H:i:s', strtotime($selected_date . ' +' . $duration . ' ' . $duration_type));
}

$resFaculty = $conn->query("SELECT * from faculty");
$faculty = array();
while ($rowFaculty =  mysqli_fetch_array($resFaculty)) {
    $faculty[] = $rowFaculty;
}


$infor = $conn->query("SELECT f.*, t.* FROM submission as t INNER JOIN faculty as f ON  t.faculty_id = f.f_id ");
if (!$infor) die($conn->error);
$submissionInfor = array();
while ($submissionF = mysqli_fetch_array($infor)) {
    $submissionInfor[] = $submissionF;
}

if (isset($_POST["addSubmission"])) {
    var_dump($_POST);

    $count = 0;
    $sql_user = "SELECT * from submission where submission_id ='$_POST[submissionId]'";
    $res = mysqli_query($conn, $sql_user) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        $isError = true;
        $msg = "Submission Id exits!";
    } else {
        $addFaculty = mysqli_query($conn, "INSERT INTO `submission` (`id`, `submission_id`, `submission_name`, `submission_description`, `submission_deadline`,`faculty_id`) VALUES (NULL, '$_POST[submissionId]', '$_POST[submissionName]', '$_POST[submissionDescription]', '$_POST[startDeadLine]','$_POST[facultyOption]');");
        if ($addFaculty) {
            $msg = "Successfully added faculty.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/html_header.php"; ?>
</head>

<body class="sidebar-pinned ">
    <?php include "../partials/aside.php"; ?>
    <main class="admin-main">
        <?php include "../partials/header.php"; ?>

        <!-- PLACE CODE INSIDE THIS AREA -->

        <section class="admin-content">
            <div class="container m-t-30 m-b-30">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">
                            Create New Submission
                        </h5>
                        <p class="m-b-0 text-muted">
                            Please input fullfill information to create submission.
                        </p>
                    </div>
                    <div class="card-body ">
                        <form action="" name="manageSubmission" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="inputName1">Id of Submission</label>
                                <input type="text" class="form-control" id="inputSubmissionId" name="submissionId" placeholder="Enter id of submission" required>
                            </div>
                            <div class="form-group">
                                <label for="inputName1">Name of Submission</label>
                                <input type="text" class="form-control" id="inputSubmissionName" name="submissionName" placeholder="Enter name of submission" required>
                            </div>
                            <div class="form-group">
                                <label for="inputRole" class="col-md-12" style="padding: 0">Add submission to Faculty</label>
                                <select name="facultyOption" class="form-select" style="width: 100%;height: 34px;border-color: #D4D2D2;border-radius: 5px">
                                    <option selected>--Select Faculty--</option>
                                    <?php
                                    foreach ($faculty as $selectFacuty) {
                                    ?>
                                        <option value="<?= $selectFacuty["f_id"] ?>"><?= $selectFacuty["f_name"] ?></option>


                                    <?php

                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputName1">Description of Submission</label>
                                <input type="text" class="form-control" id="inputSubmissionDescription" name="submissionDescription" placeholder="Enter name of submission" required>
                            </div>
                            <div class="form-group">
                                <label>Select Begin Date</label>
                                <input type="datetime-local" class="form-control" id="startDeadLine" name="startDeadLine">
                            </div>
                            <input type="submit" class="btn btn-primary btn-md float-right" name="addSubmission" value="Create Submission">
                        </form>
                    </div>

                </div>
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">
                            Create New Submission
                        </h5>
                        <p class="m-b-0 text-muted">
                            Please input fullfill information to create submission.
                        </p>
                    </div>
                    <div class="card-body ">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Submission id</th>
                                    <th>Submission name</th>
                                    <th>Submission of Faculty</th>
                                    <th>Submission description</th>
                                    <th>Submission Start deadline</th>
                                    <th>Submission End deadline</th>
                                    <th>View Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($submissionInfor as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row["submission_id"]; ?></td>
                                        <td><?php echo $row["submission_name"]; ?></td>
                                        <td><?php echo $row["f_name"]; ?></td>
                                        <td><?php echo $row["submission_description"]; ?></td>
                                        <td><?php echo  $row["submission_deadline"] ?></td>
                                        <td><?= $deadline ?></td>
                                        <td style="color: red"><a href="#.php?idt=<?= $row["id"] ?>">Select</a></td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

</body>

</html>