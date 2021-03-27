<?php
include "../../config.php";

$isError = false;
$msg = "";

$topic = $conn->query("SELECT * from topic");
$topicSubmit = mysqli_fetch_assoc($topic);

if ($topicSubmit != NULL) {
    $topicSubmit = mysqli_fetch_assoc($topic);
    $selected_date = ($topicSubmit["topic_deadline"]);
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


$infor = $conn->query("SELECT f.*, t.* FROM topic as t INNER JOIN faculty as f ON  t.faculty_id = f.f_id ");
if (!$infor) die($conn->error);
$topicInfor = array();
while ($topicF = mysqli_fetch_array($infor)) {
    $topicInfor[] = $topicF;
}

if (isset($_POST["addTopic"])) {
    var_dump($_POST);

    $count = 0;
    $sql_user = "SELECT * from topic where topic_id ='$_POST[topicId]'";
    $res = mysqli_query($conn, $sql_user) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        $isError = true;
        $msg = "Topic Id exits!";
    } else {
        $addFaculty = mysqli_query($conn, "INSERT INTO `topic` (`id`, `topic_id`, `topic_name`, `topic_description`, `topic_deadline`,`faculty_id`) VALUES (NULL, '$_POST[topicId]', '$_POST[topicName]', '$_POST[topicDescription]', '$_POST[startDeadLine]','$_POST[facultyOption]');");
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
                        Create New Topic
                    </h5>
                    <p class="m-b-0 text-muted">
                        Please input fullfill information to create topic.
                    </p>
                </div>
                <div class="card-body ">
                    <form action="" name="manageTopic" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputName1">Id of Topic</label>
                            <input type="text" class="form-control" id="inputTopicId" name="topicId" placeholder="Enter id of topic" required>
                        </div>
                        <div class="form-group">
                            <label for="inputName1">Name of Topic</label>
                            <input type="text" class="form-control" id="inputTopicName" name="topicName" placeholder="Enter name of topic" required>
                        </div>
                        <div class="form-group">
                            <label for="inputRole" class="col-md-12" style="padding: 0">Add topic to Faculty</label>
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
                            <label for="inputName1">Description of Topic</label>
                            <input type="text" class="form-control" id="inputTopicDescription" name="topicDescription" placeholder="Enter name of topic" required>
                        </div>
                        <div class="form-group">
                            <label>Select Begin Date</label>
                            <input type="datetime-local" class="form-control" id="startDeadLine" name="startDeadLine">
                        </div>
                        <input type="submit" class="btn btn-primary btn-md float-right" name="addTopic" value="Create Topic">
                    </form>
                </div>

            </div>
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="m-b-0">
                        Create New Topic
                    </h5>
                    <p class="m-b-0 text-muted">
                        Please input fullfill information to create topic.
                    </p>
                </div>
                <div class="card-body ">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Topic id</th>
                            <th>Topic name</th>
                            <th>Topic of Faculty</th>
                            <th>Topic description</th>
                            <th>Topic Start deadline</th>
                            <th>Topic End deadline</th>
                            <th>View Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        foreach ($topicInfor as $row) {
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row["topic_id"]; ?></td>
                                <td><?php echo $row["topic_name"]; ?></td>
                                <td><?php echo $row["f_name"]; ?></td>
                                <td><?php echo $row["topic_description"]; ?></td>
                                <td><?php echo  $row["topic_deadline"] ?></td>
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
