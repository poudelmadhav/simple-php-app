<?php
	include "../config.php";
	checkLogin();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin - Ecommerce</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-3 mt-2">
				<?php if(isset($_GET['message'])) { ?>
					<div class="alert alert-success">
						<?php
							echo $_GET['message'];
						?>
					</div>
				<?php } ?>
				<h1>Welcome to Ecommerce  Admin Panel</h1>
				<a href="logout.php" onclick="return  confirm('Are you sure to logout?');" class="btn btn-danger">Logout</a>
			</div>
		</div>
	</div>
</body>
</html>