<?php require_once("header.php"); ?>
<?php
require "vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Alignment\LabelAlignmentLeft;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
?>

<body class="hold-transition skin-blue sidebar-mini"onload="myFunction()" >
    <div class="wrapper" id="form1">
    <style>
          @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500;700&display=swap');


body{
    background-color:white;
    font-family: 'Roboto Mono', monospace;
}
      
        h5,p{
            font-family: 'Roboto Mono', monospace;
        }
    *{
        font-size:11pt;
    }
   
    .fst{
        display:flex;
        justify-content:space-between;
    }
      .fst h5{
        font-size:12px;
        
      }
    th {
    text-align: right!important;
    font-weight: bold !important;
    padding:1px 0 !important;
    margin:0;
    font-size:12px;
    color:black;

}
    td{
        text-align: right!important;
        padding:2px !important;
        padding:0 !important;
        font-size:10px;
        font-weight:bold !important; 
        margin:0;
        color:black;

}

@page{
    margin:0;
    padding:0;
}
.box-body{
    width:100%;
}
      #Iname{
       text-align: left!important;
      }

.fst h5 {
    margin: 4px !important;
    font-size: 12px;
    font-weight:bold;

}
.fst h6 {
    margin: 4px !important;
    font-size: 14px;
    font-weight:bold;
}
      .INo{
        text-align: left!important;
        /* padding:4px !important; */
      }
     
    </style>
       
        <?php
            $tabno = $_GET['tabno'];
            // $tabsec = $_GET['tabsec'];
            $billno = $_GET['billno'];

            $padded_id = str_pad($billno, 4, '0', STR_PAD_LEFT);
            
            $captain = $_GET['capnam'];
            $discount = $_GET['discount'];
            $date = $_GET['date'];
            $new_date = date("d/m/Y", strtotime($date));
      		$current_time = $_GET['time'];
     	    // date_default_timezone_set('Asia/Kolkata');
            // $current_time = date('h:i A');
        ?>
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="mainprint" style="background-color:white;">
            <!-- Content Header (Page header) -->
            <section class="content">
                <!-- Table -->
                <div class="box" >
                    <!-- /.box-header -->
                    <div class="box-body">
                      
                    <div class="row" style="margin-bottom:0px;" >
                            <div class="col-md-12" style="padding-right:8px;padding-left:8px !important;" >
                             
                              
                                <center> 
                                    <img src="img/Oyeshava.png" alt="" width="80"  style="object-fit:cover;">
                                    <h5 style="font-size:10px; margin-top:5px;margin-bottom:0px; line-height:0px; font-weight:bold;">1/E, Bauxite Road, B.K, Kangarli, Belagavi, Karnataka 590010</h5>
                                    <b style="font-size:9px; margin-top:0px; font-weight:bold;margin-bottom:0px;line-height:0px;">7676801529 | www.oyeshawa.in | info@oyeshawa.in </b>
                                    <p style="font-size:8px;margin-top:-3px; font-weight: bold;"> GST : 29AYAPC2895D1ZJ</b>
                                </center>  
                            </div>
                       </div>
                       <div class="row">
                            <div class="col-md-12">
                                <div class="fst">
                                    <h5>Bill No:<?php echo $padded_id; ?></h5>
                                    
                                  	   <h5>Date:<?php echo $new_date; ?></h5>
                                </div>
                                <div class="fst">
                                    <h5 style="padding-left:0px;">Table No:<?php echo $tabno; ?></h5>
                                    <h5></h5>
                                 
                                  <h5 >Time:<?php echo $current_time; ?></h5>
                                  
                                </div>
                               <div class="fst">
                                    <h5>STW:<?php echo $captain; ?></h5>
                                    <h5></h5>
                                    <h5></h5>
                                </div>
                            </div>
                       </div>
                       <hr style="margin:0; padding:0; font-weight:10px;">

                        <div class="row">
                            <div class="col-md-12">
                                <table style="width:100%;">
                                    <thead>
                                        <tr style="border-bottom:2px solid black;line-height:2; margin-bottom:18px;">
                                            <th class="INo"  style="width:7%;">No</th>
                                            <th class="INo" style="width:49%;">Item Name</th>
                                            <th style="width: 10px%;">Qty</th>
                                            <th style="width:15%;">Rate</th>
                                            <th style="width:20%;">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <!--<tr style="border-top:2px solid blackK;margin:10px 0;"></tr>-->
                                        <?php 
                                            $total = 0;
                                            $gst = 0;
                                            $gstamt = 0;
                                            $nettot = 0;
                                            require_once("dbcon.php");
                                            $sql = "SELECT * FROM tabledata WHERE tabno='$tabno' AND `billno`= $billno";
                                                $result = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result) > 0)
                                                {
                                                    $sn = 0;
                                                    while($row = mysqli_fetch_assoc($result)) 
                                                    {
                                                        $total += $row['tot'];
                                                        ?>
                                                            <tr style="margin">
                                                                <td class="INo"><?php echo ++$sn; ?></td>
                                                                <td class="INo"><?php echo $row['itmnam']; ?></td>
                                                                <td><?php echo $row['qty']; ?></td>
                                                                <td><?php echo number_format($row['prc'],2); ?></td>
                                                                <td><?php echo number_format($row['tot'],2); ?></td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }
                                                $total = number_format($total,2);
                                                // $gstamt = number_format(($total*($gst/100)),2);
                                                $nettot = $total;

                                                $gstmain=$total*2.5/100;
                                                $gst=$gstmain*2;

                                                $final=$nettot+$gst;
                                                $amount=round($final);

                                                $decimalPart = fmod($final, 1);
                                                

                                            ?>
                                          
                                                <tr></tr>
                                                <tr style="border-top:2px solid black; ">
                                                    <th colspan="2"></th>
                                                    <th colspan="2">Sub-Total: </th>
                                                    <td> <?php echo number_format($total,2); ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="1"></th>
                                                    <th colspan="3"> SGST @ 2.5%: </th>
                                                    <td><?php echo number_format($gstmain,2); ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="1"></th>
                                                    <th colspan="3">CGST @ 2.5%: </th>
                                                    <td> <?php echo number_format($gstmain,2); ?></td>
                                                </tr>
                                            	<tr>
                                                    <th colspan="2"></th>
                                                    <th colspan="2">Round Off: </th>
                                                    <td> <?php if($decimalPart < 0.50)
                                                                {
                                                                    echo -number_format($decimalPart,2);
                                                                }else
                                                                {

                                                                    echo "+".number_format(1-$decimalPart,2);
                                                                }
                                                        ?></td>
                                                </tr>
                                                <tr style="border-top:2px solid black; border-bottom:2px solid black;">
                                                   
                                                    <th colspan="4"><b>TOTAL AMOUNT</b></th>
                                                    <td><b><?php echo number_format($amount,2); ?></b></td>
                                                </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                              
 								E.& 0.E
                              <br>
                              <b>Cashier Id:</b> 
                              <?php if($cash_id=='0')
                                    {
                                        echo 'Admin'; 
                                    }
                                    else
                                    {
                                        echo $cash_id;
                                    }
                                ?>
                                <center>
                                    <?php
                                        // UPI payment details
                                        $merchantName = 'Oyeshawa';
                                        $merchantUPI = '63270088246.payswiff@indus'; // Replace with your UPI address
                                        // $amount = '1.00'; // Replace with the dynamic amount

                                        // Format UPI data
                                        $upiData = "upi://pay?pn={$merchantName}&pa={$merchantUPI}&am={$amount}";

                                        $qr_code = QrCode::create($upiData)
                                                        ->setSize(100)
                                                        ->setMargin(0)
                                                        ->setForegroundColor(new Color(0, 0, 0))
                                                        ->setBackgroundColor(new Color(255, 255, 255))
                                                        ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh);

                                        $writer = new PngWriter;

                                        $re = $writer->write($qr_code);
                                        echo $re->saveToFile('qrcode.png');
                                        // Output the QR code image to the browser

                                        // Save the image to a file if needed
                                        // $result->saveToFile("upi-qr-code.png");
                                    ?>
                                    <img src="qrcode.png" />
                                    <h4 style="margin-top:0px;">- - - - - <b>THANK YOU VISIT AGAIN</b> - - - - -</h4>
                                </center>
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- End Table -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="jquery.PrintArea.js"></script>
    <script type="text/javascript">

function myFunction()
{
    window.print();
    // window.location.href ="table_form.php";
    // window.onafterprint = function(event)
    // {
    window.location.href ="nc_reports.php";
    // };
}

</script> 
</body>

</html>