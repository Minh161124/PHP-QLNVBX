<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbxbus";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$employee_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($employee_id) {
    $sql = "SELECT * FROM nhan_su WHERE ma_nhan_su = $employee_id";
    $result = $conn->query($sql);
    $employee = $result->fetch_assoc();
} else {
    echo "Không có nhân viên nào được chọn.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_dang_nhap = $_POST['ten_dang_nhap'];
    $ho_va_ten = $_POST['ho_va_ten'];
    $ngay_sinh = $_POST['ngay_sinh'];
    $gioi_tinh = $_POST['gioi_tinh'];
    $dia_chi = $_POST['dia_chi'];
    $so_dien_thoai = $_POST['so_dien_thoai'];
    $email = $_POST['email'];
    $phong_ban = $_POST['phong_ban'];
    $luong = $_POST['luong'];
    $thuong = $_POST['thuong'];
    $trinh_do_hoc_van = $_POST['trinh_do_hoc_van'];
    $quan_ly = $_POST['quan_ly'];

    $sql_update = "UPDATE nhan_su SET 
                    ten_dang_nhap = '$ten_dang_nhap',
                    ho_va_ten = '$ho_va_ten',
                    ngay_sinh = '$ngay_sinh',
                    gioi_tinh = '$gioi_tinh',
                    dia_chi = '$dia_chi',
                    so_dien_thoai = '$so_dien_thoai',
                    email = '$email',
                    phong_ban = '$phong_ban',
                    luong = '$luong',
                    thuong = '$thuong',
                    trinh_do_hoc_van = '$trinh_do_hoc_van',
                    quan_ly = '$quan_ly'
                    WHERE ma_nhan_su = $employee_id";

    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Cập nhật thông tin thành công!'); window.location.href='3viewnv.php';</script>";
    } else {
        echo "Lỗi khi cập nhật thông tin: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Profile</title>
    <style>
    body {
        font-family: "Times New Roman", sans-serif;
        background-color: #f2f2f2;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }

    .container {
        width: 600px;
        padding: 20px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .form-group {
        text-align: left;
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .flat-button {
        background-color: #258eff;
        color: white;
        border: none;
        font-size: 16px;
        padding: 12px 18px;
        cursor: pointer;
        border-radius: 5px;
        width: 100%;
    }

    .flat-button:hover {
        background-color: #1a3cff;
    }
</style>

</style>

    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Employee Profile</h2>

        <form method="POST" action="">
            <div class="form-group">
                <label for="ten_dang_nhap">Tên đăng nhập:</label>
                <input type="text" id="ten_dang_nhap" name="ten_dang_nhap" value="<?php echo $employee['ten_dang_nhap']; ?>" required>
            </div>

            <div class="form-group">
                <label for="ho_va_ten">Họ và tên:</label>
                <input type="text" id="ho_va_ten" name="ho_va_ten" value="<?php echo $employee['ho_va_ten']; ?>" required>
            </div>

            <div class="form-group">
                <label for="ngay_sinh">Ngày sinh:</label>
                <input type="date" id="ngay_sinh" name="ngay_sinh" value="<?php echo $employee['ngay_sinh']; ?>" required>
            </div>

            <div class="form-group">
                <label for="gioi_tinh">Giới tính:</label>
                <input type="text" id="gioi_tinh" name="gioi_tinh" value="<?php echo $employee['gioi_tinh']; ?>" required>
            </div>

            <div class="form-group">
                <label for="dia_chi">Địa chỉ:</label>
                <input type="text" id="dia_chi" name="dia_chi" value="<?php echo $employee['dia_chi']; ?>" required>
            </div>

            <div class="form-group">
                <label for="so_dien_thoai">Số điện thoại:</label>
                <input type="text" id="so_dien_thoai" name="so_dien_thoai" value="<?php echo $employee['so_dien_thoai']; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $employee['email']; ?>" required>
            </div>

            <div class="form-group">
                <label for="phong_ban">Phòng ban:</label>
                <input type="text" id="phong_ban" name="phong_ban" value="<?php echo $employee['phong_ban']; ?>" required>
            </div>

            <div class="form-group">
                <label for="luong">Lương:</label>
                <input type="text" id="luong" name="luong" value="<?php echo $employee['luong']; ?>" required>
            </div>

            <div class="form-group">
                <label for="thuong">Thưởng:</label>
                <input type="text" id="thuong" name="thuong" value="<?php echo $employee['thuong']; ?>" required>
            </div>

            <div class="form-group">
                <label for="trinh_do_hoc_van">Trình độ học vấn:</label>
                <input type="text" id="trinh_do_hoc_van" name="trinh_do_hoc_van" value="<?php echo $employee['trinh_do_hoc_van']; ?>" required>
            </div>

            <div class="form-group">
                <label for="quan_ly">Quản lý:</label>
                <input type="text" id="quan_ly" name="quan_ly" value="<?php echo $employee['quan_ly']; ?>" required>
            </div>

            <button type="submit" class="flat-button">Cập nhật</button>
        </form>
    </div>

</body>
</html>
