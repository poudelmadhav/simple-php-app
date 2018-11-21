<!DOCTYPE html>
<html>
<head>
	<title>Add Category</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3 mt-5 padding-5 border p-4">
				<h2>Add Category</h2>
				<form onsubmit="return validate();" method="post" action="addcategory.php">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" id="name" class="form-control">
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea id="description" name="description" id="description" class="form-control"></textarea>
					</div>
					<div>
						<button type="submit" class="btn btn-info">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
		function checkValue(ele, msg) {
			if (ele.nextSibling) {
				ele.nextSibling.remove();
			}
			if (ele.value === "") {
				ele.classList.add('is-invalid');
				let span = document.createElement("span");
				span.style.color = 'red';
				span.textContent = 'This field cannot be empty. Please enter '+ msg + '.';
				ele.parentNode.appendChild(span);
				return false;
			}
			else {
				ele.classList.remove('is-invalid');
				return true;
			}
		}
		function validate() {
			let name = document.querySelector('#name');
			let desc = document.querySelector('#description');

			let validName = checkValue(name, 'name');
			let validdesc = checkValue(desc, 'description');

			
			if (validName && validdesc && validEmail) {
				return true;
			} else {
				return false;
			}
		}
	</script>
</body>
</html>