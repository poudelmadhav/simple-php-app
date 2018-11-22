<?php
function checkLogin() {
	if(!isset($_SESSION['is_user_login'])) {
		header("Location: login.php?message=You are not logged in yet!");
		die;
	}
}