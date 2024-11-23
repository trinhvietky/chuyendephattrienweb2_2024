@extends('admin/app')
@section('menu-footer')

@if(session('success'))
<div class="alert alert-success" style="margin: 80px 0px -80px 0px" id="success">
    {{ session('success') }}
</div>
<script>
    // Tự động ẩn thông báo sau 5 giây
    setTimeout(function() {
        document.getElementById('success').style.display = 'none';
    }, 5000);
</script>
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
                                    <h2>Danh sách danh muc</h2>
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
                    <h4>Danh muc List</h4>
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
                                <td>{{ $danhmuc->category_id }}</td>
                                <td>{{ $danhmuc->category_name }}</td>
                                <td>

                                    <div style="display: flex; margin-left: -12px;">
                                        <form action="{{ route('danhmuc.destroy', $danhmuc->category_id) }}" method="POST"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục {{ $danhmuc->category_name }} không ?');"
                                            style="margin-right: 5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"
                                                style="background: none; border: none;">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                        @php
                                        // Kiểm tra token đã có trong session chưa, nếu chưa thì tạo mới và lưu vào session
                                        $token = session('danhmuc_token', Str::random(32));


                                        // Lưu token vào session nếu nó không tồn tại
                                        session(['danhmuc_token' => $token]);

                                        // Mã hóa ID sản phẩm (chỉ mã hóa ID sản phẩm)
                                        $encodedId = Crypt::encryptString($danhmuc->category_id);
                                        @endphp
                                        <a href="{{ route('danhmuc.edit', ['danhmuc_ID' => $encodedId]) }}?token={{ $token }}" data-toggle="tooltip" title="Edit"
                                            class="pd-setting-ed"
                                            style="color: white; margin-top: 7px; background: none; border: none;">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                    <!-- Hiển thị các liên kết phân trang -->
                    <div class="pagination">
                        {{ $danhmucs->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection