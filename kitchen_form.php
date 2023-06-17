<?php 
    $update="true";
?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
        .error {
            color: red;
        }
        </style>
        <?php require_once("header.php"); 
        include("dbcon.php"); ?>
        <div class="content-wrapper">
            <?php 
                $name=$qty=$rqty=$unit=$fid="";
                if(isset($_GET['del']))
                {
                    $update="false";
                    $fid=$_GET['del'];
                    $query1="SELECT * FROM `store_room_finish` WHERE `fid`='$fid'";
                    $exc=mysqli_query($conn,$query1);
                    while ($row=mysqli_fetch_array($exc)) 
                    {
                        $name=$row['item_name_finish'];
                        $qty=$row['f_item_finish_qty'];
                        $rqty=$row['f_item_rem_qty'];
                        $unit=$row['f_item_unit'];
                    }

                }
            ?>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" id="addform" action="kitchen_insert.php" method="POST">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Product Name</label>
                                            <div class="col-sm-8">
                                                <select name="itmid" id="sid" required class="form-control pname" onblur="validate1();">
                                                    <option value="">Select Products</option>
                                                    <?php 
                                                        $query="SELECT DISTINCT `item_name` FROM `store_room` ORDER BY `store_id` ASC";
                                                        $confirm=mysqli_query($conn,$query);
                                                        while($loca=mysqli_fetch_array($confirm))
                                                        {?>
                                                           <option value="<?php echo $loca['item_name']; ?>"><?php echo $loca['item_name']; ?></option>
                                                    <?php } ?>                                         
                                                </select>
                                                <input type="hidden" name="fid" id="fid" value="<?php echo $fid; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword3" class="col-sm-4 control-label">Item Unit</label>
                                            <div class="col-sm-8">
                                                <input type="hidden" class="form-control" name="itmname" id="itmname">
                                                <input type="text" class="form-control" name="itmunit" id="itmunit" readonly="readonly" placeholder="Quantity" value="<?php echo $unit; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Remaining Quantity</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" name="remqty" id="itmqty" placeholder="Quantity" readonly  value="<?php echo $rqty; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Item Quantity</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" name="itmqty" placeholder="Quantity" id="itmqty1" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Given Date</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" name="gvndate" placeholder="Purchased Date" value="<?php echo date('Y-m-d'); ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <center>
                                        <?php if($update=="true")
                                        {
                                                ?>
                                                    <button type="submit" id="myButton" name="submit" class="btn btn-primary">Submit</button>
                                                <?php
                                        }else
                                        {
                                            ?>
                                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                                            <?php
                                        }
                                        ?>
                                    </center>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="row">
                                    <form class="form-horizontal" method="post" action="kitchen_form.php">
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
                                            <button type="submit" name="view" class="btn btn-info">View</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Kitchen Stock List</h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sl No</th>
                                                <th>Item Name</th>
                                                <th>Finished Qty</th>
                                                <th>Remaining Qty</th>
                                                <th>Item Unit</th>
                                                <th>Given Date</th>
                                                <!-- <th>Edit</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if(!isset($_POST['view']))
                                                {
                                                    $query1="SELECT `store_room_finish`.*,`store_room`.`remain` FROM `store_room_finish`,`store_room` WHERE `store_room_finish`.`item_name_finish`=`store_room`.`item_name`";
                                                    $exc=mysqli_query($conn,$query1);
                                                    while ($row=mysqli_fetch_array($exc)) 
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row['fid']; ?></td>
                                                            <td><?php echo $row['item_name_finish']; ?></td>
                                                            <td><?php echo $row['f_item_finish_qty']; ?></td>
                                                            <td><?php echo $row['remain']; ?></td>
                                                            <td><?php echo ucfirst($row['f_item_unit']); ?></td>
                                                            <td><?php echo date("d-M-Y", strtotime( $row['given_date'])); ?></td>
                                                            <!-- <td>
                                                                <button v-on:click="editItem($event)" class="btn btn-primary btn-sm edit1"
                                                                    data-toggle="modal" data-target="#myModal">Edit</button>
                                                            </td> -->
                                                        </tr>
                                                        <?php
                                                    }
                                                }else
                                                {
                                                    $start=$_POST['from_date'];
                                                    $end=$_POST['to_date'];
                                                    $query1="SELECT `store_room_finish`.*,`store_room`.`remain` FROM `store_room_finish`,`store_room` WHERE `store_room_finish`.`item_name_finish`=`store_room`.`item_name` AND `store_room_finish`.`given_date` BETWEEN '$start' AND '$end'";
                                                    $exc=mysqli_query($conn,$query1);
                                                    while ($row=mysqli_fetch_array($exc)) 
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row['fid']; ?></td>
                                                            <td><?php echo $row['item_name_finish']; ?></td>
                                                            <td><?php echo $row['f_item_finish_qty']; ?></td>
                                                            <td><?php echo $row['remain']; ?></td>
                                                            <td><?php echo ucfirst($row['f_item_unit']); ?></td>
                                                            <td><?php echo date("d-M-Y", strtotime( $row['given_date'])); ?></td>
                                                            <!-- <td>
                                                                <button v-on:click="editItem($event)" class="btn btn-primary btn-sm edit1"
                                                                    data-toggle="modal" data-target="#myModal">Edit</button>
                                                            </td> -->
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Edit</h4>
                                </div>
                                <form class="form-horizontal edit" method="post" action="kitchen_edit.php" id="editform">
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
                                                        <input type="text" class="form-control" name="itmname" id="itmname" placeholder="Item Name" required readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Item Unit</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="itmunit" placeholder="Item Name" required readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">Total QTY</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" readonly="readonly" class="form-control" name="totalqty" placeholder="Remaining" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">Item Remaining QTY</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" readonly="readonly" class="form-control" name="itm_rem" placeholder="Remaining" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Kitchen Quantity</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="itmqty" placeholder="Item Name" required>
                                                        <input type="text" class="form-control" name="oldrem" placeholder="Item Name">
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
                    </div>
                </div>
            </section>
            <script src="cdn/dataTables.buttons.min.js"></script>
            <script src="cdn/buttons.print.min.js"></script>
            
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
                        ],
                        order: [
                            [6, "desc"]
                        ]

                    });
                });
            </script>
            <script>
                function validate1()
                {
                    var lid = document.getElementById('sid').value;
                    $.ajax({
                        type: "GET",
                        data: {
                            id: lid
                        },
                        url: "ajax/get.php",
                        success: function(data) {
                        var obj = JSON.parse(data);
                        console.log(obj);
                        document.getElementById('itmunit').value = obj[0].item_unit;
                        document.getElementById('itmqty').value = obj[0].remain;
                        document.getElementById('itmname').value = obj[0].item_name;
                        }
                    });
                }
            </script>

        <script>
            $(".edit1").click(function() 
            {
                var child = $(this).closest('tr');
                var form = $("#editform input");
                console.log(child);
                form[0].value = (child.children()[0].innerHTML);
                form[1].value = (child.children()[1].innerHTML);
                form[2].value = (child.children()[4].innerHTML);
                form[3].value = (child.children()[3].innerHTML);
                form[4].value = (child.children()[3].innerHTML);
                form[5].value = (child.children()[2].innerHTML);
                form[6].value = (child.children()[2].innerHTML);
            });

            $("#itmqty1").keyup(function()
            {
                // $('#myButton').prop('disabled', true);
                var itmqty1 = parseFloat($("#itmqty1").val());
                var sid = $("#sid").val();
                var itmqty = parseFloat($("#itmqty").val());
                if(itmqty1 > itmqty)
                {
                    $('#myButton').prop('disabled', true);
                    
                }else if(sid=="")
                {
                    $('#myButton').prop('disabled', true);
                    $("#itmqty1").val(" ")
                }else
                {
                    $('#myButton').prop('disabled', false);
                }
            });
        </script>
        </div>
    </div>
</body>
</html>
