<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <?php
            require_once("header.php"); 
            ?>
            <style type="text/css" media="print">
                @media print {
                    /* Hide the search box */
                    .dataTables_filter {
                        display: none;
                    }

                    /* Hide the "Export" button */
                    .dt-buttons {
                        display: none;
                    }

                    /* Remove borders from table cells */
                    /* .dt-print-view td, .dt-print-view th {
                        border: none !important;
                    } */
                    td {
                        text-align: left;
                    }
                    th {
                        text-align: left;
                    }

                    .dt-print-view > .c1{
                        width:50;
                    }

                    .dt-print-view > .c2, .c3{
                        width:25;
                    }
                    /* Set font size and line height */
                    .dt-print-view {
                        font-size: 14px;
                        line-height: 1.5;
                    }

                    /* Center table headers */
                    /* .dt-print-view th {
                        text-align: center;
                    } */

                    /* Set background color for table headers */
                    .dt-print-view thead th {
                        background-color: #ddd;
                    }

                    /* Set background color for table rows */
                    .dt-print-view tbody tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }
                    }

            </style>
            <style>
                .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                    padding: 1px !important;
                }
                .form-horizontal .form-group{
                    margin:0 0 15px 0;
                }
                .boxx{
                    background-color:rgba(255, 255, 255, 0.4);
                
                }
                th{
                    background-color:rgba(21, 22, 23, 0.06);
                }
                td{
                    text-align:left;
                }
                th {
                        text-align: left;
                    }
                    .last-row {
  background-color: #f5f5f5;
}
            </style>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Item Wise Report
                </h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- form start -->
                <div class="boxx"><br>
                <form class="form-horizontal" method="post" id="addform" action="nc_itemwise.php">
                    <div class="box-body">
                        <div class="row">
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
                            
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="form-group col-md-2">
                        <button name="pp" onclick="printClick()" class="btn btn-info col-md-11" style="background-color:#B29CBE;color:white;">Print</button>
                    </div>
                </div>
                <script>
                    function printClick()
                    {
                        // alert('hi');.
                        var fdate=$('#fdate').val();
                        var tdate=$('#tdate').val();
                        // alert(fdate);
                        window.location.href = "NC_bill.php?fdate=" + fdate + "&tdate=" + tdate;
                    }
                </script>
                <!-- Table -->
                
                    <!-- /.box-header -->
                    <div id="prt">
                        <div class="box-body" style="overflow-x:scroll;">
                            <table id='example1' class='table table-bordered table-striped' >
                                <thead>
                                    <tr>
                                        <th style="c1">Item Name</th>
                                        <th style="c2">Total Qty</th>
                                        <!-- <th style="c3">Total Amount</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        require_once("dbcon.php");
                                        if(isset($_POST['save']))
                                        {
                                            $status = true;
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
                                            $sql_item_name = "SELECT DISTINCT `itmno` FROM `tabledata` WHERE `tot`=0 AND `date` BETWEEN '$fdate' AND '$tdate';";
                                        }
                                        else
                                        {
                                            $fdate = date("Y-m-d");
                                            $tdate = date("Y-m-d");
                                            $status = false;
                                            $sql_item_name = "SELECT DISTINCT `itmno` FROM `tabledata` WHERE `tot`=0 AND `date` BETWEEN '$fdate' AND '$tdate';";
                                        }
                                        $result = mysqli_query($conn, $sql_item_name);
                                        $tot=0;
                                        if (mysqli_num_rows($result) > 0) 
                                        {
                                            $totamt=0;
                                            while($row = mysqli_fetch_assoc($result)) 
                                            {
                                                //echo $i."=>".$row['itmnam']."<br>";
                                                $item = $row['itmno'];
                                                if($status==true)
                                                {
                                                    $sql = "SELECT sum(qty) AS total_qty,itmnam, sum(tot) AS tot, COUNT(billno) AS bill FROM tabledata where `tot`=0 AND itmno='$item' AND `date` BETWEEN '$fdate' AND '$tdate';"; 
                                                }else
                                                {
                                                    $sql = "SELECT sum(qty) AS total_qty,itmnam, sum(tot) AS tot, COUNT(billno) AS bill FROM tabledata where `tot`=0 AND itmno='$item' AND `date` BETWEEN '$fdate' AND '$tdate';";
                                                }
                                                
                                                $result1 = mysqli_query($conn, $sql);
                                               
                                                if (mysqli_num_rows($result1) > 0) 
                                                {
                                                    $i=1;
                                                    
                                                    while($row1 = mysqli_fetch_assoc($result1)) 
                                                    {
                                                        $item = $row1['itmnam'];
                                                        $total_qty = $row1['total_qty'];
                                                        $tota = $row1['tot'];
                                                        $bill = $row1['bill'];
                                                        $tot+=$total_qty;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $item; ?></td>
                                                                <td><?php echo $total_qty; ?></td>
                                                                <!-- <td><?php echo $tota; ?></td> -->
                                                            </tr>
                                                        <?php
                                                        $i++;
                                                     
                                                    }
                                                    
                                                }
                                                $totamt=$totamt+$tota;
                                            }
                                            ?>
                                            </tbody>
                                            <tfoot>
                                                
                                                <!-- <tr style="background-color:pink;">
                                                    <td><b><?php echo "Total Amount"; ?></b></td>
                                                    <td></td>
                                                    <td><b><?php echo $totamt; ?></b></td>
                                                </tr> -->
                                        </tfoot>

                                        
                                            <?php
                                            

                                        }
                                    ?>
								 
                            </table>
                        </div>
                    </div>

                </div>
                <!-- End Table -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php require_once("footer.php"); ?>

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
            buttons: [
                'print'
            ]

        });
    });
    </script>
</body>

</html>