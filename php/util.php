<?php
require "db.php";
require "auth.php";

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['searchBtn'])) {

    $name = $_POST["searchName"];
    $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);

    if (!empty($name)) {
        $sql = "select * from users where first_name=?";
        $statement = $db->prepare($sql);
        $statement->execute([$name]);
        $searchUser = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['searchUser'] = $searchUser;
            header("Location: search.php");
        } else {
            $error = "Incorrert password";
        }
    }
}

try {
    $sql = "select * from users, friendrequest where user_id = friendrequest.sender and receiver= :receiver";
    $stmt = $db->prepare($sql);
    $stmt->bindValue("receiver", $user_id);
    $stmt->execute();
    $senderInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (\Throwable $th) {
    echo ("Sql Error") . $th->getMessage();
}

try {
    $sql = "select * from friendrequest where receiver = :receiver";
    $stmt = $db->prepare($sql);
    $stmt->bindValue("receiver", $user_id);
    $stmt->execute();
    $friendrequest = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

if (!isset($friendrequest)) {
    $friendrequest = "";
}

if (!isset($senderInfo)) {
    $senderInfo = "";
}

try {
    $sql = "select * from users,myfriends where user_id=myfriends.friend_id and myfriends.my_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$user_id]);
    $myFriends = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (\Throwable $th) {
    echo "Sql Error" . $th->getMessage();
}

if (isset($_POST['deleteFriend'])) {
    extract($_POST);
    $del = $_POST['deleted_id'];
    var_dump($del);

    try {

        $sql = "insert into notification (friendship_id,deleter_id,deleted_id) values (?,?,?) ";
        $stmt = $db->prepare($sql);
        $stmt->execute([$delfriend_id, $user_id, $deleted_id]);

        $sql = "delete from myfriends where friendship_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$delfriend_id]);

        header("Location: friends.php");
        exit;
    } catch (Exception $ex) {
        echo "Sql Error: " . $ex->getMessage();
    }
}

try {
    $sql = "select * from users,notification where deleted_id = $user_id and user_id = deleter_id";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $deleterPeople = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    echo "error";
}


if (isset($_POST['delNotification'])) {
    extract($_POST);

    try {
        $sql = "delete from notification where deleted_id = ? and deleter_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$user_id, $deleterId]);

        header("Location: friends.php");
        exit;
    } catch (Exception $ex) {
        echo "Sql Error: " . $ex->getMessage();
    }
}
