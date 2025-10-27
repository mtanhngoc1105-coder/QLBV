<!DOCTYPE html>
<html>
<head>
    <title>Danh sách bác sĩ</title>
</head>
<body>
    <h1>Danh sách bác sĩ</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('doctors.create') }}">➕ Thêm bác sĩ mới</a>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Tên</th>
            <th>Chuyên khoa</th>
            <th>Điện thoại</th>
            <th>Email</th>
            <th>Phòng ban</th>
            <th>Hành động</th>
        </tr>
        @foreach ($doctors as $doctor)
        <tr>
            <td>{{ $doctor->name }}</td>
            <td>{{ $doctor->specialization }}</td>
            <td>{{ $doctor->phone }}</td>
            <td>{{ $doctor->email }}</td>
            <td>{{ $doctor->department->name ?? 'Không có' }}</td>
            <td>
                <a href="{{ route('doctors.show', $doctor) }}">Xem</a> |
                <a href="{{ route('doctors.edit', $doctor) }}">Sửa</a> |
                <form action="{{ route('doctors.destroy', $doctor) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
