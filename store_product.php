<?php require_once("header.php"); ?>
<script src="js/kitchen_int.js"></script>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error{color: red;}
            .shourtcuts{
            display:flex;
            margin-bottom:10px;
            }
            .shourtcuts > p{
                margin:0 20px;
                text-align:center;
                font-size:11px;
            }
            .table>thead
            {
                background-color:grey;
                color:white;
            }
            .table{
                border-collapse: collapse;
            }
            .table th,
            .table td
            {
                border: 1px solid black;
                padding: 5px;
            }
        </style>
        <div class="content-wrapper">
            <section class="content-header">
                <h3>
                    Stock Products
                </h3>
                <div class="row">
                <div class="col-md-12">
                    <div class="shourtcuts">
                        <p>Move Feild(Tab)</p>
                        <p>Back Feild(ALT+Tab)</p>
                        <p>Submit(Double Enter)</p>
                        <p>Refresh (ALT+z)</p>
                    </div>
                </div>
            </div>
            </section>
            <section class="content">
                <div id="app">
                    <div class="box box-default">
                        <!-- <div class="row"> -->
                            <div class="box-body">
                                <div id="app">
                                    <div class="row">
                                    <div class="col-md-2">
                                        <label for="inputPassword3" class="control-label">Select Type</label>
                                        <select class="form-control" id="catType" name="catType" placeholder="category Type" required v-model="catTypeName" @change="catTypeChange">
                                            <option value="">Select</option>
                                            <option v-for="category in categoysType" :value="category.catType">{{ category.catType }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputPassword3" class="control-label">Select Category</label>
                                        <select class="form-control" id="cat12" name="cat" placeholder="category" required v-model="catName" @change="CategoryChange">
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
                                            <!-- <option value="Gram">Gram</option> -->
                                            <option value="Pack">Pack</option>
                                            <option value="Tin">Tin</option>
                                            <option value="Bottle">Bottle</option>
                                            <!-- <option value="Bundle">Bundle</option> -->
                                            <option value="Packet">Packet</option>
                                            <!-- <option value="Jar">Jar</option> -->
                                            <option value="Piece">Piece</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputPassword3" class="control-label">Sell Unit</label>
                                        <select class="form-control" name="sellUnit" v-model="sellUnit" placeholder="Select Unit" id="sellUnit">
                                            <option value="KG">KG</option>
                                            <option value="Litre">Litre</option>
                                            <option value="Box">Box</option>
                                            <!-- <option value="Gram">Gram</option> -->
                                            <option value="Pack">Pack</option>
                                            <option value="Tin">Tin</option>
                                            <option value="Bottle">Bottle</option>
                                            <!-- <option value="Bundle">Bundle</option> -->
                                            <option value="Packet">Packet</option>
                                            <!-- <option value="Jar">Jar</option> -->
                                            <option value="Piece">Piece</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="inputPassword3" class="control-label">Tax</label>
                                        <input type="number" placeholder="Tax"  name="tax" id="tax" class="form-control" required="required" autocomplete="off" v-model="tax"/>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="inputPassword3" class="control-label">Cess</label>
                                        <input type="number" placeholder="cess"  name="cess" id="cess" class="form-control" required="required" autocomplete="off" v-model="cess"/>
                                    </div>
                                    </div></br>
                                    <div class="row" style="display:none;" id="bevcat">
                                        <div class="col-md-2">
                                            <label for="inputPassword3" class="control-label">Item Code</label>
                                            <input type="number" class="form-control" name="itm_code" id="itm_code" onInput="checku()" v-model="itmnam" autocomplete="off">
                                            <label id="checku"></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="inputEmail3" class="control-label">Price</label>
                                            <input type="number" class="form-control" name="prc" id="prc" min="1"  v-model="prc">
                                        </div>  
                                        <div class="col-md-2">
                                            <label for="inputEmail3" class="control-label">AC Price</label>
                                            <input type="number" class="form-control" name="prc1" id="prc1" min="1"  v-model="prc1">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div style="display:flex;">
                                                <button type="button" class="btn btn-sm btn-info" style="margin-top:27px; margin-right:10px;" @click="catemodal">Creat New Category</button>
                                                <button class="btn btn-info" @click="insertProduct" style="margin-top:27px;">Submit</button>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-1">
                                            <button class="btn btn-info" @click="insertProduct" style="margin-top:27px;">Submit</button>
                                        </div> -->
                                    </div>
                                    <!-- Category Module -->
                                    <div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel"><b>Edit Product</b></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="box-body form1">
                                                        <div class="form-group col-md-12">
                                                            <label for="exampleInputFile">Category</label>
                                                            <select class="form-control" id="cat12Edit" name="catEdit" placeholder="category1" required v-model="catName1">
                                                                <!-- <option value="">Select</option> -->
                                                                <!-- <option v-for="category in categoys1" :value="category.CategoryName">{{ category.CategoryName }}</option> -->
                                                                <option v-for="category in categoys1" :value="category.CategoryName.trim()">{{ category.CategoryName.trim() }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="exampleInputFile">Product Name</label>
                                                            <input type="text" class="form-control" id="editproductname" placeholder="product Name" autocomplete="off">
                                                            <input type="hidden" class="form-control" id="editproductId" placeholder="tableno">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="inputPassword3" class="control-label">Tax</label>
                                                            <input type="number" placeholder="Tax"  name="edittax" id="edittax" class="form-control" required="required" autocomplete="off"/>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="inputPassword3" class="control-label">Cess</label>
                                                            <input type="number" placeholder="cess"  name="editcess" id="editcess" class="form-control" required="required" autocomplete="off"/>
                                                            <input type="hidden" placeholder="oldProduct"  name="oldProduct" id="oldProduct" class="form-control" required="required" autocomplete="off"/>
                                                        </div>
                                                        <!-- <div class="form-group col-md-12">
                                                            <label for="inputPassword3" class="control-label">Change Category</label>
                                                            <select class="form-control" id="editcat" name="editcat" placeholder="Type Here" required>
                                                                <?php
                                                                    include("dbcon.php");
                                                                    $query="SELECT * FROM `categoroy` ORDER BY `id` ASC";
                                                                    $exc=mysqli_query($conn,$query);
                                                                    while($row=mysqli_fetch_assoc($exc))
                                                                    {
                                                                        $name=$row['CategoryName'];
                                                                        // echo '<option>'.$name.'</option>';
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div> -->
                                                        <!-- <div class="form-group col-md-12">
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
                                                        </div> -->
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
                        <!-- </div> -->
                        </br>
                        <!-- <div id="app1"> -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <table id="dynamic-table" class="table">
                                        <thead>
                                            <tr>                                                        
                                                <th>Product ID</th>
                                                <th>Type</th>
                                                <th>Product Name</th>                                                    
                                                <th>Product Category</th>                                                 
                                                <th>Unit</th>                                                 
                                                <th>Sell Unit</th>                                                 
                                                <th>Tax</th>                                                 
                                                <th>Cess</th>                                                 
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sql = "SELECT `products`.*,`categoroy`.`catType` FROM `products`,`categoroy` WHERE `products`.`category`=`categoroy`.`CategoryName`";
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
                                                            <td><?php echo $row['catType']; ?></td>
                                                            <td><?php echo $row['pname']; ?></td>
                                                            <td><?php echo $row['category']; ?></td>
                                                            <td><?php echo $row['unit']; ?></td>
                                                            <td><?php echo $row['sellunit']; ?></td>
                                                            <td class="right-align"><?php echo number_format($row['tax'],2); ?></td>
                                                            <td class="right-align"><?php echo number_format($row['cess'],2); ?></td>
                                                            <td><button @click='editItem($event)' class="btn btn-primary btn-sm">
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
                                                        <option>Material</option>
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
                </div>
                </div>
            </section>
            <script>
                $(document).ready(function()
                {
                    const product_create= new Product();
                    $(document).on("keydown", function (e) 
                    {
                        if (e.altKey && (e.key === "z" || e.keyCode === 90)) {
                            e.preventDefault();
                            window.location='store_product.php';
                        }
                    });
                });
                function checku()
                {
                    let itemcode=$("#itm_code").val();
                    if (itemcode!=0)
                    {
                        jQuery.ajax({
                            url:'ajax/accnum.php',
                            data:'itm=' +$("#itm_code").val(),
                            type:"POST",
                            success:function(data){
                                $("#checku").html(data);
                            },
                            error:function(){}
                    
                        });
                    }else
                    {
                        $("#checku").html('<span style="color:red">Not Valid</span>');
                        $('#sub').prop('disabled',true);
                    }
                }
                function submit()
                {
                    $("#empty").fadeIn();
                    let productName = $('#editproductname').val();
                    let productId = $('#editproductId').val();
                    let edittax = $('#edittax').val();
                    let editcess = $('#editcess').val();
                    let oldProduct = $('#oldProduct').val();
                    let catego=$('#cat12Edit').val();
                    if (edittax === undefined || edittax === "") {
                        edittax = 0;
                    }
                    if (editcess === undefined || editcess === "") {
                        editcess = 0;
                    }
                    // var catName ='CatName';
                    if (productName != "")
                    {
                        let log= $.ajax({
                            url: 'ajax/store_all.php',
                            type: "POST",
                            data: {
                                catName : catego,
                                product : productName,
                                tax:edittax,
                                cess:editcess,
                                productId:productId,
                                oldProduct:oldProduct,
                                insert:"update",
                            },
                            success: function(status) 
                            {
                                // console.log(status);
                                alert('Updated Successfully');
                                window.location="store_product.php";
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error("AJAX Error: " + textStatus, errorThrown);
                            }
                        });
                        // console.log(log);
                    }else{
                        $('#empty').html(`<span style='color:red'>Empty field..</span>`);
                        $("#empty").fadeOut(1000);
                    }
                }
        </script>
        </div>
    </div>
</body>
</html>