<?php namespace App\components ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Blog - Log in</title>
		<script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
	</head>
	<body>
		<?php require "bar.php" ?>

		<form class="my-4">
			<div class="row mb-3">
				<label for="username" class="col-sm-2 col-form-label">Username</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="username">
				</div>
			</div>
			<div class="row mb-3">
				<label for="password" class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-3">
					<input type="password" class="form-control" id="password">
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Log in</button>
			<button type="button" class="btn btn-secondary">Sign up</button>
		</form>

	</body>
</html>

