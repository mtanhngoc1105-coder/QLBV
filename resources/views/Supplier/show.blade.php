@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chi tiết nhà cung cấp</h1>

    <p><strong>Tên nhà cung cấp:</strong> {{ $supplier->name }}</p>
    <p><strong>Địa chỉ:</strong> {{ $supplier->address }}</p>
    <p><strong>Số điện thoại:</strong> {{ $supplier->phone }}</p>
    <p><strong>Email:</strong> {{ $supplier->email }}</p>

    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Quay lại</a>
    <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning">Sửa</a>
</div>
@endsection
