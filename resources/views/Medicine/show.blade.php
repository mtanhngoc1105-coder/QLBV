@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chi tiết thuốc</h1>

    <p><strong>Tên thuốc:</strong> {{ $medicine->name }}</p>
    <p><strong>Hãng sản xuất:</strong> {{ $medicine->manufacturer }}</p>
    <p><strong>Giá:</strong> {{ number_format($medicine->price, 0, ',', '.') }} đ</p>
    <p><strong>Số lượng:</strong> {{ $medicine->quantity }}</p>

    <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Quay lại</a>
    <a href="{{ route('medicines.edit', $medicine) }}" class="btn btn-warning">Sửa</a>
</div>
@endsection
