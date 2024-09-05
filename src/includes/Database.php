<?php
namespace App\includes;
use PDO;
use PDOException;

class Database {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $name = "blog";
	private $charset = "utf8mb4";
	private PDO $pdo;

	public function connect(): PDO
	{

		$attr = "mysql:host={$this->host};dbname={$this->name};charset={$this->charset}";

		try {

			$this->pdo = new PDO($attr, $this->user, $this->password);
			$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$this->pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $this->pdo;
		} catch (PDOException $e) {
			die("Connection Error: " . $e->getMessage());
		}
	}

	public function disconnect() : void
	{
		$this->pdo = null;
	}
}

?>
