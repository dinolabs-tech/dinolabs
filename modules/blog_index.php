<?php
session_start();
include("db_connect.php");

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$posts_per_page = 10;
$offset = ($page - 1) * $posts_per_page;

$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

$where = [];
$params = [];

if (!empty($search)) {
    $where[] = "title LIKE ?";
    $params[] = "%" . $search . "%";
}

if (!empty($category)) {
    $where[] = "category_id = ?";
    $params[] = $category;
}

$where_clause = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";

$sql = "SELECT * FROM posts " . $where_clause . " ORDER BY created_at DESC LIMIT $posts_per_page OFFSET $offset";

if (!empty($params)) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($sql);
}

$sql_total_posts = "SELECT COUNT(*) AS total FROM posts " . $where_clause;
if (!empty($params)) {
    $stmt = $conn->prepare($sql_total_posts);
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
    $stmt->execute();
    $result_total_posts = $stmt->get_result();
    $total_posts = $result_total_posts->fetch_assoc()['total'];
} else {
    $result_total_posts = $conn->query($sql_total_posts);
    $total_posts = $result_total_posts->fetch_assoc()['total'];
}

$total_pages = ceil($total_posts / $posts_per_page);
?>
