<?php

include "../config.php";
unset($_SESSION['current_user']);
unset($_SESSION['current_admin']);
if (!empty($_SESSION["current_user"]) && $currentUser['role'] === "admin") {
    unset($_SESSION['current_user']);
?>
    <script type="text/javascript">
        window.location = "../admin/login.php";
    </script><?php
            } else {
                unset($_SESSION['current_user']);
                ?>
    <script type="text/javascript">
        window.location = "../account/login.php";
    </script><?php
            }
                ?>