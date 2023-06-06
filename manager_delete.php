<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">

        <?php
            require_once("header.php"); 
            ?>
            <style>
                .form-horizontal .form-group{
                    margin:0 0 15px 0;
                }
                .boxx{
                    background-color:rgba(255, 255, 255, 0.4);
                
                }
                th{
                    background-color:rgba(21, 22, 23, 0.06);
                }
                th,td{
                    text-align:center;
                }
            </style>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                Manager Bill changed
                </h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- form start -->
                <div class="boxx"><br>
                <form class="form-horizontal" method="post" id="addform">
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
                            <div class="form-group col-md-2">
                                <button type="submit" name="save" class="btn btn-info col-md-11" style="background-color:#B29CBE;color:white;">Print</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </form>
                <!-- Table -->
                
                    <!-- /.box-header -->
                    <div id="prt">
                        <div class="box-body" style="overflow-x:scroll;">
                            <table id='example1' class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th>Sl/no</th>
                                        <th>Date</th>
                                        <th>Menu Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>1/2/2023</td>
                                        <td>Masala Papad</td>
                                        <td>2</td>
                                        <td>40</td>
                                        <td>80</td>
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
        <!-- /.content-wrapper -->

        <?php require_once("footer.php"); ?>

        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->


    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>


    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.16/api/sum().js"></script>

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