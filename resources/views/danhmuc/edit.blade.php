@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Sửa danh mục</h2>
    <form action="{{ route('danhmuc.update', $danhmuc->danhmuc_ID) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="danhmuc_Ten">Tên danh mục</label>
            <input type="text" name="danhmuc_Ten" class="form-control" value="{{ $danhmuc->danhmuc_Ten }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
@endsection
