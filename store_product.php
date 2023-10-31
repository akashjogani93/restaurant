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
                                    <label for="inputPassword3" class="control-label">Select Category</label>
                                    <select class="form-control" id="cat12" name="cat" placeholder="category" required v-model="catName">
                                        <option value="">Select</option>
                                        <option v-for="category in categoys" :value="category.CategoryName">{{ category.CategoryName }}</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputPassword3" class="control-label">Name of Product</label>
                                    <input type="text" id="form-field-1"  placeholder="Name of Product"  name="p1" class="form-control" required="required" autocomplete="off" v-model="product"/>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputPassword3" class="control-label">Purchase Unit</label>
                                    <select class="form-control" name="unit" v-model="unit" placeholder="Select Unit" id="unit">
                                        <option value="KG">KG</option>
                                        <option value="Litre">Litre</option>
                                        <option value="Box">Box</option>
                                        <option value="Gram">Gram</option>
                                        <option value="Pack">Pack</option>
                                        <option value="Tin">Tin</option>
                                        <option value="Bottle">Bottle</option>
                                        <option value="Bundle">Bundle</option>
                                        <option value="Packet">Packet</option>
                                        <option value="Jar">Jar</option>
                                        <option value="Piece">Piece</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputPassword3" class="control-label">Sell Unit</label>
                                    <select class="form-control" name="sellUnit" v-model="sellUnit" placeholder="Select Unit" id="sellUnit">
                                        <option value="KG">KG</option>
                                        <option value="Litre">Litre</option>
                                        <option value="Box">Box</option>
                                        <option value="Gram">Gram</option>
                                        <option value="Pack">Pack</option>
                                        <option value="Tin">Tin</option>
                                        <option value="Bottle">Bottle</option>
                                        <option value="Bundle">Bundle</option>
                                        <option value="Packet">Packet</option>
                                        <option value="Jar">Jar</option>
                                        <option value="Piece">Piece</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                        <label for="inputPassword3" class="control-label">Tax</label>
                                        <input type="number" placeholder="Tax"  name="tax" id="tax" class="form-control" required="required" autocomplete="off" v-model="tax"/>
                                    </div>
                                <div class="col-md-1">
                                    <button class="btn btn-info" @click="insertProduct" style="margin-top:27px;">
                                        Submit
                                    </button>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-sm btn-info" style="margin-top:27px;" @click="catemodal">Creat New Category</button>
                                </div>

                                <!-- Category Module -->
                                <div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
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
                                </div>
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
                                            <th>Product ID</th>
                                            <th>Product Name</th>                                                    
                                            <th>Product Category</th>                                                 
                                            <th>Unit</th>                                                 
                                            <th>Sell Unit</th>                                                 
                                            <th>Tax</th>                                                 
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql = "SELECT * FROM `products`";
                                            $retval = mysqli_query($conn,$sql);
                                            if(! $retval )
                                            {
                                                die('Could not get data: ' . mysqli_error($conn));
                                            }
                                            while($row = mysqli_fetch_assoc($retval))
                                            { 
                                                ?>
                                                    <tr>                                                    
                                                        <td><?php echo $row['pid']; ?></td>                                                   
                                                        <td><?php echo $row['pname']; ?></td>
                                                        <td><?php echo $row['category']; ?></td>
                                                        <td><?php echo $row['unit']; ?></td>
                                                        <td><?php echo $row['sellunit']; ?></td>
                                                        <td><?php echo $row['tax']; ?></td>
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
                    const product_create= new Product();
                });
                // function submit() 
                // {
                //     return;
                //     $("#empty").fadeIn();
                //     let productName = $('#tno').val();
                //     let productId = $('#tid').val();
                //     let editcat = $('#editcat').val();
                //     let unitchange = $('#unitchange').val();
                //     if (productName != "" && productId != "" && editcat !='' && unitchange != "")
                //     {
                //         let log=$.ajax({
                //             url: 'ajax/fetch_options.php',
                //             type: "POST",
                //             data: {
                //                 catName : editcat,
                //                 product : productName,
                //                 unit : unitchange,
                //                 productId: productId,
                //                 insert:"Update",
                //             },
                //             success: function(data) 
                //             {
                //                 if(data==1)
                //                 {
                //                     alert("Product Already Added");
                //                 }else if(data==2)
                //                 {
                //                     alert("You Have Stock On Using This Name And Unit");
                //                 }else if(data==0)
                //                 {
                //                     alert("Product Added");
                //                     window.location.href="add_prodct1.php";
                //                 }
                //             }
                //         });
                //     }else{
                //         $('#empty').html(`<span style='color:red'>Empty field..</span>`);
                //         $("#empty").fadeOut(1000);
                //     }
                // }

                // var app = new Vue({
                //     el: '#dynamic-table',
                //     methods: {
                //         editItem : function(e) 
                //         {
                //             var tar = e.currentTarget;
                //             var chil = tar.parentElement.parentElement.children;
                //             var form = $("#category input");
                //             console.log(form);
                //             form[0].value = (chil[1].innerHTML);
                //             form[1].value = (chil[0].innerHTML);
                //             var cat=chil[2].innerHTML;
                //             $('#editcat').val(cat);
                //             $('#unitchange').val(chil[3].innerHTML);
                //         }
                //     }
                // });
        </script>
        </div>
    </div>
</body>
</html>