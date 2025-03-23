<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbxbus";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (!isset($_GET['muv']) || empty($_GET['muv'])) {
    die("Mã ứng viên không hợp lệ!");
}

$muv = intval($_GET['muv']);

$sql = "SELECT * FROM ung_vien WHERE muv = $muv";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Ứng viên không tồn tại!");
}

$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mns = $_POST['mns'];
    $ho_ten_uv = $_POST['ho_ten_uv'];
    $gioi_tinh_uv = $_POST['gioi_tinh_uv'];
    $sdt_uv = $_POST['sdt_uv'];
    $trinh_do = $_POST['trinh_do'];
    $ngay_lam = $_POST['ngay_lam'];

    $sql_update = "UPDATE ung_vien SET 
        mns='$mns', 
        ho_ten_uv='$ho_ten_uv', 
        gioi_tinh_uv='$gioi_tinh_uv', 
        sdt_uv='$sdt_uv', 
        trinh_do='$trinh_do', 
        ngay_lam='$ngay_lam' 
        WHERE muv=$muv";

    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='11viewtd.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi cập nhật dữ liệu!');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa ứng viên</title>
    <style>
        body { font-family: "Times New Roman", sans-serif; background-color: #f2f2f2; text-align: center; }
        .container { width: 400px; padding: 20px; background-color: white; margin: auto; border-radius: 10px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2); }
        h2 { color: rgb(75, 147, 255); }
        form { text-align: left; }
        label { font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px; }
        button { background-color: #258eff; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; width: 100%; }
        button:hover { background-color: #1d70c0; }
        .back-button { display: block; text-align: center; margin-top: 10px; text-decoration: none; color: #258eff; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Chỉnh sửa ứng viên</h2>
        <form method="post">
            <label for="mns">Mã nhân sự:</label>
            <input type="text" name="mns" id="mns" value="<?= $row['mns'] ?>" required>

            <label for="ho_ten_uv">Họ và tên:</label>
            <input type="text" name="ho_ten_uv" id="ho_ten_uv" value="<?= $row['ho_ten_uv'] ?>" required>

            <label for="gioi_tinh_uv">Giới tính:</label>
            <select name="gioi_tinh_uv" id="gioi_tinh_uv">
                <option value="Nam" <?= ($row['gioi_tinh_uv'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
                <option value="Nữ" <?= ($row['gioi_tinh_uv'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
            </select>

            <label for="sdt_uv">Số điện thoại:</label>
            <input type="text" name="sdt_uv" id="sdt_uv" value="<?= $row['sdt_uv'] ?>" required>

            <label for="trinh_do">Trình độ:</label>
            <input type="text" name="trinh_do" id="trinh_do" value="<?= $row['trinh_do'] ?>" required>

            <label for="ngay_lam">Ngày làm:</label>
            <input type="date" name="ngay_lam" id="ngay_lam" value="<?= $row['ngay_lam'] ?>" required>

            <button type="submit">Lưu thay đổi</button>
        </form>
        <a href="11viewtd.php" class="back-button">Quay lại</a>
    </div>
</body>
</html>
