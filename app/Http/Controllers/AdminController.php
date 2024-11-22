<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    public function index()
    {
        // Logic cho admin home page
        return view('admin/dashboard');
    }

    public function AllUser()
    {
        // Lấy tất cả dữ liệu từ bảng users
        $users = User::paginate(2);

        // Trả dữ liệu về view
        return view('/admin/user-list', compact('users'));
    }
        // Phương thức xóa user
    public function destroy($id)
    {
        // Tìm user theo ID
        $user = User::findOrFail($id);

        // Xóa user
        $user->delete();

        // Sau khi xóa, chuyển hướng về trang danh sách người dùng với thông báo thành công
        return redirect()->route('admin/user-list')->with('success', 'User đã được xóa thành công.');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => [
                'required',
                'regex:/^[a-zA-ZÀ-ỹ ]+$/i', // Chỉ cho phép chữ cái và khoảng trắng
                'min:3',
                'max:100',
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                'unique:users',
                'regex:/^[^\s@<>()[\],;:\\"]+@[a-zA-Z0-9-]+(\.[a-zA-Z]{2,})+$/', // Định dạng email
            ],
            'phone' => [
                'required',
                'starts_with:0',
                'regex:/^[0-9]{10}$/',
            ],
            'role' => 'required|in:0,1',
            'password' => [
                'required',
                'min:5',
                'max:20',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{5,20}$/',
            ],
        ], [
            // Tên
            'name.required' => 'Họ và tên không được bỏ trống.',
            'name.regex' => 'Họ và tên chỉ được chứa các chữ cái và khoảng trắng. Vui lòng kiểm tra lại.',
            'name.min' => 'Họ và tên phải có ít nhất 3 ký tự.',
            'name.max' => 'Họ và tên không được vượt quá 100 ký tự.',

            // Email
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ. Vui lòng kiểm tra lại.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email này đã tồn tại.',
            'email.regex' => 'Email không hợp lệ. Vui lòng kiểm tra lại.',

            // Số điện thoại
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.starts_with' => 'Số điện thoại phải bắt đầu bằng số 0.',
            'phone.regex' => 'Số điện thoại phải có đúng 10 chữ số, là số và không chứa ký tự đặc biệt.',

            // Quyền
            'role.required' => 'Quyền là bắt buộc.',
            'role.in' => 'Quyền phải là 0 (user) hoặc 1 (admin).',

            // Mật khẩu
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 5 ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá 20 ký tự.',
            'password.regex' => 'Mật khẩu phải bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role' => (int) $validated['role'], // Chuyển thành số nguyên
            'password' => Hash::make($validated['password']),
        ]);

        // Redirect to a specific page after saving
        return redirect()->route('admin/user-list')->with('success', 'User added successfully!');
    }

    public function edit($encodedId)
    {
        // Giải mã ID sản phẩm từ URL
        try {
            $userId = Crypt::decryptString($encodedId); // Giải mã ID sản phẩm
        } catch (\Exception $e) {
            abort(404, 'ID sản phẩm không hợp lệ');
        }

        // Lấy token từ URL
        $tokenFromUrl = request()->query('token');

        // Kiểm tra nếu token không tồn tại hoặc không hợp lệ
        if (!$tokenFromUrl) {
            abort(404);
        }

        // Kiểm tra token với token trong session
        $tokenFromSession = session('user_token');
        if ($tokenFromUrl !== $tokenFromSession) {
            abort(404, 'Token không hợp lệ hoặc đã hết hạn.');
        }
        // Lấy thông tin user theo id
        $user = User::findOrFail($userId);
        // Trả dữ liệu về view edit
        return view('admin/user-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => [
                'required',
                'regex:/^[a-zA-ZÀ-ỹ ]+$/i', // Chỉ cho phép chữ cái và khoảng trắng
                'min:3',
                'max:100',
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                'unique:users,email,' . $id, // Unique trừ user đang cập nhật
                'regex:/^[^\s@<>()[\],;:\\"]+@[a-zA-Z0-9-]+(\.[a-zA-Z]{2,})+$/', // Định dạng email
            ],
            'phone' => [
                'required',
                'starts_with:0',
                'regex:/^[0-9]{10}$/',
            ],
            'role' => 'required|in:0,1',
            'password' => [
                'nullable',
                'min:5',
                'max:20',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{5,20}$/',
            ],
        ], [
            // Tên
            'name.required' => 'Họ và tên không được bỏ trống.',
            'name.regex' => 'Họ và tên chỉ được chứa các chữ cái và khoảng trắng. Vui lòng kiểm tra lại.',
            'name.min' => 'Họ và tên phải có ít nhất 3 ký tự.',
            'name.max' => 'Họ và tên không được vượt quá 100 ký tự.',

            // Email
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ. Vui lòng kiểm tra lại.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email này đã tồn tại.',
            'email.regex' => 'Email không hợp lệ. Vui lòng kiểm tra lại.',

            // Số điện thoại
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.starts_with' => 'Số điện thoại phải bắt đầu bằng số 0.',
            'phone.regex' => 'Số điện thoại phải có đúng 10 chữ số, là số và không chứa ký tự đặc biệt.',

            // Quyền
            'role.required' => 'Quyền là bắt buộc.',
            'role.in' => 'Quyền phải là 0 (user) hoặc 1 (admin).',

            // Mật khẩu
            'password.min' => 'Mật khẩu phải có ít nhất 5 ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá 20 ký tự.',
            'password.regex' => 'Mật khẩu phải bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.',
        ]);
        // Tìm user theo ID
        $user = User::findOrFail($id);

        // Cập nhật các thông tin khác
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        // Nếu admin nhập mật khẩu mới thì hash và lưu lại
        if ($request->filled('password') && strlen($request->input('password')) <= 20) {
            $user->password = Hash::make($request->input('password'));
        }

        // Lưu thay đổi
        $user->save();

        // Chuyển hướng lại trang danh sách với thông báo thành công
        return redirect()->route('admin/user-list')->with('success', 'Thông tin người dùng đã được cập nhật thành công.');
    }
    public function search(Request $request)
{
    $keyword = $request->input('keyword');  // Lấy từ khóa tìm kiếm

    $users = User::where('name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%')
                ->get();  // Lấy tất cả người dùng khớp với từ khóa

    return response()->json(['users' => $users]);  // Trả về dữ liệu JSON
}


}
