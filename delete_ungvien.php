<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbxbus";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $sql_delete = "DELETE FROM ung_vien WHERE muv = $delete_id";
    
    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('Xóa thành công!'); window.location.href='11viewtd.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa dữ liệu!'); window.location.href='recruitment_management.php';</script>";
    }
}

$conn->close();
?>
