<body class="hold-transition skin-blue sidebar-mini" onload="myFunction()">
    <div class="wrapper" id="form1">
    <style>
    *{
        font-size:11pt;
    }
    </style>
        <?php require_once("header.php"); ?>
        <?php
            $tabno = $_GET['tabno'];
            // $tabsec = $_GET['tabsec'];
            $billno = $_GET['billno'];
            $captain = $_GET['capnam'];
            $discount = $_GET['discount'];
            ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content">
                <!-- Table -->
                <div class="box" style="margin:-15px;">
                    <!-- /.box-header -->
                    <div class="box-body">
                      
                            <div id="prt">
                                <!--<table id="dynamic-table" class="table table-striped table-bordered table-hover">-->
                                <table width="320" cellpadding="0" cellspacing="0">
                                    <thead>
                                        <caption>
                                           <!-- <h3 align="center" style="color: red;">URBAN DHABA
                                            </h3>-->
                                            <h3 align="center" style="color: red;"><img src="shivalogo.png"  width="100" height="60">
                                            </h3>
                                        </caption>
                                        <thead>
                                            <tr>
                                                <td colspan="5">
                                                    <p style="text-align: center;">
                                                    Makanur cross,national highway, near harihar, harihar Karnataka 581123 <br>
                                                    <span>GST : 29AYAPC2895D1ZJ </span></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align="left"><b>Date :</b><?php echo date('d-m-Y'); ?></td>
                                                <td></td>
                                                <th colspan="2" style="text-align: left" colspan="2">Bill No : <?php echo $billno; ?></th>
                                                <!-- <td colspan="2" align="right"><b>Ph No :</b> </td> -->
                                            </tr>
                                            <tr>
                                                <th align="left" colspan="2">Waiter: <?php echo $captain; ?></th>
                                                <td></td>
                                                <th style="text-align: left" colspan="2">Table No : <?php echo $tabno; ?></th>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    <hr style="color: #000;
                                                    background-color:; border: dotted 1px;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: right; ">No</th>
                                                <th style="text-align: right; ">Item Name</th>
                                                <th style="text-align: right; ">Qty</th>
                                                <th style="text-align: right; ">Rate</th>
                                                <th style="text-align: right; ">Amount</th>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    <hr style="color: #000;
                                                    background-color:; border: dotted 1px;">
                                                </td>
                                            </tr>
                                        </thead>

                                    <tbody>
                                        <tr>
                                            <?php
                                                $total = 0;
                                                $gst = 0;
                                                $gstamt = 0;
                                                $nettot = 0;

                                                require_once("dbcon.php");
                                                $sql = "SELECT * FROM tabledata WHERE tabno='$tabno' AND `billno`= $billno";
                                                $result = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row  
                                                    $sn = 0;
                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        $total += $row['tot'];
                                                ?>
                                        <tr>
                                            <td style="text-align: right; "><?php echo ++$sn; ?></td>
                                            <td style="text-align: right; "><?php echo $row['itmnam']; ?></td>
                                            <td style="text-align: right; "><?php echo $row['qty']; ?></td>
                                            <td style="text-align: right; "><?php echo number_format($row['prc'],2); ?></td>
                                            <td style="text-align: right; "><?php echo number_format($row['tot'],2); ?></td>
                                        </tr>
                                        <?php    }
                                                }
                                                $total = round($total,2);
                                                $gstamt = round(($total*($gst/100)),2);
                                                $nettot = round(($total+$gstamt),2);

                                                $gstmain=$total*5/100;
                                                $sgst=$gstmain/2;
                                                $final=$nettot+$gstmain;
                                            ?>
                                        <tr>
                                            <td colspan="5">
                                                <hr style="color: #000;
                                                background-color:; border: dotted 1px; margin-bottom:3px; padding-bottom:0;">
                                            </td>

                                        </tr>
                                        <?php if($discount>0){?>
                                            <tr style="margin-bottom:6px;">
                                                <td></td><td></td>
                                                <td style="border-bottom: 1px solid transparent;"></td>
                                                <td style="text-align: right;">Sub Total</td>
                                                <td style="text-align: right; border-bottom: 1px solid transparent;">
                                                    <?php echo number_format($total,2); ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td></td><td></td>
                                                <td style="border-bottom: 1px solid transparent;"></td>
                                                <td style="text-align: right;">SGST 2.5%</td>
                                                <td style="text-align: right; border-bottom: 1px solid transparent;">
                                                    <?php echo number_format($sgst,2); ?></td>
                                            </tr>
                                            <tr>
                                                <td></td><td></td>
                                                <td style="border-bottom: 1px solid transparent;"></td>
                                                <td style="text-align: right;">CGST 2.5%</td>
                                                <td style="text-align: right; border-bottom: 1px solid transparent;">
                                                    <?php echo number_format($sgst,2); ?></td>
                                            </tr>
                                            <tr>
                                                <td></td><td></td>
                                                <td style="border-bottom: 1px solid transparent;"></td>
                                                <td style="text-align: right;">Discount</td>
                                                <td style="text-align: right; border-bottom: 1px solid transparent;">
                                                    <?php echo number_format($discount,2); ?></td>
                                            </tr>
                                            <tr>
                                            <td colspan="5">
                                                <hr style="color: #000; border: dotted 1px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align: right;" colspan="2">Total Amount</td>
                                            <td style="text-align: right;"> <?php echo number_format($final-$discount,2); ?></td>
                                        </tr>
                                        <?php }
                                        else
                                        {
                                            ?>
                                            <tr>
                                                <td></td><td></td>
                                                <td></td>
                                                <td style="text-align: right;">Sub Total</td>
                                                <td style="text-align: right; border-bottom: 1px solid transparent;">
                                                    <?php echo number_format($total,2); ?></td>
                                            </tr>
                                        
                                            <tr>
                                                <td></td><td></td>
                                                <td style="border-bottom: 1px solid transparent;"></td>
                                                <td style="text-align: right;">SGST 2.5%</td>
                                                <td style="text-align: right; border-bottom: 1px solid transparent;">
                                                    <?php echo number_format($sgst,2); ?></td>
                                            </tr>
                                            <tr>
                                                <td></td><td></td>
                                                <td style="border-bottom: 1px solid transparent;"></td>
                                                <td style="text-align: right;">CGST 2.5%</td>
                                                <td style="text-align: right; border-bottom: 1px solid transparent;">
                                                    <?php echo number_format($sgst,2); ?></td>
                                            </tr>
                                            <tr>
                                            <td colspan="5">
                                                <hr style="color: #000; border: dotted 1px;">
                                            </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align: right;" colspan="2">Total Amount</td>
                                                <td style="text-align: right;"> <?php echo number_format($final-$discount,2); ?></td>
                                            </tr>
                                        <?php }?>
                                        <tr>
                                            <td colspan="5">
                                                <hr style="color: #000; border: dotted 1px;">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="5" style='text-align:center'>
                                                <p style='text-align:center'>*** Thank you Visit Again ***
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- <button class="btn btn-info" type="submit" id="click" onclick="printcontent('prt')"> <i
                                    class="ace-icon fa fa-check bigger-110"></i> PRINT BILL
                            </button>  -->
                       
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- End Table -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
      


    </div>

    <script type="text/javascript">
//    function printcontent(el) {
//  var w = window.open();
//           var restorepage = document.body.innerHTML;
//           console.log(restorepage);
//           var printcontent = document.getElementById(el).innerHTML;
//           w.document.body.innerHTML = printcontent;
//         w.window.print();
//          w.onafterprint = function(event) {
//              w.close()
//           }
//     w.document.body.innerHTML=restorepage;
//         w.close();
//   window.location="table_form.php";
//     }


function myFunction() {
   window.print();
   window.onafterprint = function(event) {
    window.location.href ="table_form.php";
};
         
}

    </script>
</body>

</html>