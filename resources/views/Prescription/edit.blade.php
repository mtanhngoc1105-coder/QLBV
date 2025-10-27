@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa đơn thuốc</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('prescriptions.update', $prescription) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="patient_id" class="form-label">Bệnh nhân</label>
            <select name="patient_id" id="patient_id" class="form-control">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ $prescription->patient_id == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="doctor_id" class="form-label">Bác sĩ</label>
            <select name="doctor_id" id="doctor_id" class="form-control">
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ $prescription->doctor_id == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="prescription_date" class="form-label">Ngày kê đơn</label>
            <input type="date" name="prescription_date" id="prescription_date" class="form-control" value="{{ $prescription->prescription_date }}">
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Ghi chú</label>
            <textarea name="notes" id="notes" class="form-control">{{ $prescription->notes }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
