<?php
	include '../config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login - Ecommetce Admin</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 offset-4">
				<h3>Admin Login</h3>
				<?php if(isset($_GET['message'])) { ?>
					<div class="alert alert-danger">
						<?php
							echo $_GET['message'];
						?>
					</div>
				<?php } ?>
				<form method="post" action="loginprocess.php">
					<div class="form-group">
						<label>Username:</label>
						<input type="text" name="username" placeholder="Username" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Password:</label>
						<input type="password" name="pwd" placeholder="Password" class="form-control" required>
					</div>
					<div>
						<button type="submit" class="btn btn-success">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>