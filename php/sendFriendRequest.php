<?php
require "db.php";

$sender = $_GET['sender'];
$sender = filter_var($sender, FILTER_VALIDATE_INT);
$receiver = $_GET['receiver'];
$receiver = filter_var($receiver, FILTER_VALIDATE_INT);

try {
    $sql = "insert into friendrequest (receiver,sender) VALUES (?, ?)";
    $stmt = $db->prepare($sql);  // returns prepared Statement
    $stmt->execute([$receiver, $sender]);

    header("Location: search.php");
} catch (\Throwable $th) {
    echo ("Sql Error" . $th->getMessage());
}

