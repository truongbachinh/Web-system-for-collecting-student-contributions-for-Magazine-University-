<?php




$conn = mysqli_connect("localhost", "root", "", "db_contribution");
$db_selected = mysqli_select_db($conn, "db_contribution");

if ($conn->connect_error) {
    die("Connect DB failed" . $conn->connect_error);
}


function formatDate($date)
{
    return date('g:i a', strtotime($date));
}
