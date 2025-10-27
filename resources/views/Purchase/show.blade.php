@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chi tiết phiếu nhập</h1>

    <p><strong>Nhà cung cấp:</strong> {{ $purchase->supplier->name }}</p>
    <p><strong>Thuốc:</strong> {{ $purchase->medicine->name }}</p>
    <p><strong>Ngày nhập:</strong> {{ $purchase->purchase_date }}</p>
    <p><strong>Số lượng:</strong> {{ $purchase->quantity }}</p>
    <p><strong>Đơn giá:</strong> {{ number_format($purchase->unit_price, 0, ',', '.') }} đ</p>

    <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Quay lại</a>
    <a href="{{ route('purchases.edit', $purchase) }}" class="btn btn-warning">Sửa</a>
</div>
@endsection
