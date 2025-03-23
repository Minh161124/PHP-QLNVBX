<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    unset($_SESSION['role']); 
    header("Location: gt.php"); 
    exit();
}

$role = $_SESSION['role'] ?? null;

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Tin Tức</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 0;
        }
        header { 
            background: #072fb4; 
            color: white; 
            text-align: center; 
            padding: 15px; 
            position: relative;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        .content-section {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .reports-container {
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }
        .report-box {
            flex: 1;
            background: white;
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .report-box a {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            background: #0099ff;
            color: white;
            text-decoration: none;
            border-radius: 3px;
        }
        .announcement-section {
            text-align: center;
            margin-top: 30px;
        }
        .announcement-section img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 5px;
        }
        .announcement-text {
            margin-top: 15px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .menu-icon { 
            position: absolute; 
            left: 20px; 
            top: 15px; 
            font-size: 24px; 
            cursor: pointer; 
            z-index: 1000; 
        }
        .menu-container { 
            position: fixed; 
            left: 0; 
            top: 0; 
            width: 250px; 
            height: 100%; 
            background: white; 
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2); 
            transform: translateX(-100%); 
            transition: 0.3s; 
            padding-top: 60px; 
            z-index: 999;
        }
        .menu-container.active { 
            transform: translateX(0); 
        }
        .menu a { 
            display: block; 
            padding: 15px; 
            text-decoration: none; 
            color: #333; 
            border-bottom: 1px solid #ddd; 
            cursor: pointer; 
            padding-left: 20px; 
        }
        .menu-icon img { 
            width: 30px; 
            height: 30px; 
            cursor: pointer; 
        }
        .slider { 
            width: 100%; 
            height: 200px; 
            overflow: hidden; 
            position: relative; 
        }
        .slides { 
            display: flex; 
            flex-direction: column; 
            transition: transform 1s ease-in-out; 
        }
        .slides img { 
            width: 100%; 
            height: 200px; 
            object-fit: cover;
        }
        .footer { 
            background: linear-gradient(to bottom, #0099ff, #003366); 
            color: white; 
            padding: 20px; 
            text-align: center; 
        }
    </style>
    <script>
        function toggleMenu() {
            var menu = document.getElementById("menuContainer");
            menu.classList.toggle("active");
        }

        let index = 0;
        function slideShow() {
            const slides = document.querySelector(".slides");
            const images = document.querySelectorAll(".slides img");
            images.forEach(img => img.style.display = "none");
            images[index].style.display = "block";
            index = (index + 1) % images.length;
        }
        setInterval(slideShow, 5000);
        window.onload = slideShow;
    </script>
</head>
<body>
    <header>
        <div class="menu-icon" onclick="toggleMenu()">
            <img src="a1.png" alt="Menu" class="menu-img">
        </div>
        <div id="menuContainer" class="menu-container">
            <div class="menu">
                <a href="gt.php">Giới thiệu</a>
                <a href="tt.php">Tin tức</a>
                <a href="cd.php">Quan hệ cổ đông</a>
                <?php if ($role == 'admin' || $role == 'nvhd'): ?>
                    <a href="9viewhdld.php">Quản Lý Hợp Đồng</a>
                <?php endif; ?>
                <?php if ($role == 'admin' || $role == 'nvns'): ?>
                    <a href="3viewnv.php">Quản Lý Nhân Sự</a>
                <?php endif; ?>
                <?php if ($role == 'admin' || $role == 'nvuv'): ?>
                    <a href="11viewtd.php">Quản Lý Ứng Viên</a>
                <?php endif; ?>
                <?php if ($role == 'admin' || $role == 'nvpc'): ?>
                    <a href="5viewpc.php">Quản Lý Phân Công</a>
                <?php endif; ?>
                <?php if ($role == 'admin' || $role == 'nvcc'): ?>
                    <a href="7viewccvlt.php">Quản Lý Châm Công</a>
                <?php endif; ?>
                <?php if ($role == 'admin'): ?>
                    <a href="add_post.php">Thêm Bài Viết</a>
                <?php endif; ?>
                <?php if ($role == 'admin' || $role == 'nvcc' || $role == 'nvhd' || $role == 'nvns' || $role == 'nvuv' || $role == 'nvpc'): ?>
                    <a href="?logout=true">Đăng Xuất</a>
                <?php else: ?>
                    <a href="login.php">Đăng Nhập</a>
                <?php endif; ?>
            </div>
        </div>
        <h1>THÔNG TIN CỔ ĐÔNG</h1>
    </header>
    <div class="slider">
        <div class="slides">
            <img src="a2.png" alt="Hình 1">
            <img src="a3.png" alt="Hình 2">
            <img src="a4.png" alt="Hình 3">
        </div>
    </div>

    <div class="content-section">
        <div class="reports-container">
            <div class="report-box">
                <h3>BÁO CÁO TÀI CHÍNH 2023</h3>
                <a href="#">Chi tiết</a>
            </div>
            <div class="report-box">
                <h3>BÁO CÁO THƯỜNG NIÊN 2022</h3>
                <a href="#">Chi tiết</a>
            </div>
            <div class="report-box">
                <h3>CÔNG BỐ THÔNG TIN 2023</h3>
                <a href="#">Chi tiết</a>
            </div>
            <div class="report-box">
                <h3>ĐẠI HỘI CỔ ĐÔNG 2023</h3>
                <a href="#">Chi tiết</a>
            </div>
        </div>
    </div>

    <div class="announcement-section">
        <img src="announcement.jpg" alt="Thông tin công bố">
        <div class="announcement-text">
            <h2>Công Bố Thông Tin</h2>
            <p>Thông báo về ngày đăng ký cuối cùng để thực hiện quyền tham dự cuộc họp Đại hội đồng cổ đông thường niên năm 2025.</p>
            <p>Nghị quyết của hội đồng quản trị về việc thông qua tổ chức cuộc họp ĐHĐCĐ thường niên năm 2025.</p>
            <p>Báo cáo tình hình quản trị công ty năm 2024.</p>
            <p>CBTT hợp đồng kiểm toán và soát xét BCTC năm 2024.</p>
        </div>
    </div>
    <footer class="footer">
        <h3>CÔNG TY CỔ PHẦN BẾN XE BUS</h3>
        <p>Địa chỉ: Gác 2 Bến xe Giáp Bát – Giáp Bát – Hoàng Mai – Hà Nội</p>
        <p>Điện thoại: 1900 1825</p>
        <p>Email: benxehanoi@benxehanoi.com.vn</p>
         
    </footer>
</body>

</html>
