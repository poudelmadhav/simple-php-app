<?php
$dsn = 'mysql:dbname=ecommerce;host=localhost';
$user = 'root';
$password = 'password';

$name = $_POST['name'];
$description = $_POST['description'];

try {
	$dbh = new PDO($dsn, $user, $password);
	$sql = "INSERT INTO categories (name, description) values('$name', '$description')";
	$dbh->query($sql);

	header("Location: index.php?message=Category successfully inserted!");
	die;
	// echo "Category inserted successfully";
} catch (PDOException $e) {
	echo 'Connection failed: '.$e->getMessage ();
}
