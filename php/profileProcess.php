<?php
require "db.php";

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_COOKIE["ext_error"])) {
    $ext_error = unserialize($_COOKIE["ext_error"]);
    $ext_error = $_COOKIE['ext_error'];
}
if (isset($_COOKIE["empty_error"])) {
    $empty_error = unserialize($_COOKIE["empty_error"]);
    $empty_error = $_COOKIE['empty_error'];
}


const pageSize = 10;
$sql = "select count(*) as totalPost from posts";
$totalPost = $db->query($sql)->fetch(PDO::FETCH_ASSOC)['totalPost'];

if ($totalPost != 0) {
    $totalPage = ceil($totalPost / pageSize);

    $page = $_GET['page'] ?? 1;
    $page = filter_var($page, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => $totalPage]]);
    $start = ($page - 1) * pageSize;

    $sql = "select distinct(post_id),user_id,content,picture_url,posted_at from posts,myfriends where my_id=$user_id and (user_id=friend_id or user_id=$user_id) order by posted_at desc LIMIT $start," .  pageSize;
    $posts = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $cnt = count($posts);

    if ($cnt == 0) {
        $sql = "select * from posts where user_id=$user_id order by posted_at desc LIMIT $start," .  pageSize;
        $posts = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}

$page = ($_GET['page']) ?? 1;
$page = filter_var($page, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => $totalPage]]);




if (isset($_POST['deleteBtn'])) {
    extract($_POST);

    if ($page == $totalPage && count($posts) == 1)
        $page -= 1;

    try {
        $sql = "delete from posts where post_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$del_id]);

        header("Location: profile.php?page=$page");
        exit;
    } catch (Exception $ex) {
        echo "error";
    }
}


$sql = "select * from comments";
$comments = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['deleteComment'])) {
    extract($_POST);

    try {
        $sql = "delete from comments where comment_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$delCommentId]);

        header("Location: profile.php?page=$page");
        exit;
    } catch (Exception $ex) {
        echo "error";
    }
}


if (isset($_POST['likeBtn'])) {
    extract($_POST);
    $c = 0;

    $sql = "select * from likes";
    $likePostandComment = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    foreach ($likePostandComment as $li) {
        if ($li['liked_by'] == $user_id && $likePostId == $li['post_id']) {

            $sql = "delete from likes where post_id = :post_id and liked_by = :liked_by";
            $stmt = $db->prepare($sql);
            $stmt->bindValue("post_id", $likePostId);
            $stmt->bindValue("liked_by", $user_id);
            $stmt->execute();

            header("Location: profile.php?page=$page");
            exit;
        } else {
            $c += 1;
        }
    }

    if (count($likePostandComment) == $c) {
        try {
            $sql = "insert into likes(post_id, liked_by) values (?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$likePostId, $user_id]);

            header("Location: profile.php?page=$page");
            exit;
        } catch (Exception $ex) {
            echo "like error";
        }
    }
}
