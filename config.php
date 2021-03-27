<?php
include "connect_db.php";
session_start();

$isLoggedIn = isset($_SESSION['current_user']);
if ($isLoggedIn) $currentUser = $_SESSION['current_user'];

$pageTitle = "ARTICLE SYSTEM";

?>