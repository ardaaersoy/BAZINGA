<?php
require "db.php";
require "auth.php";

$p_image = "";
$content = "";
extract($_POST);

if ($_GET['islem'] == "ajax") {
    $content = $_POST['content'];
    $pid = $_POST['pid'];
  
    $stmt = $db->prepare("insert into comments (user_id, post_id,comment) values (?,?,?)");
    $success = $stmt->execute([$user_id, $pid, $content]);

    if ($success) {

        $res = "
            $content
        ";

        echo $res;
    } else {
        echo "Post sending is not successful";
    }
} else {
    $page = ($_GET['page']) ?? 1;
    $page = filter_var($page, FILTER_VALIDATE_INT);

    //!isset($_FILES["p_image"]["name"])
    $p_image = $_FILES["p_image"]["name"];

    if ($p_image == "") {
        if (!empty($content)) {
            try {
                $stmt = $db->prepare("insert into posts(user_id, content) values (?,?)");
                $stmt->execute([$user_id, $content]);
                $content = "";

                header("Location: profile.php?page=$page");
                exit;
            } catch (Exception $ex) {
                echo "post error";
            }
        } else {
            $empty_error = "Please write something to post";
            setcookie("empty_error", $empty_error, time() + 5);

            header("Location: profile.php?page=$page");
            exit;
        }
    } else {

        /* Filter uploaded file with respect to its extension */
        $extension = strtolower(pathinfo($p_image, PATHINFO_EXTENSION));
        $whitelist = array("jpg", "png");
        if (!in_array($extension, $whitelist)) {
            $ext_error = "File must be jpg or png format";
            setcookie("ext_error", $ext_error, time() + 5);

            header("Location: profile.php?page=$page");
            exit;
        }
    }


    $content = filter_var($content, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (move_uploaded_file($_FILES["p_image"]["tmp_name"], "postedImages/$p_image")) {

        if (!empty($content)) {
            try {
                $stmt = $db->prepare("insert into posts(user_id, content, picture_url) values (?,?,?)");
                $stmt->execute([$user_id, $content, $p_image]);
                $p_image = "";
                $content = "";

                header("Location: profile.php?page=$page");
                exit;
            } catch (Exception $ex) {
                echo "post error";
            }
        }

        if (empty($content)) {
            try {
                $stmt = $db->prepare("insert into posts(user_id, picture_url) values (?,?)");
                $stmt->execute([$user_id, $p_image]);
                $p_image = "";

                header("Location: profile.php?page=$page");
                exit;
            } catch (Exception $ex) {
                echo "post error";
            }
        }
    }
}
