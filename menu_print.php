
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
                          MENU REPORT 
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
                                        <th>Sl No</th>
                                        <!-- <th>Category</th> -->
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>AC Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        require_once("dbcon.php");
                                        $sql = "SELECT * FROM item";
                                        $result = mysqli_query($conn, $sql);
                                            // $result2= mysqli_query($conn, $sql2);
                                            //$res= mysqli_fetch_assoc($result2);
                                        if (mysqli_num_rows($result) > 0) 
                                        {
                                            // output data of each row
                                            $i=0;
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i+1; ?></td>
                                                    <!-- <td><?php echo $row['slno']; ?></td> -->
                                                    <!-- <td><?php echo $row['item_cat']; ?></td> -->
                                                    <td><?php echo $row['itmnam']; ?></td>
                                                    <td><?php echo $row['prc']; ?></td>
                                                    <td><?php echo $row['prc2']; ?></td>
                                                </tr>
                                    <?php   
                                                $i++; 
                                            }
                                    }
                                    ?>
                                   
                                    
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
