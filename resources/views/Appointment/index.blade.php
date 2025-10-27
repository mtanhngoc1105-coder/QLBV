@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách lịch hẹn</h1>
    <a href="{{ route('appointments.create') }}" class="btn btn-primary mb-3">Tạo lịch hẹn mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Bác sĩ</th>
                <th>Bệnh nhân</th>
                <th>Ngày hẹn</th>
                <th>Ghi chú</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $appointment->doctor->name }}</td>
                    <td>{{ $appointment->patient->name }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->notes }}</td>
                    <td>
                        <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display:inline-block">
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
