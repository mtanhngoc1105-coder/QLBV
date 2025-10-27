@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách thuốc</h1>
    <a href="{{ route('medicines.create') }}" class="btn btn-primary mb-3">Thêm thuốc mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên thuốc</th>
                <th>Hãng sản xuất</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicines as $medicine)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $medicine->name }}</td>
                    <td>{{ $medicine->manufacturer }}</td>
                    <td>{{ number_format($medicine->price, 0, ',', '.') }} đ</td>
                    <td>{{ $medicine->quantity }}</td>
                    <td>
                        <a href="{{ route('medicines.show', $medicine) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('medicines.edit', $medicine) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('medicines.destroy', $medicine) }}" method="POST" style="display:inline-block">
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
