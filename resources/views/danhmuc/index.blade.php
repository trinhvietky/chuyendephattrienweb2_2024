@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách danh mục</h2>
    <a href="{{ route('danhmuc.create') }}" class="btn btn-primary">Thêm danh mục</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($danhmucs as $danhmuc)
                <tr>
                    <td>{{ $danhmuc->danhmuc_ID }}</td>
                    <td>{{ $danhmuc->danhmuc_Ten }}</td>
                    <td>

                        <a href="{{ route('danhmuc.edit', $danhmuc->danhmuc_ID) }}" class="btn btn-primary">Sửa</a>

                        <form action="{{ route('danhmuc.destroy', $danhmuc->danhmuc_ID) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Bạn có chắc chắn muốn xóa?');"
                                class="btn btn-danger">Xóa</button>
                        </form>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection