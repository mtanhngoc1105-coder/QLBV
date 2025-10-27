@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa phòng ban</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('departments.update', $department) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên phòng ban</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $department->name }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" id="description" class="form-control">{{ $department->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
