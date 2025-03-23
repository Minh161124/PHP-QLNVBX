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
    <title>Giới Thiệu Công Ty</title>
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
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000; 
            
        }
        .content-container { 
            width: 80%; 
            margin: 20px auto;
            padding: 20px; 
            background: #f9f9f9; 
            border-radius: 5px; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
        }
        .company-info { 
            text-align: center;
         }
        .company-stats { 
            display: flex; 
            justify-content: space-around; 
            margin: 20px 0;
         }
        .company-stats div { 
            text-align: center; 
            font-size: 18px; 
        }
        .branches { 
            display: flex; 
            justify-content: space-around; 
        }
        .branch img {
             width: 100%; 
             border-radius: 5px; 
            }
        .branch { 
            text-align: center; 
            width: 30%; 
        }
        .history { margin-top: 30px; 
            padding: 20px; 
            background: #e9ecef; 
            border-radius: 5px; 
        }
        .history h2 { 
            text-align: center; 
            color: #0099ff;
        }
        .footer { 
            background: linear-gradient(to bottom, #0099ff, #003366); 
            color: white; 
            padding: 20px; 
            text-align: center; 
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
        h2 {
            color: #0099ff;
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
        <div style="z-index: 1005;" class="menu-icon" onclick="toggleMenu()">
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
        <h1>Giới Thiệu Công Ty</h1>

    </header>
    <div class="slider">
        <div class="slides">
            <img src="a2.png" alt="Hình 1">
            <img src="a3.png" alt="Hình 2">
            <img src="a4.png" alt="Hình 3">
        </div>
    </div>

    
    <div class="content-container">
        <h2>Công ty Cổ phần Bến Xe Hà Nội</h2>
        <div class="company-info">
            <p><strong>Tên công ty đầy đủ:</strong> CÔNG TY CỔ PHẦN BẾN XE HÀ NỘI</p>
            <p><strong>Tên tiếng Anh:</strong> HANOI TRANSPORT STATION JOINT STOCK COMPANY</p>
            <p><strong>Giấy chứng nhận đăng ký doanh nghiệp:</strong> 0100 5528 60</p>
            <p><strong>Mã cổ phiếu:</strong> HNB</p>
        </div>
        <div class="company-stats">
            <div><strong>22300+</strong><p>Lượt khách/ngày</p></div>
            <div><strong>8 triệu+</strong><p>Lượt khách/năm</p></div>
            <div><strong>232</strong><p>Doanh nghiệp vận tải</p></div>
            <div><strong>30+</strong><p>Tỉnh thành kết nối</p></div>
        </div>
        <h2>Bến Xe Thành Viên</h2>
        <div class="branches">
            <div class="branch">
                <img src="md.png" alt="Bến xe Mỹ Đình">
                <p><strong>BẾN XE MỸ ĐÌNH</strong></p>
            </div>
            <div class="branch">
                <img src="gb.png" alt="Bến xe Giáp Bát">
                <p><strong>BẾN XE GIÁP BÁT</strong></p>
            </div>
            <div class="branch">
                <img src="gl.png" alt="Bến xe Gia Lâm">
                <p><strong>BẾN XE GIA LÂM</strong></p>
            </div>
        </div>
        <section class="history">
            <h2>Lịch Sử Hình Thành</h2>
            <div class="history-event">
                <h3>Ngày 28/02/1985</h3>
                <p>Xi nghiệp Vận tư GTVT được thành lập theo Quyết định số 623/QĐ-TCCQ ngày 28/02/1985 của UBND Thành phố Hà Nội. Đến ngày 10/5/1988, Xi nghiệp Vận tư GTVT được đổi tên thành Xi nghiệp Dịch vụ GTVT theo Quyết định số 2109/QĐ-TCCQ của UBND Thành phố Hà Nội.</p>
            </div>
            <div class="history-event">
                <h3>Ngày 29/4/1991</h3>
                <p>Để lập lại kỷ cương vận tải hành khách trong Thành phố Hà Nội và thực hiện phương án di chuyển bến xe Kim Liên ra ngoại vi Thành phố, ngày 29/4/1991 UBND Thành phố Hà Nội đã ban hành Quyết định số 776 QĐ/UB về việc thành lập Bến xe Phía Nam trên cơ sở sáp nhập bến xe Kim Liên thuộc Xi nghiệp Bến xe vào Xi nghiệp dịch vụ GTVT.</p>
            </div>
            <div class="history-event">
                <h3>Ngày 25/5/1996</h3>
                <p>Với chính sách đổi mới của Đảng và Nhà nước, nhằm tách biệt chức năng quản lý nhà nước trên các bến xe với hoạt động sản xuất kinh doanh vận tải, ngày 25/5/1996 UBND Thành phố Hà Nội ban hành Quyết định số 1818/QĐ – UB về việc đổi tên và điều chỉnh nhiệm vụ của Công ty Vận tải hành khách phía Nam Hà Nội thành Công ty Quản lý bến xe Hà Nội với vốn điều lệ: 9.800.000.000 đ (Chín tỷ tám trăm triệu đồng).</p>
            </div>
            <div class="history-event">
                <h3>Ngày 14/5/2004</h3>
                <p>Thực hiện chủ trương của Đảng và Nhà nước trong việc thí điểm mô hình hoạt động: Công ty mẹ - công ty con. Ngày 14/5/2004, UBND Thành phố Hà Nội đã ban hành Quyết định số 72/2004/QĐ-UB về việc thành lập Tổng công ty Vận tải Hà Nội và Công ty Quản lý bến xe Hà Nội được chuyển từ Sở GTCC Hà Nội sang trực thuộc Tổng Công ty Vận tải Hà Nội.</p>
            </div>
        </section>
    </div>
    <footer class="footer">
        <h3>CÔNG TY CỔ PHẦN BẾN XE BUS</h3>
        <p>Địa chỉ: Gác 2 Bến xe Giáp Bát – Giáp Bát – Hoàng Mai – Hà Nội</p>
        <p>Điện thoại: 1900 1825</p>
        <p>Email: benxehanoi@benxehanoi.com.vn</p>
         
    </footer>
</body>
</html>
