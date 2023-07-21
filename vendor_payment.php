<body class="hold-transition skin-blue sidebar-mini">
<?php require_once("header.php"); ?>
    <div class="wrapper" id="form1">
        <style>
            .error{color: red;}
        </style>
       
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Vendor Payment Calculation
                </h1>
            </section>
            <!-- <section class="content"> -->
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
                                            <th>Vendor Name</th>                                                    
                                            <th>Mobile</th>                                                    
                                            <!-- <th>Purchase Date</th> -->
                                            <th>Total Amount</th>
                                            <th>Paid Amount</th>
                                            <th>Remain Amount</th>
                                            <!-- <th>View Item</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            include("dbcon.php");
                                            $sql = "SELECT * FROM vendor";
                                            $retval = mysqli_query($conn,$sql);
                                            if(! $retval )
                                            {
                                                die('Could not get data: ' . mysqli_error($conn));
                                            }
                                            while($row = mysqli_fetch_assoc($retval))
                                            { 
                                                ?>
                                                    <tr>                                                    
                                                        <td><?php echo $row['slno']; ?></td>                                                   
                                                        <td><?php echo $row['vendor']; ?></td>
                                                        <td><?php echo $row['mobile']; ?></td>
                                                        <td><?php echo $row['totalamt']; ?></td>
                                                        <td><?php echo $row['paid']; ?></td>
                                                        <td><?php echo $row['totalamt']-$row['paid']; ?></td>
                                                        <!-- <td><button  class="btn btn-primary btn-sm" data-toggle="modal" id="view-pro">
                                                                View Products
                                                            </button>
                                                        </td> -->
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                </div>
                                <div id="product-table" style="display: none;">
                                    <div id="product-table-content"></div>
                                    <center><button class="btn btn-primary" id="refresh-btn">Refresh</button></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <section>
            <!-- <section class="content" id="product-table" style="display: none;">
                <div id="product-table-content"></div>
                <button class="btn btn-primary" v-on:click="refreshTable">Refresh</button>
            </section> -->
            <script>
                $(function () {
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
                    $('#dynamic-table').on('click', '#view-pro', function() {
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
                // var app = new Vue({
                //     el: '#form1',
                //     data: {
                //         showProductTable: false
                //     },
                //     methods: {
                //         view_product: function(e, id) {
                //             var tar = e.currentTarget;
                //             var chil = tar.parentElement.parentElement.children;

                //             this.showProductTable = true;

                //             // Make an AJAX call to fetch the products for the clicked row's ID
                //             $.ajax({
                //                 type: "POST",
                //                 url: "ajax/fetch_productsRecords.php",
                //                 data: { id: id },
                //                 success: function(response) {
                //                     // Display the products in a table
                //                     $("#product-table-content").html(response);
                //                 },
                //                 error: function(xhr, status, error) {
                //                     console.log(error);
                //                 }
                //             });
                //         },
                //         refreshTable: function() {
                //             this.showProductTable =false;
                //         }
                //     }
                // });
        </script>
        </div>
    </div>
</body>
</html>