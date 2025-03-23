<?php
session_start();
include('config.php');

// Xử lý xóa bản ghi nếu có yêu cầu
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM cham_cong WHERE mcc = '$delete_id'";
    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('Xóa thành công!'); window.location.href='7viewccvlt.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa!');</script>";
    }
}

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
            flex-direction: column;
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

        .delete-btn {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: darkred;
        }

        .back-btn {
            background-color: #ccc;
            color: black;
            border: none;
            padding: 8px 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .back-btn:hover {
            background-color: #bbb;
        }
    </style>
</head>
<body>
    <div class="container">
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
                    <th>Action</th>
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
                                    <button class='delete-btn' onclick='confirmDelete(\"{$row['mcc']}\")'>🗑 Xóa</button>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(mcc) {
            if (confirm("Bạn có chắc chắn muốn xóa bản ghi này?")) {
                window.location.href = "7viewccvlt.php?delete_id=" + mcc;
            }
        }

        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
