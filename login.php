<?php
session_start();
include('config.php');

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten_dang_nhap = trim($_POST["username"]);
    $mat_khau = trim($_POST["password"]);

    if (!empty($ten_dang_nhap) && !empty($mat_khau)) {
        $sql = "SELECT * FROM users WHERE ten_dang_nhap = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $ten_dang_nhap);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($mat_khau, $user["mat_khau"])) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["ten_dang_nhap"];
                $_SESSION["role"] = $user["role"]; 

             
                if ($user["role"] === "admin") {
                    header("Location: gt.php");

                } elseif ($user["role"] === "nvcc") {
                    header("Location: gt.php");

                } elseif ($user["role"] === "nvpc") {
                    header("Location: gt.php");

                } elseif ($user["role"] === "nvhd") {
                    header("Location: gt.php");

                } elseif ($user["role"] === "nvuv") {
                    header("Location: gt.php");

                } elseif ($user["role"] === "nvns") {
                    header("Location: gt.php");

                } else {
                    $error = "Quyền truy cập không hợp lệ!";
                }
                exit();
            } else {
                $error = "Mật khẩu không chính xác!";
            }
        } else {
            $error = "Tên đăng nhập không tồn tại!";
        }
    } else {
        $error = "Vui lòng nhập đầy đủ thông tin!";
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Đăng nhập</title>
</head>
<body>

    <div class="container">
        <h2>ĐĂNG NHẬP</h2>

        <?php if (!empty($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="input-group">
                <label for="username">TÊN ĐĂNG NHẬP:</label>
                <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
            </div>

            <div class="input-group">
                <label for="password">MẬT KHẨU:</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="show-password">
                <label for="show-password">XEM MẬT KHẨU</label>
            </div>

            <div class="buttons">
                <button type="submit" class="btn btn-login">ĐĂNG NHẬP</button>
                <button type="button" class="btn btn-exit" onclick="window.location.href='login.php'">THOÁT</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById("show-password").addEventListener("change", function() {
            var passwordField = document.getElementById("password");
            passwordField.type = this.checked ? "text" : "password";
        });
    </script>

</body>
</html>
