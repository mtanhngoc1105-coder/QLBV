@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách bệnh nhân</h1>
    <a href="{{ route('patients.create') }}" class="btn btn-primary mb-3">Thêm bệnh nhân mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Địa chỉ</th>
                <th>Mã số thuế</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->dob }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ $patient->address }}</td>
                    <td>{{ $patient->tax_code }}</td>
                    <td>
                        <a href="{{ route('patients.show', $patient) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('patients.edit', $patient) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('patients.destroy', $patient) }}" method="POST" style="display:inline-block">
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
