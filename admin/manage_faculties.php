<?php
include "../config.php";


$msg = "";

if (isset($_POST["submitFaculty"])) {
    $count = 0;
    $sql_user = "SELECT * from faculty where faculty_id ='$_POST[idFaculty]'";
    $res = mysqli_query($conn, $sql_user) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        $msg = "Faculty ID is already exist.";
    } else {
        $addFaculty = mysqli_query($conn, "INSERT INTO `faculty` (`f_id`, `f_name`, `f_description`, `f_manager`, `faculty_id`) VALUES (NULL, '$_POST[nameFaculty]', '$_POST[descriptionFaculty]', '$_POST[facultyManage]', '$_POST[idFaculty]');");
        $msg = "Successfully added faculty.";
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

        <section class="manage-faculty">
            <div class="container m-t-30">
                <div class="row">
                    <?php if ($msg !== "") : ?>
                        <div class="col-12">
                            <div class="alert" role="alert">
                                <?= $msg; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4> Manage Faculty </h4>
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
                                        <a href="" class="btn btn-info float-right" role="button" data-toggle="modal" data-target="#addfaculty"><i class="mdi mdi-clipboard-plus"></i> Add Faculty
                                        </a>
                                    </div>
                                </div>
                                <div class="table-responsive p-t-10">
                                    <table id="example" class="table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Faculty ID</th>
                                                <th>Name Faculty</th>
                                                <th>Description Faculty</th>
                                                <th>Manager Facutly</th>
                                                <!-- <th>Submissions</th>
                                        <th>Articles</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $res = mysqli_query($conn, "select * from faculty");
                                            while ($row = mysqli_fetch_array($res)) {
                                            ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $row["faculty_id"] ?></td>
                                                    <td><?= $row["f_name"] ?></td>
                                                    <td><?= $row["f_description"] ?></td>
                                                    <td><?= $row["f_manager"] ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="" class="btn btn-info btn-edit-faculty" role="button" data-id="<?php echo $row["f_id"] ?>"><i class="mdi mdi-pencil-outline"></i> </a>
                                                            <a href="" class="btn btn-danger btn-delete-faculty" data-id="<?php echo $row["f_id"] ?>"><i class="mdi mdi-delete"></i> </a>
                                                            <a href="" class="btn btn-primary btn-detail-faculty" data-id="<?php echo $row["f_id"] ?>" role="button"><i class="mdi mdi-dots-horizontal"></i> </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>

                                        </tbody>
                                    </table>


                                    <!-- Modal add faculty -->
                                    <div class="modal fade" id="addfaculty" tabindex="-1" role="dialog" aria-labelledby="addfaculty" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addfaculty">Add Faculty</h5>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" name="addFaculty" method="POST" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="inputfacultyId">Faculty ID</label>
                                                            <input type="text" class="form-control" id="inputFacultyId" name="idFaculty" placeholder="Input Id" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputNameFaculty">Name Faculty</label>
                                                            <input type="text" class="form-control" id="inputNameFaculty" name="nameFaculty" placeholder="Input name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputNameFaculty">Manage Faculty</label>
                                                            <input type="text" class="form-control" id="inputFacultyFaculty" name="facultyManage" placeholder="Input name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputManager">Faculty Desciption </label>
                                                            <textarea class="form-control" aria-label="With textarea" name="descriptionFaculty" spellcheck="false"></textarea>
                                                            <grammarly-extension data-grammarly-shadow-root="true" style="position: absolute; top: 0px; left: 0px; pointer-events: none; z-index: 3;" class="cGcvT"></grammarly-extension>
                                                        </div>
                                                        <input type="submit" class="btn btn-warning btn-add-faculty" name="submitFaculty" value="Create Faculty">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                            Close
                                                        </button>

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Model edit -->
                                <div class="modal fade" id="editFaculty" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit
                                                    Faculty
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">
                                                    <div class="form-group">
                                                        <label for="inputNameFaculty">Name Faculty</label>
                                                        <input type="text" class="form-control" id="facultyName">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="facultyNameId">Faculty Code</label>
                                                        <input type="text" class="form-control" id="facultyNameId">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="facultyNameId">Faculty Manager</label>
                                                        <input type="text" class="form-control" id="facultyManager">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputManager">Description</label>
                                                        <textarea class="form-control" aria-label="With textarea" id="description" spellcheck="false"></textarea>
                                                        <grammarly-extension data-grammarly-shadow-root="true" style="position: absolute; top: 0px; left: 0px; pointer-events: none; z-index: 3;" class="cGcvT"></grammarly-extension>
                                                    </div>
                                                    <input type="button" class="btn btn-primary btn-update-faculty" name="change" value="Save changes">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        Close
                                                    </button>

                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal delete -->
                        </div>
                    </div>
                </div>
            </div>
        </section>




        <div class="modal fade" id="deleteFaculty" tabindex="-1" role="dialog" aria-labelledby="deleteFaculty" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-align-top-left" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteFaculty">Confirm Delete Faculty
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        This action cannot undo. Are you sure you want to delete this
                        faculty?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Detail -->

        <div class="modal fade" id="detailFaculty" tabindex="-1" role="dialog" aria-labelledby="detailFaculty" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailFaculty">Detail Information Faculty
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-t-0 p-l-0 p-r-0">
                        <div class="detail">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Name Faculty</td>
                                        <td id="f-name"></td>
                                    </tr>
                                    <tr>
                                        <td>Faculty ID</td>
                                        <td id="f-id"></td>
                                    </tr>
                                    <tr>
                                        <td>Manager Faculty</td>
                                        <td id="f_manager"></td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td id="f-description">
                                            Description here...
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <div class="button-close float-right">
                            <button type="button" class="btn btn-secondary m-r-10" data-dismiss="modal">
                                Close
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            let activeId = null;
            $(document).on('click', '.btn-edit-faculty', function(e) {
                e.preventDefault();
                const facultyId = parseInt($(this).data("id"));
                activeId = facultyId;
                console.log(facultyId);
                Utils.api("get_faculty_info", {
                    id: facultyId
                }).then(faculty => {
                    $("#facultyName").val(faculty.data.f_name);
                    $("#facultyId").val(faculty.data.f_id);
                    $("#facultyManager").val(faculty.data.f_manager)
                    $("#description").val(faculty.data.f_description);
                    $("#facultyNameId").val(faculty.data.faculty_id)
                    $("#editFaculty").modal();
                }).catch(err => {

                });
            });

            $(document).on('click', '.btn-update-faculty', function(e) {
                Utils.api("update_faculty_info", {
                    id: activeId,
                    facultyName: $("#facultyName").val(),
                    description: $("#description").val(),
                    facultyManager: $("#facultyManager").val(),
                    facultyId: $('#facultyNameId').val()
                }).then(response => {
                    $("#editFaculty").modal("hide");
                    swal("Notice", "Record is updated successfully!", "success").then(function(e) {
                        location.reload()
                    });
                }).catch(err => {

                })
            });

            $(document).on('click', ".btn-delete-faculty", function(e) {
                e.preventDefault();
                swal({
                    title: "Please confirm",
                    text: 'Are sure you want to delete this faculty?',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        Utils.api('delete_faculty_info', {
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

            $(document).on('click', '.btn-detail-faculty', function(e) {
                e.preventDefault();
                $('#detailFaculty').modal();
                const facultyId = parseInt($(this).data("id"));
                console.log(facultyId)
                Utils.api('get_faculty_info', {
                    id: facultyId
                }).then(response => {
                    $('#f-name').text(response.data.f_name);
                    $('#f-id').text(response.data.f_id);
                    $('#f_manager').text(response.data.f_manager)
                    $('#f-description').text(response.data.f_description)
                }).catch(err => {

                })
            });


            $()

        })
    </script>
</body>

</html>