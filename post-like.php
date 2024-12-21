<?php
require 'includes/header.php';

if (!isUserLoggedIn()) {
    header('Location: login.php');
    exit;
}

$post_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

if (hasUserLikedPost($user_id, $post_id)) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("INSERT INTO likes (user_id, post_id) VALUES (:user_id, :post_id)");
$stmt->execute(['user_id' => $user_id, 'post_id' => $post_id]);

header('Location: index.php');
exit;
?>