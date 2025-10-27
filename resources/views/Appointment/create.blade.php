@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tạo lịch hẹn mới</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="doctor_id" class="form-label">Bác sĩ</label>
            <select name="doctor_id" id="doctor_id" class="form-control">
                <option value="">-- Chọn bác sĩ --</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="patient_id" class="form-label">Bệnh nhân</label>
            <select name="patient_id" id="patient_id" class="form-control">
                <option value="">-- Chọn bệnh nhân --</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="appointment_date" class="form-label">Ngày hẹn</label>
            <input type="date" name="appointment_date" id="appointment_date" class="form-control" value="{{ old('appointment_date') }}">
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Ghi chú</label>
            <textarea name="notes" id="notes" class="form-control">{{ old('notes') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
