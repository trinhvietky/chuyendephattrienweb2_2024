<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Address extends Model
{
    use HasFactory;

    // Chỉ định tên bảng
    protected $table = 'address';
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'tinh',
        'quan',
        'phuong',
        'address',
        'is_default',
    ];
    public static function saveNewAddress($data, $userId)
    {
        $address = new self();

        $address->user_id = $userId;
        $address->name = $data['name'];
        $address->phone = $data['phone'];
        $address->tinh = $data['tinh'];
        $address->quan = $data['quan'];
        $address->phuong = $data['phuong'];
        $address->address = $data['address'];

        if (!empty($data['is_default']) && $data['is_default'] == '1') {
            // Đặt tất cả các địa chỉ khác thành không mặc định
            self::where('user_id', $userId)->update(['is_default' => false]);
            $address->is_default = true;
        } else {
            $address->is_default = false;
        }

        $address->save();

        return $address;
    }
    /**
     * Cập nhật thông tin địa chỉ, nếu có thay đổi thì gọi API để lấy tên tỉnh/quận/phường.
     */
    public static function updateAddress($data, $addressId, $userId)
    {
        // Tìm địa chỉ cần cập nhật
        $address = self::find($addressId);

        if (!$address) {
            return null; // Không tìm thấy địa chỉ
        }

        // Kiểm tra và chuyển giá trị 'on' thành true và 'off' thành false cho is_default
        $isDefault = isset($data['is_default']) && $data['is_default'] === 'on';

        // Nếu người dùng chọn làm mặc định, đặt tất cả các địa chỉ khác thành không phải mặc định
        if ($isDefault) {
            self::where('user_id', $userId)
                ->update(['is_default' => false]);
        }

        // Khởi tạo các biến để lưu tên tỉnh, quận, phường
        $tinh_name = $quan_name = $phuong_name = "";

        // Gọi API nếu có thay đổi tỉnh, quận, phường
        if ($data['tinh'] != $address->tinh) {
            $tinh_name = self::fetchLocationName('tinh', 0, $data['tinh']);
        } else {
            $tinh_name = $address->tinh; // Giữ nguyên tỉnh nếu không thay đổi
        }

        if ($data['quan'] != $address->quan) {
            $quan_name = self::fetchLocationName('quan', $data['tinh'], $data['quan']);
        } else {
            $quan_name = $address->quan; // Giữ nguyên quận nếu không thay đổi
        }

        if ($data['phuong'] != $address->phuong) {
            $phuong_name = self::fetchLocationName('phuong', $data['quan'], $data['phuong']);
        } else {
            $phuong_name = $address->phuong; // Giữ nguyên phường nếu không thay đổi
        }

        // Cập nhật thông tin địa chỉ
        $address->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'tinh' => $tinh_name,
            'quan' => $quan_name,
            'phuong' => $phuong_name,
            'is_default' => $isDefault,
        ]);

        return $address;
    }

    /**
     * Lấy tên địa lý (tỉnh, quận, phường) từ API
     */
    public static function fetchLocationName($type, $parentId, $id)
    {
        $url = match ($type) {
            'tinh' => 'https://esgoo.net/api-tinhthanh/1/0.htm',
            'quan' => 'https://esgoo.net/api-tinhthanh/2/' . $parentId . '.htm',
            'phuong' => 'https://esgoo.net/api-tinhthanh/3/' . $parentId . '.htm',
        };

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        foreach ($data['data'] as $location) {
            if ($location['id'] == $id) {
                return $location['full_name'];
            }
        }

        return ''; // Trả về chuỗi rỗng nếu không tìm thấy
    }
}
