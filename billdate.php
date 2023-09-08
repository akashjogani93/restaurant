   <?php
            require_once("header.php"); 
           
            ?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">

     

<style>
    .form-horizontal .form-group{
        margin:0 0 15px 0;
    }
    th{
        background-color:rgba(21, 22, 23, 0.06);
    }
    th,td{
        text-align:center;
    }
    .boxx{
        background-color:rgba(255, 255, 255, 0.4);
        margin:20px;
       
    }
    .box-body1{
        overflow-x:scroll;
    }
</style>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                BILL DATEWISE
                </h1>
            </section>
           
            <!-- SELECT2 EXAMPLE -->
            <div class="boxx"><br>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <form class="form-horizontal" method="post" action="billdate.php" id="addform">
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
                                    <div class="form-group col-md-2">
                                        <button type="submit" name="save" class="btn btn-success col-md-11">View</button>
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
                                        window.location.href = "date_bill.php?fdate=" + fdate + "&tdate=" + tdate;
                                    }
                                </script>
                                <form action="print_tot.php" method="post">
                                    <input type="hidden" name="sdate" value="" />
                                    <input type="hidden" name="edate" value="" />
                                <!-- <div class="form-group col-md-2" style="margin-top: -13px;">
                                        <button type="submit" name="print" class="btn  col-md-11" style="background-color:#B29CBE;color:white;">Print</button>
                                    </div>
                                </form> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
           
           
                <div class="box-body">
                <div class="box-body1">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Bill Date</th>
                                <th>Bill No</th>
                                <th>Grand Amount</th>
                                <th>Discount</th>
                                <th>GST(5%)</th>
                                <th>Net pay</th>
                                <th>Payment Mode</th>
                            </tr>
                        </thead>
                        <tbody id="tb">
                            <?php
                                require_once("dbcon.php");
                                $online=0;
                          		$tot_bills=0;
                          		$tot_amount=0;
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
                                    $sql = "SELECT * FROM tabletot WHERE  date BETWEEN '$fdate' AND '$tdate'";
                                    // $sql2 = "SELECT SUM(gndtot) AS grdtot, discount, SUM(gstamt) AS gsttot, SUM(nettot) AS netprc,SUM(discount) AS dis  FROM tabletot WHERE  date BETWEEN '$fdate' AND '$tdate'";
                                }
                                else{
                                        $fdate = date("Y-m-d");
                                        $tdate = date("Y-m-d");
                                        $sql = "SELECT * FROM tabletot WHERE  date BETWEEN '$fdate' AND '$tdate'";
                                        // $sql2 = "SELECT SUM(gndtot) AS grdtot, discount, SUM(gstamt) AS gsttot, SUM(nettot) AS netprc,SUM(discount) AS dis  FROM tabletot WHERE  date BETWEEN '$fdate' AND '$tdate'";
                                    }
                                    $result = mysqli_query($conn, $sql);
                                    // $result2= mysqli_query($conn, $sql2);
                                    // $res= mysqli_fetch_assoc($result2);
                                    if (mysqli_num_rows($result) > 0) 
                                    {
                                        // output data of each row
                                        while($row = mysqli_fetch_assoc($result)) 
                                        {
                                            $gst=($row['gndtot']-$row['disamt'])*5/100;
                                            $net=round($row['nettot']);
                                        ?>
                                            <tr>
                                                <td><?php echo date("d-M-Y", strtotime( $row['date'])); ?></td>
                                                <td><?php echo $row['slno']; ?></td>
                                                 <td><?php echo number_format($row['gndtot'],2); ?></td>
                                                 <td><?php echo number_format($row['disamt'],2); ?></td>
                                                 <td><?php echo number_format($gst,2); ?></td>
                                                <td><?php echo number_format($net,2); ?></td>
                                                <td><?php echo $row['paymentmode']; ?></td> 
                                            </tr>
                                            <?php  if($row['paymentmode']=="online")
                                                    {
                                                        $online+=$row['gndtot'];  
                                                    }
                                          $tot_bills=$tot_bills+1;
                                          $tot_amount=$tot_amount+$net;
                                        } 
                                    } ?>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-striped">
                      <tbody>
                        <tr style="background: #cc4b4b; color: #fff;">
                            <td colspan="4">
                                <h4>Total Bills: &nbsp;&nbsp;
                                    <?php echo $tot_bills; ?>
                                </h4>
                            </td>
                            <td colspan="2">
                                <h4>Total Amount: : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  <?php echo number_format(round($tot_amount),2); ?>
                                    </h4>
                            </td>

                        </tr>
                       </tbody>
                    </table>
                    </div>
                </div>
            
        </div>
        <!-- End Table -->

        </section>
        <!-- /.content -->
    </div>
    </div>
    <!-- /.content-wrapper -->

    

    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
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

</body>

</html>