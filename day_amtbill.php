<body class="hold-transition skin-blue sidebar-mini"onload="myFunction()" >
    <div class="wrapper" id="form1">
    <style>
        body{
            background-color:white;
        }
    *{
        font-size:11pt;
    }
    th{
        font-size:12px;
        font-weight:600;
    }
    td{
        font-size:12px;
        
    }
    span{
        font-size:12px;
    }
    h5{
        font-size: 12px;
        margin-top: -7px !important;
        margin-bottom: 8px !important;
        font-weight:700 !important;
    }
    h6{
        font-size: 10px;
        margin-top: -7px !important;
    margin-bottom: 8px !important;
    }

    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 8px;
        line-height: 1 !important;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }

@page{
    margin:0;
    padding:0;
}
.box-body{
    width:100%;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 1px !important;

}
    
    </style>
       <?php require_once("header.php"); ?>
        <?php
            // $tdate = $_GET['tdate'];
            // $tabsec = $_GET['tabsec'];
            $fdate = $_GET['fdate'];

        ?>
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="mainprint" style="background-color:white;">
            <!-- Content Header (Page header) -->
            <section class="content">
                <!-- Table -->
                <div class="box" >
                    <!-- /.box-header -->
                    <div class="box-body">
                    <div class="col-md-12 addres">
                             <center><b>
                                <!-- <h5>SHIVA HOTEL</h5></b>
                            <h6>MAKANUR CROSS, NH4</h6>
                            <h6>RANEBENNUR</h6> -->
                            <b><h5>Sales Day Calculation-Amount Wise</h5></b>

                            <h6>Date: <?php echo $fdate; ?></h6>
                        </center>
                        </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:10%" class="text-center">Bill</th>
                                <th style="width:10%" class="text-center">B.Amt</th>
                                <th style="width:15%" class="text-center">CGST</th>
                                <th style="width:15%" class="text-center">SGST</th>
                              	<th style="width:10%" class="text-center">Discount</th>	
                                <th style="width:10%" class="text-center">R(-)</th>
                                <th style="width:10%" class="text-center">R(+)</th>
                                <th style="width:20%" class="text-center">N.Amt</th>
                            </tr>
                        </thead>
                        <tbody id="tb">
                            <?php
                                require_once("dbcon.php");
                                $grandTotal = 0;
                                $netprc = 0;
                                $basic1=0;
                                $gst1=0;
                                $net1=0;
                                $rminus=0;
                                $rplus=0;
                              $disc=0;
                                $sql = "SELECT * FROM tabletot WHERE date='$fdate' AND `status`=1";
                                $sql2 = "SELECT SUM(gndtot) AS grdtot, discount, SUM(gstamt) AS gsttot, SUM(nettot) AS netprc,SUM(discount) AS dis  FROM tabletot WHERE date='$fdate'";
                                
                                $result = mysqli_query($conn, $sql);
                                  $result2= mysqli_query($conn, $sql2);
                                  $res= mysqli_fetch_assoc($result2);
                                  if (mysqli_num_rows($result) > 0) 
                                  {
                                      // output data of each row
                                      
                                      while($row = mysqli_fetch_assoc($result)) 
                                      {
                                        $basic=$row['gndtot'];
                                        $net=$row['nettot'];
										$disamt= $row['disamt'];
                                      $disc += $row['disamt'];
                                        $gst=($basic*5)/100;
                                        $sgst=$gst/2;

                                        $decimalPart = fmod($net, 1);

                                        if($decimalPart < 0.50)
                                        {
                                            $negative=$decimalPart;
                                            $positive= 0;
                                            // $positive=1-$decimalPart;
                                        }else
                                        {
                                            $negative= 0;
                                            $positive=1-$decimalPart;
                                        }
                                        $net11=round($row['nettot']);
                                      ?>
                                        <tr>
                                            <td class="text-left"><span style="margin-left:5px;"><?php echo $row['slno']; ?></span></td>
                                            <td class="text-right"><span style="margin-right:5px;"><?php echo number_format($basic,2); ?></span></td>
                                            <td class="text-right"><span style="margin-right:5px;"><?php echo number_format($sgst,2); ?></span></td>
                                            <td class="text-right"><span style="margin-right:5px;"><?php echo number_format($sgst,2); ?></span></td>
                                            <td class="text-right"><span style="margin-right:5px;"><?php echo number_format($disamt,2); ?></span></td>
                                            <td class="text-right"><span style="margin-right:5px;"><?php echo number_format($negative,2); ?></span></td>
                                            <td class="text-right"><span style="margin-right:5px;"><?php echo number_format($positive,2); ?></span></td>
                                            <td class="text-right"><span style="margin-right:5px;"><?php echo number_format($net11,2); ?></span></td>
                                        </tr>

                                        <?php

                                            $basic1=$basic1+$basic;
                                            $gst1=$gst1+$gst;
                                            // $net1=$net1+$net;
                                            $rminus=$rminus+$negative;
                                            $rplus=$rplus+$positive;
                                    }
                                    $net1=($basic1+$gst1+$rplus)-$disc-$rminus;

                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-center"><b><?php echo "Total"; ?></b></td>
                                <td class="text-right"><b style="margin-right:5px;"><?php echo number_format($basic1,2); ?></b></td>
                                <td  class="text-right"><b style="margin-right:5px;"><?php echo "CGST"." ".number_format($gst1/2,2); ?></b></td>
                                <td  class="text-right"><b style="margin-right:5px;"><?php echo "SGST"." ".number_format($gst1/2,2); ?></b></td>
                                <td  class="text-right"><b style="margin-right:5px;"><?php echo "Disc"." ".number_format($disc,2); ?></b></td>
                                <td  class="text-right"><b style="margin-right:5px;"><?php echo number_format($rminus,2); ?></b></td>
                                <td  class="text-right"><b style="margin-right:5px;"><?php echo number_format($rplus,2); ?></b></td>
                                <td class="text-right"><b style="margin-right:5px;"><?php echo number_format(round($net1),2); ?></b></td>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="jquery.PrintArea.js"></script>
    <script type="text/javascript">

function myFunction()
{
    window.print();
    window.onafterprint = function(event)
    {
        window.location.href ="day_amount.php";
    };
}

</script> 
</body>

</html>