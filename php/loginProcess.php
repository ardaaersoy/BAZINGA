<?php
require "db.php";

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST["loginBTN"])) {
    if (isset($_POST['postcsrf']) && $_SESSION['token'] === $_POST['postcsrf']) {
        extract($_POST);

        $loginMail = $_POST["loginMail"];
        $loginMail = filter_var($loginMail, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $loginPassword = $_POST["loginPassword"];
        $loginPassword = filter_var($loginPassword, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "select * from users where email=?";
        $statement = $db->prepare($sql);

        $statement->execute([$loginMail]);
        $userInfo = $statement->fetch(PDO::FETCH_ASSOC);

        if ($userInfo) {
            if (password_verify($loginPassword, $userInfo['password'])) {
                // Success - Login
                $_SESSION['user'] = $userInfo;
                if ($optionsCheckboxes == "on") {
                    setcookie("usermail", $_POST['loginMail'], time() + 60 * 60 * 24);
                    setcookie("password", $_POST['loginPassword'], time() + 60 * 60 * 24);
                    header("Location: profile.php");
                    exit;
                } else {
                    setcookie("usermail", $_POST['loginMail'], time() - 60 * 60 * 24);
                    setcookie("password", $_POST['loginPassword'], time() - 60 * 60 * 24);
                    header("Location: profile.php");
                }
            } else {
                $pass_error = "Incorrert password";
                setcookie("pass_error", $pass_error, time() + 5);
                header("Location: login.php");
                exit;
            }
        } else {
            $user_error = "User not exist";
            setcookie("user_error", $user_error, time() + 5);
            header("Location: login.php");
            exit;
        }
    }
}

$csrf_token = md5(uniqid(rand(), true));
$_SESSION['token'] = $csrf_token;
