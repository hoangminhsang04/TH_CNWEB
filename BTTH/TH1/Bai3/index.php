<?php
// Kết nối cơ sở dữ liệu
include("connect.php");

// Truy vấn cơ sở dữ liệu để lấy thông tin sinh viên
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Sinh viên</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-5">Danh sách Sinh viên</h1>

        <!-- Bảng hiển thị thông tin sinh viên -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Username</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Class</th>
                    <th>Email</th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Kiểm tra có dữ liệu trong cơ sở dữ liệu không
                if ($result->num_rows > 0) {
                    $stt = 1; // Số thứ tự sinh viên
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $stt . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['firstname'] . "</td>";
                        echo "<td>" . $row['lastname'] . "</td>";
                        echo "<td>" . $row['class'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['course1'] . "</td>";
                        echo "</tr>";
                        $stt++;
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Không có dữ liệu sinh viên.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
