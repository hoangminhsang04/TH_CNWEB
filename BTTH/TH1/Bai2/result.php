<?php
include "connect.php";
$sql = "SELECT id, correct_option FROM questions";
$result = $conn->query($sql);
//lấy đáp án từ csdl
$answers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $answers[$row['id']] = $row['correct_option'];
    }
}
// tính điểm
$score = 0;
$total_questions = count($answers);

foreach ($_POST as $key => $userAnswer) {
    $question_id = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT);
    if (isset($answers[$question_id]) && $answers[$question_id] === $userAnswer) {
        $score++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả bài làm</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-5">Kết quả bài làm</h1>

        <div class="alert alert-success text-center">
            Bạn trả lời đúng <strong><?php echo $score; ?></strong>/<?php echo count($answers); ?> câu.
        </div>

        <a href="index.php" class="btn btn-primary">Làm lại</a>
    </div>
</body>

</html>
