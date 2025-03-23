<?php
    session_start();

    include 'config.php';

    $result = $conn->query("SELECT id, title, image, created_at FROM posts ORDER BY created_at DESC");
    

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

    if (isset($_SESSION['message'])) {
        echo "<p style='color: green; font-weight: bold;'>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']); 
    }


    function getNewsFromURL($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
        $html = curl_exec($ch);
        curl_close($ch);
        return $html;
    }

    $url = "https://transerco.com.vn/vi/tin-buyt";
    $html = getNewsFromURL($url);

    // Xử lý HTML
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);
    $newsItems = $xpath->query("//article[contains(@class, 'news__item')]");

    // Hiển thị tối đa 3 tin tức
    $maxItems = 3;
    $count = 0;


?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Tin Tức</title>
    <script src="script.js"></script>

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
            height: 350px; 
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
            height: 350px; 
            object-fit: cover;
        }
        .news-container { 
            width: 80%; 
            margin: 20px auto; 
            padding: 20px; 
            background: #f9f9f9; 
            border-radius: 5px; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .news-container h2 { 
            text-align: center; 
            color: #333; 
            margin-bottom: 15px;
        }
        .news-item { 
            display: flex; 
            align-items: center; 
            padding: 10px; 
            border-bottom: 1px solid #ddd;
        }
        .news-item img { 
            width: 80px; 
            height: 80px; 
            object-fit: cover; 
            margin-right: 15px;
        }
        .news-item a { 
            text-decoration: none; 
            color: #333; 
            font-weight: bold;
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
        <h1>Trang Tin Tức</h1>
    </header>

    <div class="slider">
        <div class="slides">
            <img src="ban1.jpg" alt="Hình 1">
            <img src="a3.png" alt="Hình 2">
            <img src="a4.png" alt="Hình 3">
        </div>
    </div>


    <!-- Phần tin tức mới nhất -->
    <div class="news-container">
        <h2>Tin Tức Mới Nhất</h2>

        <!-- <?php
        if (isset($_SESSION['message'])) {
            echo "<p style='color: green; font-weight: bold;'>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']); 
        }
        ?> -->

        <div class="container">
            <h1 class="text-center my-4">📖 Blog Cá Nhân</h1>
            <div class="row">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-12 mb-3">
                        <div style="display: flex; margin-right: 20px auto;" class="d-flex align-items-center border p-3 rounded bg-white shadow-sm">
                            <img style="margin-right: 20px;" src="<?= $row['image'] ?>" class="rounded flex-shrink-0" alt="<?= $row['title'] ?>" width="120" height="80" style="object-fit: cover;">
                            <div class="ms-3">
                                <h5 class="mb-1">
                                    <a href="post.php?id=<?= $row['id'] ?>" style="color: black; text-decoration: none; font-weight: bold;">
                                        <?= $row['title'] ?>
                                    </a>
                                </h5>
                                <p class="text-muted mb-0"><small>Ngày đăng: <?= $row['created_at'] ?></small></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>


    </div>

    <footer class="footer">
        <h3>CÔNG TY CỔ PHẦN BẾN XE BUS</h3>
        <p>Địa chỉ: Gác 2 Bến xe Giáp Bát – Giáp Bát – Hoàng Mai – Hà Nội</p>
        <p>Điện thoại: 1900 1825</p>
        <p>Email: benxehanoi@benxehanoi.com.vn</p>
         
    </footer>
</body>
<script>
    setInterval(function() {
        fetch('gt.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById("news-content").innerHTML = data;
        });
    }, 5000); 
</script>

</html>
