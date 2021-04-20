<?php
include "../config.php";
include "./database.php";


// set_time_limit(3000);
// $mysqli = new mysqli($host, $user, $pass, $name);
// var_dump($mysqli);
// exit;
// $mysqli->select_db($name);
// $mysqli->query("SET NAMES 'utf8'");
// $queryTables = $mysqli->query('SHOW TABLES');
// while ($row = $queryTables->fetch_row()) {
//     $target_tables[] = $row[0];
// }
// if ($tables !== false) {
//     $target_tables = array_intersect($target_tables, $tables);
// }
// $content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `" . $name . "`\r\n--\r\n\r\n\r\n";
// foreach ($target_tables as $table) {
//     if (empty($table)) {
//         continue;
//     }
//     $result    = $mysqli->query('SELECT * FROM `' . $table . '`');
//     $fields_amount = $result->field_count;
//     $rows_num = $mysqli->affected_rows;
//     $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
//     $TableMLine = $res->fetch_row();
//     $content .= "\n\n" . $TableMLine[1] . ";\n\n";
//     $TableMLine[1] = str_ireplace('CREATE TABLE `', 'CREATE TABLE IF NOT EXISTS `', $TableMLine[1]);
//     for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
//         while ($row = $result->fetch_row()) { //when started (and every after 100 command cycle):
//             if ($st_counter % 100 == 0 || $st_counter == 0) {
//                 $content .= "\nINSERT INTO " . $table . " VALUES";
//             }
//             $content .= "\n(";
//             for ($j = 0; $j < $fields_amount; $j++) {
//                 $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
//                 if (isset($row[$j])) {
//                     $content .= '"' . $row[$j] . '"';
//                 } else {
//                     $content .= '""';
//                 }
//                 if ($j < ($fields_amount - 1)) {
//                     $content .= ',';
//                 }
//             }
//             $content .= ")";
//             //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
//             if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
//                 $content .= ";";
//             } else {
//                 $content .= ",";
//             }
//             $st_counter = $st_counter + 1;
//         }
//     }
//     $content .= "\n\n\n";
// }
// $content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
// $backup_name = $backup_name ? $backup_name : $name . '___(' . date('H-i-s') . '_' . date('d-m-Y') . ').sql';
// ob_get_clean();
// header('Content-Type: application/octet-stream');
// header("Content-Transfer-Encoding: Binary");
// header('Content-Length: ' . (function_exists('mb_strlen') ? mb_strlen($content, '8bit') : strlen($content)));
// header("Content-disposition: attachment; filename=\"" . $backup_name . "\"");
// echo $content;
// print_r($content);
// exit;


if (isset($_POST['downFile'])) {


    $dbost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'db_contribution';
    $tables = '*';

    //Call the core function
    EXPORT_DATABASE($dbhost, $dbuser, $dbpass, $dbname, $tables);

    //Core function
    function EXPORT_DATABASE($host, $user, $pass, $dbname, $tables = '*')
    {
        $link = mysqli_connect($host, $user, $pass, $dbname);

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit;
        }

        mysqli_query($link, "SET NAMES 'utf8'");

        //get all of the tables
        if ($tables == '*') {
            $tables = array();
            $result = mysqli_query($link, 'SHOW TABLES');
            while ($row = mysqli_fetch_row($result)) {
                $tables[] = $row[0];
            }
        } else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }

        $return = '';
        //cycle through
        foreach ($tables as $table) {
            $result = mysqli_query($link, 'SELECT * FROM ' . $table);
            $num_fields = mysqli_num_fields($result);
            $num_rows = mysqli_num_rows($result);

            $return .= 'DROP TABLE IF EXISTS ' . $table . ';';
            $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE ' . $table));
            $return .= "\n\n" . $row2[1] . ";\n\n";
            $counter = 1;

            //Over tables
            for ($i = 0; $i < $num_fields; $i++) {   //Over rows
                while ($row = mysqli_fetch_row($result)) {
                    if ($counter == 1) {
                        $return .= 'INSERT INTO ' . $table . ' VALUES(';
                    } else {
                        $return .= '(';
                    }

                    //Over fields
                    for ($j = 0; $j < $num_fields; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n", "\\n", $row[$j]);
                        if (isset($row[$j])) {
                            $return .= '"' . $row[$j] . '"';
                        } else {
                            $return .= '""';
                        }
                        if ($j < ($num_fields - 1)) {
                            $return .= ',';
                        }
                    }

                    if ($num_rows == $counter) {
                        $return .= ");\n";
                    } else {
                        $return .= "),\n";
                    }
                    ++$counter;
                }
            }
            $return .= "\n\n\n";
        }

        //save file
        $fileName = 'db-backup-' . time() . '-' . (md5(implode(',', $tables))) . '.sql';
        $handle = fopen($fileName, 'w+');
        fwrite($handle, $return);
        if (fclose($handle)) {
            echo "Done, the file name is: " . $fileName;
            exit;
        }
    }
}



// function zipFilesAndDownload($file_names)
// {

//     // $downloadPath = "./file_zip/";
//     // if (!is_dir($downloadPath)) {
//     //     mkdir($downloadPath, 0777, true);
//     // }


//     $zipname = 'fileSubmission.zip';
//     $zip = new ZipArchive;
//     $tmp_file = tempnam('.', '');
//     $zip->open($tmp_file, ZipArchive::CREATE);

//     foreach ($file_names as $file) {
//         $download_file = file_get_contents($file);

//         #add it to the zip
//         $zip->addFromString(basename($file), $download_file);
//     }

//     $zip->close();
//     // $fileName = '';
//     // $fileName = $studentName . $facultyName . '.zip';

//     # send the file to the browser as a download
//     header('Content-disposition: attachment; filename=databasae.zip');
//     header('Content-type: application/zip');
//     readfile($tmp_file);
//     unlink($tmp_file);
//     // if (file_exists($zipname)) {
//     //     header("Pragma: public");
//     //     header("Expires: 0");
//     //     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//     //     header("Cache-Control: public");
//     //     header("Content-Description: File Transfer");
//     //     header("Content-type: application/octet-stream");
//     //     header('Content-Disposition: attachment; filename="' . basename($zipname) . '"');
//     //     header("Content-Transfer-Encoding: binary");
//     //     header("Content-Length: " . filesize($zipname));
//     //     ob_end_flush();
//     //     @readfile($zipname);
//     //     // delete file
//     //     unlink($zipname);
//     // }
// }

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


        <div class="container m-t-30">
            <h1>Download DB </h1>
        </div>
        <div style="text-align: center; padding: 10px">
            <form action="" method="post">
                <input type="submit" style="text-align: center" name="downFile" class="btn btn-info" value="Download">
            </form>
        </div>








        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>

    <script>

    </script>
</body>

</html>
<?php


?>