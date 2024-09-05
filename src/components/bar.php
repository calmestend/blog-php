<?php 
namespace App\components;
echo '
<nav class="navbar navbar-expand-lg bg-body-tertiary">
	<div class="container-fluid">
		<a class="navbar-brand" href="/blog-reto-01/">Blog</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li><a href="/blog-reto-01/posts">Posts</a></li>
			</ul>';

if (isset($_SESSION["username"])) {
	echo '
			<form class="d-flex" action="/blog-reto-01/src/api/auth/logout.php" method="POST">
				<button type="submit" class="btn btn-outline-danger mx-2">Log out</button>
			</form>';
} else {
	echo '
			<form class="d-flex" action="/blog-reto-01/login" method="POST">
				<button class="btn btn-outline-success mx-2">Log in</button>
			</form>

			<form class="d-flex" action="/blog-reto-01/signup" method="POST">
				<button class="btn btn-outline-success mx-2">Sign up</button>
			</form>';
}

echo '
		</div>
	</div>
</nav>';
?>
