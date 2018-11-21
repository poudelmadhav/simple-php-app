<!DOCTYPE html>
<html>
<head>
	<title>Add Category</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3 mt-5">
				<h2>Add Category</h2>
				<form method="post" action="addcategory.php">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" id="name" class="form-control">
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea id="description" name="description" class="form-control"></textarea>
					</div>
					<div>
						<button type="submit" class="btn btn-info">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>