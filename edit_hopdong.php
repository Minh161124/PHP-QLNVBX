<?php
session_start();
include('config.php');

$search = isset($_GET['search']) ? $_GET['search'] : '';

// Xử lý cập nhật hợp đồng
if (isset($_POST['update'])) {
    $mhd = intval($_POST['mhd']);
    $mns = $_POST['mns'];
    $loai_hop_dong = $_POST['loai_hop_dong'];
    $vi_tri = $_POST['vi_tri'];
    $ngay_ky = $_POST['ngay_ky'];
    $ngay_kt = $_POST['ngay_kt'];
    $thoi_han_hd = $_POST['thoi_han_hd'];
    $luongcb = intval($_POST['luongcb']);

    $sql_update = "UPDATE hop_dong SET mns=?, loai_hop_dong=?, vi_tri=?, ngay_ky=?, ngay_kt=?, thoi_han_hd=?, luongcb=? WHERE mhd=?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssssssii", $mns, $loai_hop_dong, $vi_tri, $ngay_ky, $ngay_kt, $thoi_han_hd, $luongcb, $mhd);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='9viewhdld.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi cập nhật: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// Chống SQL Injection trong tìm kiếm
$sql = "SELECT * FROM hop_dong WHERE mhd LIKE CONCAT('%', ?, '%') OR mns LIKE CONCAT('%', ?, '%')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $search, $search);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách hợp đồng</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; text-align: center; margin: 0; padding: 0; }
        .container { width: 80%; margin: 30px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 5px 5px 15px rgba(0,0,0,0.2); }
        h2 { color: #007bff; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #007bff; color: white; }
        .edit-btn, .save-btn, .back-btn { padding: 8px 12px; border-radius: 5px; cursor: pointer; border: none; }
        .edit-btn { background: #ffc107; }
        .save-btn { background: #28a745; color: white; display: none; }
        .back-btn { background: #dc3545; color: white; }
        input { width: 100px; padding: 5px; border: 1px solid #ddd; border-radius: 5px; }
    </style>
    <script>
        function enableEdit(rowId) {
            document.querySelectorAll('.row-' + rowId + ' input').forEach(input => input.removeAttribute('readonly'));
            document.getElementById('save-' + rowId).style.display = "inline-block";
            document.getElementById('edit-' + rowId).style.display = "none";
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Danh sách hợp đồng</h2>
        <button class="back-btn" onclick="window.location.href='9viewhdld.php';">Quay lại</button>
        <table>
            <thead>
                <tr>
                    <th>MHD</th><th>MNS</th><th>Loại hợp đồng</th><th>Vị trí</th>
                    <th>Ngày ký</th><th>Ngày kết thúc</th><th>Thời hạn</th><th>Lương cơ bản</th><th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $mhd = $row['mhd'];
                        echo "<tr class='row-{$mhd}'>";
                        echo "<form method='POST'>";
                        echo "<td><input type='hidden' name='mhd' value='{$mhd}'><input type='text' value='{$mhd}' readonly></td>";
                        echo "<td><input type='text' name='mns' value='{$row['mns']}' readonly></td>";
                        echo "<td><input type='text' name='loai_hop_dong' value='{$row['loai_hop_dong']}' readonly></td>";
                        echo "<td><input type='text' name='vi_tri' value='{$row['vi_tri']}' readonly></td>";
                        echo "<td><input type='date' name='ngay_ky' value='{$row['ngay_ky']}' readonly></td>";
                        echo "<td><input type='date' name='ngay_kt' value='{$row['ngay_kt']}' readonly></td>";
                        echo "<td><input type='text' name='thoi_han_hd' value='{$row['thoi_han_hd']}' readonly></td>";
                        echo "<td><input type='number' name='luongcb' value='{$row['luongcb']}' readonly></td>";
                        echo "<td>
                                <button type='button' class='edit-btn' id='edit-{$mhd}' onclick='enableEdit({$mhd})'>Sửa</button>
                                <button type='submit' class='save-btn' id='save-{$mhd}' name='update'>Lưu</button>
                              </td>";
                        echo "</form></tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Không có hợp đồng nào được tìm thấy.</td></tr>";
                } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php $conn->close(); ?>
