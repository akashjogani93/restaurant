<?php 
    require __DIR__.'/vendor/autoload.php';
    use Endroid\QrCode\QrCode; 


    // Generate QR code
    $upiId = 'example@upi'; // Replace with your UPI ID
    $amount = 100; // Replace with the payment amount
    $qrCodeText = "upi://pay?pa=" . urlencode($upiId) . "&am=" . $amount;
    $qrCode = new QrCode($qrCodeText);
    $qrCode->setSize(200); // Adjust the size of the QR code (in pixels)
    $qrCodeImage = $qrCode->writeDataUri();

    // Connect to the thermal printer
    $printer = printer_open('LPT1'); // Replace 'LPT1' with your printer device

    // Set the printer to print graphics
    printer_set_option($printer, PRINTER_MODE, "RAW");

    // Send the QR code image to the printer
    printer_write($printer, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $qrCodeImage)));

    // Close the printer connection
    printer_close($printer);
?>