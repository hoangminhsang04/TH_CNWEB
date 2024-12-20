<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Thêm Sự Cố</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            color: #343a40;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
        }

        .form-control {
            border-radius: 6px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Thêm Sự Cố Mới</h1>
        <form action="{{ route('issues.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="computer_id" class="form-label">Tên máy tính</label>
                <select class="form-control" id="computer_id" name="computer_id" required>
                    @foreach($computers as $computer)
                        <option value="{{ $computer->id }}">{{ $computer->computer_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="reported_by" class="form-label">Người báo cáo</label>
                <input type="text" class="form-control" id="reported_by" name="reported_by" required>
            </div>
            <div class="mb-3">
                <label for="reported_date" class="form-label">Thời gian báo cáo</label>
                <input type="datetime-local" class="form-control" id="reported_date" name="reported_date" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả sự cố</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="urgency" class="form-label">Mức độ sự cố</label>
                <select class="form-control" id="urgency" name="urgency" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái hiện tại</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Open">Open</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Resolved">Resolved</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>

</body>

</html>
