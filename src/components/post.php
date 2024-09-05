<?php
namespace App\components;
session_start();

use App\core\Post_categories;
use App\core\Categories;
use App\core\Comments;
use App\includes\Database;
use PDO;

$db = new Database();
$pdo = $db->connect();

$postCategories = new Post_categories($pdo);
$categories = new Categories($pdo);
$comments = new Comments($pdo);

$allCategories = $categories->select();
$categoriesList = [];
while ($row = $allCategories->fetch(PDO::FETCH_ASSOC)) {
    $categoriesList[] = $row['name'];
}

$selectedCategory = $_GET['category'] ?? '';
$postsWithCategories = $postCategories->selectWithCategories($selectedCategory);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts List</title>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <?php require "bar.php" ?>

    <div class="container mt-4">
        <h1>Posts</h1>

        <form class="mb-4" method="GET" action="">
            <div class="form-group">
                <label for="category">Filter by category:</label>
                <select id="category" name="category" class="form-select">
                    <option value="">All Categories</option>
                    <?php foreach ($categoriesList as $category): ?>
                    <option value="<?php echo htmlspecialchars($category); ?>" <?php echo $selectedCategory === $category ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($category); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Filter</button>
        </form>

        <div class="row">
            <?php if (!empty($postsWithCategories)): ?>
            <?php foreach ($postsWithCategories as $post): ?>
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Title: <?php echo htmlspecialchars($post['title']); ?></h2>
                        <p class="card-text"><strong>Content</strong> <br><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                        <p><strong>Categories</strong></p>
                        <ul class="list-group">
                            <?php foreach ($post['categories'] as $category): ?>
                            <li class="list-group-item"><?php echo htmlspecialchars($category); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <form class="mt-4" method="POST" action="/blog-reto-01/src/api/comments/create.php">
                    <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['post_id']); ?>">
                    <div class="form-group">
                        <label for="comment">Add comment:</label>
                        <textarea id="comment" name="comment" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Add</button>
                </form>

                <form class="mt-2 view-comments-form" method="POST" data-post-id="<?php echo htmlspecialchars($post['post_id']); ?>">
                    <button type="button" class="btn btn-secondary mt-2 view-comments-button">View Comments</button>
                </form>

                <div class="comments-container"></div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p>No posts found</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.view-comments-button').forEach(button => {
            button.addEventListener('click', (e) => {
                const form = e.target.closest('.view-comments-form');
                const postId = form.getAttribute('data-post-id');
                const commentsContainer = form.nextElementSibling;

                fetch('/blog-reto-01/src/api/comments/view.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `post_id=${postId}`
                })
                .then(response => response.json())
                .then(comments => {
                    commentsContainer.innerHTML = '';
                    comments.forEach(comment => {
                        const commentElement = document.createElement('div');
                        commentElement.classList.add('comment');
                        commentElement.innerHTML = `
                            <p><strong>User ID:</strong> ${comment.user_id}</p>
                            <p><strong>Comment:</strong> ${comment.comment}</p>
                            <p><strong>Created At:</strong> ${comment.created_at}</p>
                        `;
                        commentsContainer.appendChild(commentElement);
                    });
                });
            });
        });
    });
    </script>
</body>
</html>

