<?php require_once("header.php"); ?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">

        
    <style>
        thead{
            background-color:rgba(21, 22, 23, 0.06);
        }
        th, td{
            text-align:center;
        }
        .box-body1{
            overflow-x:scroll;
        }
        .form-horizontal .form-group{
            margin:0 0 15px 0;
        }
    </style>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <h4>KOT Cancelled</h4>
                <!-- Table -->
                <div class="box" >
                    <!-- /.box-header -->
                    <!-- <div class="row">
                        <div class="col-md-12">
                            form start
                            <form class="form-horizontal" method="post" action="" id="">
                                <div class="box-body"><br>
                                    <div class="row ">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Bill No</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control pull-right" name="billno">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <button type="submit" class="btn btn-success col-md-12">View</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        /.row
                    </div> -->
                    <div id="prt">
                <div class="box-body">
                <div class="box-body1">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>KOT No</th>
                                <th>Item Name</th>
                                <th>Item No</th>
                                <th>Date</th>
                                <th>Table No</th>
                            </tr>
                        </thead>
                       <tbody id="tb">
                            <?php
                                require_once("dbcon.php");
                                $sn=0;
                                $sql = "SELECT * FROM `kot_cancel` ORDER BY `id`;";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) 
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['kot_num']; ?></td>
                                        <td><?php echo $row['itmnam']; ?></td>
                                        <td><?php echo $row['itmno']; ?></td>
                                        <td><?php echo date("d-M-Y", strtotime( $row['date'])); ?></td>
                                        <td><?php echo $row['tabno']; ?></td>
                                    </tr>
                                    <?php
                                } 
                                ?>
                       </tbody>
                    </table>
                </div>
                </div>
            </div>
                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php require_once("footer.php"); ?>

        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

    <script>
    $(function() {
        $("#example1").DataTable({
            "lengthMenu": [
                [25, 10, 100, -1],
                [25, 10, 100, "All"]
            ]
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
    </script>
    <script>
        $(document).ready(function() 
        {
            // $("#example1 tbody").on('dblclick', 'tr', function() 
            // {
            //     var currow = $(this).closest('tr');
            //     var item_id = currow.find('td:eq(0)').html();
            //     console.log(item_id);
            //     window.location.href = 'bill_copy.php?bill_no='+item_id;
            // });
            
        });

        $("#tb tr").hover(function() {
            $(this).css('background-color', 'yellow');
        }, function() {
            $(this).css('background-color', 'white');
        });
    </script>
</body>

</html>