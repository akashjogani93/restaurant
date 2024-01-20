<?php require_once("header.php"); 
    require_once("dbcon.php");
?>
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

<body class="hold-transition skin-blue sidebar-mini"onload="myFunction('EPSON TM-T82 Receipt')" >
    <div class="wrapper" id="form1">
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500;700&display=swap');


        body{
            background-color:white;
            font-family: 'Roboto Mono', monospace;
        }
        p{
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
letter-spacing:0.2px;
word-spacing:0.4px;

}

    td{
        text-align: right!important;
        padding:2px !important;
        padding:0 !important;
        font-size:11px;
        font-weight:bold !important; 
        margin:0;
        color:black;
	letter-spacing:0.2px;
word-spacing:0.4px;

}
th.qty, td.qty{
    text-align: left !important; 
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
    margin: 0px !important;
    font-size: 12px;
    font-weight:bold;

}
      #mainprint{
      
      min-height:auto;
      }
.fst h6 {
    margin: 0px !important;
    font-size: 14px;
    font-weight:bold;
}
      .INo{
        text-align: left!important;
        /* padding:4px !important; */
      }
     .content
     {
        
        margin:0  !important;
        padding:0 0 0 10px !important;
        overflow: !important;
        width:95%;
     }
    </style>
       
        <?php
            // $tabno = $_GET['tabno'];
            // // $tabsec = $_GET['tabsec'];
            $billno = $_GET['billno'];
            $back = $_GET['back'];
            $billno1 = str_pad($billno, 4, '0', STR_PAD_LEFT);
            
            $query="SELECT * FROM `invoice` WHERE `slno`='$billno'";
            $exc=mysqli_query($conn,$query);
            while($row=mysqli_fetch_assoc($exc))
            {
                $date=$row['date'];
                $time=$row['time'];
                $cpaname=$row['capname'];
                $tabno=$row['tabno'];
                $status=$row['status'];
                $gtot=(float) $row['gtot'];
                $discount=(float) $row['discount'];
                $discAmt=(float) $row['discAmt'];
                $gstAmt=(float) ($row['gstAmt']/2);
                $roundplus=(float) $row['roundplus'];
                $roundminus=(float) $row['roundminus'];
                $nettot=(float) $row['nettot'];
                $userid=$row['cashId'];
            }
            if($status==0)
            {
                $table="temtable";
            }else
            {
                $table="tabledata";
            }
        ?>
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="mainprint" style="background-color:white; padding-top:0px;">
            <!-- Content Header (Page header) -->
            <section class="content">
                <!-- Table -->
                <div class="box" >
                    <!-- /.box-header -->
                    <div class="box-body" >
                      
                       <div class="row" style="margin-bottom:0px;" >
                            <div class="col-md-12" style="padding-right:8px;padding-left:8px !important;" >
                                <center> 
                                    <img src="img/Oyeshava.png" alt="" width="80"  style="object-fit:cover;">
                                    <h5 style="font-size:10px; margin-top:5px;margin-bottom:0px;  font-weight:bold;">1/E, Bauxite Road, B.K, Kangarli, Belagavi, Karnataka 590010</h5>
                                    <b style="font-size:9px; margin-top:0px; font-weight:bold;margin-bottom:0px;line-height:0px;">7676801529 | www.oyeshawa.in | info@oyeshawa.in </b>
                                    <p style="font-size:8px;margin-top:-3px; font-weight: bold;"> GST : 29AVDPK6618E1ZJ</p>
                                </center>  
                            </div>
                       </div>
                       <div class="row">
                            <div class="col-md-12" style="padding-right:8px;padding-left:8px;" >
                                <div class="fst">
                                    <h5 style="font-size:11px;font-weight:900;">Bill No:<?php echo $billno; ?></h5>
                                    
                                  	   <h5>Date:<?php echo $date; ?></h5>
                                </div>
                                <div class="fst">
                                    <h5 style="padding-left:0px;font-size:11px;font-weight:900;margin-top:-8px;">Table No:<?php echo $tabno; ?></h5>
                                    <h5></h5>
                                 
                                  <h5 >Time:<?php echo $time; ?></h5>
                                  
                                </div>
                               <div class="fst">
                                    <h5>STW:<?php echo $cpaname; ?></h5>
                                    <h5></h5>
                                    <h5></h5>
                                </div>
                            </div>
                       </div>
                       <hr style="margin:0; padding:0; font-weight:10px;">
                        <div class="row">
                            <div class="col-md-12" style="padding-right:8px;padding-left:8px;" >
                                <table style="width:100%;">
                                    <thead>
                                        <tr style="border-bottom:1px solid black;line-height:2; margin-bottom:18px;">
                                            <th class="INo"  style="width:7%;">No</th>
                                            <th class="INo" style="width:49%;">Item Name</th>
                                            <th class="qty" style="width: 10px%;">Qty</th>
                                            <th style="width:15%;">Rate</th>
                                            <th style="width:20%;">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                    
					$sql = "SELECT itmnam, prc, SUM(qty) as total_qty, SUM(tot) as total_tot 
                                                        FROM $table 
                                                           WHERE `tabno`='$tabno' AND `billno`= $billno 
                                                            GROUP BY `itmnam` 
                                                        ORDER BY slno ASC";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0)
                                            {
                                                $sn=0;
                                                while($row = mysqli_fetch_assoc($result)) 
                                                {
                                                    ?>
                                                        <tr style="margin">
                                                            <td class="INo"><?php echo ++$sn; ?></td>
                                                            <td class="INo"><?php echo $row['itmnam']; ?></td>
                                                            <td class="qty"><?php echo $row['total_qty']; ?></td>
                                                            <td><?php echo number_format($row['prc'], 2); ?></td>
                                                            <td><?php echo number_format($row['total_tot'], 2); ?></td>
                                                        </tr>
                                                    <?php
                                                }
                                            }
                                        ?>
                                        <tr></tr>
                                        <tr style="border-top:1px solid black; ">
                                            <th colspan="2"></th>
                                            <th colspan="2" style="font-size:10px;">Sub-Total: </th>
                                            <td> <?php echo number_format($gtot,2); ?></td>
                                        </tr>
                                        <?php 
                                            if($discount!=0 && $discount!='')
                                            {
                                                echo '<tr>
                                                <th colspan="1"></th>
                                                    <th colspan="3">Discount('.$discount.'%): </th>
                                                    <td>-'.number_format($discAmt,2).'</td>
                                                </tr>';
                                            }
                                        ?>
                                        <tr>
                                            <th colspan="1"></th>
                                            <th colspan="3" style="font-size:10px;"> SGST @ 2.5%: </th>
                                            <td><?php echo number_format($gstAmt,2); ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="1"></th>
                                            <th colspan="3" style="font-size:10px;">CGST @ 2.5%: </th>
                                            <td> <?php echo number_format($gstAmt,2); ?></td>
                                        </tr>
                                        <?php 
                                            if($roundplus != 0)
                                            {
                                                ?>
                                                <tr>
                                                    <th colspan="2"></th>
                                                    <th colspan="2" style="font-size:10px;">Round Off: </th>
                                                    <td> <?php echo +$roundplus; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            if($roundminus != 0)
                                            {
                                                ?>
                                                <tr>
                                                    <th colspan="2"></th>
                                                    <th colspan="2" style="font-size:10px;">Round Off: </th>
                                                    <td> <?php echo -$roundminus; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                        <tr style="border-top:1px solid black; border-bottom:1px solid black;">
                                            <th colspan="4"><b style="font-size:12px;padding-right:30px;">TOTAL AMOUNT</b></th>
                                            <td><b style="font-size:12px;"><?php echo number_format($nettot,2); ?></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="font-size:11px;padding-right:8px;padding-left:8px;" >
 								E.& 0.E
                              <br>
                              <b style="font-size:11px;">Cashier Id:</b> 
                              <?php if($userid=='0')
                                    {
                                        echo 'Admin'; 
                                    }
                                    else
                                    {
                                        echo $userid;
                                    }
                                ?>

                                <center>
                                <?php
                                    // UPI payment details
                                    $merchantName = 'Oyeshawa';
                                    $merchantUPI = '63270088246.payswiff@indus'; // Replace with your UPI address
                                    // $amount = '1.00'; // Replace with the dynamic amount

                                    // Format UPI data
                                    $upiData = "upi://pay?pn={$merchantName}&pa={$merchantUPI}&am={$nettot}";

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
                                    <img src="qrcode.png"/>
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

function myFunction(pritername)
{
    const urlParams = new URLSearchParams(window.location.search);
    var back = urlParams.get('back');
    var pri = urlParams.get('pri');
    window.print();
    

    // if (window.print) {
    //     // Use silent printing option (true) for direct printing
    //     const printOptions = {
    //         silent: true,
    //         printerName: pritername,
    //     };

    //     // Print the document
    //     window.print({ printOptions })
    //         .then(() => {
    //             console.log('Document sent to printer successfully.');
    //         })
    //         .catch((error) => {
    //             console.error('Error printing document:', error);
    //         });
    // } else {
    //     console.error('Printing not supported in this browser.');
    // }

    // window.onafterprint = function(event)
    // {
        if (back == 1 && pri == 0) {
            window.location.href = "table_master.php";
        } else if (back == 1 && pri == 1) {
            window.location.href = "parcel_master.php";
        } else if (back == 0 && pri == 0) {
            window.location.href = "report_day_invoice.php";
        }
    // };
}

// Function to print a document to a specific printer
function printDocument(printerName) {
    if (navigator.print) {
        // Use silent printing option (true) for direct printing
        const printOptions = {
            silent: true,
            printerName: printerName,
        };

        // Print the document
        navigator.print.print({ printOptions })
            .then(() => {
                console.log('Document sent to printer successfully.');
            })
            .catch((error) => {
                console.error('Error printing document:', error);
            });
    } else {
        console.error('Printing not supported in this browser.');
    }
}

// Example usage:
// Replace 'YourPrinterName' with the actual name of the printer you want to use
// printDocument('YourPrinterName');
</script> 
</body>

</html>