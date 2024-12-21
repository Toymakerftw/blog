<?php
require 'includes/header.php';

if (!isUserLoggedIn()) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_url = $_POST['image_url'];
    $author_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO posts (title, content, image_url, author_id) VALUES (:title, :content, :image_url, :author_id)");
    $stmt->execute(['title' => $title, 'content' => $content, 'image_url' => $image_url, 'author_id' => $author_id]);

    header('Location: index.php');
    exit;
}
?>

<div class="container mt-5">
    <h2>Create Post</h2>
    <form action="create-post.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="image_url" name="image_url">
        </div>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>