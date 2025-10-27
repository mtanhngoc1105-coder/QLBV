@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chi tiết lịch hẹn</h1>

    <p><strong>Bác sĩ:</strong> {{ $appointment->doctor->name }}</p>
    <p><strong>Bệnh nhân:</strong> {{ $appointment->patient->name }}</p>
    <p><strong>Ngày hẹn:</strong> {{ $appointment->appointment_date }}</p>
    <p><strong>Ghi chú:</strong> {{ $appointment->notes }}</p>

    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Quay lại</a>
    <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-warning">Sửa</a>
</div>
@endsection
