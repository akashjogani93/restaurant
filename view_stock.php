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
                VIEW STOCK REPORT
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
                                            <input type="date" class="form-control pull-right" name="fdate"
                                                value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">To Date</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control pull-right" name="tdate"
                                                value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="submit" name="save" class="btn btn-success col-md-11">View</button>
                                    </div>
                                </form>
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
                                <th>Sr no</th>
                                <th>Product name</th>
                                <th>Sale Quntity</th>
                                <th>Remaining Quantity</th>
                            </tr>
                        </thead>
                       <tbody>
                            <tr>
                                <td>2</td>
                                <td>rice</td>
                                <td>100kg%</td>
                                <td>10kg</td>
                            </tr>
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