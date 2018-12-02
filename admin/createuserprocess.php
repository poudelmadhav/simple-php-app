<?php
include "../config.php";
checkLogin();

$username = $_POST['username'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$status = $_POST['status'];

$sql = "INSERT INTO users (username, password, first_name, last_name, status) values('$username', md5('$password'), '$first_name', '$last_name', '$status')";
$db->query($sql);

header("Location: users.php?message=User successfully inserted!");
die;
