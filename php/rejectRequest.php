<?php
require "db.php";
require "auth.php";
require "util.php";

$friendship_id = $_GET['fid'];
$friendship_id = filter_var($friendship_id, FILTER_VALIDATE_INT);

try {
    $sql = "delete from friendrequest where friendship_id =?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$friendship_id]);

    header("Location: profile.php");
} catch (\Throwable $th) {
    echo "Sql error" . $th->getMessage();
}
