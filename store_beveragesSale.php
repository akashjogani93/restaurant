<?php require_once("header.php");?>
<?php require_once("dbcon.php");?>
<style>
    .error {
        color: red;
    }
    #bevadd{
        background: green;
    }
    .tablebox{
            width: 100%;
            overflow-x: auto;
        }
    .table>thead,tfoot
        {
            background-color:grey;
            color:white;
        }
        .table{
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td 
        {
            border: 1px solid black;
            padding: 5px;
            /* text-align: left; */
            white-space: nowrap;
        }
</style>
<body class="hold-transition skin-blue sidebar-mini">
    <div id="app">
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Beverages Inventory
                </h1>
                </br>
                <?php include('bevbutton.html'); ?>
            </section>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="control-label">Select Category</label>
                                        <select name="catename" id="catename" required class="form-control pname" v-model="categoryOption" @change="categoryChange">
                                            <option value="">Select Category</option>
                                            <option v-for="option in categorys" :value="option.category">{{ option.category }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="control-label">Product Name</label>
                                        <select name="pname" id="pid" required class="form-control pname" v-model="selectedOption" onchange="getProductDetails(this.value)">
                                            <option value="">Select Products</option>
                                            <option v-for="option in options" :value="option.pid">{{ option.pname }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="control-label">Sale Unit</label>
                                        <input type="text" class="form-control" name="sellunit" id="sellunit" readonly="readonly" placeholder="sellunit"> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="control-label">Stock</label>
                                        <input type="text" class="form-control" name="sellqty" id="sellqty" readonly="readonly" placeholder="Quantity">
                                        <input type="hidden" class="form-control" name="perCaseQty" id="perCaseQty" readonly="readonly" placeholder="perCaseQty">
                                        <input type="hidden" class="form-control" name="perCaseQty" id="stockid" readonly="readonly" placeholder="perCaseQty">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="control-label">Sale Qty</label>
                                        <input type="text" class="form-control" name="pqty" id="uqty" placeholder="Beverages Qty">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="control-label">Given Date</label>
                                        <input type="date" class="form-control" name="purdate" id="gdate" placeholder="Purchased Date">
                                    </div>
                                </div>
                                </br>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                    <center>
                        <button type="button" class="btn btn-primary" id="addToList">Add To List</button>
                        <button type="button" class="btn btn-danger" id="updateItem" style="display:none;">Update Item</button>
                        <button type="button" class="btn btn-danger" id="clea">Clear</button>
                    </center>
                    </div>
                </div>
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="row">
                                    <div class="container mt-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Product ID</th>
                                                    <th>Product Name</th>
                                                    <th>Sell Unit</th>
                                                    <th>Total Quantity</th>
                                                    <th>UQty</th>
                                                    <th>Date</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table-body">
                                                <!-- Values will be inserted here dynamically -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <center>
                        <button type="button" class="btn btn-primary" id="submit">Submit</button>
                        <button type="button" class="btn btn-danger" id="clear">Clear</button>
                    </center>
                </div>
            </section>
        </div>
    </div>
    <script src="vue.min.js"></script>
    <script src="js/kitchen_int.js"></script>
    <script src="js/web_tables.js"></script>
    <script src="cdn/dataTables.buttons.min.js"></script>
    <script src="cdn/buttons.print.min.js"></script>
    <script>
        function getProductDetails(pid)
        {
            $("#pid").css("border-color", "");
            let log=$.ajax({
                url: 'ajax/store_all.php',
                method: 'POST',
                datatype:'JSON',
                data: {
                    productKitchenChange: pid
                },
                success(response)
                {
                    $('#sellunit').val(response[0].unit);
                    $('#sellqty').val(response[0].netStock);
                }
            });
        }

        $(document).ready(function()
        {
            const bev = new Beaverages();
            let kitchenData = JSON.parse(localStorage.getItem('beaveragesData')) || [];
            const mainInstance = new Main();
            mainInstance.retrieve(kitchenData,'beaveragesData');

            $('#addToList').click(function()
            {
                mainInstance.addToList(kitchenData,'beaveragesData');
            });

            $('#uqty, #gdate').keydown(function (event) 
            {
                if (event.which === 13) {
                    if ($('#addToList').is(':visible')) 
                    {
                        mainInstance.addToList(kitchenData, 'beaveragesData');
                    } else if ($('#updateItem').is(':visible')) 
                    {
                        mainInstance.updateToList(kitchenData, 'beaveragesData');
                    }
                }
            });

            $('#updateItem').click(function()
            {
                mainInstance.updateToList(kitchenData,'beaveragesData');
            });

            $('#submit').click(function()
            {
                mainInstance.finalSubmit(kitchenData,'beaveragesData','bev','description');
            });
            $('#clear').click(function()
            {
                mainInstance.clear(kitchenData,'beaveragesData');
            });
            $('#clea').click(function()
            {
                mainInstance.inputClear(kitchenData,'materialData');
            });
            var yourDateValue = new Date();
            var formattedDate = yourDateValue.toISOString().substr(0, 10)
            $('#gdate').val(formattedDate);

            $('#uqty').keypress(function(event) 
            {
                var keycode = (event.keyCode ? event.keyCode : event.which);

                if ((keycode < 48 || keycode > 57)) {
                    return false; // Prevent non-numeric characters and allow decimal point
                } else {
                    return true;
                }
            });
            $('#uqty').on('input', function ()
            {
                let totalqty=$('#sellqty').val();
                let inputValue = $(this).val();
                let regex = /^\d*\.?\d*$/;
                switch (true) 
                {
                    case !regex.test(inputValue):
                        $(this).val('');
                        break;
                    // case totalqty && parseFloat(inputValue) > parseFloat(totalqty):
                    //     $(this).val(totalqty);
                    //     break;
                    case !totalqty:
                        $(this).val('');
                        $("#pid").css("border-color", "red");
                        break;
                }
            });
            $('#catename, #pid, #uqty, #gdate').keydown(function(event) 
            {
                var elementId = event.target.id;
                if (event.which === 9)
                {
                    event.preventDefault();
                    if(elementId=='catename')
                    {
                        $('#pid').focus();
                    }else if(elementId=='pid')
                    {
                        $('#uqty').focus();
                    }else if(elementId=='uqty')
                    {
                        $('#gdate').focus();
                    }
                    // else if(elementId=='gdate')
                    // {
                    //     $('#gdate').focus();
                    // }                  
                }
            });
        });  
    </script>
</body>