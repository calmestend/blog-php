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
	$password = $_POST['password'] ?? '';

	$user = new Users(db: $pdo, username: $username);

	try 
	{
		$result = $user->selectByUsername();
		if ($result && $password === $result['password']) 
		{

			session_start();
			$_SESSION['user_id'] = $result['user_id'];
			$_SESSION['username'] = $result['username'];

			header("Location: /blog-reto-01/");
			exit();
		} else 
		{
			header("Location: /blog-reto-01/login");
			exit();
		}
	} catch (PDOException $error) 
	{
		header("Location: /blog-reto-01/login");
		exit();
	}
}
?>

