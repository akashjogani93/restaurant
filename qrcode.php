<?php

$upiVpa = 'akashjogani93@axl';
$amount = 1;

// Generate QR code data
$data = "upi://pay?pa=$upiVpa&am=$amount&pn=MerchantName&mc=123456&tid=987654321&tr=123456789&tn=PaymentDescription&url=https://example.com/callback&ands=googlepay";

// URL to generate QR code using Google Charts API
$apiUrl = 'https://chart.googleapis.com/chart';

// API parameters
$params = array(
    'cht' => 'qr',
    'chs' => '300x300', // QR code image size
    'chl' => $data // QR code data
);

// Generate the API URL with parameters
$apiUrl .= '?' . http_build_query($params);

// Output the QR code image
echo '<img src="' . $apiUrl . '" alt="UPI Amount QR Code">';

?>