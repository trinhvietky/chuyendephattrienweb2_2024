<?php

return [
    'tmn_code' => env('VNP_TMN_CODE', 'default_tmn_code'),
    'hash_secret' => env('VNP_HASH_SECRET', 'default_hash_secret'),
    'url' => env('VNP_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
    'return_url' => env('VNP_RETURN_URL', 'http://localhost/igt.vn/vnpay/vnpay_return.php'),
    'api_url' => env('VNP_API_URL', 'https://sandbox.vnpayment.vn/merchant_webapi/api/transaction'),
];
