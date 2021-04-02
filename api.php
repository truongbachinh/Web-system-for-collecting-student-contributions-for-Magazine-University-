<?php
header('Content-Type: application/json');
include "./config.php";
// include "./assets/js/utils.js";

$response = array();
$data = [];
$msg = "";
$error = 0;
$action = @$_POST['action'];


// check login and password
if ($isLoggedIn) {
    // process requests
    switch ($action) {
        case "get_faculty_info":
            $id = $_POST['id'];
            $query = $conn->query("SELECT * FROM `faculty` WHERE `f_id` = $id");
            if ($query->num_rows == 0) {
                $error = 1;
                $msg = "This file is not available.";
            } else {
                $data = $query->fetch_assoc();
            }
            break;
        case "update_faculty_info":
            $id = $_POST['id'];
            $nameFaculty = $_POST['facultyName'];
            $description = $_POST['description'];
            $manager = $_POST['facultyManager'];
            $facultyId = $_POST['facultyId'];
            $stmt = $conn->prepare("UPDATE `faculty` SET 
                `faculty_id`= ?,`f_name`= ?,`f_description`=?,`f_manager`=? WHERE `f_id`=?");
            $stmt->bind_param("ssssi", $facultyId, $nameFaculty, $description, $manager, $id);
            if ($stmt->execute()) {
                $msg = "Record updated successfully";
            } else {
                $error = 400;
                $msg = "Error updating record: " . $conn->error;
            }
            break;
        case "delete_faculty_info":
            $id = $_POST['id'];
            $query = $conn->query("DELETE FROM `faculty` WHERE `f_id` = $id");
            if ($query) {
                $msg = "Record deleted successfully";
            } else {
                $error = 400;
                $msg = "Error delete record: " . $conn->error;
            }
            break;
        case "add_submission_info":
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
        case "get_submission_info":
            $id = $_POST['id'];
            $query = $conn->query("SELECT * FROM `submission` WHERE `id` = $id");
            if ($query->num_rows == 0) {
                $error = 1;
                $smg = "This file is not available";
            } else {
                $data = $query->fetch_assoc();
            }
            break;
        case "update_submission_info":
            $id = $_POST['id'];
            $submissionName = $_POST['submissionName'];
            $submissionCode = $_POST['submissionCode'];
            $deadline = $_POST['deadline'];
            $description = $_POST['description'];
            $stmt = $conn->prepare("UPDATE `submission` SET `submission_id`=?,`submission_name`=?,`submission_description`=?,`submission_deadline`=? WHERE `id`=?");
            $stmt->bind_param("ssssi", $submissionCode, $submissionName, $description, $deadline, $id);
            if ($stmt->execute()) {
                $msg = "Record updated successfully";
            } else {
                $error = 400;
                $msg = "Error delete record: " . $conn->error;
            }
            break;
        case "delete_submission":
            $id = $_POST['id'];
            $stmt = $conn->prepare("DELETE FROM `submission` WHERE `id` = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                $msg = "Successfully deleted submission.";
            } else {
                $error = 400;
                $msg = "Error delete record: " . $conn->error;
            }
            break;
        case "add_user_info":


            break;
        case "get_user_info":
            $id = $_POST['id'];
            $stmt = $conn->prepare("SELECT * FROM `user` WHERE `u_id` = ?");
            if ($stmt->bind_param("i", $id) && $stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows == 0) {
                    $error = 404;
                    $msg = "Account is not exist.";
                } else {
                    $row = $result->fetch_assoc();
                    $row['password'] = "";
                    $data = $row;
                }
            } else {
                $error = 400;
                $msg = "Unknown error occurred.";
            }
            break;
        case "update_user_info":
            $id = $_POST['id'];
            $stmt = $conn->prepare("UPDATE `user` SET `username` = ?, `email` = ?, `fullname` = ?, `status` = ?, `role` = ? WHERE `u_id` = ?");
            if ($stmt->bind_param(
                "sssisi",
                $_POST['username'],
                $_POST['email'],
                $_POST['fullname'],
                $_POST['status'],
                $_POST['role'],
                $id
            ) && $stmt->execute()) {
                $stmt2 = $conn->prepare("UPDATE `user` SET `password` = ? WHERE `u_id` = ?");
                if ($stmt2->bind_param("si", $_POST['newPassword'], $id)) {
                    $msg = "Changed information & password successfully!";
                } else {
                    $error = 400;
                    $msg = "Failed to change password but information is updated.";
                }
            } else {
                $error = 400;
                $msg = "Unknown error occurred.";
            }
            break;
        case "delete_user":
            $id = $_POST['id'];
            $stmt = $conn->prepare("DELETE FROM `user` WHERE `u_id` = ?");
            if ($stmt->bind_param("i", $id) && $stmt->execute()) {
                $msg = "Successfully deleted this user.";
            } else {
                $error = 400;
                $msg = "Failed to change password but information is updated.";
            }

            break;
    }
} else {
    $error = 500;
    $msg = "Unauthorized.";
}


$response["msg"] = $msg;
$response["error"] = $error;
$response["data"] = $data;

echo json_encode($response);
