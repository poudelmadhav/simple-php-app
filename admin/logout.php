<?php
include '../config.php';

unset($_SESSION['is_user_login']);

header("Location: login.php?message=You are successfully logged out!");
die;