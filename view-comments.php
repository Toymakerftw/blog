<?php
require 'includes/header.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$post_id = $_GET['id'];
$post = getPostById($post_id);

if (!$post) {
    header('Location: index.php');
    exit;
}

$comments = getCommentsByPostId($post_id);
?>

<div class="container mt-5">
    <h2>Comments on "<?php echo htmlspecialchars($post['title']); ?>"</h2>
    <p><?php echo htmlspecialchars($post['content']); ?></p>
    <p><small class="text-muted">By <?php echo htmlspecialchars($post['username']); ?> on <?php echo $post['created_at']; ?></small></p>
    <p>Likes: <?php echo getLikesCount($post['id']); ?></p>
    <a href="post-like.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Like</a>
    <a href="post-comment.php?id=<?php echo $post['id']; ?>" class="btn btn-secondary">Comment</a>
    <?php if (isUserLoggedIn() && $post['author_id'] == $_SESSION['user_id']): ?>
        <a href="edit-post.php?id=<?php echo $post['id']; ?>" class="btn btn-warning">Edit</a>
        <a href="delete-post.php?id=<?php echo $post['id']; ?>" class="btn btn-danger">Delete</a>
    <?php endif; ?>

    <hr>

    <h3>Comments</h3>
    <?php if (empty($comments)): ?>
        <p>No comments yet.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($comments as $comment): ?>
                <li class="list-group-item">
                    <strong><?php echo htmlspecialchars($comment['username']); ?>:</strong>
                    <p><?php echo htmlspecialchars($comment['content']); ?></p>
                    <small class="text-muted"><?php echo $comment['created_at']; ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<?php
require 'includes/footer.php';
?>