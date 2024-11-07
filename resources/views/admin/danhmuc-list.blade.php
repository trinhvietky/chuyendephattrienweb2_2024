@extends('admin/app')
@section('menu-footer')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="breadcome-area">
    <div class="container-fluid" style="margin-top: 70px;">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="icon nalika-home"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Danh sách danh mục</h2>
                                    <p>Welcome to T-Fashion <span class="bread-ntd">Shop</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-report">
                                <button data-toggle="tooltip" data-placement="left" title="Download Report"
                                    class="btn"><i class="icon nalika-download"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4>Danh sách danh mục</h4>
                    <div class="add-product">
                        <a href="danhmuc-add" class="btn btn-primary">Thêm danh mục</a>
                    </div>
                    <table>
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
                                       
                                    <div style="display: flex; margin-left: -12px;">
                                        <form action="{{ route('danhmuc.destroy', $danhmuc->danhmuc_ID) }}" method="POST"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục {{ $danhmuc->danhmuc_Ten }} không ?');"
                                            style="margin-right: 5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"
                                                style="background: none; border: none;">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </form>

                                        <a href="{{ route('danhmuc.edit', $danhmuc->danhmuc_ID) }}" data-toggle="tooltip" title="Edit"
                                            class="pd-setting-ed"
                                            style="color: white; margin-top: 7px; background: none; border: none;">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                    <div class="custom-pagination">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection