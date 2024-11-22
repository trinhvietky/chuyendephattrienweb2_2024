<?php

return [
    'vnp_TmnCode' => env('VNP_TMN_CODE', 'default_tmn_code'),
    'vnp_HashSecret' => env('VNP_HASH_SECRET', 'default_hash_secret'),
    'vnp_Url' => env('VNP_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
    'vnp_Returnurl' => env('VNP_RETURN_URL', 'http://localhost/igt.vn/vnpay/vnpay_return.php'),
    'api_url' => env('VNP_API_URL', 'https://sandbox.vnpayment.vn/merchant_webapi/api/transaction'),
];
