<?php
include "connect.php";

// Kiểm tra nếu có yêu cầu xóa (thông qua tham số ID trên URL)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin ảnh cũ từ cơ sở dữ liệu
    $sql_old_image = "SELECT anh FROM flowers WHERE id = $id";
    $result_old_image = mysqli_query($conn, $sql_old_image);
    $row_old_image = mysqli_fetch_assoc($result_old_image);

    if ($row_old_image) {
        // Xóa tệp ảnh cũ khỏi thư mục trên server
        $image_path = $row_old_image['anh'];
        if (file_exists($image_path)) {
            unlink($image_path); // Xóa tệp ảnh
        }

        // Xóa bản ghi khỏi cơ sở dữ liệu
        $sql_delete = "DELETE FROM flowers WHERE id = $id";
        if (mysqli_query($conn, $sql_delete)) {
            // Chuyển hướng về trang quản lý sau khi xóa thành công
            header("Location: adminindex.php");
            exit();
        } else {
            echo "Lỗi khi xóa dữ liệu: " . mysqli_error($conn);
        }
    } else {
        echo "Không tìm thấy hoa với ID đã cho.";
    }
} else {
    echo "Không có ID nào được cung cấp.";
}
?>
