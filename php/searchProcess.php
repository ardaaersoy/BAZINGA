<?php
require "db.php";

if (!isset($_SESSION)) {
    session_start();
}

$error = "";

extract($_SESSION['searchUser']);
if ($_SESSION['searchUser'] == true) {
    try {
        $sql = "select * from users where first_name= :first_name";
        $stmt = $db->prepare($sql);
        $stmt->bindValue("first_name", $first_name);
        $stmt->execute();

        $friends = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $k = 0;

        foreach ($friends as $friend) {
            extract($_SESSION['user']);
            if ($first_name == $friend['first_name']) {
                $k += 1;
            }
            if ($email == $friend['email']) {
                for ($i = 0; $i < count($friends); $i++) {
                    if ($friend['user_id'] == $friends[$i]['user_id']) {
                        unset($friends[$i]);
                    }
                }
            }
        }

        if ($k == 1) {
            header("Location: photos.php");
            exit;
        }
    } catch (\Throwable $th) {
        $error = "db error!";
    }
} else {
    $error = "User not found!";
}