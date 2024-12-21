<?php
require 'includes/header.php';

if (!isUserLoggedIn()) {
    header('Location: login.php');
    exit;
}

$post_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO comments (content, user_id, post_id) VALUES (:content, :user_id, :post_id)");
    $stmt->execute(['content' => $content, 'user_id' => $user_id, 'post_id' => $post_id]);

    header('Location: index.php');
    exit;
}
?>

<div class="container mt-5">
    <h2>Comment on Post</h2>
    <form action="post-comment.php?id=<?php echo $post_id; ?>" method="post">
        <div class="mb-3">
            <label for="content" class="form-label">Comment</label>
            <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </form>
</div>