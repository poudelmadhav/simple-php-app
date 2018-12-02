<?php
include "../config.php";
checkLogin();

$name = $_POST['name'];
$description = $_POST['description'];
$status = $_POST['status'];

$sql = "INSERT INTO categories (name, description, status) values('$name', '$description', '$status')";
$db->query($sql);

header("Location: categories.php?message=Category successfully inserted!");
die;
