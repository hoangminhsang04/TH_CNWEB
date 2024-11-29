<?php
include "connect.php";
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

$question_data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $question_data[] = [
            "id" => $row['id'],
            "question_text" => $row['question_text'],
            "options" => [
                "A" => $row['option_a'],
                "B" => $row['option_b'],
                "C" => $row['option_c'],
                "D" => $row['option_d']
            ]
        ];
    }
} else {
    echo "Không có dữ liệu câu hỏi.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài tập trắc nghiệm</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-5">Bài tập trắc nghiệm</h1>

        <form method="post" action="result.php">
            <?php
            $question_number = 1;
            foreach ($question_data as $question) {
                echo "<div class='card mb-4'>";
                echo "<div class='card-header'><strong>{$question['question_text']}</strong></div>";
                echo "<div class='card-body'>";
                foreach ($question['options'] as $key => $value) {
                    echo "<div class='form-check'>";
                    echo "<input class='form-check-input' type='radio' name='question{$question['id']}' value='{$key}' id='question{$question['id']}{$key}'>";
                    echo "<label class='form-check-label' for='question{$question['id']}{$key}'>{$key}. {$value}</label>";
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
                $question_number++;
            }
            ?>
            <button type="submit" class="btn btn-primary">Nộp bài</button>
        </form>
    </div>
</body>

</html>