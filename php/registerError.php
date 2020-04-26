<?php

if (isset($_COOKIE["fname_error"])) {
	$fname_error = unserialize($_COOKIE["fname_error"]);
	$fname_error = $_COOKIE['fname_error'];
}

if (isset($_COOKIE["lname_error"])) {
	$lname_error = unserialize($_COOKIE["lname_error"]);
	$lname_error = $_COOKIE['lname_error'];
}

if (isset($_COOKIE["phone_error"])) {
	$phone_error = unserialize($_COOKIE["phone_error"]);
	$phone_error = $_COOKIE['phone_error'];
}

if (isset($_COOKIE["error"])) {
	$error = unserialize($_COOKIE["error"]);
	$error = $_COOKIE['error'];
}

if (isset($_COOKIE["ext_error"])) {
	$ext_error = unserialize($_COOKIE["ext_error"]);
	$ext_error = $_COOKIE['ext_error'];
}

if (isset($_COOKIE["mb_error"])) {
	$mb_error = unserialize($_COOKIE["mb_error"]);
	$mb_error = $_COOKIE['mb_error'];
}

$csrf_token=md5(uniqid(rand(),true));
$_SESSION['tokenReg']=$csrf_token;