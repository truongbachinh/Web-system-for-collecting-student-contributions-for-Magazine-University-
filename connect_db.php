<?php
$conn = mysqli_connect("localhost", "root", "", "contribution_appication");
$db_selected = mysqli_select_db($conn, "contribution_appication");

if ($conn->connect_error) {
    die("Connect DB failed" . $conn->connect_error);
}

/*
function formatDate($date){
    return date('g:i a',strtotime($date));
}

*/

