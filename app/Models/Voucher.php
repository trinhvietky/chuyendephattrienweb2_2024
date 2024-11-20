<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Voucher extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'voucher';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'voucher_code',
        'description',
        'discount_amount',
        'start_date',
        'end_date',
        'minimum_order',
        'usage_limit',
        'status',
    ];


    /**
     * hàm thực hiện tạo voucher
     */
    public static function createVoucher($data)
    { // Các thông báo lỗi tùy chỉnh
        $messages = [
            'voucher_code.required' => 'Vui lòng điền đầy đủ thông tin.',
            'voucher_code.size' => 'Mã giảm giá phải có độ dài 6 ký tự.',
            'voucher_code.regex' => 'Mã giảm giá chỉ được bao gồm chữ hoa và số, không có khoảng trắng hay ký tự đặc biệt.',
            'discount_amount.required' => 'Vui lòng điền đầy đủ thông tin.',
            'discount_amount.integer' => 'Giá trị giảm phải là số nguyên.',
            'discount_amount.min' => 'Giá trị giảm phải lớn hơn hoặc bằng 0.',
            'discount_amount.digits_between' => 'Giá trị giảm có giá trị nhỏ hơn hoặc bằng 100',
            'start_date.required' => 'Vui lòng điền đầy đủ thông tin.',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',
            'start_date.after_or_equal' => 'Ngày bắt đầu phải lớn hơn hoặc bằng ngày hôm nay.',
            'end_date.required' => 'Vui lòng điền đầy đủ thông tin.',
            'end_date.date' => 'Ngày kết thúc không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
            'usage_limit.required' => 'Vui lòng điền đầy đủ thông tin.',
            'usage_limit.integer' => 'Số lần sử dụng phải là số nguyên.',
            'usage_limit.min' => 'Số lần sử dụng phải lớn hơn hoặc bằng 0.',
            'usage_limit.digits_between' => 'Số lần sử dụng phải nằm trong khoảng từ 1 đến 10 chữ số.',
            'minimum_order.required' => 'Vui lòng điền đầy đủ thông tin.',
            'minimum_order.integer' => 'Giá trị đơn hàng tối thiểu phải là số nguyên.',
            'minimum_order.min' => 'Giá trị đơn hàng tối thiểu phải lớn hơn hoặc bằng 0.',
            'description.required' => 'Vui lòng điền đầy đủ thông tin.',
            'description.regex' => 'Mô tả không hợp lệ, không được chứa ký tự đặc biệt ngoài các ký tự cho phép.',
            'description.max' => 'Mô tả không được vượt quá 255 ký tự.',
        ];
        $validatedData = validator($data, [
            'voucher_code' => 'required|size:6|regex:/^[A-Z0-9]+$/|unique:voucher',
            'description' => 'required|max:255',
            'discount_amount' => 'required|min:0|integer|digits_between:1,3',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'minimum_order' => 'required|min:0|integer',
            'usage_limit' => 'required|min:0|integer|digits_between:1,10',
        ], $messages)->validate();
        return self::create([
            'voucher_code' => $validatedData['voucher_code'],
            'description' => $validatedData['description'],
            'discount_amount' => $validatedData['discount_amount'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'minimum_order' => $validatedData['minimum_order'],
            'usage_limit' => $validatedData['usage_limit'],
            'status' => 0,
        ]);
    }


    /**
     * hàm thực hiện cập nhập voucher
     */
    public static function updateVoucher($data, $id)
    {
        $messages = [
            'voucher_code.required' => 'Vui lòng điền đầy đủ thông tin.',
            'voucher_code.size' => 'Mã giảm giá phải có độ dài 6 ký tự.',
            'voucher_code.regex' => 'Mã giảm giá chỉ được bao gồm chữ hoa và số, không có khoảng trắng hay ký tự đặc biệt.',
            'discount_amount.required' => 'Vui lòng điền đầy đủ thông tin.',
            'discount_amount.integer' => 'Giá trị giảm phải là số nguyên.',
            'discount_amount.min' => 'Giá trị giảm phải lớn hơn hoặc bằng 0.',
            'discount_amount.digits_between' => 'Giá trị giảm có giá trị nhỏ hơn hoặc bằng 100',
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
            'usage_limit.digits_between' => 'Số lần sử dụng phải nằm trong khoảng từ 1 đến 10 chữ số.',
        ];
        $validator = Validator::make($data, [
            'voucher_code' => 'required|size:6|regex:/^[A-Z0-9]+$/',
            'description' => 'required|max:255',
            'discount_amount' => 'required|min:0|integer|digits_between:1,3',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'minimum_order' => 'required|min:0|integer',
            'usage_limit' => 'required|min:0|integer|digits_between:1,10',

        ], $messages);
        $validatedData = $validator->validate();
        $voucher = self::findOrFail($id);
        $voucher->update($validatedData);
        return $voucher;
    }
}
