<?php require_once("header.php"); ?>
<script src="js/kitchen_int.js"></script>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error{color: red;}
        </style>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Stock Products
                </h1>
            </section>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="box-body">
                            <div id="app">
                                <div class="col-md-2">
                                    <label for="inputPassword3" class="control-label">Name of Product</label>
                                    <input type="text" id="product"  placeholder="Name of Product"  name="p1" class="form-control" required="required" autocomplete="off"/>
                                </div>
                                <!-- <div class="col-md-1">
                                    <label for="inputPassword3" class="control-label">Tax</label>
                                    <input type="number" placeholder="Tax"  name="tax" id="tax" class="form-control" required="required" autocomplete="off"/>
                                </div> -->
                                <div class="col-md-1">
                                    <button class="btn btn-info" id="sub" style="margin-top:27px;">
                                        Submit
                                    </button>
                                </div>
                                <!-- Category Module -->
                                <!-- <div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel"><b>Edit Table</b></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="box-body form1">
                                                    <div class="form-group col-md-12">
                                                        <label for="exampleInputFile">Product Name</label>
                                                        <input type="text" class="form-control" id="tno" placeholder="product Name" autocomplete="off">
                                                        <input type="hidden" class="form-control" id="tid" placeholder="tableno">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="inputPassword3" class="control-label">Change Category</label>
                                                        <select class="form-control" id="editcat" name="editcat" placeholder="Type Here" required>
                                                            <?php
                                                                include("dbcon.php");
                                                                $query="SELECT * FROM `categoroy` ORDER BY `id` ASC";
                                                                $exc=mysqli_query($conn,$query);
                                                                while($row=mysqli_fetch_assoc($exc))
                                                                {
                                                                    $name=$row['CategoryName'];
                                                                    echo '<option>'.$name.'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="inputPassword3" class="control-label">Change Unit</label>
                                                        <select class="form-control" id="unitchange" name="unitchange" placeholder="Type Here.." required>
                                                            <option value="">Select</option>
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
                                                    <label id="empty"></label>
                                                </div>
                                                <div class="box-footer">
                                                    <button type="submit" onclick="submit();" id="adduser" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>                                                        
                                            <th>Sl.No</th>
                                            <th>Product Name</th>                                                    
                                            <!-- <th>Tax</th>                                                  -->
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql = "SELECT * FROM `assetsProduct`";
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
                                                        <td><?php echo $row['product']; ?></td>
                                                        <!-- <td><?php echo $row['tax']; ?></td> -->
                                                        <td><button v-on:click="editItem($event)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#category">
                                                            Edit
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Create new Category Module -->
                        <div class="modal fade" id="Addcategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel1"><b>Add Category</b></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="box-body form1">
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputFile">Select Type</label>
                                                <select class="form-control" id="typeCat" name="typeCat" placeholder="Category Type">
                                                    <option value="">Select</option>
                                                    <option>Kitchen</option>
                                                    <option>Bevarages</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputFile">Category Name</label>
                                                <input type="text" class="form-control" id="cat1" placeholder="Category">
                                                <label id="catempty"></label>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button id="addcate" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script>
                $(document).ready(function()
                {
                    const product_create= new Assets_Product();
                });
        </script>
        </div>
    </div>
</body>
</html>