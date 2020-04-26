<?php
require "db.php";

try {
    $sql = "select * from users where user_id=?";
    $statement = $db->prepare($sql);
    $statement->execute([$user_id]);
    $userInfo = $statement->fetch(PDO::FETCH_ASSOC);

    $newName = $userInfo["first_name"];
    $newSurname = $userInfo["last_name"];
    $mailAdress = $userInfo["email"];
    $newPhone = $userInfo["phone"];
    $newBirth = $userInfo["birth_date"];
    $newGender = $userInfo["gender"];
} catch (Exception $ex) {
    $ex->getMessage();
}

$fname_error = "";
$lname_error = "";
$phone_error = "";

if (isset($_POST["btnSubmit"])) {
    extract($_POST);

    $firstname = filter_var($firstname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($lastname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_var($phone, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($firstname && $lastname && $phone) {
        if (!empty($firstname) && !preg_match('/^[A-Z][a-z]{2,10}$/', $firstname)) {
            $fname_error = "Incorrect first name";
            setcookie("fname_error", $fname_error, time() + 5);
            header("Location: settings.php");
            exit;
        }

        if (!empty($lastname) && !preg_match('/^[A-Z][a-z]{2,10}$/', $lastname)) {
            $lname_error = "Incorrect last name";
            setcookie("lname_error", $lname_error, time() + 5);
            header("Location: settings.php");
            exit;
        }

        if (!empty($phone) && !preg_match('/^5\d{9}$/', $phone)) {
            $phone_error = "Incorrect phone";
            setcookie("phone_error", $phone_error, time() + 5);
            header("Location: settings.php");
            exit;
        }
    }

    if (empty($fname_error) && empty($lname_error) && empty($phone_error)) {

        try {
            $sql = "update users set first_name=:firstname,last_name=:lastname,phone=:phone,gender=:gender,birth_date=:birthday where user_id=$user_id";
            $stmt = $db->prepare($sql);
            $data = ["firstname" => $_POST["firstname"], "lastname" => $_POST["lastname"], "phone" => $_POST["phone"], "gender" => $_POST["gender"], "birthday" => $_POST["birthday"]];
            $stmt->execute($data);

            $sql = "select * from users where user_id=?";
            $statement = $db->prepare($sql);
            $statement->execute([$user_id]);
            $userInfo = $statement->fetch(PDO::FETCH_ASSOC);
            $_SESSION['updatedUser'] = $userInfo;

            $info = "Your changes have been updated";
            setcookie("info", $info, time() + 5);

            header("Location: settings.php");
            exit;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
