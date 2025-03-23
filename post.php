<?php
include 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$result = $conn->query("SELECT * FROM posts WHERE id = $id");
$post = $result->fetch_assoc();

if (!$post) {
    die("Bài viết không tồn tại.");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $post['title'] ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1 class="text-center my-4"><?= $post['title'] ?></h1>
    <img src="<?= $post['image'] ?>" class="img-fluid rounded mx-auto d-block" alt="<?= $post['title'] ?>">
    <p class="text-muted text-center">Ngày đăng: <?= $post['created_at'] ?></p>
    <p class="mt-4"><?= nl2br($post['content']) ?></p>
    <a href="tt.php" class="btn btn-secondary">🔙 Quay lại</a>
</div>
</body>
</html>
