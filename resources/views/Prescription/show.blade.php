@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chi tiết đơn thuốc</h1>

    <p><strong>Bệnh nhân:</strong> {{ $prescription->patient->name }}</p>
    <p><strong>Bác sĩ:</strong> {{ $prescription->doctor->name }}</p>
    <p><strong>Ngày kê đơn:</strong> {{ $prescription->prescription_date }}</p>
    <p><strong>Ghi chú:</strong> {{ $prescription->notes }}</p>

    <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">Quay lại</a>
    <a href="{{ route('prescriptions.edit', $prescription) }}" class="btn btn-warning">Sửa</a>
</div>
@endsection
