<body class="hold-transition skin-blue sidebar-mini"onload="myFunction()" >
    <div class="wrapper" id="form1">
    <style>
    *{
        font-size:11pt;
    }
   
    .fst{
        display:flex;
        justify-content:space-between;
    }
    th {
    text-align: right!important;
}
td{
    text-align: right!important;

}
@page{
    margin:0;
    padding:0;
}

    </style>
       <?php require_once("header.php"); ?>
        <?php
            $tabno = $_GET['tabno'];
            // $tabsec = $_GET['tabsec'];
            $billno = $_GET['billno'];
            $captain = $_GET['capnam'];
            // $discount = $_GET['discount'];
            $discount=0;
            $date = $_GET['date'];
        ?>
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="mainprint">
            <!-- Content Header (Page header) -->
            <section class="content">
                <!-- Table -->
                <div class="box" >
                    <!-- /.box-header -->
                    <div class="box-body">
                      
                       <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <img src="img/shiva.png" alt="" width="90" height="90">
                                    <h5>Makanur cross, national Highway, near harihar, Harihar, Karnataka 581123</h5>
                                    <h6>GST : 29AYAPC2895D1ZJ</h6>

                                </center> 
                            </div>
                       </div>
                       <div class="row">
                            <div class="col-md-12">
                                <div class="fst">
                                    <h5><b>Bill No:</b><?php echo $billno; ?></h5>
                                    <h5><b>Date:</b><?php echo $date; ?></h5>
                                </div>
                                <div class="fst">
                                    <h5><b>Waiter:</b><?php echo $captain; ?></h5>
                                    <h5><b>Table No:</b><?php echo $tabno; ?></h5>
                                </div>
                            </div>
                       </div>
                       <hr style="margin:0; padding:0; font-weight:10px;">

                        <div class="row">
                            <div class="col-md-12">
                                <table style="width:100%;">
                                    <thead>
                                        <tr style="border-bottom:1px dotted black;">
                                            <th>No</th>
                                            <th>Item name</th>
                                            <th>Qty</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                                            <tr>
                                                                <td><?php echo ++$sn; ?></td>
                                                                <td><?php echo $row['itmnam']; ?></td>
                                                                <td><?php echo $row['qty']; ?></td>
                                                                <td><?php echo number_format($row['prc'],2); ?></td>
                                                                <td><?php echo number_format($row['tot'],2); ?></td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }
                                                $total = round($total,2);
                                                $gstamt = round(($total*($gst/100)),2);
                                                $nettot = round(($total+$gstamt),2);

                                                $gstmain=$total*5/100;
                                                $sgst=$gstmain/2;
                                                $final=$nettot+$gstmain;
                                            ?>
                                                <tr style="border-top:1px dotted black;">
                                                    <th colspan="3"></th>
                                                    <th>Sub-Total: </th>
                                                    <td> <?php echo number_format($total,2); ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3"></th>
                                                    <th>SGST: </th>
                                                    <td><?php echo number_format($sgst,2); ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3"></th>
                                                    <th >CGST: </th>
                                                    <td> <?php echo number_format($sgst,2); ?></td>
                                                </tr>
                                            <?php if($discount>0){ ?>
                                                <tr>
                                                    <th colspan="3"></th>
                                                    <th >Discount</th>
                                                    <td><?php echo number_format($discount,2); ?></td>
                                                </tr>
                                            <?php } ?> 
                                                <tr style="border-top:1px dotted black; border-bottom:1px dotted black;">
                                                    <th colspan="3"></th>
                                                    <th >TOTAL AMOUNT</th>
                                                    <td><?php echo number_format($final-$discount,2); ?></td>
                                                </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <h4>- - - - - <b>THANK YOU VISIT AGAIN</b> - - - - -</h4>
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
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="jquery-3.6.0.min.js"></script>
  <script src="jquery.PrintArea.js"></script>
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


function myFunction() 
{

    window.print();
   window.onafterprint = function(event)
   {
    window.location.href ="table_form.php";
};
         
}
// $(document).ready(function() 
// {
//     $('#mainprint').printArea(
//         {
//           mode: 'iframe',
//           popClose: true
//         }
//     );
// });
    </script>
</body>

</html>