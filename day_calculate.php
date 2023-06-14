<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">

        <?php
            require_once("header.php"); 
            ?>
<style>
    .boxx{
        background-color:rgba(255, 255, 255, 0.4);
        margin:20px;
       
    }
    tr{
        background-color:rgba(21, 22, 23, 0.06);
    }
    th,td{
        text-align:center;
    }
    .box-body1{
        width:100%;
        overflow-x:scroll;
    }
</style>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Month Wise Calculation
                </h1>
            </section>
           
            <div class="boxx ">
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <form class="form-horizontal" method="post" action="day_calculate.php" id="addform">
                                    
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">From Date</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control pull-right" name="fdate" id="fdate"
                                                value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">To Date</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control pull-right" name="tdate" id="tdate"
                                                value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="form-group  col-md-3">
                                        <button type="submit" name="save" class="btn btn-success col-md-12">View</button>
                                    </div>
                                    </div> 
                                 </div>
                                
                                </form>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <button name="pp" onclick="printClick()" class="btn btn-info col-md-11" style="background-color:#B29CBE;color:white; margin-top:-15px;">Print</button>
                                    </div>
                                </div>
                                <script>
                                    function printClick()
                                    {
                                        // alert('hi');.
                                        var fdate=$('#fdate').val();
                                        var tdate=$('#tdate').val();
                                        // alert(fdate);
                                        window.location.href = "daycal_bill.php?fdate=" + fdate + "&tdate=" + tdate;
                                    }
                                </script>

                             </div>
                        </div>
                    </div>
                
                <!-- /.row -->
           
            <div id="prt">
                <div class="box-body">
                <div class="box-body1">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Bill Date</th>
                                <th>Basic Amount</th>
                                <th>Discount</th>
                                <th>CGST 2.5%</th>
                                <th>SGST 2.5%</th>
                                <th>Round Off(-)</th>
                                <th>Round Off(+)</th>
                                <th>Bill Amount</th>
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
                                $Final=0;
                                if(isset($_POST['save']))
                                {
                                    $fdate = date("Y-m-d",strtotime($_POST['fdate']));
                                    $tdate = date("Y-m-d",strtotime($_POST['tdate']));
                                    ?>
                                        <script>
                                            var fdate="<?php echo $fdate; ?>";
                                            var tdate="<?php echo $tdate; ?>";
                                            $("#fdate").val(fdate);
                                            $("#tdate").val(tdate);
                                        </script>
                                    <?php
                                    // echo $fdate;
                                    $sql3= "SELECT slno, SUM(gndtot) as gndtot, date, SUM(gstamt) AS gsttot, SUM(nettot) AS netprc, SUM(disamt) AS disamt FROM tabletot WHERE date BETWEEN '$fdate' AND '$tdate' AND `status`=1 GROUP BY DAY(date)";
                                }else
                                {
                                    $fdate = date("Y-m-d");
                                    $tdate = date("Y-m-d");
                                    $sql3= "SELECT slno, SUM(gndtot) as gndtot, date, SUM(gstamt) AS gsttot, SUM(nettot) AS netprc, SUM(disamt) AS disamt FROM tabletot WHERE date BETWEEN '$fdate' AND '$tdate' AND `status`=1 GROUP BY DAY(date)";
                                }
                                $result = mysqli_query($conn, $sql3);
                                // $result2= mysqli_query($conn, $sql3);
                                // $res= mysqli_fetch_assoc($result);
                                if(mysqli_num_rows($result) > 0) 
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

                                        $GST +=(($gndtot-$disamt)*5)/100;
                                        $GST1=(($gndtot-$disamt)*5)/100;
                                        $sgst=$GST1/2;
                                        ?>
                                        <tr>
                                            <td><?php echo date("d-M-Y", strtotime( $row['date'])); ?></td>
                                            <td><?php echo number_format($gndtot,2); ?></td>
                                            <td><?php echo number_format($disamt,2); ?></td>
                                            <td><?php echo number_format($sgst,2); ?></td>
                                            <td><?php echo number_format($sgst,2); ?></td>
                                            <td><?php echo number_format($roundNegative,2); ?></td>
                                            <td><?php echo number_format($roundPositive,2); ?></td>
                                            <td><?php echo number_format($total,2); ?></td>
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
                        </table>
                    </div><br><br>
                        <table class="table table-bordered table-striped">
                            <tr style="background: #cc4b4b; color: #fff;">
                                <td>
                                    <h4>Basic Amount: &nbsp;&nbsp;
                                       
                                    <?php echo number_format($basic1,2); ?>
                                    </h4>
                                </td>
                                <td>
                                    <h4>Discount: &nbsp;&nbsp;
                                     
                                    <?php echo number_format($disc,2); ?>
                                    </h4>
                                </td>
                                <td>
                                    <h4>CGST 2.5%: &nbsp;&nbsp;
                                     
                                    <?php echo number_format($gst1,2); ?>
                                    </h4>
                                </td>
                                <td>
                                    <h4>SGST 2.5%: &nbsp;&nbsp;
                                     
                                    <?php echo number_format($gst1,2); ?>
                                    </h4>
                                </td>
                                <td>
                                    <h4>Round off(-): &nbsp;&nbsp;
                                     
                                    <?php echo number_format($rminus,2); ?>
                                    </h4>
                                </td>                                <td>
                                    <h4>Round off(+): &nbsp;&nbsp;
                                     
                                    <?php echo number_format($rplus,2); ?>
                                    </h4>
                                </td>
                                <td>
                                    <h4>Total Bill Amount: &nbsp;&nbsp;
                                        
                                    <?php echo round($Final); ?>
                                    </h4>
                                </td>
                            </tr>
                        </table>           
                    </div>
                </div>
            </div>
        </div>
        <!-- End Table -->

        </section>
        <!-- /.content -->
    </div>
    </div>
    <!-- /.content-wrapper -->

    <?php// require_once("footer.php"); ?>

    <div class="control-sidebar-bg"></div>
    </div>
   
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.16/api/sum().js"></script> -->

    <script src="cdn/dataTables.buttons.min.js"></script>
    <script src="cdn/buttons.print.min.js"></script>
    <script src="cdn/sum().js"></script>
    
    <script>
        $(function() {
            $("#example1").DataTable({
                // dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                "lengthMenu": [
                    [25, 10, 100, -1],
                    [25, 10, 100, "All"]
                ],
                // buttons: [
                //     'print'
                // ]

            });
        });
    </script>

    <!-- <script>
    $(document).ready(function() {
        $("#example1 tbody").on('dblclick', 'tr', function() {
            var currow = $(this).closest('tr');
            var item_id = currow.find('td:eq(0)').html();
            window.location.href = 'bill_copy.php?bill_no=' + item_id;
        });
    });

    $("#tb tr").hover(function() {
        $(this).css('background-color', 'yellow');
    }, function() {
        $(this).css('background-color', 'white');
    });
    </script> -->

</body>

</html>