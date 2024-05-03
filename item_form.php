<?php require_once("header.php"); ?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
        .error {
            color: red;
        }
        </style>
        
        <?php require_once("dbcon.php"); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <div class="content-wrapper">
            <section class="content">
                <h2>Menu Master</h2>
                <div class="box box-default">
                    <div class="row">
                        <div class="box-body">
                            <div class="col-md-12">
                                <h4 class="text-center" id="empty1"></h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <form class="form-horizontal" id="addform" action="item_insert.php" method="POST"> -->
                            <div class="box-body">
                                <!-- <div class="col-md-2">
                                    <label for="inputPassword3" class="control-label">category</label>
                                    <select class="form-control" name="cat" id="cat">
                                    </select>
                                    <label id="catsus"></label>
                                </div> -->
                                <div class="col-md-2">
                                    <label for="inputPassword3" class="control-label">Item Code</label>
                                    <input type="number" class="form-control" name="itm_code" id="itm_code" onInput="checku()" v-model="itmnam" autocomplete="off">
                                    <label id="checku"></label>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputPassword3" class="control-label">Menu Name</label>
                                    <input type="text" class="form-control" name="itm" id="itm"  v-model="itmnam" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <label for="inputEmail3" class="control-label">Price</label>
                                    <input type="number" class="form-control" name="prc" id="prc" min="1"  v-model="prc">
                                </div>  
                                <div class="col-md-2">
                                    <label for="inputEmail3" class="control-label">AC Price</label>
                                    <input type="number" class="form-control" name="prc1" id="prc1" min="1"  v-model="prc1">
                                </div>
                                <!-- <input type="hidden" step="0.01" name="qty" id="inputPassword3" placeholder="Quantity" value="1"> -->
                                <!-- have to check-->   
                                <div class="col-md-3">
                                    <button type="submit" onclick="addmenu()" class="btn btn-primary" id="sub" style="margin-top:25px;">Submit</button>
                                    <button class="btn btn-danger" style="margin-top:23px;" onclick="generateTable()">PDF</button>
                                </div>
                            </div>
                        <!-- </form> -->
                    </div>
                    <div class="box-body" id="itemlist" style="margin-top: -15px;">
                        
                    </div>

                    <!-- Edit data Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Edit</h4>
                                    <h4 class="text-center" id="editt"></h4>
                                </div>
                                <form class="form-horizontal" method="post"  id="editform">
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <div class="box-body">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail3" class="col-md-4 control-label">SlNo</label>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" placeholder="Sl No" name="slno" id="sl" readonly>
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group col-md-12">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Category</label>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" id="cat12" name="cat"
                                                            placeholder="category" required>
                                                            <option>Select</option>
                                                            <?php
                                                                // $query="SELECT DISTINCT `category` FROM `item-categories`;";
                                                                // $c=mysqli_query($conn, $query);
                                                                // while($row = mysqli_fetch_array($c))
                                                                {?>
                                                                    <option><?php echo $row['category']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div> -->
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail3" class="col-md-4 control-label">Item Code</label>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" placeholder="itmm Code" name="itmm_code" id="itmm_code" onInput="checku1()">
                                                        <label id="checku1"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Item Name</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="itmnam" id="itmnam" placeholder="Item Name" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">Price</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="prc" id="editprc" placeholder="Price" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">Ac Price</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="prc1" id="editprc1" placeholder="Ac Price" required>
                                                        <input type="hidden" class="form-control" placeholder="Sl No" name="itmm_code1" id="itmm_code1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="editmenu()" id="sub1">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- add category Modal-->
                    <!-- <div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><b>Add Category</b></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="box-body form1">
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputFile">Category</label>
                                            <input type="text" class="form-control" id="cat1" placeholder="Category">
                                            <label id="empty"></label>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" onclick="submit();" id="adduser" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> -->
                </div>
            </section>
        </div>
        <?php require_once("footer.php"); ?>
        <div class="control-sidebar-bg"></div>
    </div>


    <script src="html2pdf.js-master/dist/html2pdf.bundle.min.js"></script>
    <!-- <script src="conn.js"></script> -->
    <script src="js/item_fetch.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>     -->
    <script>
            function generateTable() 
            {
                // var fdate=$('#fdate').val();
                // var tdate=$('#tdate').val();
                var lastColumn = $('#example1 th:last-child, #example1 td:last-child');
                var lastColumnIndex = lastColumn.index() + 1;
                lastColumn.hide();
                var doc = new jsPDF('p', 'pt', 'letter');
                var y = 20;
                doc.setLineWidth(2);
                doc.text(150, y = y + 10, "Menu Master");
                doc.autoTable({
                    html: '#example1',
                    startY: 40,
                    startX: 40,
                    theme: 'grid',
                    // columns: [
                    //     {dataKey: 'slno'},
                    //     {dataKey: 'Item Code'},
                    //     {dataKey: 'Menu Name'},
                    //     {dataKey: 'Discount'},
                    //     {dataKey: 'Price'},
                    //     {dataKey: 'Ac Price'},
                    // ],
                    styles: {
                        overflow: 'linebreak',
                        lineWidth: 1,
                        fontSize: 8,
                        cellPadding: {horizontal: 5, vertical: 2},
                    },
                    headerStyles: {
                        fillColor: [128, 128, 128],
                        textColor: [255, 255, 255],
                        fontSize: 8,
                        lineWidth: 1,
                    },
                    footStyles: {
                        fontSize: 8,
                        fillColor: [128, 128, 128],
                        textColor: [255, 255, 255],
                        lineWidth: 1,
                    },
                    columnStyles: {
                        // Exclude the last column (index starts from 0)
                        5: { // Change '5' to the index of the column you want to exclude
                            visible: false // Set the column to invisible
                        }
                    }
                })
                lastColumn.show();
                // doc.setProperties({
                //     title: 'Product Detailed Report',
                //     subject: 'This is the Product Detailed Report',
                //     author: 'Author Name',
                //     keywords: 'generated, javascript, web 2.0, ajax',
                //     creator: 'Author Name',
                //     margins: {
                //         top: 0,
                //         bottom: 0,
                //         left: 0,
                //         right: 0,
                //     },
                //     pageSize: 'letter',
                // });
                doc.save('menu_master');
            }
        </script>
</body>
</html>