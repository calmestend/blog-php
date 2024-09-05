<?php 
	namespace App\components;
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Blog - Sign Up</title>
		<script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
	</head>
	<body>
		<?php require "bar.php" ?>

		<form class="my-4" action="/blog-reto-01/src/api/auth/signup.php" method="POST">
			<div class="row mb-3">
				<label for="username" class="col-sm-2 col-form-label">Username</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="username" name="username">
				</div>
			</div>
			<div class="row mb-3">
				<label for="email" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-3">
					<input type="email" class="form-control" id="email" name="email">
				</div>
			</div>
			<div class="row mb-3">
				<label for="password" class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-3">
					<input type="password" class="form-control" id="password" name="password">
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Sign up</button>
			<button type="button" class="btn btn-secondary">Log in</button>
		</form>

	</body>
</html>

