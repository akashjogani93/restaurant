
<body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper" id="form1">

            <?php
            require_once("header.php"); 
           
            ?>
<style>
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
                    PURCHASE BEVERAGES  
                  </h1>
                </section>
              

                <!-- Main content -->
                <section class="content">
                    <!-- Table -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Item List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div id="prt">
                        <div class="box-body"style="overflow-x:scroll;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Item.no</th>
                                        <th>Item name</th>
                                        <th>Purchase date</th>
                                        <th>Finished date</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Vendor</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                        <td>1412</td>
                                        <td>rice</td>
                                        <td>1-1-2023</td>
                                        <td>10-1-2023</td>
                                        <td>100 kg</td>
                                        <td>1000</td>
                                        <td>big bazar</td>
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
            $(function () {
               /*  $("#example1").DataTable({
                    "lengthMenu": [[25, 10, 100, -1], [25, 10, 100, "All"]],
					
                }); */
				
				
				$("#example1").DataTable({
                    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                    "lengthMenu": [[25, 10, 100, -1], [25, 10, 100, "All"]],
                    buttons: [
								'print'
							]
					
                });
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                });
            });
        </script>
    </body>
</html>
