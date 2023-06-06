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
            $tdate = $_GET['tdate'];
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
                            <b><h5>Sales Calculation-Month Wise</h5></b>
                            <h6>From: <?php echo $fdate; ?> To <?php echo $tdate; ?></h6>
                        </center>
                        </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:20%" class="text-center">Date</th>
                                <th style="width:15%" class="text-center">B.Amt</th>
                                <th style="width:10%" class="text-center">CGST</th>
                                <th style="width:10%" class="text-center">SGST</th>
                              	<th style="width:10%" class="text-center">Discount</th>
                                <th style="width:10%" class="text-center">R(-)</th>
                                <th style="width:10%" class="text-center">R(+)</th>
                                <th style="width:15%" class="text-center">N.Amt</th>
                            </tr>
                        </thead>
                        <tbody id="tb">
                            <?php
                                require_once("dbcon.php");
                                $grandTotal = 0;
                          		$disc=0;
                                $netprc = 0;
                                $basic1=0;
                                $gst1=0;
                                $rminus=0;
                                $rplus=0;
                                $GST=0;
                                $sql3= "SELECT slno, SUM(gndtot) as gndtot, date, SUM(gstamt) AS gsttot, SUM(nettot) AS netprc, SUM(disamt) AS disamt FROM tabletot WHERE date BETWEEN '$fdate' AND '$tdate' AND `status`=1 GROUP BY DAY(date)";
                                
                                $result = mysqli_query($conn, $sql3);
                                $result2= mysqli_query($conn, $sql3);
                                $res= mysqli_fetch_assoc($result2);
                                if (mysqli_num_rows($result) > 0) 
                                {
                                    while($row = mysqli_fetch_assoc($result)) 
                                    {

                                        $date=$row['date'];
                                        $sql4="SELECT * FROM `tabletot` WHERE `date`='$date' AND `status`=1";
                                        $result4 = mysqli_query($conn,$sql4);
                                        $roundNegative=0;
                                        $roundPositive=0;
                                        $total=0;
                                        $disamt=0;
                                        $gndtot=0;
                                        while($row4 = mysqli_fetch_assoc($result4)) 
                                        {
                                            $round=round($row4['nettot']);
                                            $round1=$row4['nettot'];
                                           
                                            $disamt += $row4['disamt'];

                                            $total=$total+$round;
                                            $roundDeci = fmod($round1, 1);
                                            if($roundDeci < 0.50)
                                            {
                                                $roundNegative=$roundNegative+$roundDeci;
                                            }else
                                            {
                                                $roundPos=1-$roundDeci;
                                                $roundPositive=$roundPositive+$roundPos;
                                            }

                                            $gndtot+= $row4['gndtot'];
                                        }
                                        $disc += $disamt;

                                        $GST +=($gndtot*5)/100;
                                        $GST1=($gndtot*5)/100;
                                        $sgst=$GST1/2;
                                        ?>
                                        <tr>
                                            <td><?php echo date("d-M-Y", strtotime( $row['date'])); ?></td>
                                            <td class="text-right"><?php echo number_format($gndtot,2); ?></td>
                                            <td class="text-right"><?php echo number_format($sgst,2); ?></td>
                                            <td class="text-right"><?php echo number_format($sgst,2); ?></td>
                                            <td class="text-right"><?php echo number_format($disamt,2); ?></td>
                                            <td class="text-right"><?php echo number_format($roundNegative,2); ?></td>
                                            <td class="text-right"><?php echo number_format($roundPositive,2); ?></td>
                                            <td class="text-right"><?php echo number_format($total,2); ?></td>
                                        </tr>
                                        <?php
                                        $basic1=$basic1+$gndtot;
                                        $gst1=$gst1+$sgst;
                                        $rminus=$rminus+$roundNegative;
                                        $rplus=$rplus+$roundPositive;
                                    }
                                    $Final=($basic1+$GST+$rplus)-$disc-$rminus;
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-center"><b><?php echo "Total"; ?></b></td>
                                <td class="text-right"><b style="margin-right:5px;"><?php echo number_format($basic1,2); ?></b></td>
                                <td  class="text-right"><b style="margin-right:5px;"><?php echo number_format($gst1,2); ?></b></td>
                                <td  class="text-right"><b style="margin-right:5px;"><?php echo number_format($gst1,2); ?></b></td>
                                <td  class="text-right"><b style="margin-right:5px;"><?php echo number_format($disc,2); ?></b></td>
                                <td  class="text-right"><b style="margin-right:5px;"><?php echo number_format($rminus,2); ?></b></td>
                                <td  class="text-right"><b style="margin-right:5px;"><?php echo number_format($rplus,2); ?></b></td>
                                <td class="text-right"><b style="margin-right:5px;"><?php echo number_format(round($Final),2); ?></b></td>
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
        window.location.href ="day_calculate.php";
     };
}

</script> 
</body>

</html>