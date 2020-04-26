<?php
require "db.php";
require "auth.php";
require "util.php";

$sender_id = $_GET['id'];
$sender_id = filter_var($sender_id, FILTER_VALIDATE_INT);
$friendship_id = $_GET['fid'];
$friendship_id = filter_var($friendship_id, FILTER_VALIDATE_INT);

try {
    $sql = "insert into myfriends (friendship_id,my_id,friend_id) values (? ,?, ?) ";
    $stmt = $db->prepare($sql);
    $stmt->execute([$friendship_id, $user_id, $sender_id]);
    $stmt->execute([$friendship_id, $sender_id, $user_id]);

    $sql = "delete from friendrequest where friendship_id=?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$friendship_id]);

    header("Location: profile.php");
} catch (\Throwable $th) {
    echo "Sql Error: " . $th->getMessage();
}
