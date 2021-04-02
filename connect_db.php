<?php
$conn = mysqli_connect("localhost", "root", "", "contribution_application_db");
$db_selected = mysqli_select_db($conn, "contribution_application_db");

if ($conn->connect_error) {
    die("Connect DB failed" . $conn->connect_error);
}

/*
function formatDate($date){
    return date('g:i a',strtotime($date));
}

*/
