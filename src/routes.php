<?php
namespace App;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
	'/blog-reto-01/' => 'src/components/index.php',
	'/blog-reto-01/login' => 'src/components/login.php',
	'/blog-reto-01/signup' => 'src/components/signup.php',
];

if (array_key_exists($uri, $routes)) {
	require $routes[$uri];
} else {
	require "src/components/error.php";
}

?>
