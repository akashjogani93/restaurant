<?php require_once("header.php"); ?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error{color: red;}
        </style>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Stock Inventory
                </h1>
            </section>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="box-body">
                            <div id="app">
                                <!-- <form class="form-horizontal" role="form" action="add_table.php" method="post"> -->
                                    <div class="col-md-2">
                                        <label for="inputPassword3" class="control-label">Select Category</label>
                                        <select class="form-control" id="cat12" name="cat" placeholder="category" required v-model="catName">
                                            <option value="">Select</option>
                                            <option v-for="category in categoys" :value="category.CategoryName">{{ category.CategoryName }}</option>
                                        </select>
                                        <!-- <input type="text" id="form-field-1"  placeholder="Name of Product"  name="p1" class="form-control" required="required" autocomplete="off"/> -->
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputPassword3" class="control-label">Name of Product</label>
                                        <input type="text" id="form-field-1"  placeholder="Name of Product"  name="p1" class="form-control" required="required" autocomplete="off" v-model="product"/>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputPassword3" class="control-label">Item Unit</label>
                                        <select class="form-control" name="unit" v-model="unit" placeholder="Select Unit" id="unit">
                                            <!-- <option value="">Select Unit</option> -->
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
                                    <div class="col-md-2">
                                        <label for="inputPassword3" class="control-label">Tax Of Product</label>
                                        <input type="number" id="form-field-1"  placeholder="Tax of Product"  name="tax" id="tax" class="form-control" required="required" autocomplete="off" v-model="tax"/>
                                    </div>
                                    <div class="col-md-1">
                                            <button class="btn btn-info" @click="insertProduct" style="margin-top:27px;">
                                                Submit
                                            </button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-sm btn-info" style="width:100%; margin-top:27px;" @click="catemodal">Creat New Category</button>
                                    </div>
                                <!-- </form> -->

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
                                                            <!-- <option value="">Select</option> -->
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
                                                    <div class="form-group col-md-12">
                                                        <label for="inputPassword3" class="control-label">Tax Of Product</label>
                                                        <input type="number" placeholder="Tax of Product"  name="tax1" id="tax1" class="form-control" required="required" autocomplete="off">
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
                    </div></br>
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>                                                        
                                            <th>Product ID</th>
                                            <th>Product Name</th>                                                    
                                            <th>Product Category</th>                                                 
                                            <th>Unit</th>                                                 
                                            <th>Tax</th>                                                 
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            
                                            $sql = "SELECT * FROM products";
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

                        <!-- add category Modal-->
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
                                                <label for="exampleInputFile">Category</label>
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
            <section>
            <script>
                $('#tax').keypress(function(event)
                {
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    if ((keycode < 47 || keycode > 57))
                    {
                        return false;
                    }else
                    {
                        return true;
                    }
                });
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

                function submit() 
                {
                    $("#empty").fadeIn();
                    let productName = $('#tno').val();
                    let productId = $('#tid').val();
                    let editcat = $('#editcat').val();
                    let unitchange = $('#unitchange').val();
                    let tax1 = $('#tax1').val();
                    if (productName != "" && productId != "" && editcat !='' && unitchange != "" && tax1 !='')
                    {
                        // $.ajax({
                        //     url: 'ajax/create_p.php',
                        //     type: "POST",
                        //     data: {
                        //         tedit : cat,tid: tid
                        //     },
                        //     success: function(data) 
                        //     {
                        //         alert(data);
                        //         window.location.href="add_prodct1.php";
                        //     }
                        // });
                        let log=$.ajax({
                            url: 'ajax/fetch_options.php',
                            type: "POST",
                            data: {
                                catName : editcat,
                                product : productName,
                                unit : unitchange,
                                productId: productId,
                                tax: tax1,
                                insert:"Update",
                            },
                            success: function(data) 
                            {
                                if(data==1)
                                {
                                    alert("Product Already Added");
                                }else if(data==2)
                                {
                                    alert("You Have Stock On Using This Name And Unit");
                                }else if(data==0)
                                {
                                    alert("Product Added");
                                    window.location.href="add_prodct1.php";
                                }
                                console.log(data)
                            }
                        });
                        console.log(log)
                    }else{
                        $('#empty').html(`<span style='color:red'>Empty field..</span>`);
                        $("#empty").fadeOut(1000);
                    }
                }

                var app = new Vue({
                    el: '#dynamic-table',
                    methods: {
                        editItem : function(e) 
                        {
                            var tar = e.currentTarget;
                            var chil = tar.parentElement.parentElement.children;
                            var form = $("#category input");
                            console.log(form);
                            form[0].value = (chil[1].innerHTML);
                            form[1].value = (chil[0].innerHTML);
                            form[2].value = (chil[4].innerHTML);
                            var cat=chil[2].innerHTML;
                            $('#editcat').val(cat);
                            $('#unitchange').val(chil[3].innerHTML);
                        }
                    }
                });

                var app1 = new Vue({
                    el:'#app',
                    data:{
                        stockList: [],
                        categoys:[],
                        catName:'',
                        product:'',
                        unit:'',
                        tax:null,
                    },
                    mounted() {
                        this.fetchOptions();
                    },
                    methods:{
                        fetchOptions()
                        {
                            const vm = this;
                            $.ajax({
                                url: 'ajax/fetch_options.php',
                                method: 'POST',
                                data:{cat:'cat'},
                                success(response) 
                                {
                                    vm.categoys = response;
                                },
                                error(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        },
                        catemodal()
                        {
                            $('#Addcategory').modal('show');
                        },
                        cateAdd()
                        {
                            var cat = $("#cat1").val().trim();
                            var pattern = /^[a-zA-Z\s]*$/;
                            if(cat!='' && pattern.test(cat))
                            {
                                $.ajax({
                                    url: 'ajax/fetch_options.php',
                                    type: "POST",
                                    data: {
                                        addcat : cat
                                    },
                                    success: function(data) 
                                    {
                                        alert(data);
                                        window.location.href="add_prodct1.php";
                                    }
                                });
                            }else
                            {
                                $('#catempty').html(`<span style='color:red'>Not Valid..</span>`);
                                $("#catempty").fadeOut(1000);
                            }
                        },
                        insertProduct()
                        {
                            catName=this.catName;
                            product=this.product;
                            unit=this.unit;
                            tax=this.tax;
                            var pattern = /^[a-zA-Z\s]*$/;
                            if(catName!='' && product!='' && unit!='')
                            {
                                $.ajax({
                                    url: 'ajax/fetch_options.php',
                                    type: "POST",
                                    data: {
                                        catName : catName,
                                        product : product,
                                        unit : unit,
                                        tax : tax,
                                        insert:"Insert",
                                    },
                                    success: function(data) 
                                    {
                                        if(data==1)
                                        {
                                            alert("Product Already Added");
                                        }else
                                        {
                                            alert("Product Added");
                                            window.location.href="add_prodct1.php";
                                        }
                                    }
                                });

                            }else
                            {
                                if(!catName) 
                                {
                                    $('#cat12').css('border-color', 'red');
                                }

                                if(!product) 
                                {
                                    $('input[name="p1"]').css('border-color', 'red');
                                }else
                                {
                                    $('input[name="p1"]').css('border-color', 'red');
                                }
                                if (!unit) 
                                {
                                    $('#unit').css('border-color', 'red');
                                }

                                setTimeout(function() 
                                {
                                    $('#cat12').css('border-color', '');
                                    $('input[name="p1"]').css('border-color', '');
                                    $('input[name="unit"]').css('border-color', '');
                                }, 5000);
                            }
                        }
                    }
                });

                $('#addcate').on('click', function() 
                {
                    app1.cateAdd();
                });
        </script>
        </div>
    </div>
</body>
</html>