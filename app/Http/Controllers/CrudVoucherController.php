<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
    public function edit($encryptedId)
    {
        // Giải mã ID
        try {
            $id = Crypt::decryptString(urldecode($encryptedId));
        } catch (\Exception $e) {
            return redirect('admin/voucher-list')->with('error', 'voucher không tồn tại');
        }
        // Lấy thông tin user theo id đã giải mã
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
        Voucher::createVoucher($request->all());
        return redirect('admin/voucher-list')->withSuccess('Thêm voucher thành công');
    }

    /**
     * hàm thực hiện cập nhập voucher
     */
    public function updateVoucher(Request $request, $id)
    {
        Voucher::updateVoucher($request->all(), $id);
        return redirect()->route('voucher_list')->with('success', 'Sửa voucher thành công');
    }
}
