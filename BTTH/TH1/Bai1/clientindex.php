<?php include"connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">
    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="web">
        <div class="header">
            <h1>14 loài hoa tuyệt đẹp thích hợp trồng để khoe hương sắc dịp xuân hè</h1>
        </div>
        <div class="container">
            <?php
                $sql = "SELECT * FROM flowers";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
            ?>
                <div class="flower">
                    <h3><?php echo $row['ten_hoa']; ?></h3>
                    <p><?php echo $row['mo_ta']; ?></p>
                    <img src="<?php echo $row['anh']; ?>" alt="<?php echo $row['ten_hoa']; ?>">
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</body>
</html>