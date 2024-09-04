<?php
namespace App\core;
use PDO, PDOStatement;

class Comments {
	private PDO $conn;

	private int $comment_id;
	private int $post_id;
	private int $user_id;
	private string $comment;
	private string $created_at;

	public function __construct(PDO $db)
	{
		$this->conn = $db;
	}

	public function select() : PDOStatement | bool
	{
		$query = "SELECT * FROM comments";

		$statement = $this->conn->prepare($query);
		$statement->execute();

		return $statement;
	}

	public function insert() : bool
	{
		$query = "INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)";

		$this->post_id = htmlspecialchars(strip_tags($this->post_id));
		$this->user_id = htmlspecialchars(strip_tags($this->user_id));
		$this->comment = htmlspecialchars(strip_tags($this->comment));

		$statement = $this->conn->prepare($query);
		$statement->bindParam(1, $this->post_id);
		$statement->bindParam(2, $this->user_id);
		$statement->bindParam(3, $this->comment);

		return $statement->execute() ? true : false;
	}
}

?>

