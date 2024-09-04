<?php
namespace App\core;
use PDO, PDOStatement;

class Posts {
	private PDO $conn;

	private int $post_id;
	private string $title;
	private string $content;
	private int $user_id;
	private string $created_at;

	public function __construct(PDO $db)
	{
		$this->conn = $db;
	}

	public function select() : PDOStatement | bool
	{
		$query = "SELECT * FROM posts";

		$statement = $this->conn->prepare($query);
		$statement->execute();
		return $statement;
	}

	public function insert() : bool
	{
		$query = "INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)";

		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->content = htmlspecialchars(strip_tags($this->content));
		$this->user_id = htmlspecialchars(strip_tags($this->user_id));

		$statement = $this->conn->prepare($query);

		$statement->bindParam(1, $this->title);
		$statement->bindParam(2, $this->content);
		$statement->bindParam(3, $this->user_id);

		return $statement->execute() ? true : false;
	}
}

?>
