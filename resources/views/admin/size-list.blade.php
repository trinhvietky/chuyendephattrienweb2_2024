@extends('admin/app')
@section('menu-footer')

@if(session('success'))
<div class="alert alert-success" style="margin: 20px 0px 0px 0px">
    {{ session('success') }}
</div>
@endif

<div class="breadcome-area">
    <div class="container-fluid">
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
                                    <h2>Size Administrator</h2>
                                    <p>Welcome to T-Fashion <span class="bread-ntd">Shop</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-report">
                                <button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="icon nalika-download"></i></button>
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
                    <h4>Size List</h4>
                    <div class="add-product">
                        <a href="size-add">Add Size</a>
                    </div>
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Tên size</th>
                            <th>Action</th>
                        </tr>
                        @foreach($sizes as $size)
                        <tr>
                            <td>{{$size->size_id}}</td>
                            <td>{{$size->size_name}}</td>
                            <td>
                                <div style="display: flex; margin-left: -12px;">
                                    <form action="{{ route('size.destroy', $size->size_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa thông tin size này?');" style="margin-right: 5px;">
                                        @csrf
                                        @method('DELETE')
                                        <button data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="background: none; border: none;">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('size.edit', $size->size_id) }}" data-toggle="tooltip" title="Edit" class="pd-setting-ed" style="color: white; margin-top: 7px; background: none; border: none;">
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