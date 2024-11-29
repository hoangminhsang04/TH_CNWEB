<?php
include "connect.php";

// Lấy ID từ URL
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Không tìm thấy ID!";
    exit;
}

// Lấy thông tin hoa từ cơ sở dữ liệu dựa trên ID
$sql = "SELECT * FROM flowers WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Không tìm thấy hoa với ID $id";
    exit;
}

// Kiểm tra nếu form đã được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $ten_hoa = mysqli_real_escape_string($conn, $_POST['ten_hoa']);
    $mo_ta = mysqli_real_escape_string($conn, $_POST['mo_ta']);

    // Kiểm tra nếu có ảnh mới được tải lên
    if ($_FILES['anh']['name']) {
        $target_dir = "img/"; // Thư mục lưu ảnh
        $target_file = $target_dir . time() . '_' . basename($_FILES["anh"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra nếu tệp là ảnh
        if (getimagesize($_FILES["anh"]["tmp_name"])) {
            if (move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file)) {
                // Xóa ảnh cũ khỏi server (nếu cần)
                if (file_exists($row['anh'])) {
                    unlink($row['anh']);
                }
                $image_path = $target_file; // Gán đường dẫn ảnh mới
            } else {
                echo "Lỗi khi tải ảnh lên.";
                exit;
            }
        } else {
            echo "Vui lòng chọn một tệp ảnh hợp lệ.";
            exit;
        }
    } else {
        // Nếu không tải ảnh mới, giữ lại ảnh cũ
        $image_path = $row['anh'];
    }

    // Cập nhật thông tin hoa vào cơ sở dữ liệu
    $sql_update = "UPDATE flowers SET ten_hoa = '$ten_hoa', mo_ta = '$mo_ta', anh = '$image_path' WHERE id = $id";
    if (mysqli_query($conn, $sql_update)) {
        header("Location: adminindex.php");
        exit;
    } else {
        echo "Lỗi khi cập nhật dữ liệu: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Hoa</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Sửa Hoa</h1>

        <?php if (!$row): ?>
            <div class='alert alert-danger'>Không tìm thấy thông tin hoa để chỉnh sửa.</div>
        <?php else: ?>
            <form action="edit.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <div class="mb-3">
                    <label for="ten_hoa" class="form-label">Tên Hoa</label>
                    <input type="text" class="form-control" id="ten_hoa" name="ten_hoa" value="<?php echo $row['ten_hoa']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="mo_ta" class="form-label">Mô Tả</label>
                    <textarea class="form-control" id="mo_ta" name="mo_ta" rows="4" required><?php echo $row['mo_ta']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="anh" class="form-label">Chọn Ảnh Mới (nếu có)</label>
                    <input type="file" class="form-control" id="anh" name="anh" accept="image/*">
                    <img src="<?php echo $row['anh']; ?>" alt="<?php echo $row['ten_hoa']; ?>" class="img-fluid mt-3" style="max-width: 100px; height: auto;">
                </div>

                <button type="submit" class="btn btn-primary">Cập Nhật</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>