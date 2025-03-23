<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbxbus";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$mpc = isset($_GET['mpc']) ? intval($_GET['mpc']) : 0;

if ($mpc > 0) {
    $sql = "SELECT * FROM phan_cong WHERE mpc = $mpc";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Không tìm thấy bản ghi!");
    }
} else {
    die("ID không hợp lệ!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mns = $_POST['mns'];
    $ten_nhan_su = $_POST['ten_nhan_su'];
    $nam_sinh = $_POST['nam_sinh'];
    $vi_tri = $_POST['vi_tri'];
    $tuyen_xe = $_POST['tuyen_xe'];
    $ca_lam = $_POST['ca_lam'];
    $ngay_lam = $_POST['ngay_lam'];

    $sql_update = "UPDATE phan_cong SET 
                    mns='$mns', 
                    ten_nhan_su='$ten_nhan_su', 
                    nam_sinh='$nam_sinh', 
                    vi_tri='$vi_tri', 
                    tuyen_xe='$tuyen_xe', 
                    ca_lam='$ca_lam', 
                    ngay_lam='$ngay_lam' 
                   WHERE mpc=$mpc";

    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='5viewpc.php';</script>";
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
    <title>Chỉnh sửa phân công</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            text-align: left;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            width: 48%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-btn {
            background-color: #6c757d;
            text-decoration: none;
            display: inline-block;
            padding: 10px 15px;
            border-radius: 5px;
            color: white;
            text-align: center;
            font-size: 16px;
            width: 48%;
        }

        .back-btn:hover {
            background-color: #545b62;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Chỉnh sửa phân công</h2>
        <form method="POST">
            <label>MNS:</label>
            <input type="text" name="mns" value="<?= $row['mns'] ?>" required>

            <label>Tên Nhân Sự:</label>
            <input type="text" name="ten_nhan_su" value="<?= $row['ten_nhan_su'] ?>" required>

            <label>Năm Sinh:</label>
            <input type="number" name="nam_sinh" value="<?= $row['nam_sinh'] ?>" required>

            <label>Vị Trí:</label>
            <input type="text" name="vi_tri" value="<?= $row['vi_tri'] ?>" required>

            <label>Tuyến Xe:</label>
            <input type="text" name="tuyen_xe" value="<?= $row['tuyen_xe'] ?>" required>

            <label>Ca Làm:</label>
            <input type="text" name="ca_lam" value="<?= $row['ca_lam'] ?>" required>

            <label>Ngày Làm:</label>
            <input type="date" name="ngay_lam" value="<?= $row['ngay_lam'] ?>" required>

            <div class="btn-container">
                <button type="submit">Cập nhật</button>
                <a href="5viewpc.php" class="back-btn">🔙 Quay lại</a>
            </div>
        </form>
    </div>
</body>
</html>
