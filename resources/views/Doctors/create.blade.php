<!DOCTYPE html>
<html>
<head>
    <title>Thêm bác sĩ</title>
</head>
<body>
    <h1>Thêm bác sĩ mới</h1>

    <form action="{{ route('doctors.store') }}" method="POST">
        @csrf
        <p>Tên: <input type="text" name="name" required></p>
        <p>Chuyên khoa: <input type="text" name="specialization"></p>
        <p>Điện thoại: <input type="text" name="phone"></p>
        <p>Email: <input type="email" name="email"></p>
        <p>Phòng ban:
            <select name="department_id">
                <option value="">-- Chọn phòng ban --</option>
                @foreach ($departments as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                @endforeach
            </select>
        </p>

        <button type="submit">Lưu</button>
    </form>

    <a href="{{ route('doctors.index') }}">⬅ Quay lại danh sách</a>
</body>
</html>
