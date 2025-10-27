@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa bệnh nhân</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('patients.update', $patient) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Họ tên</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $patient->name }}">
        </div>

        <div class="mb-3">
            <label for="dob" class="form-label">Ngày sinh</label>
            <input type="date" name="dob" id="dob" class="form-control" value="{{ $patient->dob }}">
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Giới tính</label>
            <select name="gender" id="gender" class="form-control">
                <option value="Nam" {{ $patient->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ $patient->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ $patient->address }}">
        </div>

        <div class="mb-3">
            <label for="tax_code" class="form-label">Mã số thuế</label>
            <input type="text" name="tax_code" id="tax_code" class="form-control" value="{{ $patient->tax_code }}">
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('patients.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
