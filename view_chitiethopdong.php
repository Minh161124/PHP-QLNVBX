<?php
session_start();
include('config.php');

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$sql = "SELECT * FROM hop_dong WHERE mhd LIKE '%$search%' OR mns LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách hợp đồng</title>
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
            text-align: left;
        }
        h2 {
            color: #007bff;
            font-size: 26px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Danh sách hợp đồng</h2>
        <table>
            <thead>
                <tr>
                    <th>MHD</th>
                    <th>MNS</th>
                    <th>Loại hợp đồng</th>
                    <th>Vị trí</th>
                    <th>Ngày ký</th>
                    <th>Ngày kết thúc</th>
                    <th>Thời hạn</th>
                    <th>Lương cơ bản</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['mhd']}</td>";
                        echo "<td>{$row['mns']}</td>";
                        echo "<td>{$row['loai_hop_dong']}</td>";
                        echo "<td>{$row['vi_tri']}</td>";
                        echo "<td>{$row['ngay_ky']}</td>";
                        echo "<td>{$row['ngay_kt']}</td>";
                        echo "<td>{$row['thoi_han_hd']}</td>";
                        echo "<td>{$row['luongcb']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Không có hợp đồng nào được tìm thấy.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
