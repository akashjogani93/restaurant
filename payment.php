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
                    Day Payments
                </h1>
            </section>
           
            <div class="boxx ">
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <form class="form-horizontal" method="post" action="payment.php" id="addform">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Date</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control pull-right" name="fdate" id="fdate"
                                                value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Payment Mode</label>
                                        <div class="col-sm-4">
                                            <select name="payment" id="payment" class="form-control">
                                                <option>ALL</option>
                                                <option>Cash</option>
                                                <option>Online</option>
                                                <option>Card</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group  col-md-1">
                                        <button type="submit" name="save" class="btn btn-success col-md-12">View</button>
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
                                        var fdate=$('#fdate').val();
                                        var tdate=$('#tdate').val();
                                        window.location.href = "paymentbill.php?fdate=" + fdate;
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
                                <th>Bill NO</th>
                                <th>Discount%</th>
                                <th>Discount Amount</th>
                                <th>Bill Amount</th>
                                <th>Payment</th>
                            </tr>
                        </thead>
                        <tbody id="tb">
                            <?php
                                require_once("dbcon.php");
                                $online=0;
                                $tot_bills=0;
                                $tot_amount=0;
                                $disamt2=0;
                                $net1=0;
                                $net11=0;
                              if(isset($_POST['save']))
                              {
                                  $fdate = date("Y-m-d",strtotime($_POST['fdate']));
                                  $payment = $_POST['payment'];
                                   ?>
                                          <script>
                                              var fdate="<?php echo $fdate; ?>";
                                              var payment="<?php echo $payment; ?>";
                                              $("#fdate").val(fdate);
                                              $("#payment").val(payment);
                                          </script>
                                    <?php
                                    if($payment=='ALL')
                                    {
                                        $sql = "SELECT * FROM tabletot WHERE date='$fdate'";
                                    }else
                                    {
                                        $sql = "SELECT * FROM `tabletot` WHERE `paymentmode`='$payment' AND date='$fdate'";
                                    }
                                  $sql2 = "SELECT SUM(gndtot) AS grdtot, discount, SUM(gstamt) AS gsttot, SUM(nettot) AS netprc,SUM(discount) AS dis  FROM tabletot WHERE date='$fdate'";
                              }
                              else{
                                    $fdate = date("Y-m-d");
                                    $sql = "SELECT * FROM tabletot WHERE date='$fdate'";
                                  }
                                  $result = mysqli_query($conn, $sql);
                                  if (mysqli_num_rows($result) > 0) 
                                  {
                                      
                                      while($row = mysqli_fetch_assoc($result)) 
                                      {

                                        $amount=round($row['nettot']);
                                        $net11 +=round($row['nettot']);
                                        $disamt1=$row['disamt'];
                                        $disamt2 +=$row['disamt'];
                                    ?>
                                        
                                            <tr>
                                                <td><?php echo $row['slno']; ?></td>
                                                <td><?php echo $row['discount'].'%'; ?></td>
                                                <td><?php echo number_format($disamt1,2); ?></td>
                                                <td><?php echo number_format($amount,2); ?></td>
                                                <td><?php echo $row['paymentmode']; ?></td>
                                            </tr>
                                          <?php 
                                        } 
                                  } ?>
                            </tbody>
                        </table>
                    </div><br><br>
                        <table class="table table-bordered table-striped">
                            <tr style="background: #cc4b4b; color: #fff;">
                                <td>
                                    <h4>Total Discount Amount: &nbsp;&nbsp;
                                       
                                    <?php echo number_format($disamt2,2); ?>
                                    </h4>
                                </td>
                                <td>
                                    <h4>Total Bill Amount: &nbsp;&nbsp;
                                        
                                    <?php echo number_format(round($net11),2); ?>
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
                                <?php ?>
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