<?php require_once("header.php");?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }
        </style>
        <?php 
        include('dbcon.php'); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Purchase Inventary
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" id="addform" action="store_insert.php" method="POST">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Product Name</label>
                                            <div class="col-sm-8">
                                                <select name="pname" id="pid" required class="form-control pname">
                                                    <option value="">Select Products</option>
                                                    <?php 
                                                        $query="SELECT DISTINCT `pname` FROM `products` ORDER BY `pid` ASC";
                                                        $confirm=mysqli_query($conn,$query);
                                                        while($loca=mysqli_fetch_array($confirm))
                                                        {?>
                                                           <option value="<?php echo $loca['pname']; ?>"><?php echo $loca['pname']; ?></option>
                                                    <?php } ?>                                         
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword3" class="col-sm-4 control-label">Item Unit</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="unit">
                                                    <option value="kg">KG</option>
                                                    <option value="litre">Litre</option>
                                                    <option value="box">Box</option>
                                                    <option value="gram">Gram</option>
                                                    <option value="pack">Pack</option>
                                                    <option value="tin">Tin</option>
                                                    <option value="bottle">Bottle</option>
                                                    <option value="bundle">Bundle</option>
                                                    <option value="packet">Packet</option>
                                                    <option value="jar">Jar</option>
                                                    <option value="piece">Piece</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Item Quantity</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" name="qty" min="1" placeholder="Quantity" v-model="qty">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Item Price</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" name="prc" min="1" placeholder="Price" v-model="prc">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Purchased Date</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" name="purdate" placeholder="Purchased Date" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <center>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </center>
                                </div>
                            </form>
                            <div class="box box-default">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body">
                                            <div class="row">
                                                <form class="form-horizontal" method="post" action="store_form.php">
                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail3" class="col-sm-4 control-label">From Date</label>
                                                        <div class="col-sm-8">
                                                            <input type="date" class="form-control pull-right" name="from_date" value="<?php echo date('Y-m-d'); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail3" class="col-sm-4 control-label">To Date</label>
                                                        <div class="col-sm-8">
                                                            <input type="date" class="form-control pull-right" name="to_date" value="<?php echo date('Y-m-d'); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <button type="submit" name="view_report" class="btn btn-info">View</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Stock List</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Item Name</th>
                                    <th>Purchase Qty</th>
                                    <th>Remain</th>
                                    <th>Item Unit</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Purchased Date</th>
                                    <th>Edit/Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    if(!isset($_POST['view_report']))
                                    {
                                        $qry="select * from store_room";
                                        $exc=mysqli_query($conn,$qry);
                                        while ($row=mysqli_fetch_array($exc)) 
                                        {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['store_id']; ?></td>
                                                    <td><?php echo $row['item_name']; ?></td>
                                                    <td><?php echo $row['item_qty']; ?></td>
                                                    <td><?php echo $row['remain']; ?></td>
                                                    <!-- <td><?php echo $row['item_qty']; ?></td> -->
                                                    <td><?php echo $row['item_unit']; ?></td>
                                                    <td><?php echo $row['item_rate']; ?></td>
                                                    <td><?php echo $row['item_total']; ?></td>
                                                    <td><?php echo date("d-M-Y", strtotime( $row['item_pur_date'])); ?></td>
                                                    <td>
                                                        <button v-on:click="editItem($event)" class="btn btn-primary btn-sm edit1" data-toggle="modal" data-target="#myModal">
                                                        Update</button>
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                    }else
                                    {
                                        $start=$_POST['from_date'];
                                        $end=$_POST['to_date'];
                                        $qry="SELECT * FROM `store_room` WHERE `item_pur_date` BETWEEN '$start' AND '$end'";
                                        $exc=mysqli_query($conn,$qry);
                                        while ($row=mysqli_fetch_array($exc)) 
                                        {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['store_id']; ?></td>
                                                    <td><?php echo $row['item_name']; ?></td>
                                                    <td><?php echo $row['item_qty']; ?></td>
                                                    <td><?php echo $row['remain']; ?></td>
                                                    <!-- <td><?php echo $row['item_qty']; ?></td> -->
                                                    <td><?php echo $row['item_unit']; ?></td>
                                                    <td><?php echo $row['item_rate']; ?></td>
                                                    <td><?php echo $row['item_total']; ?></td>
                                                    <td><?php echo date("d-M-Y", strtotime( $row['item_pur_date'])); ?></td>
                                                    <td>
                                                    <button v-on:click="editItem($event)" class="btn btn-primary btn-sm edit1" data-toggle="modal" data-target="#myModal">
                                                        Update</button>
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Edit</h4>
                                </div>
                                <form class="form-horizontal edit" method="post" action="store_edit.php" id="editform">
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <div class="box-body">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail3" class="col-md-4 control-label">Sl No</label>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" placeholder="Sl No" name="slno" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Item Name</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="itmnam" placeholder="Item Name" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Remain Quantity</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="itmqty" placeholder="Item Qty" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Item Unit</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="itmunit" placeholder="Item Name" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Change Quantity</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="removed" id="removed" placeholder="Item Qty" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail3"
                                                        class="col-sm-4 control-label">Change Price</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" step="0.01" class="form-control" name="itmprc" placeholder="Price" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </section>
            <script src="js/purchase_item.js"></script>

            <script src="cdn/dataTables.buttons.min.js"></script>
            <script src="cdn/buttons.print.min.js"></script>
            
            <script>
                $(function () {
                    $("#example1").DataTable({
                        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                        "lengthMenu": [
                            [25, 10, 100, -1],
                            [25, 10, 100, "All"]
                        ],
                        order: [
                            [6, "desc"]
                        ]
                    });
                });
            </script>

<script>
    var app = new Vue({
        el: '#form1',
        data: {
            slno: 0,
            rows: {},
            itmnam: '',
            qty: 1,
            prc: '',
            shnam: '',
            attemptSubmit: false
        },
        computed: {
            missingItmnam: function() {
                return this.itmnam === '';
            },
            missingQty: function() {
                return this.qty === '';
            },
            missingPrc: function() {
                return this.prc === '';
            },
            missingShnam: function() {
                return this.shnam === '';
            },
        },
        methods: {
            validateForm: function(event) {
                this.attemptSubmit = true;
                if (this.missingItmnam || this.missingQty || this.missingPrc || this.missingShnam) {
                    event.preventDefault();
                } else {
                    event.preventDefault();
                    let formData = new FormData(document.getElementById("addform"));



                    this.$http.post('item_insert.php', formData, {
                        emulateJSON: true
                    }).then(function(data) {
                        alert("added");
                        $("#addform").trigger("reset");
                        location.reload();
                    });
                }
            },
            addItem: function(e) {
                e.preventDefault;
                let formData = new FormData(document.getElementById("addform"));



                this.$http.post('item_insert.php', formData, {
                    emulateJSON: true
                }).then(function(data) {
                    alert("added");
                    $("#addform").trigger("reset");
                    location.reload();
                });
            },
            tableData: function() {
                this.$http.post('item_table.php', formData, {
                    emulateJSON: true
                }).then(function(data) {
                    $("#addform").trigger("reset");
                    this.slno++;
                });
            },
            editItem: function(e) 
            {
                var tar = e.currentTarget;
                var chil = tar.parentElement.parentElement.children;
                var form = $("#editform input");

                form[0].value = (chil[0].innerHTML);
                form[1].value = (chil[1].innerHTML);
                form[2].value = (chil[3].innerHTML);
                form[3].value = (chil[4].innerHTML);
                form[4].value = (chil[3].innerHTML);
                form[5].value = (chil[5].innerHTML);
                // $("#d_date").val(chil[7].innerHTML);
                // form[6].value = ();

            }
        },
      
    });
    </script>
        </div>
    </div>
</body>

</html>