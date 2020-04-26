<?php
session_start();

//var_dump( $_FILES ) ; 
if (!isset($_FILES["p_image"]["name"])) {
    header("Location: register.php");
    exit;
}

$p_image = $_FILES["p_image"]["name"];

/* Filter uploaded file with respect to its extension */
$extension = strtolower(pathinfo($p_image, PATHINFO_EXTENSION));
$whitelist = array("jpg", "png");
if (!in_array($extension, $whitelist)) {
    $ext_error = "File must be jpg or png format";
    setcookie("ext_error", $ext_error, time() + 5);
    header("Location: register.php");
    exit;
}

/* if file is greater than 1 MB, it gives an error */
if ($_FILES["p_image"]["size"] > 1024 * 1024) {
    $mb_error = "File must be less than 1 MB";
    setcookie("mb_error", $mb_error, time() + 5);
    header("Location: register.php");
    exit;
}

/* create a uniqie file name */
//$filename = uniqid() . "_" . $p_image ;
if (move_uploaded_file($_FILES["p_image"]["tmp_name"], "uploaded/$p_image")) {

    session_start();
    require("db.php");
    extract($_POST);
    /* Save record into database */

    if (isset($_POST["regSubmit"])) {
        if (isset($_POST['postcsrf']) && $_SESSION['tokenReg'] === $_POST['postcsrf']) {
            extract($_POST);

            $fname = filter_var($first_name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lname = filter_var($last_name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $mail = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $gend = filter_var($gender, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $birth = filter_var($birth_date, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $phon = filter_var($phone, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($fname && $lname && $mail && $pass && $gend && $phon && $birth) {
                if (!empty($first_name) && !preg_match('/^[A-Z][a-z]{2,10}$/', $first_name)) {
                    $fname_error = "Incorrect first name";
                    setcookie("fname_error", $fname_error, time() + 5);
                }

                if (!empty($last_name) && !preg_match('/^[A-Z][a-z]{2,10}$/', $last_name)) {
                    $lname_error = "Incorrect last name";
                    setcookie("lname_error", $lname_error, time() + 5);
                }

                if (!empty($phone) && !preg_match('/^5\d{9}$/', $phone)) {
                    $phone_error = "Incorrect phone";
                    setcookie("phone_error", $phone_error, time() + 5);
                }
            }

            if (empty($fname_error) && empty($lname_error) && empty($phone_error)) {
                $password = password_hash($password, PASSWORD_BCRYPT);
                try {
                    $statement = $db->prepare("insert into users (first_name,last_name,email,password,birth_date,gender,profile_picture_url,phone) values (?,?,?,?,?,?,?,?)");
                    $statement->execute([$first_name, $last_name, $email, $password, $birth_date, $gender, $p_image, $phone]);
                    header("Location: login.php");
                    exit;
                } catch (Exception $ex) {
                    $error = "User exist";
                    setcookie("error", $error, time() + 5);
                }
            } else {
                header("Location: register.php");
            }
        }
    } else {
        header("Location: register.php");
    }
}
