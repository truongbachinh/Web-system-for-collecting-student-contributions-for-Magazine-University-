<?php
include "../config.php";
$faculty = $conn->query("SELECT * from faculty");
$facultyArray = array();
while ($rowF = mysqli_fetch_array($faculty)) {
    $facultyArray[] = $rowF;
}

?>
<?php
if (isset($_POST['addNewUser'])) {
    var_dump($_POST);
    $msg = "";

    $count = 0;
    $sql_user = "SELECT * from user where username ='$_POST[usernameUser]'";
    $res = mysqli_query($conn, $sql_user) or die(mysqli_error($conn));
    $count = mysqli_num_rows($res);

    if ($count > 0) {

        $msg = "Submission Id exits!";
    } else {


        $addNewUser = $conn->query("INSERT INTO `user` (`u_id`, `fullname`, `username`, `password`, `email`, `status`, `role`, `faculty_id`,`u_create_time` ) VALUES (NULL, '$_POST[fullnameUser]', '$_POST[usernameUser]','$_POST[passwordUser]','$_POST[emailUser]','1','$_POST[roleUser]','$_POST[facultyUser]','" . time() . "');");
        if ($addNewUser) {
            $msg = "Successfully added faculty.";
        }
    }
    var_dump($addNewUser);
    exit;
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
                                    <h4> Manage Users</h4>
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
                                        <a href="" class="btn btn-info float-right" role="button" data-toggle="modal" data-target="#addUser"><i class="mdi mdi-clipboard-plus"></i> Create User
                                        </a>

                                    </div>
                                </div>
                                <div class="table-responsive p-t-10">
                                    <table id="example" class="table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Fullname</th>
                                                <th>Email</th>
                                                <th>Faculty</th>
                                                <th>Status</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $res = mysqli_query($conn, "SELECT user.*, faculty.* from `user` INNER JOIN faculty ON faculty.f_id = user.faculty_id");
                                            while ($row = mysqli_fetch_array($res)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row["u_id"]; ?></td>
                                                    <td><?php echo $row["username"]; ?></td>
                                                    <td><?php echo $row["fullname"]; ?></td>
                                                    <td><?php echo $row["email"]; ?></td>
                                                    <td> <?php echo $row["f_name"]; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($row["status"] == 1) { ?>
                                                            <span class="badge badge-warning">Active</span>
                                                        <?php
                                                        } else { ?>
                                                            <span class="badge badge-danger">Blocked</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="#" onclick="edit(<?= $row['u_id'] ?>)" class="btn btn-info" role="button">
                                                                <i class="mdi mdi-pencil-outline"></i>
                                                            </a>
                                                            <a href="#" onclick="remove(<?= $row['u_id'] ?>)" class="btn btn-danger" role="button">
                                                                <i class="mdi mdi-delete"></i>
                                                            </a>
                                                            <a href="#" onclick="detail(<?= $row['u_id'] ?>)" class="btn btn-primary" role="button">
                                                                <i class="mdi mdi-dots-horizontal"></i>
                                                            </a>
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

                <!--            Add User-->

                <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="editSubmission" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editSubmission">Create User</h5>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" name="addUser" method="POST" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="inputName1">Full name</label>
                                        <input type="text" class="form-control" id="inputName1" name="fullnameUser" placeholder="Thu Thuy" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="usernameUser" placeholder="Enter username..." required>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPass1">Password</label>
                                        <input type="text" class="form-control" placeholder="Enter password" name="passwordUser" id="inputPass1" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPass2">Confirm Passs</label>
                                        <input type="text" class="form-control" id="inputPass2" placeholder="Enter confirm password" name="confirmpasswordUser" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1">Email</label>
                                        <input type="email" class="form-control" id="inputEmail1" placeholder="Enter email" name="emailUser" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress1">Address</label>
                                        <input type="text" class="form-control" id="inputAddress1" name="addressUser" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputRole1">Roles</label>
                                        <select id="inputRole" class="form-control" name="roleUser">
                                            <option selected value="student">Student</option>
                                            <option value="manager-coordinator">Manager Coordinator</option>
                                            <option value="manager-marketing">Manager Marketing</option>
                                            <option value="admin">Admin</option>
                                            <option value="guest">Guest</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputRole1">Faculty</label>
                                        <select id="inputRole" class="form-control" name="facultyUser">
                                            <?php
                                            foreach ($facultyArray as $rowFaculty) {


                                            ?>

                                                <option value="<?= $rowFaculty['f_id'] ?>"><?= $rowFaculty['f_name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input class="btn btn-primary float-right btn-add-user" type="submit" name="addNewUser" value="Create Account"></button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Modal edit -->
                <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editSubmission" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editSubmission">Edit User Information</h5>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <div class="form-group">
                                        <label for="inp-username">Username</label>
                                        <input type="text" class="form-control" id="inp-username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inp-fullname">Full Name</label>
                                        <input type="text" class="form-control" id="inp-fullname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inp-email">Email</label>
                                        <input type="text" class="form-control" id="inp-email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inp-status">Status</label>
                                        <select id="inp-status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="2">Blocked</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inp-role">Role</label>
                                        <select id="inp-role" class="form-control">
                                            <option value="student">Student</option>
                                            <option value="admin">Admin</option>
                                            <option value="manager-coordinator">Coordinator Manager</option>
                                            <option value="manager-marketing">Marketing Manager</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="inp-password">New Password (Leave blank for unchanged)</label>
                                        <input type="password" placeholder="Leave blank for unchanged..." class="form-control" id="inp-password" required>
                                    </div>

                                    <div class="model-footer">
                                        <button type="button" class="btn btn-warning btn-save">
                                            Save Changes
                                        </button>
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
                <div class="modal fade" id="userDetail" tabindex="-1" role="dialog" aria-labelledby="detailSubmission" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailSubmission">Detail
                                    Information User
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
                                                <td>Full Name</td>
                                                <td id="u-name"></td>
                                            </tr>
                                            <tr>
                                                <td>User Name</td>
                                                <td id="u_username"></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td id="u-email"></td>
                                            </tr>
                                            <tr>
                                                <td>Role</td>
                                                <td id="u-role"></td>
                                            </tr <tr>
                                            <td>Status</td>
                                            <td id="u-status"></td>
                                            </tr <tr>
                                            <td>Time Created</td>
                                            <td id="u-time">
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
        // function add() {
        //     $(document).on('click', ".btn-create-user", function(e) {
        //         $('#addUser').modal();
        //         $(document).on('click', '.btn-add-user', function(e) {
        //             Utils.api("add_user_info", {
        //                 fullname: $('#inputName2').val() + $('#inputName2'),
        //                 username: $('#username').val(),
        //                 email: $('#inputEmail1').val(),
        //                 password: $('#inputPass1').val(),
        //                 role: $('#inputRole').val(),
        //                 address: $('#inputAddress1').val(),
        //             }).then(response => {



        //             }).catch(err => {

        //             })
        //         })


        //     })
        // }

        function remove(userId) {
            swal({
                title: "Please confirm",
                text: 'Are sure you want to delete this user?',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    Utils.api('delete_user', {
                        id: userId,
                    }).then(response => {
                        $("#editFaculty").modal("hide");
                        swal("Notice", response.msg, "success").then(function(e) {
                            location.reload();
                        });
                    }).catch(err => {})
                }
            });
        }

        function edit(userId) {
            console.log('hello')
            $('#editUser .btn-save').unbind('click');
            Utils.api("get_user_info", {
                id: userId
            }).then(response => {
                let user = response.data;
                $('#editUser #inp-username').val(user.username);
                $('#editUser #inp-fullname').val(user.fullname);
                $('#editUser #inp-email').val(user.email);
                $('#editUser #inp-status').val(user.status);
                $('#editUser #inp-role').val(user.role);
                $('#editUser').modal();
                $('#editUser .btn-save').click(() => {
                    Utils.api("update_user_info", {
                        id: userId,
                        username: $('#editUser #inp-username').val(),
                        fullname: $('#editUser #inp-fullname').val(),
                        email: $('#editUser #inp-email').val(),
                        status: $('#editUser #inp-status').val(),
                        role: $('#editUser #inp-role').val(),
                        newPassword: $('#editUser #inp-password').val()
                    }).then((response) => {
                        swal("Notice", response['msg'], "success").then(function(e) {
                            location.reload()
                        });
                    });
                });
            });
        }

        function detail(userId) {
            Utils.api("get_user_info", {
                id: userId
            }).then(response => {
                $("#u-name").text(response.data.fullname);
                $("#u_username").text(response.data.username);
                $("#u-role").text(response.data.role);
                $("#u-email").text(response.data.email);
                $("#u-status").text(response.data.role === 1 ? "active" : "block");
                $("#u-time").text(response.data.u_create_time);
                $('#userDetail').modal();
            }).catch(err => {

            })
        }
    </script>
</body>

</html>