<!DOCTYPE html>
<html>
<head>
  <title>Dynamic QR Code for Payment</title>
  <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
</head>
<body>
  <div id="qrcode"></div>

  <script>
    // Sample payment data (replace this with your actual payment data)`
    // var upi = "upi://pay?pa=akashjogani93@axl&am=1&pn=MerchantName&mc=123456&tid=987654321&tr=123456789&tn=PaymentDescription&url=https://example.com/callback&ands=googlepay";

    let upi = {
        pa: "akashjogani93@axl",
        pn: "Foody",
        tn: "Order",
        am: "100.34",
        cu: "INR"
    }
    let upiLink = new URLSearchParams(upi).toString();
    console.log('UPI Link:'+ 'http://paytm.com/?' +upiLink);


    // Create the QR code
    // const qrCode = new QRCode(document.getElementById("qrcode"), {
    //   text: JSON.stringify(paymentData),
    //   width: 256,
    //   height: 256,
    // });
  </script>
</body>
</html>