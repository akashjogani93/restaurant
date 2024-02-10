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
        /* height: 100px; */
        /* overflow-y:scroll; */
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
    .shourtcuts{
            display:flex;
            margin-bottom:10px;
            }
            .shourtcuts > p{
                margin:0 20px;
                text-align:center;
                font-size:11px;
            }

    .checkbox-container {
      display: flex;
      align-items: center;
    }
    .checkbox-input {
      width: 20px; /* Set the width of the checkbox */
      height: 20px; /* Set the height of the checkbox */
      margin-right: 50px; /* Adjust spacing between checkbox and label */
      cursor: pointer;
    }
    .checkbox-label {
      font-family: Arial, sans-serif;
      font-size: 16px;
      cursor: pointer;
    }

</style>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<body class="hold-transition skin-blue sidebar-mini">
    <div id="app">
        <div class="wrapper" id="form1"></div>
        <div class="content-wrapper">
            <section class="content-header">
                <h3>
                    Purchase Product
                </h3>
                <div class="row">
                <div class="col-md-12">
                    <div class="shourtcuts">
                        <p>Move Feild(Tab)</p>
                        <p>Back Feild(ALT+Tab)</p>
                        <p>Submit(Double Enter)</p>
                        <p>Refresh (ALT+z)</p>
                        <p>Cancel Bill(ALT+c)</p>
                        <p>Submit/Update(ALT+s)</p>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="box box-default">
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
                                        <label for="inputEmail3" class="control-label">Bill Date</label>
                                        <input type="date" class="form-control" name="purdate" id="purdate" placeholder="Purchased Date" style=" border-color: #0a5f81;">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Bill No</label>
                                            <input type="text" class="form-control" name="billno" id="bill" placeholder="Bill No" style=" border-color: #0a5f81;">
                                    </div>
                                </div></br>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Select Category</label>
                                        <select name="pname" id="pid12" required class="form-control pname" v-model="categoryOption" @change="categoryChange">
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
                                    <div class="col-md-2">
                                        <label for="inputPassword3" class="control-label">Purchase Unit</label>
                                        <input type="text" class="form-control" name="unit" id="unit" placeholder="Type Here.." v-model="unit" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputPassword3" class="control-label">Sell Unit</label>
                                        <input type="text" class="form-control" name="sellunit" id="sellunit" placeholder="Type Here.." v-model="sellunit" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Item Expiry</label>
                                        <input type="date" class="form-control" name="exp" id="exp" placeholder="item Expiry Date" v-model="exp">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Item Qty</label>
                                        <input type="number" class="form-control" name="qty" id="qty" min="1" placeholder="Quantity" v-model="qty">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Inside Qty</label>
                                        <input type="number" class="form-control" name="insideqty" id="insideqty" min="1" placeholder="Quantity" v-model="insideqty">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Price Per Unit</label>
                                        <input type="number" class="form-control" name="price" id="price" min="1" placeholder="Price Per Unit" v-model="price">
                                        <input type="radio" id="option1" name="options" value="0" checked>
                                        <label for="option1">No GST</label>
                                        <input type="radio" id="option2" name="options" value="1">
                                        <label for="option2">With GST</label>
                                    </div>
                                    <!-- <div class="form-group col-md-2">
                                    </div> -->
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Total</label>
                                        <input type="number" class="form-control" name="pricetotal" id="pricetotal" min="1" placeholder="Price Total Amout" v-model="totalofprice" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Disc</label>
                                        <input type="number" class="form-control" name="disc" id="disc" min="1" placeholder="Discount" v-model="disc">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="inputEmail3" class="control-label">Tax</label>
                                        <input type="number" class="form-control" name="tax" id="tax" min="1" placeholder="Tax" v-model="tax" readonly>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="inputEmail3" class="control-label">Cess</label>
                                        <input type="number" class="form-control" name="cess" id="cess" min="1" placeholder="Cess" v-model="cess" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Tax Amt</label>
                                        <input type="number" class="form-control" name="taxtaxamt" id="taxtaxamt" min="1" placeholder="Tax Amt" v-model="taxtaxamt" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Cess Amt</label>
                                        <input type="number" class="form-control" name="cesstaxamt" id="cesstaxamt" min="1" placeholder="Cess Amt" v-model="cesstaxamt" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Net Amt</label>
                                        <input type="number" class="form-control" name="addnetAmt" id="addnetAmt" min="1" placeholder="Nett Amt" v-model="addnetAmt" readonly>
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
                        <table id="example1" class="table">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Item Name</th>
                                    <th>Category</th>
                                    <th>P-Unit</th>
                                    <th>S-Unit</th>
                                    <th>Qty</th>
                                    <th>Qty/Case</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Discount</th>
                                    <th>Tax Amt</th>
                                    <th>Cess Amt</th>
                                    <th>Net Amt</th>
                                    <th>Expiry</th>
                                    <th>Edit/Delete</th>
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
                                    <td>{{ item.baseamt }}</td>
                                    <td>{{ item.disc }}</td>
                                    <td>{{ item.tax }}</td>
                                    <td>{{ item.cessAmt }}</td>
                                    <td>{{ item.amt }}</td>
                                    <td>{{ item.exp }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" @click="editItem(item, index)"><i class='bx bx-edit-alt'></i></button>
                                        <button type="button" class="btn btn-sm btn-danger" @click="deleteItem(index)"><i class='bx bx-trash'></i></button>
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
                                        <label for="inputEmail3" class="control-label">Gross Amt</label>
                                            <input type="number" class="form-control" name="g-amt" id="g-amt" placeholder="Gross Amount" v-model="gamt" style=" border-color: #0a5f81;" min="1" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Disc</label>
                                        <input type="number" class="form-control" name="disc-amt" id="disc-amt" placeholder="Disc Amount" v-model="disctax" style=" border-color: #0a5f81;" min="1" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Tax</label>
                                        <input type="number" class="form-control" name="tax-amt" id="tax-amt" placeholder="Tax" v-model="totaltax" style=" border-color: #0a5f81;" min="1" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Cess</label>
                                        <input type="number" class="form-control" name="cess-amt" id="cess-amt" placeholder="Cess" v-model="totalcess" style=" border-color: #0a5f81;" min="1" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Other Charge</label>
                                        <input type="number" class="form-control" name="other-amt" id="other-amt" placeholder="Other Amount" style=" border-color: #0a5f81;">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Net Amt</label>
                                        <input type="number" class="form-control" name="totamt" id="totamt" placeholder="Total Amount" style=" border-color: #0a5f81;" readonly>
                                        <input type="hidden" class="form-control" name="totamt1" id="totamt1" placeholder="Tax Amount1" style="border-color: #0a5f81;" min="1" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Paid Amount</label>
                                            <input type="number" class="form-control pamt" name="pamt" placeholder="Paid Amount" v-model="pamt" style=" border-color: #0a5f81;" id="pamt">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputEmail3" class="control-label">Payment</label>
                                        <select name="paymentmode" id="paymentmode" class="form-control">
                                            <option value="">Select</option>
                                            <option>Cash</option>
                                            <option>Online</option>
                                            <option>Cheque</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="control-label">Remark</label>
                                            <input type="text" class="form-control" name="remark" id="remark" placeholder="Remark" style=" border-color: #0a5f81;">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <!-- <center>    -->
                                            <button type="button" class="btn btn-sm btn-danger" style="width:100%; margin-top:25px;" @click="clearData">Cancel</button>
                                        <!-- </center> -->
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="button" class="btn btn-sm btn-info" style="width:100%; margin-top:25px;" @click="submitData" v-if="!billEdit">Submit</button>
                                        <button v-else type="button" class="btn btn-sm btn-info" style="width:100%; margin-top:25px;" @click="finalUpdateData">Update</button>
                                    </div>
                                </div>
                                <div class="row">
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

            $('#pamt, #totamt, #qty, #bill').keypress(function(event) {
                var keycode = (event.keyCode ? event.keyCode : event.which);

                if ((keycode < 48 || keycode > 57) && keycode !== 46) {
                    return false; // Prevent non-numeric characters and allow decimal point
                } else {
                    return true;
                }
            });
            $('#other-amt').on('input', function() 
            {
                var tot = $('#totamt').val();
                var totamt1 = $('#totamt1').val();
                var otherAmt = $('#other-amt').val();
                if (otherAmt !== '' && !isNaN(parseFloat(otherAmt))) 
                {
                    var total = parseFloat(totamt1) + parseFloat(otherAmt);
                    $('#totamt').val(total);
                } else {
                    $('#totamt').val(totamt1.toFixed(2));
                }
            });

            // $('#pid, #totamt, #qty, #bill').keydown(function(event) 
            // {
            //     // Check which field has focus
            //     var activeElementId = document.activeElement.id;
            //     var nextElementId;
            //     if (event.which === 9)
            //     {
            //         switch (activeElementId) {
            //             case 'pid':
            //                 nextElementId = 'qty';
            //                 break;
            //             case 'totamt':
            //                 nextElementId = 'qty';
            //                 break;
            //             case 'qty':
            //                 nextElementId = 'bill';
            //                 break;
            //             // Add more cases if needed

            //             // Default case: no change if the focused element is not one of the specified IDs
            //             default:
            //                 return;
            //         }

            //         // Move the cursor to the next field
            //         $('#' + nextElementId).focus();
            //     }
            // });

            // $('#pid, #qty, #disc').keydown(function(event) 
            // {
            //     var elementId = event.target.id;
            //     if (event.which === 9) 
            //     {
            //         event.preventDefault();
            //         if(elementId=='pid')
            //         {
            //             $('#qty').focus();
            //         }else if(elementId=='qty')
            //         {
            //             $('#price').focus();
            //         }else if(elementId=='disc')
            //         {
            //             $('#disc').focus();
            //         }                  
            //     }
            // });
        });
    </script>
</body>