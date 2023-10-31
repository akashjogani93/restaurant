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
        <div class="wrapper" id="form1"></div>
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
                                        <label for="inputEmail3" class="control-label">Select Category</label>
                                        <select name="pname" id="pid" required class="form-control pname" v-model="categoryOption" @change="categoryChange">
                                            <option value="">Select Category</option>
                                            <option v-for="cate in category" :value="cate.CategoryName">{{ cate.CategoryName }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Product Name</label>
                                        <select name="pname" id="pid" required class="form-control pname" v-model="selectedOption" @change="productChange">
                                            <option value="">Select Products</option>
                                            <option v-for="option in options" :value="option.pid">{{ option.pname }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputPassword3" class="control-label">Purchase Unit</label>
                                        <input type="text" class="form-control" name="unit" id="unit" placeholder="Type Here.." v-model="unit" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputPassword3" class="control-label">Sell Unit</label>
                                        <input type="text" class="form-control" name="sellunit" id="sellunit" placeholder="Type Here.." v-model="sellunit" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Item Qty</label>
                                        <input type="number" class="form-control" name="qty" id="qty" min="1" placeholder="Quantity" v-model="qty">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Inside Qty</label>
                                        <input type="number" class="form-control" name="insideqty" id="insideqty" min="1" placeholder="Quantity" v-model="insideqty">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Price Per Unit</label>
                                        <input type="number" class="form-control" name="price" id="price" min="1" placeholder="Price Per Unit" v-model="price">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Item Expiry</label>
                                        <input type="date" class="form-control" name="exp" id="exp" placeholder="item Expiry Date" v-model="exp">
                                    </div>
                                </div>  
                            </div>  
                        </div>  
                    </div>
                </div>
                <div class="box-footer">
                    <center>
                        <button v-if="!editMode" type="button" class="btn btn-primary" @click="addItem">Add</button>
                        <button v-else type="button" class="btn btn-primary" @click="updateItem(index)">Update</button>
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
                                    <th>Sl No</th>
                                    <th>Item Name</th>
                                    <th>Category</th>
                                    <th>Purchase Qty</th>
                                    <th>Sell Unit</th>
                                    <th>Qty</th>
                                    <th>Qty/case</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Tax Amt</th>
                                    <th>Net Total</th>
                                    <th>Expiry</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in stockList" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.cat }}</td>
                                    <td>{{ item.purunit }}</td>
                                    <td>{{ item.sellunit }}</td>
                                    <td>{{ item.qty }}</td>
                                    <td>{{ item.insideqty }}</td>
                                    <td>{{ item.pric }}</td>
                                    <td>{{ item.amt }}</td>
                                    <td>{{ item.tax }}</td>
                                    <td>{{ item.total }}</td>
                                    <td>{{ item.exp }}</td>
                                    <td>
                                        <!-- <button type="button" class="btn btn-sm btn-primary" @click="editItem(item, index)">Edit</button> -->
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
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Vendor</label>
                                            <select required class="form-control pname" v-model="vendorName" style=" border-color: #0a5f81;" name="ven" id="ven">
                                                <option value="">Select Vendor</option>
                                                <option v-for="ven in vens" :value="ven.slno">{{ ven.vendor }}</option>
                                            </select>
                                            <span v-if="vendorNameError" class="error">Vendor name should only contain letters.</span>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Gross Amt</label>
                                            <input type="number" class="form-control" name="g-amt" id="g-amt" placeholder="Gross Amount" v-model="gamt" style=" border-color: #0a5f81;" min="1" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Tax</label>
                                            <input type="number" class="form-control" name="tax-amt" id="tax-amt" placeholder="Tax Amount" v-model="totaltax" style=" border-color: #0a5f81;" min="1" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Net Amt</label>
                                            <input type="number" class="form-control" name="totamt" id="totamt" placeholder="Total Amount" v-model="totamt" style=" border-color: #0a5f81;" min="1" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Paid Amount</label>
                                            <input type="number" class="form-control pamt" name="pamt" placeholder="Paid Amount" v-model="pamt" style=" border-color: #0a5f81;" id="pamt">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Bill Date</label>
                                            <input type="date" class="form-control" name="purdate" id="purdate" placeholder="Purchased Date" style=" border-color: #0a5f81;">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Bill No</label>
                                            <input type="text" class="form-control" name="billno" id="bill" placeholder="Bill No" style=" border-color: #0a5f81;">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Remark</label>
                                            <input type="text" class="form-control" name="remark" id="remark" placeholder="Remark" style=" border-color: #0a5f81;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <center>   
                                            <button type="button" class="btn btn-sm btn-danger" style="width:20%;" @click="clearData">Cancel</button>
                                            <button type="button" class="btn btn-sm btn-info" style="width:20%;" @click="submitData">Submit</button>
                                        </center>
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
            const purchase_datas= new Purchase();

            var yourDateValue = new Date();
            var formattedDate = yourDateValue.toISOString().substr(0, 10)
            $('#purdate').val(formattedDate);
            $('#pamt,#totamt,#qty,#bill').keypress(function(event)
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
            let log= $('#pamt,#totamt').on('change', function()
            {
                var pamt = parseFloat($('#pamt').val());
                var totamt = parseFloat($('#totamt').val());
                if (!isNaN(pamt) && !isNaN(totamt) && pamt > totamt) 
                {
                    $('#pamt').val(totamt)
                }
            });
        });
    </script>
</body>