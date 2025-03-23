<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbxbus";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$hashed_password = password_hash("12", PASSWORD_DEFAULT);
$sql = "INSERT INTO users (ten_dang_nhap, mat_khau) VALUES ('nvtest', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "Tạo tài khoản thành công!";
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->close();
?>
