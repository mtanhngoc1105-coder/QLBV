@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chi tiết bệnh nhân</h1>

    <p><strong>Họ tên:</strong> {{ $patient->name }}</p>
    <p><strong>Ngày sinh:</strong> {{ $patient->dob }}</p>
    <p><strong>Giới tính:</strong> {{ $patient->gender }}</p>
    <p><strong>Địa chỉ:</strong> {{ $patient->address }}</p>
    <p><strong>Mã số thuế:</strong> {{ $patient->tax_code }}</p>

    <a href="{{ route('patients.index') }}" class="btn btn-secondary">Quay lại</a>
    <a href="{{ route('patients.edit', $patient) }}" class="btn btn-warning">Sửa</a>
</div>
@endsection
