<?php
$dsn = 'mysql:dbname=ecommerce;host=localhost';
$user = 'root';
$password = 'password';

try {
	$dbh = new PDO($dsn, $user, $password);
	// $sql = "INSERT INTO categories (name, description) values('Shoes', 'Wearing at foot')";
	$sql = "SELECT * from categories";
	$categories = $dbh->query($sql);

	// echo "Category inserted successfully";
} catch (PDOException $e) {
	echo 'Connection failed: '.$e->getMessage ();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Categories</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3 mt-5">
				<?php if(isset($_GET['message'])) { ?>
					<div class="alert alert-success">
						<?php
							echo $_GET['message'];
						?>
					</div>
				<?php } ?>
				<h3>List of Categories</h3>
				<a href="addform.php" class="btn btn-info float-right mb-2" role="button">Add new</a>
				<table class="table table-striped table-bordered">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Description</th>
					</tr>
					<?php  foreach($categories as $category) { ?>
					<tr>
						<td><?php echo $category['id']; ?></td>
						<td><?php echo $category['name']; ?></td>
						<td><?php echo $category['description']; ?></td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>