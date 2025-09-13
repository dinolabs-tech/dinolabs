<?php
require_once '../db_connect.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit();
}

$post_id = $_GET["id"];

// First, fetch the post
$stmt = $conn->prepare("SELECT * FROM community_posts WHERE id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
$stmt->close();

if (!$post || $_SESSION["username"] !== $post["author"]) {
    header("Location: index.php");
    exit();
}

// Now, delete the post from community_posts
$stmt = $conn->prepare("DELETE FROM community_posts WHERE id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$stmt->close();

header("Location: view_thread.php?id=" . $post["thread_id"]);
exit();
?>
