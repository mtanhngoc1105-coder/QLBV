@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa phiếu nhập</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('purchases.update', $purchase) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="supplier_id" class="form-label">Nhà cung cấp</label>
            <select name="supplier_id" id="supplier_id" class="form-control">
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $purchase->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="medicine_id" class="form-label">Thuốc</label>
            <select name="medicine_id" id="medicine_id" class="form-control">
                @foreach($medicines as $medicine)
                    <option value="{{ $medicine->id }}" {{ $purchase->medicine_id == $medicine->id ? 'selected' : '' }}>{{ $medicine->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="purchase_date" class="form-label">Ngày nhập</label>
            <input type="date" name="purchase_date" id="purchase_date" class="form-control" value="{{ $purchase->purchase_date }}">
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Số lượng</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $purchase->quantity }}">
        </div>

        <div class="mb-3">
            <label for="unit_price" class="form-label">Đơn giá</label>
            <input type="number" name="unit_price" id="unit_price" class="form-control" value="{{ $purchase->unit_price }}">
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
