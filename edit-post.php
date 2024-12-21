<?php
require 'includes/header.php';

if (!isUserLoggedIn()) {
    header('Location: login.php');
    exit;
}

$post_id = $_GET['id'];
$post = getPostById($post_id);

if ($post['author_id'] != $_SESSION['user_id']) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_url = $_POST['image_url'];

    $stmt = $pdo->prepare("UPDATE posts SET title = :title, content = :content, image_url = :image_url WHERE id = :id");
    $stmt->execute(['title' => $title, 'content' => $content, 'image_url' => $image_url, 'id' => $post_id]);

    header('Location: index.php');
    exit;
}
?>

<div class="container mt-5">
    <h2>Edit Post</h2>
    <form action="edit-post.php?id=<?php echo $post_id; ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $post['title']; ?>" required>
        </div class="mb-3">
 <label>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="4" required><?php echo $post['content']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo $post['image_url']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>