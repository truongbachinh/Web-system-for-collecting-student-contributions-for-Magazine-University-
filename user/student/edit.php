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

    <!-- PLACE CODE INSIDE THIS AREA -->
    <section class="admin-content">
        <div class="container m-t-30">
            <div class="card">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>Edit Article</h4>
                            </div>

                            <p class="m-b-0 text-muted">
                                Students are need to provide complete information prior to edit an
                                article.
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputName">Name of article</label>
                                    <input type="text" class="form-control" id="inputName"
                                           name="nameArticle" placeholder="Name of article">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputAuthor">Author</label>
                                    <input type="text" class="form-control" id="inputAuthor"
                                           name="nameAuthor" placeholder="Name Article">
                                </div>
                            </div>
                            <div class="form-group">
                                <p class=" font-secondary">File Uploads (Click to delete)</p>
                                <div class="">
                                    <button class="btn btn-outline-danger m-b-10">
                                        File Name
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                    <button class="btn btn-outline-danger m-b-10">
                                        File Name
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                    <button class="btn btn-outline-danger m-b-10">
                                        File Name
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                    <button class="btn btn-outline-danger m-b-10">
                                        File Name
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>

                            </div>
                            <div class="form-group">
                                <div>
                                    <div class="form-group">
                                        <div>
                                            <p class=" font-secondary">File Uploads</p>
                                            <div class="input-group mb-3">
                                                <div class="custom-file" onload="GetFileInfo ()">
                                                    <input type="file" class="custom-file-input"
                                                           id="inputFile" name="inputFileArticle[]"
                                                           multiple onchange="GetFileInfo ()">
                                                    <label class="custom-file-label" for="inputFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                            <div id="info" style="margin-top:10px"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                   id="gridCheck" name="agree">
                                            <label class="form-check-label" for="gridCheck">
                                                I agree to the Terms and Conditions
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group  float-right">
                                        <input type="submit" name="uploadFile" class="btn btn-primary"
                                               value="Upload File" id="uploadFile"></input>
                                        <!--                                    <button type="submit" value="Upload" name="uploadFile" class="btn btn-primary" value="uploadFile" id="uploadFile" onclick="onUploadI()">Submit</button>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
</body>