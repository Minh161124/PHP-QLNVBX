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
    $delete_id = $_GET['delete_id'];
    
    $delete_sql = "DELETE FROM nhan_su WHERE ma_nhan_su = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "<script>alert('Xóa thành công!'); window.location.href='3viewnv.php';</script>";
    } else {
        echo "<script>alert('Xóa thất bại!'); window.location.href='3viewnv.php';</script>";
    }
    
    $stmt->close();
}

$sql = "SELECT * FROM nhan_su";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết nhân sự</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #007bff;
            font-size: 26px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            transition: 0.3s;
            font-size: 16px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .delete-btn:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Xóa nhân sự</h2>
        <table>
            <tr>
                <th>Mã nhân sự</th>
                <th>Họ và tên</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Phòng ban</th>
                <th>Lương</th>
                <th>Thưởng</th>
                <th>Trình độ</th>
                <th>Quản lý</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['ma_nhan_su'] ?></td>
                <td><?= $row['ho_va_ten'] ?></td>
                <td><?= $row['ngay_sinh'] ?></td>
                <td><?= $row['gioi_tinh'] ?></td>
                <td><?= $row['dia_chi'] ?></td>
                <td><?= $row['so_dien_thoai'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phong_ban'] ?></td>
                <td><?= number_format($row['luong']) ?> VNĐ</td>
                <td><?= number_format($row['thuong']) ?> VNĐ</td>
                <td><?= $row['trinh_do_hoc_van'] ?></td>
                <td><?= $row['quan_ly'] ?></td>
                <td>
                    <a href="?delete_id=<?= $row['ma_nhan_su'] ?>" class="delete-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa nhân sự này không?')">Xóa</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <a href="3viewnv.php" class="back-button">Quay lại</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
