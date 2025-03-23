<?php
session_start();
include('config.php');

// Kiểm tra nếu có tham số mcc trên URL
if (isset($_GET['mcc'])) {
    $mcc = $_GET['mcc'];

    // Lấy thông tin chấm công theo MCC
    $sql = "SELECT * FROM cham_cong WHERE mcc = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $mcc);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
} else {
    echo "MCC không hợp lệ.";
    exit;
}

// Xử lý cập nhật khi nhấn nút Lưu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mns = $_POST['mns'];
    $ngay_cham = $_POST['ngay_cham'];
    $ca_lam = $_POST['ca_lam'];
    $tinh_trang = $_POST['tinh_trang'];
    $luong_cb = $_POST['luong_cb'];
    $so_ngay_cong = $_POST['so_ngay_cong'];
    $phu_cap = $_POST['phu_cap'];

    $sql_update = "UPDATE cham_cong SET mns=?, ngay_cham=?, ca_lam=?, tinh_trang=?, luong_cb=?, so_ngay_cong=?, phu_cap=? WHERE mcc=?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssssddds", $mns, $ngay_cham, $ca_lam, $tinh_trang, $luong_cb, $so_ngay_cong, $phu_cap, $mcc);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='7viewccvlt.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Chấm Công</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sửa Chấm Công</h2>
        <form method="POST">
            <input type="text" name="mns" value="<?php echo $data['mns']; ?>" required>
            <input type="date" name="ngay_cham" value="<?php echo $data['ngay_cham']; ?>" required>
            <input type="text" name="ca_lam" value="<?php echo $data['ca_lam']; ?>" required>
            <input type="text" name="tinh_trang" value="<?php echo $data['tinh_trang']; ?>" required>
            <input type="number" step="0.01" name="luong_cb" value="<?php echo $data['luong_cb']; ?>" required>
            <input type="number" name="so_ngay_cong" value="<?php echo $data['so_ngay_cong']; ?>" required>
            <input type="number" step="0.01" name="phu_cap" value="<?php echo $data['phu_cap']; ?>" required>
            <button type="submit">💾 Lưu</button>
        </form>
        <br>
        <a href="7viewccvlt.php">🔙 Quay lại</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
