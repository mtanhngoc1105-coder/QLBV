@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách đơn thuốc</h1>
    <a href="{{ route('prescriptions.create') }}" class="btn btn-primary mb-3">Tạo đơn thuốc mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Bệnh nhân</th>
                <th>Bác sĩ</th>
                <th>Ngày kê đơn</th>
                <th>Ghi chú</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prescriptions as $prescription)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $prescription->patient->name }}</td>
                    <td>{{ $prescription->doctor->name }}</td>
                    <td>{{ $prescription->prescription_date }}</td>
                    <td>{{ $prescription->notes }}</td>
                    <td>
                        <a href="{{ route('prescriptions.show', $prescription) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('prescriptions.edit', $prescription) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('prescriptions.destroy', $prescription) }}" method="POST" style="display:inline-block">
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
