@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách phiếu nhập</h1>
    <a href="{{ route('purchases.create') }}" class="btn btn-primary mb-3">Tạo phiếu nhập mới</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nhà cung cấp</th>
                <th>Thuốc</th>
                <th>Ngày nhập</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $purchase->supplier->name }}</td>
                    <td>{{ $purchase->medicine->name }}</td>
                    <td>{{ $purchase->purchase_date }}</td>
                    <td>{{ $purchase->quantity }}</td>
                    <td>{{ number_format($purchase->unit_price, 0, ',', '.') }} đ</td>
                    <td>
                        <a href="{{ route('purchases.show', $purchase) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('purchases.edit', $purchase) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('purchases.destroy', $purchase) }}" method="POST" style="display:inline-block">
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
