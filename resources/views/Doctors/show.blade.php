<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết bác sĩ</title>
</head>
<body>
    <h1>Thông tin chi tiết bác sĩ</h1>

    <p><strong>Tên:</strong> {{ $doctor->name }}</p>
    <p><strong>Chuyên khoa:</strong> {{ $doctor->specialization }}</p>
    <p><strong>Điện thoại:</strong> {{ $doctor->phone }}</p>
    <p><strong>Email:</strong> {{ $doctor->email }}</p>
    <p><strong>Phòng ban:</strong> {{ $doctor->department->name ?? 'Không có' }}</p>

    <a href="{{ route('doctors.index') }}">⬅ Quay lại danh sách</a>
</body>
</html>
