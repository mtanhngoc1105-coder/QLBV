@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm bệnh nhân mới</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('patients.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Họ tên</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="dob" class="form-label">Ngày sinh</label>
            <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob') }}">
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Giới tính</label>
            <select name="gender" id="gender" class="form-control">
                <option value="">-- Chọn giới tính --</option>
                <option value="Nam" {{ old('gender') == 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ old('gender') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
        </div>

        <div class="mb-3">
            <label for="tax_code" class="form-label">Mã số thuế</label>
            <input type="text" name="tax_code" id="tax_code" class="form-control" value="{{ old('tax_code') }}">
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('patients.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
