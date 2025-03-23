<?php
include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $image = $_POST['image'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts (title, image, content) VALUES ('$title', '$image', '$content')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thêm bài viết thành công!'); window.location.href='tt.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Bài Viết</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Thêm Bài Viết</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Link Ảnh</label>
                <input type="text" class="form-control" name="image" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nội dung</label>
                <textarea class="form-control" name="content" rows="5" required></textarea>
            </div>
            <div style="display: flex;">
                <button style="margin-right: 20px;" type="submit" class="btn btn-primary">Thêm</button>
                <button style="background-color:blue;" type="submit"> <a style="text-decoration: none; color: aliceblue; background-color:blue;" href="tt.php">Quay lại</a> </button>
            </div>
        </form>
    </div>
</body>
</html>
