<?php
include '../connect_db.php';
/** @var TYPE_NAME $conn */
session_start();

//if (isset($_GET)) {
//    var_dump($_GET);
//}

$userid = $_SESSION["current_user"]["u_id"];
$partnerId = $_SESSION["partnerId"];

$query = "SELECT * FROM tbl_chat WHERE tbl_chat.use_id_1 in ($userid, $partnerId) and tbl_chat.use_id_2 in ($userid, $partnerId) ORDER BY id DESC ";
$run = $conn->query($query);
$name = mysqli_fetch_array($conn->query("SELECT user.username FROM user where user.u_id = $partnerId"), MYSQLI_ASSOC);
//printf($run);
while($row = $run->fetch_array()):
    if ($row["use_id_1"] == $userid) {
        ?>
        <div class="outgoing_msg">
            <div class="sent_msg">
                <p><?php echo $row['message'];?></p>
                <span class="time_date"><?php echo formatDate($row['date']);?></span></div>
        </div>
        <?php
    } else {
        ?>
        <div class="incoming_msg">
            <div class="received_msg">
                <div class="received_withd_msg">
                    <p><?php echo $row['message'];?></p>
                    <span class="time_date"><?php echo formatDate($row['date']);?></span></div>
            </div>
        </div>
        <?php
    }
    ?>

<?php endwhile; ?>

