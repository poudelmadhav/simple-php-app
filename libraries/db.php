<?php
$dsn = 'mysql:dbname='._DB_NAME.';host='._DB_HOST;
$user = _DB_USER;
$password = _DB_PASSWORD;
$db = null;

try {
	$db = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
	echo $e->getMessage ();
}
