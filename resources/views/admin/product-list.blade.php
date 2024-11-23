@extends('admin/app')
@section('menu-footer')


<!-- Tải CSS của Bootstrap -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<style>
    /* General Modal Styles */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Background overlay */
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-backdrop {
        background: none;
    }

    .modal-dialog {
        background: white;
        width: 80%;
        max-width: 1000px;
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    /* Modal content */
    .modal-content {
        display: flex;
        flex-direction: column;
        height: 600px;
    }

    /* Modal header */
    .modal-header {
        padding: 10px;
        background-color: #f4f4f4;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ddd;
    }

    .modal-title {
        margin: 0;
        font-size: 24px;
    }

    .btn-close {
        font-size: 18px;
        color: red;
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
        border-radius: 4px;
        line-height: 1;
        transition: background 0.2s ease;
    }

    .btn-close:hover {
        background: rgba(255, 0, 0, 0.1);
    }

    /* Modal body */
    .modal-body {
        padding: 16px;
        background-color: #1b2a47;
        color: white;
        flex-grow: 1;
        overflow-y: auto;
    }

    /* Modal footer */
    .modal-footer {
        padding: 5px;
        background-color: #f4f4f4;
        display: flex;
        justify-content: flex-end;
        border-top: 1px solid #ddd;
    }

    .modal-footer .btn {
        padding: 8px 16px;
        margin-left: 8px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-default {
        background-color: #6c757d;
        color: white;
    }

    .btn-default:hover {
        background-color: #5a6268;
    }
</style>
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
                <div class="product-status-wrap product">
                    <h4>Product List</h4>
                    <div class="add-product">
                        <a href="{{ route('products.create') }}">Add Product</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Chi tiết</th>
                                <th>Giá</th>
                                <th>Danh mục</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                            <tr class="product-item" data-product-id="{{$product->product_id}}">
                                <div class="product-hover">
                                    <td>{{ $product->product_id }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>@if(isset($images[$index]) && $images[$index]->image_path)
                                        <img src="{{ asset(optional($images[$index])->image_path) }}" alt="{{ $product->product_name }}">
                                        @endif
                                    </td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->category->category_name }}</td>
                                </div>
                                <td>
                                    <div style="display: flex; margin-left: -12px;">
                                        <form action="{{ route('product.destroy', $product->product_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');" style="margin-right: 5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="background: none; border: none;">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('productAdmin.edit', $product->product_id) }}" data-toggle="tooltip" title="Edit" class="pd-setting-ed" style="color: white; margin-top: 7px; background: none; border: none;">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="pagination">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal to display product details -->
<div id="productDetailsModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" style="margin-left: auto;">Product Details</h1>
                <button class="btn-close" style="margin-left: auto;" id="closeModalButton">X</button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" id="closeModalFooter">Close</button>
            </div>
        </div>
    </div>
</div>








<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Tải Bootstrap JavaScript (nếu bạn dùng Bootstrap 5, cần tải Bootstrap 5 JS) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#search-button').on('click', function(e) {
            e.preventDefault();

            let keyword = $('#search-keyword').val(); // Lấy từ khóa tìm kiếm

            if (keyword.length > 2) { // Chỉ bắt đầu tìm kiếm khi từ khóa dài hơn 2 ký tự
                $.ajax({
                    url: "{{ route('product_variants.search') }}",
                    method: 'GET',
                    data: {
                        keyword: keyword
                    },
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
                    <form action="{{ route('product_variants.destroy', $product->product_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');" style="margin-right: 5px;">
                        @csrf
                        @method('DELETE')
                        <button data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="background: none; border: none;">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </form>
                    <a href="" data-toggle="tooltip" title="Edit" class="pd-setting-ed" style="color: white; margin-top: 7px; background: none; border: none;">
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

<script>
    $(document).ready(function() {

        const modal = document.getElementById("productDetailsModal");
        const openModalButton = document.getElementById("openModalButton");
        const closeModalButton = document.getElementById("closeModalButton");
        const closeModalFooter = document.getElementById("closeModalFooter");

        // Function to open modal
        function openModal() {
            modal.style.display = "flex";
        }

        // Function to close modal
        function closeModal() {
            modal.style.display = "none";
        }

        // function previewImage(input, index) {
        //     const imagePreview = document.getElementById(`imagePreview${index}`);
        //     const file = input.files[0];

        //     if (file) {
        //         const reader = new FileReader();
        //         reader.onload = function(e) {
        //             imagePreview.src = e.target.result;
        //             imagePreview.style.display = "block";
        //         };
        //         reader.readAsDataURL(file);
        //     }
        // }

        // // Hàm để khởi tạo hình ảnh từ `response.images`
        // function initializeImages(response) {
        //     response.images.forEach((imagePath, index) => {
        //         const imagePreview = document.getElementById(`imagePreview${index}`);
        //         if (imagePreview) {
        //             imagePreview.src = imagePath;
        //             imagePreview.style.display = "block";
        //         }
        //     });
        // }


        // Event listeners
        closeModalButton.addEventListener("click", closeModal);
        closeModalFooter.addEventListener("click", closeModal);

        // Close modal when clicking outside the modal content
        modal.addEventListener("click", (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });
        $('.product-item td').hover(
            function() {
                // Thay đổi màu của tất cả các td trong hàng, trừ td cuối cùng
                $(this).closest('.product-item').find('td').not(':last-child').css('background-color', '#f5f5f545');
                $(this).closest('.product-item').find('td').not(':last-child').css('cursor', 'pointer');
            },
            function() {
                // Đặt lại màu nền cho tất cả các td trong hàng, trừ td cuối cùng
                $(this).closest('.product-item').find('td').css('background-color', '');
            }
        );

        // Khi hover vào td cuối, không thay đổi màu
        $('.product-item td:last-child').hover(
            function() {
                $(this).closest('.product-item').find('td').css('background-color', '');
            },
        );

        const baseUrl = window.location.origin;
        // Bắt sự kiện click vào nút sua
        $(document).on('click', '.edit-button', function() {
            const variantId = $(this).data('id'); // Lấy ID của sản phẩm
            console.log(variantId);

            $.ajax({
                url: '/admin/product_variants/' + variantId + '/edit', // URL to the controller method
                type: 'GET',
                success: function(response) {
                    console.log(response);

                    if (response.success) {
                        var variantsHtml = '';

                        // Build the HTML from the response data
                        variantsHtml += `<form action="product_variants/${response.productVariant.productVariant_id}" method="post" enctype="multipart/form-data">
                         @csrf
                         @method('PUT')
                        <div class="review-tab-pro-inner">
                <ul id="myTab3" class="tab-review-design">
                    <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i> Add Product</a></li>
                </ul>
                <div id="myTabContent" class="tab-content custom-product-edit">
                    <div class="product-tab-list tab-pane fade active in" id="description">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mg-b-pro-edt">
                                    <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                    <input type="text" name="product_name" class="form-control" placeholder="Product Name" id="product_name" value="${response.product_name}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mg-b-pro-edt">
                                    <span class="input-group-addon"><i class="icon nalika-unlocked" aria-hidden="true"></i></span>
                                    <input type="number" name="stock" class="form-control" placeholder="Số lượng" required min="0" value="${response.productVariant.stock}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mg-b-pro-edt">
                                    <span class="input-group-addon"><i class="icon nalika-unlocked" aria-hidden="true"></i></span>
                                    <select name="size_id" class="form-control" required>
                                        <option value="" selected disabled>Chọn kích thước</option>
                                        ${response.sizes.map(size => `<option value="${size.size_id}" ${size.size_id === response.productVariant.size_id ? 'selected' : ''}>${size.size_name}</option>`).join('')}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mg-b-pro-edt">
                                    <span class="input-group-addon"><i class="icon nalika-user" aria-hidden="true"></i></span>
                                    <select name="color_id" id="color_id" class="form-control" required>
                                        <option value="" selected disabled>Chọn màu sắc</option>
                                        ${response.colors.map(color => `<option value="${color.color_id}" ${color.color_id === response.productVariant.color_id ? 'selected' : ''}>${color.color_name}</option>`).join('')}
                                    </select>
                                </div>
                            </div>
                        </div>
                         
    ${response.images.map((image, index) => `
    <div class="row mb-4">
    <div class="col-md-8">
        <div class="input-group mg-b-pro-edt">
            <span class="input-group-addon"><i class="icon nalika-mail" aria-hidden="true"></i></span>
            <div class="custom-file form-control">
                <input type="file"  name="product_image[]" id="image${index}" class="custom-file-input" onchange="previewImage(this, ${index})">
                <input type="hidden" name="productImage_id[]" value="${image.image_id}">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <!-- Phần hiển thị hình ảnh đã chọn -->
        <div id="imagePreviewContainer${index}">
            <img id="imagePreview${index}" src="${baseUrl}/${image.image_path}" alt="Image Preview" style="    width: 100px;
    height: 100px;
    ">
        </div>
    </div>
    </div>
    `).join('')}


                        <div class="text-center custom-pro-edt-ds mt-2">
                            <button data-id="${response.productVariant.productVariant_id}" class="btn btn-ctl-bt waves-effect waves-light m-r-10 btn-edit-productVariant ">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </div> </form>`;

                        // Insert the generated HTML into the modal
                        $('.modal-body').html(variantsHtml);
                    } else {
                        alert('Failed to load product data.');
                    }
                },
                error: function(respone) {
                    alert('thong bao')
                    console.log(response);
                }
            });


        });

        // Bắt sự kiện click vào nút xóa
        $(document).on('click', '.delete-button', function() {
            const variantId = $(this).data('id'); // Lấy ID của sản phẩm
            const row = $(this).closest('tr'); // Lấy dòng tương ứng

            if (confirm('Are you sure you want to delete this product variant?')) {
                $.ajax({
                    url: `product_variants/${variantId}`, // Đường dẫn API xóa
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        if (response.success) {
                            // Xóa dòng tương ứng
                            row.remove();
                        } else {
                            alert('Failed to delete product variant.');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText); // Ghi lỗi vào console
                        alert('An error occurred while deleting the product variant.');
                    }
                });
            }
        });

        // Khi click vào td bất kỳ (trừ td cuối)
        $('.product-item td').not(':last-child').click(function() {
            // Thay đổi màu của tất cả các td trong hàng, trừ td cuối cùng
            var productId = $(this).closest('.product-item').data('product-id');
            console.log(productId);

            // Gửi request để lấy dữ liệu của product variants (nếu có)
            $.ajax({
                url: "/admin/productVariant/" + productId, // URL bạn sẽ gửi yêu cầu
                method: "get",
                success: function(response) {
                    console.log(response);

                    // Cập nhật nội dung cho modal
                    var variantsHtml = '';
                    variantsHtml += `<div class="product-status-wrap product-variant">
                    <h4>Product List</h4>
                    <div class="add-product"><a href="product_variants/create/${productId}">Add Product</a></div>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Màu sắc</th>
                                <th>Kích thước</th>
                                <th>Số lượng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="productVariantsList">`
                    response.variantDetails.forEach(function(variant) {
                        variantsHtml += ` 
                <tr>
                    <td>${variant.productVariant_id}</td>
                    <td>${variant.product_name}</td>
                    <td><img src="${variant.image_path}" alt="${variant.product_name}" width="50"></td>
                    <td>${variant.color_name}</td>
                    <td>${variant.size_name}</td>
                    <td>${variant.stock}</td>
                    <td>
                        <div style="display: flex; margin-left: -12px;">
                            
                                <button type="submit" data-id="${variant.productVariant_id}" data-toggle="tooltip" title="Trash" class="pd-setting-ed delete-button" style="background: none; border: none;">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>

                            <button data-toggle="tooltip" data-id="${variant.productVariant_id}" title="Edit" class="pd-setting-ed edit-button" style="color: white; margin-top: 7px; background: none; border: none;">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;

                    });
                    variantsHtml += `</tbody>
                    </table>
                </div>`
                    // Chèn vào phần tử modal-body
                    $('.modal-body').html(variantsHtml);

                    // Hiển thị modal
                    // $('#productDetailsModal').modal('show');
                    openModal()
                },
                error: function(response) {
                    console.log(response);

                    alert("Có lỗi xảy ra, vui lòng thử lại.");
                }
            });
        });
    });
</script>

@endsection