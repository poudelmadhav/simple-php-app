<?php
include "../config.php";

$username = $_POST['username'];
$password = $_POST['pwd'];

$sql = "SELECT * FROM users where username='$username' and password=md5('$password')";
$result = $db->query($sql);
$user = $result->fetch();


if (!empty($user)) {
	// echo "Login success!";
	$_SESSION['is_user_login'] = true;
	header("Location: index.php?message=You are successfully logged in!");
	die;
} else {
	// echo "Invalid Login!";
	header("Location: login.php?message=Invalid login, please try again!");
	die;
}
