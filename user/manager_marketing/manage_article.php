<?php
include "../../config.php";

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

    <section class="manage-articles">
        <div class="container m-t-30">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4> Manage Articles</h4>
                                </h4>
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
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <select class="form-control " data-select2-id="1" tabindex="-1"
                                                        aria-hidden="true">
                                                    <option selected="" data-select2-id="3">Select status</option>
                                                    <option data-select2-id="16">Approved</option>
                                                    <option data-select2-id="17">Reject</option>
                                                    <option data-select2-id="16">Processing</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <select class="form-control " data-select2-id="1" tabindex="-1"
                                                        aria-hidden="true">
                                                    <option selected="" data-select2-id="3">Select topic</option>
                                                    <option data-select2-id="16">Cup Cake</option>
                                                    <option data-select2-id="17">Donut</option>
                                                    <option data-select2-id="18">Eclair</option>
                                                    <option data-select2-id="19">Froyo</option>
                                                </select>
                                            </div>
                                        </div>
                                </div>
                            </div>

                        </div>
                        <div class="table-responsive p-t-10">
                            <table id="example" class="table text-center" style="width:100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Article Name</th>
                                    <th>Student Owner</th>
                                    <th>Faculty</th>
                                    <th>Topic</th>
                                    <th>Amount Of File</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Article_01</td>
                                    <td>Advance Cloud</td>
                                    <td>ASM1</td>
                                    <td>Nguyen Van B</td>
                                    <td>Nguyen Van A</td>
                                    <td>2</td>
                                    <td><span class="badge badge-warning">Processing</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>
<link href="path/to/select2.min.css" rel="stylesheet" /> <br>
<script src="path/to/select2.min.js"></script>
<?php include "../partials/js_libs.php"; ?>
</body>
</html>