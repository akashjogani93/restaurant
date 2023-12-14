<?php
require "vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Alignment\LabelAlignmentLeft;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

// UPI payment details
$merchantName = 'Oyeshawa';
$merchantUPI = '63270088246.payswiff@indus'; // Replace with your UPI address
$amount = '1.00'; // Replace with the dynamic amount

// Format UPI data
$upiData = "upi://pay?pn={$merchantName}&pa={$merchantUPI}&am={$amount}";

$qr_code = QrCode::create($upiData)
                 ->setSize(300)
                 ->setMargin(40)
                 ->setForegroundColor(new Color(0, 0, 0))
                 ->setBackgroundColor(new Color(255, 255, 255))
                 ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh);

$label = Label::create("UPI Payment QR Code")
              ->setTextColor(new Color(255, 0, 0))
              ->setAlignment(new LabelAlignmentLeft);


$writer = new PngWriter;

$result = $writer->write($qr_code,  label: $label);

// Output the QR code image to the browser


echo $result->saveToFile('qrcode.png');

// Save the image to a file if needed
// $result->saveToFile("upi-qr-code.png");
?>
