<?php 
namespace App\components;
session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Blog</title>
		<script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
		<script>
			function addCategory() {
				const categoryInput = document.getElementById('newCategory');
				const categoriesContainer = document.getElementById('categoriesContainer');

				if (categoryInput.value.trim() !== '') {
					const newCategoryDiv = document.createElement('div');
					newCategoryDiv.className = 'input-group mb-2';

					const newCategoryInput = document.createElement('input');
					newCategoryInput.type = 'text';
					newCategoryInput.name = 'categories[]';
					newCategoryInput.className = 'form-control';
					newCategoryInput.value = categoryInput.value;
					newCategoryInput.readOnly = true;

					const removeButton = document.createElement('button');
					removeButton.className = 'btn btn-danger';
					removeButton.innerHTML = 'Delete';
					removeButton.type = 'button';
					removeButton.onclick = function() {
						categoriesContainer.removeChild(newCategoryDiv);
					};

					newCategoryDiv.appendChild(newCategoryInput);
					newCategoryDiv.appendChild(removeButton);

					categoriesContainer.appendChild(newCategoryDiv);
					categoryInput.value = '';
				}
			}
		</script>
	</head>
	<body>
		<?php require "bar.php" ?>

		<div class="container my-4">
			<h1>Create Post</h1>

			<form action="/blog-reto-01/src/api/posts/create.php" method="POST">
				<div class="mb-3">
					<label for="title" class="form-label">Title</label>
					<input type="text" class="form-control" id="title" name="title" required>
				</div>

				<div class="mb-3">
					<label for="content" class="form-label">Content</label>
					<textarea class="form-control" id="content" name="content" rows="5" required></textarea>
				</div>

				<div class="mb-3">
					<label for="categories" class="form-label">Categories</label>
					<div id="categoriesContainer"></div>

					<div class="input-group mb-3">
						<input type="text" id="newCategory" class="form-control" placeholder="Category name">
						<button type="button" class="btn btn-success" onclick="addCategory()">Add category</button>
					</div>
				</div>

				<button type="submit" class="btn btn-primary">Create Post</button>
			</form>
		</div>

	</body>
</html>



