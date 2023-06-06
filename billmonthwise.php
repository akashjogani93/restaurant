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
                Bill Monthwise
                </h1>
            </section>
           
            <div class="boxx ">
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <form class="form-horizontal" method="post" action="billmonthwise.php" id="addform">
                                    
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
                                        <!-- <label class="control-label" for="company_name">Payment Type</label><br>
                                        <input type="radio" id="contactChoice1" name="contact" value="Online" />
                                        <label for="contactChoice1" checked style="margin-right:20px;">Online</label>

                                        <input type="radio" id="contactChoice2" name="contact" value="Case" />
                                        <label for="contactChoice2">Cash</label> -->
                                        <div class="form-group  col-md-3">
                                        <button type="submit" name="save" class="btn btn-success col-md-12">View</button>
                                    </div>
                                    </div> 
                                 </div>
                                <div class="row" style="margin:10px 0 0 5px;">
                                    <!-- <div class="form-group  col-md-3">
                                        <button type="submit" name="save" class="btn btn-success col-md-12">View</button>
                                    </div> -->

                                    <!-- <div class="form-group col-md-3" >
                                        <button type="submit" name="print" class="btn btn-warning col-md-12"style="background-color:#B29CBE;color:white;">Print</button>
                                    </div> -->
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
                                        window.location.href = "month_bill.php?fdate=" + fdate + "&tdate=" + tdate;
                                    }
                                </script>
                                <!-- <form action="printmonthreport.php" method="post">
                                    <input type="hidden" name="sdate" value="<?php echo $fdate; ?>" />
                                    <input type="hidden" name="edate" value="<?php echo $tdate; ?>" />
                                    

                                </form> -->
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
                               <!-- <th>Bill No</th> -->
                                <th>Bill Amount</th>
                                <!-- <th>Discount</th> -->
                                <!-- <th>Net pay</th> -->
                                <!-- <th>Payment Mode</th> -->
                            </tr>
                        </thead>
                        <tbody id="tb">
                            <?php
                                require_once("dbcon.php");
                                $online=0;
                                $grandTotal = 0;
                                $discount=0;
                          $tot_amount=0;
                                if(isset($_POST['save']))
                                {
                                    $fdate = date("Y-m-d",strtotime($_POST['fdate']));
                                     $tdate = date("Y-m-d",strtotime($_POST['tdate']));
                                        // $payment=$_POST['contact'];
                                        ?>
                                        <script>
                                            var fdate="<?php echo $fdate; ?>";
                                            var tdate="<?php echo $tdate; ?>";
                                            $("#fdate").val(fdate);
                                            $("#tdate").val(tdate);
                                        </script>
                                        <?php
                                    $sql3= "select slno, SUM(gndtot) as gndtot, date, discount, SUM(gstamt) AS gsttot, SUM(nettot) AS netprc,SUM(discount) AS discount, paymentmode from tabletot WHERE date BETWEEN '$fdate' AND '$tdate' GROUP BY DAY(date)";
                                    
                                }
                                else{
                                        $fdate = date("Y-m-d");
                                        $tdate = date("Y-m-d");
                                        $sql3= "select slno, SUM(gndtot) as gndtot, date, discount, SUM(gstamt) AS gsttot, SUM(nettot) AS netprc,SUM(discount) AS discount, paymentmode from tabletot WHERE date BETWEEN '$fdate' AND '$tdate' GROUP BY DAY(date)";
                                    }
                                    $result = mysqli_query($conn, $sql3);
                                   // var_dump($result);
                                    $result2= mysqli_query($conn, $sql3);
                                    $res= mysqli_fetch_assoc($result2);
                                    if (mysqli_num_rows($result) > 0) 
                                    {
                                        // output data of each row
                                        
                                        while($row = mysqli_fetch_assoc($result)) 
                                        {
                                            $grandTotal += $row['gndtot'];
                                            $discount +=$row['discount'];

                                        ?>
                                        <tr>
                                            <td><?php echo date("d-M-Y", strtotime( $row['date'])); ?></td>
                                            <!--<td><?php echo $row['slno']; ?></td>-->
                                            <td><?php echo $row['gndtot']; ?></td>
                                            <!--  <td><?php echo $row['grdtot']; ?></td>-->
                                            <!-- <td><?php echo $row['discount']; ?></td>
                                            <td><?php echo $row['paymentmode']; ?></td> -->
                                        </tr>
                                        <?php  if($row['paymentmode']=="online"){$online+=$row['gndtot'];  }
                                          $tot_amount=$tot_amount+$row['gndtot'];
                                    } }  ?>
                        </tbody>
                    </table>
                </div><br><br>
                   <table class="table table-bordered table-striped">
                        <tr style="background: #cc4b4b; color: #fff;">
                            <td colspan="6">
                                <h4>Total Amount: &nbsp;&nbsp;
                                    <i class="fa fa-inr"></i> 
                                  <?php echo $tot_amount; ?>
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