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
        body{
            background-color:white;
        }
    *{
        font-size:11pt;
    }
      .col-md-12{
      padding-left:8px !important;
        padding-right:8px !important;
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
    font-weight: 900 !important;
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
        font-weight:900 !important; 
        margin:0;
        color:black;

}

@page{
    margin:0;
    padding:0;
}
.content{
    width:95%;
    padding:0 0 0 10px !important;
    margin:0 !important;
}
    #Iname{
       text-align: left!important;
      }

.fst h5 {
    margin: 0px !important;
    font-size: 12px;
    font-weight:900;

}
.fst h6 {
    margin: 4px !important;
    font-size: 14px;
    font-weight:900;
}
      .INo{
        text-align: left!important;
    }
     
    </style>
       <?php require_once("header.php");
     ?>
        <?php
            $tabno = $_GET['tabno'];
            $billno = $_GET['billno'];

            $padded_id = str_pad($billno, 4, '0', STR_PAD_LEFT);
            
            $captain = $_GET['capnam'];
            $discount = $_GET['discount'];
            $amt = $_GET['amt'];
            $date = $_GET['date'];
            $new_date = date("d/m/Y", strtotime($date));
      		$current_time = $_GET['time'];
        ?>
        <div class="content-wrapper" id="mainprint" style="background-color:white; min-height:auto;">
            <section class="content">
                <!-- Table -->
                <div class="box" >
                    <!-- /.box-header -->
                    <div class="box-body">
                      
                    <div class="row" style="margin-bottom:8px;">
                            <div class="col-md-12">
                            <center> 
                                    <img src="img/Oyeshava.png" alt="" width="80"  style="object-fit:cover;">
                                    <h5 style="font-size:10px; margin-top:5px;margin-bottom:5px; line-height:0px; font-weight:900;">1/E, Bauxite Road, B.K, Kangarli, Belagavi, Karnataka 590010</h5>
                                    <b style="font-size:10px; margin-top:2px; font-weight:900;margin-bottom:15px;">7676801529 | www.oyeshawa.in | info@oyeshawa.in </b><br>
                                    <b style="font-size:8px; margin-top:0px; font-weight:900;margin-bottom:0px;">GST : 29AYAPC2895D1ZJ</b>
                                </center>  
                            </div>
                       </div>
                       <div class="row">
                            <div class="col-md-12">
                                <div class="fst">
                                    <h5 style="font-size:11px;font-weight:900;">Bill No:<?php echo $padded_id; ?></h5>
                                    
                                  	   <h5>Date:<?php echo $new_date; ?></h5>
                                </div>
                                <div class="fst">
                                    <h5 style="padding-left:0px;font-size:11px;font-weight:900;margin-top:-8px;">Table No:<?php echo $tabno; ?></h5>
                                    <h5></h5>
                                 
                                  <h5 >Time:<?php echo $current_time; ?></h5>
                                  
                                </div>
                               <div class="fst">
                                    <!-- <h5>STW:<?php echo $captain; ?></h5> -->
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
                                        <tr style="border-bottom:1px solid black;border-top:1px solid black;line-height:2; margin-bottom:18px;">
                                            <th class="INo"  style="width:7%;">No</th>
                                            <th class="INo" style="width:40%;">Item name</th>
                                            <th style="width:11%;">Qty</th>
                                            <th style="width:18%;">Rate</th>
                                            <th style="width:24%;">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <!--<tr style="border-top:1px dotted black;margin:10px 0;"></tr>-->
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
                                                //$total = number_format($total,2);
                                                $nettot = $total-$amt;

                                                $gstmain=$nettot*2.5/100;
                                                $gst=$gstmain*2;

                                                $final=($nettot+$gst);
                                                $amount=round($final);

                                                $decimalPart = fmod($final, 1);
                                            ?>
                                          
                                                <tr></tr>
                                                <tr style="border-top:1px solid black; ">
                                                    <th colspan="2"></th>
                                                    <th colspan="2" style="font-size:10px;">Sub-Total: </th>
                                                    <td> <?php echo number_format($total,2); ?></td>
                                                </tr>
                                                <?php 
                                                    if($discount!=0 && $discount!='')
                                                    {
                                                        echo '<tr>
                                                        <th colspan="1"></th>
                                                            <th colspan="3">Discount('.$discount.'%): </th>
                                                            <td>'.-number_format($amt,2).'</td>
                                                        </tr>';
                                                    }
                                                 ?>
                                                <tr>
                                                    <th colspan="1"></th>
                                                    <th colspan="3" style="font-size:10px;"> SGST @ 2.5%: </th>
                                                    <td><?php echo number_format($gstmain,2); ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="1"></th>
                                                    <th colspan="3" style="font-size:10px;">CGST @ 2.5%: </th>
                                                    <td> <?php echo number_format($gstmain,2); ?></td>
                                                </tr>
                                            	    <?php 
                                                        if($decimalPart!=0)
                                                        {
                                                            ?>
                                                            <tr>
                                                                <th colspan="2"></th>
                                                                <th colspan="2" style="font-size:10px;">Round Off: </th>
                                                                <td> <?php if($decimalPart < 0.50)
                                                                            {
                                                                                echo -number_format($decimalPart,2);
                                                                            }else
                                                                            {

                                                                                echo "+".number_format(1-$decimalPart,2);
                                                                            }
                                                                ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    ?>
                                                <tr style="border-top:1px solid black; border-bottom:1px solid black;">
                                                   
                                                    <th colspan="4"><b style="font-size:12px;">TOTAL AMOUNT</b></th>
                                                    <td><b style="font-size:12px;"><?php echo number_format($amount,2); ?></b></td>
                                                </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="font-size:11px;">
                              
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
                                    <img src="qrcode.png" style="object-fit:cover;" />
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
    // window.onafterprint = function(event)
    // {
       // window.location.href ="parcel.php";
    // };
}

</script> 
</body>

</html>