<?php
include "connect.php";

// Kiểm tra nếu form đã được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_hoa = $_POST['ten_hoa'];
    $mo_ta = $_POST['mo_ta'];
    
    // Xử lý tải ảnh lên
    $target_dir = "img/"; // Thư mục lưu ảnh
    $target_file = $target_dir . basename($_FILES["anh"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Kiểm tra nếu tệp là ảnh
    if (getimagesize($_FILES["anh"]["tmp_name"])) {
        if (move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file)) {
            // Nếu ảnh được tải lên thành công, thêm thông tin hoa vào cơ sở dữ liệu
            $sql = "INSERT INTO flowers (ten_hoa, mo_ta, anh) VALUES ('$ten_hoa', '$mo_ta', '$target_file')";
            if (mysqli_query($conn, $sql)) {
                header("Location: adminindex.php");
                exit();
            } else {
                echo "Lỗi khi thêm dữ liệu: " . mysqli_error($conn);
            }
        } else {
            echo "Lỗi khi tải ảnh lên.";
        }
    } else {
        echo "Vui lòng chọn một tệp ảnh hợp lệ.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Hoa</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">
    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Thêm Hoa Mới</h1>
        
        <!-- Form Thêm Hoa -->
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="ten_hoa" class="form-label">Tên Hoa</label>
                <input type="text" class="form-control" id="ten_hoa" name="ten_hoa" required>
            </div>

            <div class="mb-3">
                <label for="mo_ta" class="form-label">Mô Tả</label>
                <textarea class="form-control" id="mo_ta" name="mo_ta" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="anh" class="form-label">Chọn Ảnh</label>
                <input type="file" class="form-control" id="anh" name="anh" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Thêm Hoa</button>
        </form>
    </div>
</body>
</html>
