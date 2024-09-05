<?php
namespace App\api\comments;
session_start();
require_once "../../../vendor/autoload.php";

use App\core\Comments;
use App\includes\Database;
use PDO;

$db = new Database();
$pdo = $db->connect();

$comments = new Comments($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $postId = $_POST['post_id'];

    if ($postId) {
        $comments->setPostId($postId);
        $commentsList = $comments->select()->fetchAll(PDO::FETCH_ASSOC);
    }
}

header('Content-Type: application/json');
echo json_encode($commentsList ?? []);
exit();
?>

