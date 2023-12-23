<?php require_once("header.php");?>
<style>
    .error 
    {
        border-color: red;
    }
    .footerset
    {
        position: fixed;
        bottom: 0;
        width:100%;
    }
    #example1
    {
        height:20% !important;
    }
    .tablebox
    {
        /* height: 350px;
        overflow-y:scroll; */
    }
    .buga{
                margin-right:10px;
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
<body class="hold-transition skin-blue sidebar-mini">
    <div id="app">
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Purchase Product
                </h1>
            </section>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-9 assets">
                                        <a class="btn btn-info buga" href="create_assets.php" style="margin-top:27px;">
                                            Create Asset
                                        </a>
                                        <a class="btn btn-success buga" href="purchase_assets.php" style="margin-top:27px;">
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
                                </div></br>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Select Product</label>
                                        <select name="pname" id="pid" required class="form-control pname" v-model="productName">
                                            <option value="">Select Product</option>
                                            <option v-for="cate in products" :value="cate.id">{{ cate.product }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Product Qty</label>
                                        <input type="number" class="form-control" name="qty" id="qty" min="1" placeholder="Quantity">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Case Price</label>
                                        <input type="number" class="form-control" name="price" id="price" min="1" placeholder="Price">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Total</label>
                                        <input type="number" class="form-control" name="total" id="total" min="1" placeholder="Total Price" readonly>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <center>
                                        <button id="sub" type="button" class="btn btn-primary" @click="addItem">Submit</button>
                                    </center>
                                </div>
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Stock List</h3>
                                    </div>
                                    <div class="box-body tablebox">
                                        <table id="example1" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Sl.No</th>
                                                    <th>Product Name</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
                                                    <th>Total Amount</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in stockList" :key="item.id">
                                                    <td>{{ index + 1 }}</td>
                                                    <td>{{ item.product }}</td>
                                                    <td>{{ item.qty }}</td>
                                                    <td>{{ item.price }}</td>
                                                    <td>{{ item.total }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-danger" @click="deleteItem(index)">Delete</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail3" class="control-label">Total Amount</label>
                                                        <input type="number" class="form-control" name="price" id="totamt" min="1" placeholder="Total Amount" readonly v-model="totamt">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail3" class="control-label">Remark</label>
                                                        <input type="text" class="form-control" name="remark" id="remark" placeholder="Remark" style=" border-color: #0a5f81;">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="inputEmail3" class="control-label">Purchase Date</label>
                                                        <input type="date" class="form-control" name="date" id="date" placeholder="date" style=" border-color: #0a5f81;">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <button type="button" class="btn btn-sm btn-danger" style="width:100%; margin-top:25px;" @click="clearData">Cancel</button>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <button type="button" class="btn btn-sm btn-info" style="width:100%; margin-top:25px;" @click="submitData">Purchase</button>
                                                    </div>
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
        </div>
    </div>
    <script src="vue.min.js"></script>
    <script src="js/kitchen_int.js"></script>
    <script>
        $(document).ready(function()
        {
            const purchase= new Asset_purchase();
            $('#qty, #price').keypress(function(event) {
                var keycode = (event.keyCode ? event.keyCode : event.which);

                if ((keycode < 48 || keycode > 57) && keycode !== 46) {
                    return false; // Prevent non-numeric characters and allow decimal point
                } else {
                    return true;
                }
            });
        });
    </script>
</body>
