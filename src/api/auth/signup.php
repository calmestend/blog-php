<?php 
namespace App\api\auth;

require_once "../../../vendor/autoload.php";

use App\includes\Database;
use App\core\Users;
use PDOException;

$db = new Database();
$pdo = $db->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
	$username = $_POST['username'] ?? '';
	$email = $_POST['email'] ?? '';
	$password = $_POST['password'] ?? '';

	$user = new Users(db: $pdo, username: $username, email: $email, password: $password);

	try 
	{
		$user->insert();
		header("Location: /blog-reto-01/");
		exit();
	} catch (PDOException $error) 
	{
		header("Location: /blog-reto-01/signup");
		exit();
	}
}

?>
