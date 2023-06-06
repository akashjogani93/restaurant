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
                    Day Calculation
                </h1>
            </section>
           
            <div class="boxx ">
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <form class="form-horizontal" method="post" action="day_amount.php" id="addform">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Date</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control pull-right" name="fdate" id="fdate" value="<?php echo date('Y-m-d'); ?>">
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
                                        // alert(fdate);
                                        window.location.href = "day_amtbill.php?fdate=" + fdate;
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
                                <th>Basic Amount</th>
                                <th>CGST 2.5%</th>
                                <th>SGST 2.5%</th>
                              	<th>Discount</th>
                                <th>Round Off(-)</th>
                                <th>Round Off(+)</th>
                                <th>Bill Amount</th>
                            </tr>
                        </thead>
                        <tbody id="tb">
                            <?php
                                require_once("dbcon.php");
                                $online=0;
                                $tot_bills=0;
                                $tot_amount=0;
                          		$disc=0;
                                $basic1=0;
                                $gst1=0;
                                $net1=0;
                                $rminus=0;
                                $rplus=0;
                              if(isset($_POST['save']))
                              {
                                  $fdate = date("Y-m-d",strtotime($_POST['fdate']));
                                //   $tdate = date("Y-m-d",strtotime($_POST['tdate']));
                                   ?>
                                          <script>
                                              var fdate="<?php echo $fdate; ?>";
                                              $("#fdate").val(fdate);
                                          </script>
                                          <?php
                                  $sql = "SELECT * FROM tabletot WHERE date='$fdate' AND `status`=1";
                                  $sql2 = "SELECT SUM(gndtot) AS grdtot, discount, SUM(gstamt) AS gsttot, SUM(nettot) AS netprc,SUM(discount) AS dis  FROM tabletot WHERE date='$fdate'";
                              }
                              else{
                                      $fdate = date("Y-m-d");
                                    //$tdate = date("Y-m-d");
                                      $sql = "SELECT * FROM tabletot WHERE date='$fdate' AND `status`=1";
                                      $sql2 = "SELECT SUM(gndtot) AS grdtot, discount, SUM(gstamt) AS gsttot, SUM(nettot) AS netprc,SUM(discount) AS dis  FROM tabletot WHERE date='$fdate'";
                                  }
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
                                                <td><?php echo $row['slno']; ?></td>
                                                <td><?php echo number_format($row['gndtot'],2); ?></td>
                                                <td><?php echo number_format($sgst,2); ?></td>
                                                <td><?php echo number_format($sgst,2); ?></td>
                                                <td><?php echo number_format($disamt,2); ?></td>
                                                <td><?php echo number_format($negative,2); ?></td>
                                                <td><?php echo number_format($positive,2); ?></td>
                                                <td><?php echo number_format($net11,2); ?></td>
                                            </tr>
                                          <?php 
                                            // $tot_bills=$tot_bills+1;
                                            // $tot_bills=$tot_bills+1;
                                            // $tot_amount=$tot_amount+$row['gndtot'];

                                            $basic1=$basic1+$basic;
                                            $gst1=$gst1+$gst;
                                            // $net1=$net1+$net11;
                                            
                                            $rminus=$rminus+$negative;
                                            $rplus=$rplus+$positive;
                                        } 
                                        $net1=($basic1+$gst1+$rplus)-$disc-$rminus;
                                  } ?>
                            </tbody>
                        </table>
                    </div><br><br>
                        <table class="table table-bordered table-striped">
                            <tr style="background: #cc4b4b; color: #fff;">
                                <td>
                                    <h4>Total Basic Amount: &nbsp;&nbsp;
                                       
                                    <?php echo number_format($basic1,2); ?>
                                    </h4>
                                </td>
                                <td>
                                    <h4>Total SGST: &nbsp;&nbsp;
                                     
                                    <?php echo number_format($gst1/2,2); ?>
                                    </h4>
                                </td>
                                <td>
                                    <h4>Total CGST: &nbsp;&nbsp;
                                     
                                    <?php echo number_format($gst1/2,2); ?>
                                    </h4>
                                </td>
                              	<td>
                                    <h4>Total Discount: &nbsp;&nbsp;
                                     
                                    <?php echo number_format($disc,2); ?>
                                    </h4>
                                </td>
                                <td>
                                    <h4>Round Off(-): &nbsp;&nbsp;
                                     
                                    <?php echo number_format($rminus,2); ?>
                                    </h4>
                                </td>
                                <td>
                                    <h4>Round off(+): &nbsp;&nbsp;
                                     
                                    <?php echo number_format($rplus,2); ?>
                                    </h4>
                                </td>
                                <td>
                                    <h4>Total Bill Amount: &nbsp;&nbsp;
                                        
                                    <?php echo number_format(round($net1),2); ?>
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