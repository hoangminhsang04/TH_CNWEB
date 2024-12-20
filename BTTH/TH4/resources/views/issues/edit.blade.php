<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Edit Issue</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }

        .form-group {
            margin-top: 10px;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">

        <h1 style="margin: 50px 50px">Chỉnh sửa thông tin sự cố</h1>

        <form action="{{ route('issues.update', $issue->id) }}" method="POST" style="margin: 50px 50px">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="computer_id" class="form-label">Tên máy tính</label>
                <select name="computer_id" class="form-control" required>
                    @foreach($computers as $computer)
                        <option value="{{ $computer->id }}" {{ $computer->id == $issue->computer_id ? 'selected' : '' }}>
                            {{ $computer->computer_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="model" class="form-label">Tên phiên bản</label>
                <input type="text" name="model" class="form-control" value="{{ $issue->computer->model }}" disabled>
            </div>
            <div class="form-group">
                <label for="reported_by" class="form-label">Người báo cáo sự cố</label>
                <input type="text" name="reported_by" class="form-control" value="{{ $issue->reported_by }}" required>
            </div>
            <div class="form-group">
                <label for="reported_date" class="form-label">Thời gian báo cáo</label>
                <input type="datetime-local" name="reported_date" class="form-control"
                    value="{{ $issue->reported_date}}" required>
            </div>
            <div class="form-group">
                <label for="urgency" class="form-label">Mức độ sự cố</label>
                <select name="urgency" class="form-control" required>
                    <option value="Low" {{ $issue->urgency == 'Low' ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ $issue->urgency == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ $issue->urgency == 'High' ? 'selected' : '' }}>High</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status" class="form-label">Trạng thái hiện tại</label>
                <select name="status" class="form-control" required>
                    <option value="Open" {{ $issue->status == 'Open' ? 'selected' : '' }}>Open</option>
                    <option value="In Progress" {{ $issue->status == 'In Progress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="Resolved" {{ $issue->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top: 10px">Cập nhật</button>
        </form>
    </div>
</body>

</html>