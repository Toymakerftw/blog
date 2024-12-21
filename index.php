<?php
require 'includes/header.php';
$posts = getPosts();
?>

<div class="container mt-5">
    <h2>Blog Posts</h2>
    <div class="row">
        <?php foreach ($posts as $post): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo htmlspecialchars($post['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($post['title']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($post['content']); ?></p>
                        <p class="card-text"><small class="text-muted">By <?php echo htmlspecialchars($post['username']); ?> on <?php echo $post['created_at']; ?></small></p>
                        <p class="card-text">Likes: <?php echo getLikesCount($post['id']); ?></p>
                        <a href="post-like.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Like</a>
                        <a href="post-comment.php?id=<?php echo $post['id']; ?>" class="btn btn-secondary">Comment</a>
                        <a href="view-comments.php?id=<?php echo $post['id']; ?>" class="btn btn-info">View Comments</a>
                        <?php if (isUserLoggedIn() && $post['author_id'] == $_SESSION['user_id']): ?>
                            <a href="edit-post.php?id=<?php echo $post['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete-post.php?id=<?php echo $post['id']; ?>" class="btn btn-danger">Delete</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
require 'includes/footer.php';
?>