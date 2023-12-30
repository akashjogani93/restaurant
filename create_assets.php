<?php require_once("header.php"); ?>
<?php require_once("dbcon.php"); ?>
<script src="js/kitchen_int.js"></script>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error{color: red;}
            .buga{
                margin-right:10px;
            }
            .table>thead
        {
            background-color:grey;
            color:white;
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
                <h1>
                    Assets
                </h1>
            </section>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="box-body">
                            <div class="col-md-9 assets">
                                <a class="btn btn-success buga" href="create_assets.php" style="margin-top:27px;">
                                    Create Asset
                                </a>
                                <a class="btn btn-info buga" href="purchase_assets.php" style="margin-top:27px;">
                                    Purchase
                                </a>
                                <a class="btn btn-info buga" href="stock_assets.php" style="margin-top:27px;">
                                    View Stock
                                </a>
                                <a class="btn btn-info buga" href="damage_assets.php" style="margin-top:27px;">
                                    Damage Stock
                                </a>
                                <a class="btn btn-info buga" href="purchaseRecord_assets.php" style="margin-top:27px;">
                                    Purchase Records
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="app">
                    <div class="row">
                        <div class="box-body">
                            <div class="col-md-2">
                                <label for="inputPassword3" class="control-label">Name of Product</label>
                                <input type="text" id="product"  placeholder="Name of Product"  name="p1" class="form-control" required="required" autocomplete="off"/>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-danger" id="sub" style="margin-top:27px;">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <table id="dynamic-table" class="table">
                                    <thead>
                                        <tr>                                                        
                                            <th>Sl.No</th>
                                            <th>Product Name</th>     
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
                        <div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel1"><b>Edit Product</b></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="box-body form1">
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputFile">Product Name</label>
                                                <input type="text" class="form-control" id="pro" placeholder="Product Name">
                                                <input type="hidden" class="form-control" id="idp" placeholder="Product Name">
                                                <label id="catempty"></label>
                                            </div>
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
            </section>
            <script>
                $(document).ready(function()
                {
                    const product_create= new Assets_Product();

                    var app1 = new Vue({
                    el: '#dynamic-table',
                    methods: {
                        editItem : function(e) 
                        {
                            var tar = e.currentTarget;
                            var chil = tar.parentElement.parentElement.children;
                            var form = $("#category input");
                            form[0].value = (chil[1].innerHTML);
                            form[1].value = (chil[0].innerHTML);
                        }
                    }
                    });
                    
                });

                function submit()
                {
                    $("#empty").fadeIn();
                    var product = $('#pro').val();
                    var idp = $('#idp').val();
                    var check='update';
                    if(product=='')
                    {
                        $('#pro').css('border-color','red');
                        return;
                    }
                    let log=$.ajax({
                        url:'ajax/store_all.php',
                        type:'POST',
                        data:{assetsProduct:product,check:check,idp:idp},
                        success:function(response)
                        {
                            alert(response);
                            if(response=='Product Updated')
                            {
                                $('#category').modal('hide');
                                location.reload();
                            }
                        }
                    });
                    // console.log(log);
                }
            </script>
        </div>
    </div>
</body>
</html>