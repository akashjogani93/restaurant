<?php require_once("header.php"); ?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error{color: red;}
        </style>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Purchase Records
                </h1>
            </section>
            <section class="content" id="initial-table">
                <div class="box box-default">
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="col-md-12">
                            <div id="product-table1">
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>                                                        
                                            <th>Id</th>
                                            <th>Bill No</th>
                                            <th>Vendor Name</th>                                                    
                                            <th>Purchase Date</th>
                                            <th>Gross Amount</th>
                                            <th>Tax</th>
                                            <th>Total Amount</th>
                                            <th>Paid Amount</th>
                                            <th>Remark</th>
                                            <th>View Item</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            include("dbcon.php");
                                            $sql = "SELECT * FROM purchase_data";
                                            $retval = mysqli_query($conn,$sql);
                                            if(! $retval )
                                            {
                                                die('Could not get data: ' . mysqli_error($conn));
                                            }
                                            while($row = mysqli_fetch_assoc($retval))
                                            { 
                                                ?>
                                                    <tr>                                                    
                                                        <td><?php echo $row['id']; ?></td>                                                   
                                                        <td><?php echo $row['bill']; ?></td>                                            
                                                        <td><?php echo $row['vendor']; ?></td>
                                                        <td><?php echo $row['purchase_date']; ?></td>
                                                        <td><?php echo $row['gamt']; ?></td>
                                                        <td><?php echo $row['tax']; ?></td>
                                                        <td><?php echo $row['totalamt']; ?></td>
                                                        <td><?php echo $row['pamt']; ?></td>
                                                        <td><?php echo $row['remark']; ?></td>
                                                        <td><button  class="btn btn-primary btn-sm" data-toggle="modal" id="view-pro">
                                                                View Products
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                </div>
                                <div id="product-table" style="display: none;">
                                    <div id="product-table-content"></div>
                                    <center><button class="btn btn-primary" id="refresh-btn">Back</button></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <section>
            <script>
                $(function () 
                {
                    $("#dynamic-table").DataTable({
                        columnDefs: [
                            { "orderable": false, "targets": -1 }
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

                $(document).ready(function()
                {
                    $('#dynamic-table').on('click', '#view-pro', function() 
                    {
                        var id = $(this).closest('tr').find('td:first').text();
                        $('#product-table1').hide();
                        // Show the product table
                        $('#product-table').show();
                        $.ajax({
                            type: "POST",
                            url: "ajax/fetch_productsRecords.php",
                            data: { id: id },
                            success: function(response) {
                                // Display the products in the product table content
                                $("#product-table-content").html(response);
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });
                    });
                    // Event handler for "Refresh" button
                    $('#refresh-btn').click(function() {
                    $('#product-table1').show();
                    $('#product-table').hide();
                    });
                });
        </script>
        </div>
    </div>
</body>
</html>