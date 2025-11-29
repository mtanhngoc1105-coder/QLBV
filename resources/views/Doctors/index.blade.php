@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách Bác sĩ</h1>
    <a href="{{ route('doctors.create') }}" class="btn btn-primary mb-3">Thêm bác sĩ mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Mã Bác sĩ</th>
                <th>Tên Bác sĩ</th>
                <th>Khoa</th>
                <th>Điện thoại</th>
                <th>Email</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $doctor->doctor_code }}</td>
                    <td>{{ $doctor->doctor_name }}</td>
                    <td>{{ $doctor->department->name ?? 'Chưa có' }}</td>
                    <td>{{ $doctor->phone ?? '-' }}</td>
                    <td>{{ $doctor->email ?? '-' }}</td>
                    <td>
                        <a href="{{ route('doctors.edit', $doctor) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('doctors.destroy', $doctor) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @if($doctors->isEmpty())
                <tr>
                    <td colspan="7" class="text-center">Chưa có bác sĩ nào</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
