<?php
include "../config.php";



$isError = false;
$msg = "";

$submission = $conn->query("SELECT * from submission");
$submissionSubmit = mysqli_fetch_assoc($submission);



// $resFaculty = $conn->query("SELECT * from faculty");
// $faculty = array();
// while ($rowFaculty =  mysqli_fetch_array($resFaculty)) {
//     $faculty[] = $rowFaculty;
// }


// $infor = $conn->query("SELECT faculty.*, submission.* FROM submission ");
// if (!$infor) die($conn->error);
// $submissionInfor = array();
// while ($submissionF = mysqli_fetch_array($infor)) {
//     $submissionInfor[] = $submissionF;
// }

if (isset($_POST["addSubmission"])) {


    $count = 0;
    $sql_user = "SELECT * from submission where submission_name ='$_POST[submissionName]'";
    $res = mysqli_query($conn, $sql_user) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        $isError = true;
        $msg = "Submission Id exits!";
    } else {
        $addFaculty = mysqli_query($conn, "INSERT INTO `submission` (`id`,  `submission_name`, `submission_description`, `submission_deadline`) VALUES (NULL,  '$_POST[submissionName]', '$_POST[submissionDescription]', '$_POST[startDeadLine]');");
        if ($addFaculty) {
            $msg = "Successfully added Submission.";
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

        <section class="manage-submission">
            <div class="container m-t-30">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4> Manage Submission </h4>
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
                                    <div class="col-sm-6 ">
                                        <a href="" class="btn btn-info float-right" role="button" data-toggle="modal" data-target="#addSubmission"><i class="mdi mdi-clipboard-plus"></i> Add Submission
                                        </a>
                                    </div>
                                </div>
                                <div class="table-responsive p-t-10">
                                    <table id="example" class="table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Submission Name</th>
                                                <th>Submission Description</th>
                                                <th>Submission Start Deadline</th>
                                                <th>Submission End Deadline</th>
                                                <!-- <th>Articles</th> -->
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $res = mysqli_query($conn, "SELECT * from submission");
                                            while ($row = mysqli_fetch_array($res)) {
                                                if ($submissionSubmit != NULL) {
                                                    $submissionSubmit = mysqli_fetch_assoc($submission);
                                                    $selected_date = ($row["submission_deadline"]);
                                                    // echo $selected_date, "a ";
                                                    $duration = 14;
                                                    $duration_type = 'day';

                                                    $deadline = date('Y/m/d H:i:s', strtotime($selected_date . ' +' . $duration . ' ' . $duration_type));
                                                }
                                            ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?php echo $row["submission_name"]; ?></td>
                                                    <td><?php echo $row["submission_description"]; ?></td>
                                                    <td><?php echo $row["submission_deadline"]; ?></td>
                                                    <td><?php echo $deadline; ?></td>
                                                    <td><span class="badge badge-warning">Processing</span></td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="" class="btn btn-info btn-get-info" role="button" data-id="<?= $row['id'] ?>"><i class="mdi mdi-pencil-outline"></i> </a>
                                                            <a href="" class="btn btn-danger btn-delete-submission" role="button" data-id="<?= $row['id'] ?>"><i class="mdi mdi-delete"></i>
                                                            </a>
                                                            <a href="" class="btn btn-primary btn-detail-submission" role="button" data-id="<?= $row['id'] ?>"><i class="mdi mdi-dots-horizontal"></i> </a>
                                                        </div>
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
                <!-- Modal add faculty -->
                <div class="modal fade" id="addSubmission" tabindex="-1" role="dialog" aria-labelledby="addSubmission" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addSubmission">Add Submission</h5>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" name="manageSubmission" method="POST" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="inputName1">Name of Submission</label>
                                        <input type="text" class="form-control" id="inputSubmissionName" name="submissionName" placeholder="Enter name of submission" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName1">Description of Submission</label>
                                        <input type="text" class="form-control" id="inputSubmissionDescription" name="submissionDescription" placeholder="Enter name of submission" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Begin Date</label>
                                        <input type="datetime-local" class="form-control" id="startDeadLine" name="startDeadLine">
                                    </div>

                                    <div class="model-footer">
                                        <input type="submit" class="btn btn-primary btn-md float-right" name="addSubmission" value="Create Submission">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Modal edit -->
                <div class="modal fade" id="editSubmission" tabindex="-1" role="dialog" aria-labelledby="editSubmission" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editSubmission">Edit Submission</h5>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <div class="form-group">
                                        <label for="inputNameSubmission">Submission Name</label>
                                        <input type="text" class="form-control" id="submissionName" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="example-date-input">Deadline</label>
                                        <input class="form-control" type="datetime-local" id="deadline">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputManager">Description</label>
                                        <textarea class="form-control" id="description" aria-label="With textarea" spellcheck="false"></textarea>
                                        <grammarly-extension data-grammarly-shadow-root="true" style="position: absolute; top: 0px; left: 0px; pointer-events: none; z-index: 3;" class="cGcvT"></grammarly-extension>
                                    </div>

                                    <div class="model-footer">
                                        <input type="button" class="btn btn-warning btn-update-submission" name="change" value="Save Changes">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Modal Detail -->
                <div class="modal fade" id="detailSubmission" tabindex="-1" role="dialog" aria-labelledby="detailSubmission" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailSubmission">Detai
                                    Infomation Submission
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="detail">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Submission Name</td>
                                                <td id="t-name"></td>
                                            </tr>
                                            <tr>
                                                <td>Submission ID</td>
                                                <td id="t-id"></td>
                                            </tr>
                                            <tr>
                                                <td>Start Date</td>
                                                <td id="t_deadline"></td>
                                            </tr>
                                            <tr>
                                                <td>Deadline</td>
                                                <td>22/20/2021</td>
                                            </tr <tr>
                                            <td>Description</td>
                                            <td id="t-description">
                                            </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="button-close float-right">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
        </section>
        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function(e) {
            let activeId = null;
            $(document).on('click', ".btn-get-info", function(e) {
                e.preventDefault();
                const submissionId = parseInt($(this).data("id"));
                activeId = submissionId;
                console.log(submissionId)
                Utils.api("get_submission_info", {
                    id: submissionId
                }).then(response => {
                    console.log(response.data.submission_deadline.split(' ')[0])
                    $('#submissionName').val(response.data.submission_name);
                    $('#submissionCode').val(response.data.submission_id);
                    $('#description').val(response.data.submission_description);
                    $('#deadline').val(response.data.submission_deadline.replace(" ", "T").slice(0, -3));
                    $('#editSubmission').modal();
                }).catch(err => {

                })
            });

            $(document).on('click', ".btn-update-submission", function(e) {
                Utils.api('update_submission_info', {
                    id: activeId,
                    deadline: $("#deadline").val().replace("T", " ") + ":00",
                    submissionName: $('#submissionName').val(),
                    submissionCode: $('#submissionCode').val(),
                    description: $('#description').val()
                }).then(response => {
                    $("#editFaculty").modal("hide");
                    swal("Notice", "Record is updated successfully!", "success").then(function(e) {
                        location.reload()
                    });
                }).catch(err => {})
            })

            $(document).on('click', ".btn-delete-submission", function(e) {
                e.preventDefault();
                swal({
                    title: "Please confirm",
                    text: 'Are sure you want to delete this submission?',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        Utils.api('delete_submission', {
                            id: $(this).data('id'),
                        }).then(response => {
                            $("#editFaculty").modal("hide");
                            swal("Notice", response.msg, "success").then(function(e) {
                                location.reload();
                            });
                        }).catch(err => {})
                    }
                });
            });

            $(document).on('click', '.btn-detail-submission', function(e) {
                e.preventDefault();
                const submissionId = parseInt($(this).data("id"));
                Utils.api('get_submission_info', {
                    id: submissionId
                }).then(response => {
                    $('#t-name').text(response.data.submission_name);
                    $('#t-id').text(response.data.submission_id);
                    $('#t_deadline').text(response.data.submission_deadline)
                    $('#t-description').text(response.data.submission_description)
                    $('#detailSubmission').modal();
                }).catch(err => {

                })
            });
        })
    </script>
</body>

</html>