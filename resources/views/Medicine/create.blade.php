@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm thuốc mới</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('medicines.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên thuốc</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="manufacturer" class="form-label">Hãng sản xuất</label>
            <input type="text" name="manufacturer" id="manufacturer" class="form-control" value="{{ old('manufacturer') }}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Số lượng</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}">
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
