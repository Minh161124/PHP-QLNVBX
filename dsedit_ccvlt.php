<?php
session_start();
include('config.php');

// Lấy dữ liệu danh sách chấm công
$sql_select = "SELECT * FROM cham_cong";
$result = $conn->query($sql_select);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance List</title>
    <style>
        body { 
            font-family: "Times New Roman", sans-serif; 
            background-color: #f2f2f2; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }

        .container { 
            width: 1000px; 
            padding: 20px; 
            background-color: white; 
            border-radius: 10px; 
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2); 
            text-align: center;
        }

        h2 { 
            color: red; 
            font-size: 28px; 
            text-align: center; 
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
            font-size: 14px; 
        }

        th { 
            background-color: #258eff; 
            color: white; 
        }

        .back-btn {
            background-color: rgb(247, 244, 244);
            color: black;
            border: none;
            padding: 8px 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .back-btn:hover {
            background-color: rgb(244, 237, 237);
        }
    </style>
</head>
<body>
    <div class="container">
        <button onclick="goBack()" class="back-btn">🔙 Quay lại</button>
        <h2>ATTENDANCE LIST</h2>

        <table>
            <thead>
                <tr>
                    <th>MCC</th>
                    <th>MNS</th>
                    <th>NGÀY CHẤM CÔNG</th>
                    <th>CA LÀM</th>
                    <th>TÌNH TRẠNG</th>
                    <th>LUONGCB</th>
                    <th>SỐ NGÀY CÔNG</th>
                    <th>PHỤ CẤP</th>
                    <th>HOẠT ĐỘNG</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['mcc']}</td>
                                <td>{$row['mns']}</td>
                                <td>{$row['ngay_cham']}</td>
                                <td>{$row['ca_lam']}</td>
                                <td>{$row['tinh_trang']}</td>
                                <td>{$row['luong_cb']}</td>
                                <td>{$row['so_ngay_cong']}</td>
                                <td>{$row['phu_cap']}</td>
                                <td>
    <a href='edit_ccvlt.php?mcc={$row['mcc']}' class='edit-btn'>✏️ Sửa</a>
</td>
                            </tr>";
                            
                    }
                } else {
                    echo "<tr><td colspan='8'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
