@extends('admin/app')
@section('menu-footer')

@if(session('success'))
<div class="alert alert-success" style="margin: 80px 0px -80px 0px" id="success">
    {{ session('success') }}
</div>
<script>
    // Tự động ẩn thông báo sau 3 giây
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
                                    <h2>User Administrator</h2>
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

<!-- Phần Tìm Kiếm -->
<div class="search" style="margin: 0 auto; max-width: 500px; display: flex; gap: 10px; position: relative; top: -15px;">
    <input type="text" id="search-keyword" class="form-control" placeholder="Tìm kiếm người dùng..."
        style="flex: 1; padding: 8px; border: 1px solid #ddd; color: black; font-size: 16px; border-radius: 5px;">
    <button type="button" class="btn btn-primary" id="search-button" style="padding: 8px 16px; border: none; border-radius: 5px;">Tìm</button>
</div>

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4>User List</h4>
                    <div class="add-product">
                        <a style="background-color: #337ab7;" href="user-add">Add User</a>
                    </div>
                    <!-- Table to display users -->
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Quyền</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{ $user->usertype === '1' ? 'Admin' : 'User' }}</td>
                                <td>
                                    <div style="display: flex; margin-left: -12px;">
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');" style="margin-right: 5px;">
                                            @csrf
                                            @method('DELETE')
                                            @php
                                            $token = session('user_token', Str::random(32));
                                            session(['user_token' => $token]);
                                            $encodedId = Crypt::encryptString($user->id);
                                            @endphp
                                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="background: none; border: none;">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('user.edit', ['id' => $encodedId]) }}?token={{ $token }}" data-toggle="tooltip" title="Edit" class="pd-setting-ed" style="color: white; margin-top: 7px; background: none; border: none;">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="pagination">
                        {{ $users->links('pagination::bootstrap-4') }}
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

            if (keyword.length > 2) { // Kiểm tra từ khóa có ít nhất 3 ký tự
                $.ajax({
                    url: "{{ route('admin.user.search') }}", // Gọi API tìm kiếm
                    method: 'GET',
                    data: {
                        keyword: keyword
                    },
                    success: function(response) {
                        $('table tbody').empty(); // Xóa dữ liệu cũ trong bảng

                        // Kiểm tra nếu không có kết quả
                        if (response.users.length === 0) {
                            $('table tbody').append('<tr><td colspan="7" style="text-align:center;">Không tìm thấy người dùng nào</td></tr>');
                        } else {
                            response.users.forEach(function(user) {

                                let row = `<tr>
                                            <td>${user.id}</td>
                                            <td>${user.name}</td>
                                            <td>${user.email}</td>
                                            <td>${user.phone}</td>
                                            <td>${user.usertype === 1 ? 'Admin' : 'User'}</td>
                                            <td>
                                                <div style="display: flex; margin-left: -12px;">
                                                    <form action="" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');" style="margin-right: 5px;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="background: none; border: none;">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('user.edit', ['id' => $encodedId]) }}?token={{ $token }}" data-toggle="tooltip" title="Edit" class="pd-setting-ed" style="color: white; margin-top: 7px; background: none; border: none;">
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
                        alert("Có lỗi xảy ra trong khi tìm kiếm.");
                    }
                });
            } else {
                alert('Vui lòng nhập từ khóa dài hơn 2 ký tự.');
            }
        });
    });
</script>

@endsection