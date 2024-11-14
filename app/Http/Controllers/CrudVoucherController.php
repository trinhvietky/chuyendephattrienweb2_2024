<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CrudVoucherController extends Controller
{
    /**
     * hàm lấy dữ liệu voucher
     */
    public function listVoucher()
    {
        $vouchers = Voucher::paginate(10);
        return view('admin.voucher-list', ['vouchers' => $vouchers]);
    }

    /**
     * xóa voucher
     */
    public function deletevoucher($id)
    {
        $voucher = Voucher::where('id', $id)->first();
        if (!$voucher) {
            return redirect('admin/voucher-list')->with('error', 'voucher không tồn tại');
        }
        $voucher->delete();
        return redirect('admin/voucher-list')->with('success', 'voucher đã được xóa thành công.');
    }


    /**
     * hàm tìm voucher theo id
     */
    public function edit($id)
    {
        // Lấy thông tin user theo id
        $voucher = Voucher::where('id', $id)->first();
        if (!$voucher) {
            return redirect('admin/voucher-list')->with('error', 'voucher không tồn tại');
        }
        // Trả dữ liệu về view edit
        return view('admin.voucher-edit', ['voucher' => $voucher]);
    }

    /**
     * hàm thêm voucher
     */
    public function postVoucher(Request $request)
    {
        $messages = [
            'voucher_code.required' => 'Vui lòng điền đầy đủ thông tin.',
            'voucher_code.size' => 'Mã giảm giá phải có độ dài 6 ký tự.',
            'voucher_code.regex' => 'Mã giảm giá chỉ được bao gồm chữ hoa và số, không có khoảng trắng hay ký tự đặc biệt.',
            'discount_amount.required' => 'Vui lòng điền đầy đủ thông tin.',
            'discount_amount.integer' => 'Giá trị giảm phải là số nguyên.',
            'discount_amount.min' => 'Giá trị giảm phải lớn hơn hoặc bằng 0.',
            'start_date.required' => 'Vui lòng điền đầy đủ thông tin.',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',
            'start_date.after_or_equal' => 'Ngày bắt đầu phải lớn hơn hoặc bằng ngày hôm nay.',
            'end_date.required' => 'Vui lòng điền đầy đủ thông tin.',
            'end_date.date' => 'Ngày kết thúc không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
            'usage_limit.required' => 'Vui lòng điền đầy đủ thông tin.',
            'usage_limit.integer' => 'Số lần sử dụng phải là số nguyên.',
            'usage_limit.min' => 'Số lần sử dụng phải lớn hơn hoặc bằng 0.',
            'minimum_order.required' => 'Vui lòng điền đầy đủ thông tin.',
            'minimum_order.integer' => 'Giá trị đơn hàng tối thiểu phải là số nguyên.',
            'minimum_order.min' => 'Giá trị đơn hàng tối thiểu phải lớn hơn hoặc bằng 0.',
            'description.required' => 'Vui lòng điền đầy đủ thông tin.',
            'description.regex' => 'Mô tả không hợp lệ, không được chứa ký tự đặc biệt ngoài các ký tự cho phép.',
            'description.max' => 'Mô tả không được vượt quá 255 ký tự.',
        ];

        $request->validate([
            'voucher_code' => 'required|size:6|regex:/^[A-Z0-9]+$/|unique:voucher',
            'description' => 'required|max:255',
            'discount_amount' => 'required|min:0|integer',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'minimum_order' => 'required|min:0|integer',
            'usage_limit' => 'required|min:0|integer',

        ], $messages);
        $data = $request->all();
        $check = Voucher::create([
            'voucher_code' => $data['voucher_code'],
            'description' => $data['description'],
            'discount_amount' => $data['discount_amount'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'minimum_order' => $data['minimum_order'],
            'usage_limit' => $data['usage_limit'],
            'status' => 0,
        ]);
        return redirect('admin/voucher-list')->withSuccess('Thêm voucher thành công');
    }





    /**
     * hàm thực hiện cập nhập voucher
     */
    public function updateVoucher(Request $request, $id)
    {
        $messages = [
            'voucher_code.required' => 'Vui lòng điền đầy đủ thông tin.',
            'voucher_code.size' => 'Mã giảm giá phải có độ dài 6 ký tự.',
            'voucher_code.regex' => 'Mã giảm giá chỉ được bao gồm chữ hoa và số, không có khoảng trắng hay ký tự đặc biệt.',
            'discount_amount.required' => 'Vui lòng điền đầy đủ thông tin.',
            'discount_amount.integer' => 'Giá trị giảm phải là số nguyên.',
            'discount_amount.min' => 'Giá trị giảm phải lớn hơn hoặc bằng 0.',
            'start_date.required' => 'Vui lòng điền đầy đủ thông tin.',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',
            'start_date.after_or_equal' => 'Ngày bắt đầu phải lớn hơn hoặc bằng ngày hôm nay.',
            'end_date.required' => 'Vui lòng điền đầy đủ thông tin.',
            'end_date.date' => 'Ngày kết thúc không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
            'usage_limit.required' => 'Vui lòng điền đầy đủ thông tin.',
            'usage_limit.integer' => 'Số lần sử dụng phải là số nguyên.',
            'usage_limit.min' => 'Số lần sử dụng phải lớn hơn hoặc bằng 0.',
            'minimum_order.required' => 'Vui lòng điền đầy đủ thông tin.',
            'minimum_order.integer' => 'Giá trị đơn hàng tối thiểu phải là số nguyên.',
            'minimum_order.min' => 'Giá trị đơn hàng tối thiểu phải lớn hơn hoặc bằng 0.',
            'description.required' => 'Vui lòng điền đầy đủ thông tin.',
            'description.regex' => 'Mô tả không hợp lệ, không được chứa ký tự đặc biệt ngoài các ký tự cho phép.',
            'description.max' => 'Mô tả không được vượt quá 255 ký tự.',
        ];
        $request->validate([
            'voucher_code' => 'required|size:6|regex:/^[A-Z0-9]+$/',
            'description' => 'required|max:255',
            'discount_amount' => 'required|min:0|integer',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'minimum_order' => 'required|min:0|integer',
            'usage_limit' => 'required|min:0|integer',

        ], $messages);

        $voucher = Voucher::findOrFail($id);
        $voucher->voucher_code = $request->input('voucher_code');
        $voucher->description = $request->input('description');
        $voucher->discount_amount = $request->input('discount_amount');
        $voucher->start_date = $request->input('start_date');
        $voucher->end_date = $request->input('end_date');
        $voucher->minimum_order = $request->input('minimum_order');
        $voucher->usage_limit = $request->input('usage_limit');

        $voucher->save();

        return redirect()->route('voucher_list')->with('success', 'Sửa voucher thành công');
    }
}
