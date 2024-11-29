<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Hoa</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">
    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Danh Sách Hoa</h1>
        <div class="mb-3">
            <a href="add.php" class="btn btn-success btn-lg"><i class="bi bi-plus-circle"></i> Thêm Hoa</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tên Hoa</th>
                    <th>Mô Tả</th>
                    <th>Ảnh</th>
                    <th>Chỉnh Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include "connect.php";
                    $sql = "SELECT * FROM flowers";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?php echo $row["ten_hoa"]; ?></td>
                            <td><?php echo $row["mo_ta"]; ?></td>
                            <td><img src="<?php echo $row["anh"]; ?>" alt="<?php echo $row["ten_hoa"]; ?>" class="img-fluid" style="max-width: 100px; height: auto;"></td>
                            <td><a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a></td>
                            <td><a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?');"><i class="bi bi-trash"></i></a></td>
                        </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
