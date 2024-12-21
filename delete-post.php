<?php
require 'includes/header.php';

if (!isUserLoggedIn()) {
    header('Location: login.php');
    exit;
}

$post_id = $_GET['id'];
$post = getPostById($post_id);

if (!$post) {
    header('Location: index.php');
    exit;
}

if ($post['author_id'] != $_SESSION['user_id']) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
    $stmt->execute(['id' => $post_id]);

    header('Location: index.php');
    exit;
}
?>

<div class="container mt-5">
    <h2>Delete Post</h2>
    <p>Are you sure you want to delete the post titled "<?php echo htmlspecialchars($post['title']); ?>"?</p>
    <form action="delete-post.php?id=<?php echo $post_id; ?>" method="post">
        <button type="submit" class="btn btn-danger">Delete Post</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>