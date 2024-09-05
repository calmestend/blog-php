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

	public function __construct
	(
		PDO $db,
		int $user_id = null,
		string $username = null,
		string $email = null,
		string $password = null,
		string $created_at = null
	)

	{
		$this->conn = $db;

		if ($user_id) 
		{
			$this->user_id = $user_id; 
		}

		if ($username) 
		{
			$this->username = $username;
		}

		if ($email) 
		{
			$this->email = $email;
		}

		if ($password) 
		{
			$this->password = $password;
		}

		if ($created_at) 
		{
			$this->created_at = $created_at;
		}
	}

	public function select() : PDOStatement | bool
	{
		$query = "SELECT * FROM users";

		$statement = $this->conn->prepare($query);
		$statement->execute();
		return $statement;
	}

	public function selectByUsername() : Array
	{
		$query = "SELECT * FROM users WHERE username = ?";

		$this->username = htmlspecialchars(strip_tags($this->username));

		$statement = $this->conn->prepare($query);

		$statement->bindParam(1, $this->username);

		$statement->execute();
		return $statement->fetch(PDO::FETCH_ASSOC);
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
