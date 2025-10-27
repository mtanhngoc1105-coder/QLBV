@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách phòng ban</h1>
    <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Thêm phòng ban mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên phòng ban</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $department)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->description }}</td>
                    <td>
                        <a href="{{ route('departments.show', $department) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('departments.edit', $department) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('departments.destroy', $department) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
