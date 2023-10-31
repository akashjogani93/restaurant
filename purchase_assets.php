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
        height: 350px;
        overflow-y:scroll;
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
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Select Product</label>
                                        <select name="pname" id="pid" required class="form-control pname">
                                            <option value="">Select Product</option>
                                            <option v-for="cate in products" :value="cate.product">{{ cate.product }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Product Qty</label>
                                        <input type="number" class="form-control" name="qty" id="qty" min="1" placeholder="Quantity">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Total Price</label>
                                        <input type="number" class="form-control" name="price" id="price" min="1" placeholder="Total Price">
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
                                        <table id="example1" class="table table-bordered table-striped" style="height:100px !important;">
                                            <thead>
                                                <tr>
                                                    <th>Sl.No</th>
                                                    <th>Product Name</th>
                                                    <th>Qty</th>
                                                    <th>Total Amount</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in stockList" :key="item.id">
                                                    <td>{{ index + 1 }}</td>
                                                    <td>{{ item.product }}</td>
                                                    <td>{{ item.qty }}</td>
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
        });
    </script>
</body>
