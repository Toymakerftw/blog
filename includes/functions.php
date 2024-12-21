<?php
function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getUserById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getPostById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getPosts() {
    global $pdo;
    $stmt = $pdo->query("SELECT p.*, u.username FROM posts p JOIN users u ON p.author_id = u.id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getLikesCount($post_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM likes WHERE post_id = :post_id");
    $stmt->execute(['post_id' => $post_id]);
    return $stmt->fetchColumn();
}

function hasUserLikedPost($user_id, $post_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT 1 FROM likes WHERE user_id = :user_id AND post_id = :post_id");
    $stmt->execute(['user_id' => $user_id, 'post_id' => $post_id]);
    return $stmt->fetchColumn() > 0;
}

function getCommentsByPostId($post_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT c.*, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.post_id = :post_id");
    $stmt->execute(['post_id' => $post_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>