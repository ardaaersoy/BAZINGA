<?php

if(!isset($_SESSION)){
    session_start();
}


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['updatedUser'])) {
    extract($_SESSION['updatedUser']);
} else {
    extract($_SESSION['user']);
}

//extract($_SESSION['page']);
//extract($_SESSION['error']);
