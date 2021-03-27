<?php
session_start();
include "../connect_db.php";
?>

<?php
// Perform query
$user_id = 353;
$file_faculty_id = 34;
$result = mysqli_query($conn, "SELECT * FROM file_submit_to_system WHERE user_id = $user_id and $file_faculty_id = 34");
$file_submit_to_system = mysqli_fetch_array($result, MYSQLI_ASSOC);
print_r($file_submit_to_system);
?>

<?php

if (isset($_POST["submit"])) {

    // $res = mysqli_query($link, "select * from products where p_category_id = '$idCtg'");
    // while ($row = mysqli_fetch_array($res)) {
    //     $product = $row['p_id'];
    // }
    $tm = md5(time());
    $fnm1 = $_FILES["upFile"]["name"];
    $dst1 = "./image/" . $tm . $fnm1;
    $dst_db1 = "image/" . $tm . $fnm1;
    move_uploaded_file($_FILES["upFile"]["tmp_name"], $dst1);
    mysqli_query($conn, "insert into file_submit (file_id, file_content_upload, file_date_uploaded) values (NULL, '$dst1','" . date() . "') ");
    $file_submit_id_result = mysqli_query($conn, "SELECT file_id FROM file_submit WHERE file_submit.file_content_upload = './image/6e9b94ff974eb0caea9788a7aaa976d897485493_2490671654577425_8179314827781472256_n.png'");
    $file_submit_id = mysqli_fetch_assoc($file_submit_id_result, MYSQLI_ASSOC);
    $file_id = $file_submit_to_system["file_id"];
    print_r($file_submit_id);
    mysqli_query($conn,  "UPDATE file_submit_to_system SET file_submit_id = $file_submit_id WHERE file_id = $file_id")
    ?>
    <script type="text/javascript">
        alert("Add successfully");
        window.location.href = window.location.href;
    </script>
<?php

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Contribution - CMS</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div>

        <li><a href="https://ciliweb.vn/contribution_application/account/logout.php"><span></span>Log out</a>

    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="https://ciliweb.vn/contribution_application/user/index.php">Student page</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="#">My contribution</a>
                    </li>
                    <li>
                        <a href="#">Dashboard</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1> Post report or image for faculty</h1>

                <!-- Author -->
                <p class="lead">
                    by <span class="admin-name" style="color: #ff0000">
                        <?php
                        $file_faculty_id = $file_submit_to_system["file_faculty_id"];
                        $username = mysqli_query($conn, "SELECT user.username FROM user INNER JOIN faculty ON faculty.teacher_id=user.u_id WHERE f_id = {$file_faculty_id}");
                        $faculty = mysqli_fetch_array($username, MYSQLI_ASSOC);
                        echo $faculty["username"];
                        ?>
                    </span>

                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span>
                    Posted on
                    <?php
                    echo $file_submit_to_system["date_post"];
                    ?>
                </p>

                <hr>
                <!-- Post Content -->
                <p class="lead">Nội dung những bài cần nộp cho hệ thống</p>
                <p>Miêu tả các file cần nộp như PDF, Image.</p>

                <hr>

                <!-- Blog Comments -->
                <!-- Preview Image -->
                <div id="upload-zone" class="box-content">
                    <fieldset>
                        <legend>
                            Upload File
                        </legend>
                        <form id="upload-file-form" action="" method="POST" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Add file:</label>
                                <div class="controls">
                                    <input type="file" class="span11" name="upFile" />
                                </div>
                            </div>
                            <div class="form-actions text-center">
                                <button type="submit" name="submit" class="btn btn-success">Save File</button>
                            </div>
                            <div class="alert alert-success" id="success" style="display:none">
                                <strong>Record Inserted Successfully!</strong>
                            </div>
                        </form>

                    </fieldset>

                </div>

                <hr>



                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Teacher comment
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin
                        commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum
                        nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Studente reply
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin
                        commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum
                        nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Studente reply
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra
                                turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis
                                in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci
                        accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>

<?php
class FileSubmit
{
    private $file_id;
    private $file_categories_id;
private $user_id;
private $file_name;
private $file_description;
private $file_faculty_id;
private $file_semester_id;
private $status;
private $comment;
private $file_date_uploaded;
private $file_date_edited;
private $file_content_upload;
}
?>