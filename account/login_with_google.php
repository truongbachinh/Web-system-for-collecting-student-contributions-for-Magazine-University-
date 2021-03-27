<?php
//Hàm login sau khi mạng xã hội trả dữ liệu về
function loginFromSocialCallBack($socialUser)
{
    include "../connect_db.php";

    $result = mysqli_query($conn, "Select `u_id`,`username`,`email`,`fullname` from `user` WHERE `email` ='" . $socialUser['email'] . "'");
    if ($result->num_rows == 0) {
        $result = mysqli_query($conn, "INSERT INTO `user` (`fullname`,`email`, `status`) VALUES ('" . $socialUser['name'] . "', '" . $socialUser['email'] . "', 1);");
        if (!$result) {
            echo mysqli_error($conn);
            exit;
        }
        $result = mysqli_query($conn, "Select `u_id`,`username`,`email`,`fullname` from `user` WHERE `email` ='" . $socialUser['email'] . "'");
    }
    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['current_user_google'] = $user;
        header('Location: ../account/login.php');
    }
}
