<?php
require_once '../db_connect.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $thread_id = $_POST["thread_id"];
    $content = $_POST["content"];
    $author = $_SESSION["username"];

    try {
        $thread_id = mysqli_real_escape_string($conn, $thread_id);
        $content = mysqli_real_escape_string($conn, $content);
        $author = mysqli_real_escape_string($conn, $author);

        $sql = "INSERT INTO community_posts (thread_id, content, author, created_at) VALUES ('$thread_id', '$content', '$author', NOW())";

        if ($conn->query($sql) === TRUE) {
            header("Location: view_thread.php?id=" . $thread_id);
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

