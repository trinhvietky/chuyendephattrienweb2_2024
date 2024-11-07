@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm danh mục</h2>
    <form action="{{ route('danhmuc.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="danhmuc_Ten">Tên danh mục</label>
            <input type="text" name="danhmuc_Ten" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>
@endsection
