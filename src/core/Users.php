<?php
namespace App\core;
use PDO, PDOStatement;

class Users {
	private PDO $conn;

	private int $user_id;
	private string $username;
	private string $email;
	private string $password;
	private string $created_at;

	public function __construct(PDO $db)
	{
		$this->conn = $db;
	}

	public function select() : PDOStatement | bool
	{
		$query = "SELECT * FROM users";

		$statement = $this->conn->prepare($query);
		$statement->execute();
		return $statement;
	}

	public function insert() : bool
	{
		$query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

		$this->username = htmlspecialchars(strip_tags($this->username));
		$this->email = htmlspecialchars(strip_tags($this->email));
		$this->password = htmlspecialchars(strip_tags($this->password));

		$statement = $this->conn->prepare($query);

		$statement->bindParam(1, $this->username);
		$statement->bindParam(2, $this->email);
		$statement->bindParam(3, $this->password);

		return $statement->execute() ? true : false;
	}
}

?>

