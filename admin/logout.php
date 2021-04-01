<?php

include "../config.php";

unset($_SESSION['current_user']);
unset($_SESSION['current_admin']);
?>
<script type="text/javascript">
    window.location = "login.php";
</script>