<!DOCTYPE html>
<html>
<head>
    <title>Sửa bác sĩ</title>
</head>
<body>
    <h1>Sửa thông tin bác sĩ</h1>

    <form action="{{ route('doctors.update', $doctor) }}" method="POST">
        @csrf
        @method('PUT')

        <p>Tên: <input type="text" name="name" value="{{ $doctor->name }}" required></p>
        <p>Chuyên khoa: <input type="text" name="specialization" value="{{ $doctor->specialization }}"></p>
        <p>Điện thoại: <input type="text" name="phone" value="{{ $doctor->phone }}"></p>
        <p>Email: <input type="email" name="email" value="{{ $doctor->email }}"></p>
        <p>Phòng ban:
            <select name="department_id">
                <option value="">-- Chọn phòng ban --</option>
                @foreach ($departments as $dept)
                    <option value="{{ $dept->id }}" @if($dept->id == $doctor->department_id) selected @endif>
                        {{ $dept->name }}
                    </option>
                @endforeach
            </select>
        </p>

        <button type="submit">Cập nhật</button>
    </form>

    <a href="{{ route('doctors.index') }}">⬅ Quay lại danh sách</a>
</body>
</html>
