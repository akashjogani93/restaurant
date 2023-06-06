<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">

        <?php
            require_once("header.php"); 
           
            ?>

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
                AVAILABLE STOCKS
                </h1>
            </section>
           
            <!-- SELECT2 EXAMPLE -->
            <div class="boxx"><br>
                <!-- /.box-header -->
                
                <!-- /.row -->
           
           
                <div class="box-body">
                <div class="box-body1">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr no</th>
                                <th>Item name</th>
                                <th>Remaining Qty</th>
                                <th>Item unit</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Purchased date</th>
                            </tr>
                        </thead>
                       <tbody>
                            <?php
                                require_once("dbcon.php");
                                    $sql = "SELECT * FROM store_room";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) 
                                    {
                                        while($row = mysqli_fetch_assoc($result)) 
										{
											$item_name = $row['item_name'];
											// $m_qty = $row['mqty'];
                                            $sql1 = "SELECT * FROM `store_room_finish` WHERE fid=(SELECT max(fid) FROM `store_room_finish` WHERE `item_name_finish`='$item_name')";
											$result1 = mysqli_query($conn, $sql1);
											if (mysqli_num_rows($result1) > 0) 
                                            {
												while($row1= mysqli_fetch_assoc($result1))
                                                {
													$r_qty = $row1['f_item_rem_qty'];
												}
											}
									        ?>
                                            </tr>
                                                <td><?php echo $row['store_id']; ?></td>
                                                <td><?php echo $row['item_name']; ?></td>
                                                <td><?php echo $row['item_qty']; ?></td>
                                                <td><?php echo ucfirst($row['item_unit']); ?></td>
                                                <td><?php echo $row['item_rate']; ?></td>
                                                <td><?php echo $row['item_total']; ?></td>
                                                <td><?php echo date("d-M-Y", strtotime( $row['item_pur_date'])); ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                ?>
                       </tbody>
                    </table>
                    </div>
                    <br><br>
                    
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
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
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