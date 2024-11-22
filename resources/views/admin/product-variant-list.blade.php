@extends('admin/app')
@section('menu-footer')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="breadcome-area" style="margin-top: 50px;">
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
                                    <h2>Product list</h2>
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

<div class="search" style="margin: 0 auto; max-width: 500px; display: flex; gap: 10px; position: relative; top: -15px;">
    <input type="text" name="keyword" id="search-keyword" class="form-control" placeholder="Tìm kiếm sản phẩm..." 
           style="flex: 1; padding: 8px; border: 1px solid #ddd; color: black; font-size: 16px; border-radius: 5px;">
    <button type="submit" class="btn btn-primary" id="search-button" style="padding: 8px 16px; border: none; border-radius: 5px;">Tìm</button>
</div>

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4>Product List</h4>
                    <div class="add-product">
                        <a href="{{ route('products.create') }}">Add Product</a>
                    </div>
                    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Màu sắc</th>
            <th>Kích thước</th>
            <th>Số lượng</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productVariants as $index => $variant)
        <tr>
            <td>{{ $variant->productVariant_id }}</td>
            <td>{{ $variant->product->product_name }}</td>
            <td>@if(isset($images[$index]) && $images[$index]->image_path)
                <img src="{{ asset(optional($images[$index])->image_path) }}" alt="{{ $variant->product->product_name }}">
                @endif
            </td>
            <td>{{ $variant->color->color_name }}</td>
            <td>{{ $variant->size->size_name }}</td>
            <td>{{ $variant->stock }}</td>
            <td>
                <div style="display: flex; margin-left: -12px;">
                    <form action="{{ route('product_variants.destroy', $variant->productVariant_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');" style="margin-right: 5px;">
                        @csrf
                        @method('DELETE')
                        <button data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="background: none; border: none;">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </form>
                    <a href="{{ route('product_variants.edit', $variant->productVariant_id) }}" data-toggle="tooltip" title="Edit" class="pd-setting-ed" style="color: white; margin-top: 7px; background: none; border: none;">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('#search-button').on('click', function(e) {
        e.preventDefault();

        let keyword = $('#search-keyword').val(); // Lấy từ khóa tìm kiếm

        if (keyword.length > 2) {  // Chỉ bắt đầu tìm kiếm khi từ khóa dài hơn 2 ký tự
            $.ajax({
                url: "{{ route('product_variants.search') }}",
                method: 'GET',
                data: { keyword: keyword },
                success: function(response) {
                    $('table tbody').empty(); // Xóa dữ liệu cũ trong bảng

                    // Kiểm tra nếu không có kết quả
                    if (response.productVariants.length === 0) {
                        $('table tbody').append('<tr><td colspan="7" style="text-align:center;">Không tìm thấy sản phẩm nào</td></tr>');
                    } else {
                        response.productVariants.forEach(function(variant) {
                            // Lấy hình ảnh đầu tiên của sản phẩm (nếu có)
                            let imageUrl = 'path/to/default-image.jpg'; // Hình ảnh mặc định

                            // Kiểm tra nếu sản phẩm có ít nhất một hình ảnh
                            if (variant.product.images && variant.product.images.length > 0) {
                                // Sử dụng đường dẫn tuyệt đối tới thư mục public/img/product/
                                imageUrl = "{{ asset('') }}" + variant.product.images[0].image_path;
                            }

                            let row = `<tr>
                                        <td>${variant.productVariant_id}</td>
                                        <td>${variant.product.product_name}</td>
                                        <td><img src="${imageUrl}" alt="${variant.product.product_name}" style="width: 60px; height: auto;" /></td>
                                        <td>${variant.color.color_name}</td>
                                        <td>${variant.size.size_name}</td>
                                        <td>${variant.stock}</td>
                                        <td>
                                            <div style="display: flex; margin-left: -12px;">
                    <form action="{{ route('product_variants.destroy', $variant->productVariant_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');" style="margin-right: 5px;">
                        @csrf
                        @method('DELETE')
                        <button data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="background: none; border: none;">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </form>
                    <a href="{{ route('product_variants.edit', $variant->productVariant_id) }}" data-toggle="tooltip" title="Edit" class="pd-setting-ed" style="color: white; margin-top: 7px; background: none; border: none;">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                </div>
                                        </td>
                                      </tr>`;
                            $('table tbody').append(row);
                        });
                    }
                    // Reset input field after search
                    $('#search-keyword').val(''); // Reset ô tìm kiếm sau khi tìm
                },
                error: function() {
                    alert("Có lỗi xảy ra, vui lòng thử lại.");
                }
            });
        }
    });
});

</script>

@endsection