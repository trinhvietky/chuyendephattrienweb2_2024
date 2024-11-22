<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index()
    {
        // Lấy tất cả blog từ cơ sở dữ liệu
        $blogs = Blog::paginate(2);

        // Trả về view và truyền dữ liệu blog vào
        return view('admin/blog-list', compact('blogs'));
    }
    public function AllBlog()
    {
        // Lấy tất cả blog từ cơ sở dữ liệu
        $blogs = Blog::paginate(2);
        $categories = Categories::all();
        $latestProducts = Product::with('images')->latest()->take(3)->get();

        // Trả về view và truyền dữ liệu blog vào
        return view('users/blog', compact('blogs', 'categories','latestProducts'));
    }

    public function destroy($id)
    {
        // Tìm blog theo ID
        $blog = Blog::findOrFail($id);

        // Kiểm tra và xóa file ảnh nếu tồn tại
        if ($blog->cover_image && File::exists(public_path($blog->cover_image))) {
            File::delete(public_path($blog->cover_image));
        }

        // Xóa blog
        $blog->delete();

        // Chuyển hướng về trang danh sách blog với thông báo thành công
        return redirect()->route('blog-list')->with('success', 'Blog đã được xóa thành công!');
    }

    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'title' => [
                'required',
                'max:255',
                'regex:/^[a-zA-ZÀ-ỹ0-9.,!? ]+$/i', // Cho phép chữ cái, số, khoảng trắng, dấu câu cơ bản
            ],
            'content' => [
                'required',
                'min:50', // Nội dung cần có ít nhất 50 ký tự
            ],
            'cover_image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
            ],
        ], [
            // Tiêu đề
            'title.required' => 'Tiêu đề không được để trống.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'title.regex' => 'Tiêu đề chỉ được chứa chữ cái, số và các ký tự đặc biệt như dấu câu.',
        
            // Nội dung
            'content.required' => 'Nội dung bài viết không được để trống.',
            'content.min' => 'Nội dung phải có ít nhất 50 ký tự.',
        
            // Ảnh bìa
            'cover_image.required' => 'Ảnh bìa không được để trống.',
            'cover_image.image' => 'Ảnh bìa phải là định dạng ảnh.',
            'cover_image.mimes' => 'Ảnh bìa chỉ được phép có định dạng: jpeg, png, jpg, gif.',
            'cover_image.max' => 'Ảnh bìa không được vượt quá 2MB.',
        ]);

        // Xử lý file ảnh nếu có
        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            // Đặt tên file theo timestamp + tên gốc để tránh trùng lặp
            $fileName = time() . '_' . $request->file('cover_image')->getClientOriginalName();

            // Lưu file vào thư mục public/img/blog-details
            $request->file('cover_image')->move(public_path('img/blog-details'), $fileName);

            // Lưu đường dẫn file để lưu vào database
            $coverImagePath = 'img/blog-details/' . $fileName;
        }

        // Lưu blog vào cơ sở dữ liệu
        Blog::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'cover_image' => $coverImagePath,
        ]);

        // Chuyển hướng về trang danh sách blog với thông báo thành công
        return redirect()->route('blog-list')->with('success', 'Blog đã được thêm thành công!');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id); // Tìm blog theo ID
        return view('admin/blog-edit', compact('blog')); // Truyền blog vào view
    }
    public function show($id)
    {
        $blog = Blog::findOrFail($id); // Tìm blog theo ID
        $categories = Categories::all();
        $latestProducts = Product::with('images')->latest()->take(3)->get();
        return view('users.blog-detail', compact('blog', 'categories','latestProducts')); // Truyền blog vào view
    }
    public function update(Request $request, $id)
    {
        // Tìm blog cần sửa
        $blog = Blog::findOrFail($id);

        // Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'title' => [
                'required',
                'max:255',
                'regex:/^[a-zA-ZÀ-ỹ0-9.,!? ]+$/i', // Cho phép chữ cái, số, khoảng trắng, dấu câu cơ bản
            ],
            'content' => [
                'required',
                'min:50', // Nội dung cần có ít nhất 50 ký tự
            ],
            'cover_image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
            ],
        ], [
            // Tiêu đề
            'title.required' => 'Tiêu đề không được để trống.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'title.regex' => 'Tiêu đề chỉ được chứa chữ cái, số và các ký tự đặc biệt như dấu câu.',
        
            // Nội dung
            'content.required' => 'Nội dung bài viết không được để trống.',
            'content.min' => 'Nội dung phải có ít nhất 50 ký tự.',
        
            // Ảnh bìa
            'cover_image.image' => 'Ảnh bìa phải là định dạng ảnh.',
            'cover_image.mimes' => 'Ảnh bìa chỉ được phép có định dạng: jpeg, png, jpg, gif.',
            'cover_image.max' => 'Ảnh bìa không được vượt quá 2MB.',
        ]);

        // Kiểm tra xem người dùng có upload ảnh mới không
        if ($request->hasFile('cover_image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($blog->cover_image && File::exists(public_path($blog->cover_image))) {
                File::delete(public_path($blog->cover_image));
            }

            // Lưu ảnh mới vào thư mục
            $fileName = time() . '_' . $request->file('cover_image')->getClientOriginalName();
            $request->file('cover_image')->move(public_path('img/blog-details'), $fileName);
            $blog->cover_image = 'img/blog-details/' . $fileName; // Cập nhật đường dẫn ảnh mới
        }

        // Cập nhật các trường khác
        $blog->title = $validatedData['title'];
        $blog->content = $validatedData['content'];
        $blog->save();

        // Chuyển hướng về trang danh sách blog với thông báo
        return redirect()->route('blog-list')->with('success', 'Blog đã được cập nhật thành công!');
    }
}
