<?php
namespace App\core;
use PDO, PDOStatement;

class Post_categories {
	private PDO $conn;

	private int $post_id;
	private string $category_id;

	public function __construct(PDO $db)
	{
		$this->conn = $db;
	}

	public function select() : PDOStatement | bool
	{
		$query = "SELECT * FROM post_categories";

		$statement = $this->conn->prepare($query);
		$statement->execute();
		return $statement;
	}

	public function insert() : bool
	{
		$query = "INSERT INTO post_categories (post_id, category_id) VALUES (?)";

		$this->post_id = htmlspecialchars(strip_tags($this->post_id));
		$this->category_id = htmlspecialchars(strip_tags($this->category_id));

		$statement = $this->conn->prepare($query);
		$statement->bindParam(1, $this->post_id);
		$statement->bindParam(2, $this->category_id);

		return $statement->execute() ? true : false;
	}
}

?>

