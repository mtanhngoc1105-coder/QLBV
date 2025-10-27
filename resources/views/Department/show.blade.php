@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chi tiết phòng ban</h1>

    <p><strong>Tên phòng ban:</strong> {{ $department->name }}</p>
    <p><strong>Mô tả:</strong> {{ $department->description }}</p>

    <a href="{{ route('departments.index') }}" class="btn btn-secondary">Quay lại</a>
    <a href="{{ route('departments.edit', $department) }}" class="btn btn-warning">Sửa</a>
</div>
@endsection
