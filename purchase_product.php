<?php require_once("header.php");?>
<style>
    .error {
        border-color: red;
    }
    .footerset{
        position: fixed;
        bottom: 0;
        width:100%;
        /* left: 0;
        width: 100%; */
    }
    #example1{
        height:20% !important;
    }
    .tablebox{
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
                    Purchase Inventory
                </h1>
            </section>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Select Category</label>
                                        <div class="col-sm-8">
                                            <select name="pname" id="pid" required class="form-control pname" v-model="categoryOption" @change="categoryChange">
                                                <option value="">Select Products</option>
                                                <option v-for="cate in category" :value="cate.CategoryName">{{ cate.CategoryName }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Product Name</label>
                                        <div class="col-sm-8">
                                            <select name="pname" id="pid" required class="form-control pname" v-model="selectedOption" @change="productChange">
                                                <option value="">Select Products</option>
                                                <option v-for="option in options" :value="option.pid">{{ option.pname }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword3" class="col-sm-4 control-label">Item Unit</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="unit" id="unit" placeholder="Type Here.." v-model="unit" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Product Name</label>
                                        <div class="col-sm-8">
                                            <select name="pname" id="pid" required class="form-control pname" v-model="selectedOption">
                                                <option value="">Select Products</option>
                                                <option v-for="option in options" :value="option.pid">{{ option.pname }}</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Item Quantity</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="qty" id="qty" min="1" placeholder="Quantity" v-model="qty">
                                        </div>
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
                                    <th>Item Unit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in stockList" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.cat }}</td>
                                    <td>{{ item.qty }}</td>
                                    <td>{{ item.unit }}</td>
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
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Vendor Name</label>
                                        <div class="col-sm-8">
                                            <!-- <input type="text" class="form-control" name="ven" placeholder="Vendor Name" v-model="vendorName" @input="validateVendorName" style=" border-color: #0a5f81;"> -->
                                            <select required class="form-control pname" v-model="vendorName" style=" border-color: #0a5f81;" name="ven" id="ven">
                                                <option value="">Select Vendor</option>
                                                <option v-for="ven in vens" :value="ven.slno">{{ ven.vendor }}</option>
                                            </select>
                                            <span v-if="vendorNameError" class="error">Vendor name should only contain letters.</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Total Amount</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="totamt" id="totamt" placeholder="Total Amount" v-model="totamt" style=" border-color: #0a5f81;" min="1">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Paid Amount</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control pamt" name="pamt" placeholder="Paid Amount" v-model="pamt" style=" border-color: #0a5f81;" id="pamt">
                                        </div>
                                    </div>
                                </div></br>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Bill Date</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="purdate" id="purdate" placeholder="Purchased Date" style=" border-color: #0a5f81;">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Bill No</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="billno" id="bill" placeholder="Bill No" style=" border-color: #0a5f81;">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Remark</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="remark" id="remark" placeholder="Remark" style=" border-color: #0a5f81;">
                                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    
   <script>
        $(document).ready(function()
        {
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
            $('#pamt,#totamt').on('input', function()
            {
                var pamt = parseFloat($('#pamt').val());
                var totamt = parseFloat($('#totamt').val());

                if (!isNaN(pamt) && !isNaN(totamt) && pamt > totamt) 
                {
                    $('#pamt').val(totamt)
                }
            });

        });
        var app = new Vue({
            el: '#app',
            data: {
                category: [],
                options: [],
                vens: [],
                selectedOption: '',
                categoryOption:'',
                unit: '',
                qty: '',
                stockList: [],
                nextId: 1,
                editMode: false,
                index: null,
                totamt:null,
                vendorName: '',
                vendorNameError: false,
                pamt:null

            },
            mounted() {
                this.fetchOptions();
                this.retrieveData();
            },
            methods: {
                fetchOptions() 
                {
                    const vm = this;
                    $.ajax({
                        url: 'ajax/fetch_options.php',
                        method: 'POST',
                        data:{cat:'category'},
                        success(response) {
                            vm.category = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });

                    $.ajax({
                        url: 'ajax/fetch_options.php',
                        method: 'POST',
                        data:{ven:'ven'},
                        success(response) {
                            vm.vens = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                categoryChange()
                {
                    const vm1 = this;
                    vm1.unit='';
                    categoryOption=this.categoryOption;
                    $.ajax({
                        url: 'ajax/fetch_options.php',
                        method: 'POST',
                        data:{opt:'opt',categoryOption:categoryOption},
                        success(response) {
                            vm1.options = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                productChange()
                {
                    const vm2 = this;
                    const selectedItem = this.options.find(option => option.pid === this.selectedOption);
                    // console.log(selectedItem.pname)
                    $.ajax({
                        url: 'ajax/fetch_options.php',
                        method: 'POST',
                        data:{selectedpname:selectedItem.pname},
                        success(response) 
                        {
                            vm2.unit = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                addItem() {
                    const selectedItem = this.options.find(option => option.pid === this.selectedOption);
                    const category=this.categoryOption;
                    // alert(category);
                    // return;
                    if (selectedItem && category) {
                        if (this.unit && this.qty && this.qty > 0) 
                        {
                            const newItem = {
                                id: this.nextId++,
                                name: selectedItem.pname,
                                qty: this.qty,
                                unit: this.unit,
                                cat:this.categoryOption
                            };
                                
                            this.stockList.push(newItem);

                            this.saveData();
                            this.selectedOption = '';
                            this.unit = '';
                            this.qty = '';
                            this.categoryOption='';
                        } else {
                            if (!this.unit) {
                                document.querySelector('.form-control[name="unit"]').classList.add('error');
                            } else {
                                document.querySelector('.form-control[name="unit"]').classList.remove('error');
                            }
                            if (!this.qty || this.qty <= 0) {
                                document.querySelector('.form-control[name="qty"]').classList.add('error');
                            } else {
                                document.querySelector('.form-control[name="qty"]').classList.remove('error');
                            }
                        }
                    }
                },
                editItem(item, index) {
                    this.selectedOption = item.id;
                    this.unit = item.unit;
                    this.qty = item.qty;
                    this.editMode = true;
                    this.index = index;
                },
                deleteItem(index) {
                    this.stockList.splice(index, 1);
                    this.saveData();
                },
                updateItem(index) {
                    console.log(index);
                    const selectedItem = this.options.find(option => option.pid === this.selectedOption);
                    
                    if (selectedItem) {
                        const existingItem = this.stockList[index];
                        
                        if (existingItem) {
                            existingItem.qty += parseInt(this.qty);
                            existingItem.unit = this.unit;
                        }
                    }
                    
                    // Reset input fields
                    this.selectedOption = '';
                    this.unit = '';
                    this.qty = '';
                    
                    // Reset edit mode
                    this.editMode = false;
                },
                saveData() {
                    // Save stockList data to localStorage
                    localStorage.setItem('stockListData', JSON.stringify(this.stockList));
                },
                retrieveData() {
                    // Retrieve stockList data from localStorage
                    const data = localStorage.getItem('stockListData');
                    
                    if (data) {
                        this.stockList = JSON.parse(data);
                    }
                },
                clearData() 
                {
                    this.stockList = [];
                    this.saveData();
                    this.vendorName='';
                    localStorage.removeItem('stockListData');
                },
                submitData() 
                {
                    const vendorName = $('#ven').val();

                    const venItem = this.vens.find(ven => ven.slno === this.vendorName);
                    const category=this.categoryOption;
                    const purchasedDate = $('input[name="purdate"]').val();
                    const totamt = $('input[name="totamt"]').val();
                    const pamt = $('input[name="pamt"]').val();
                    const remark = $('input[name="remark"]').val();
                    const bill = $('input[name="billno"]').val();
                    if (vendorName && purchasedDate && this.stockList.length > 0 && totamt && pamt) 
                    {
                        const vm = this;
                       let log= $.ajax({
                            url: 'ajax/purchase_submit.php',
                            method: 'POST',
                            data: {
                            vendorName: venItem.vendor,
                            venId: venItem.slno,
                            purchasedDate: purchasedDate,
                            totamt:totamt,
                            pamt:pamt,
                            remark:remark,
                            billNo:bill,
                            stockList: vm.stockList
                            },
                            success(response) {
                                console.log(response);
                                alert("Data Submited")
                                vm.stockList = [];
                                $('#ven').val('');
                                $('input[name="purdate"]').val('');
                                localStorage.removeItem('stockListData');
                                window.location="purchase_product.php"
                            },
                            error(xhr, status, error) 
                            {
                                console.error(error);
                            }
                        });
                        console.log(log)
                    } else {
                        $('.form-control').removeClass('error');
                        if (!vendorName) 
                        {
                            $('#ven').css('border-color', 'red');
                        }
                        if (!totamt) 
                        {
                            $('input[name="totamt"]').css('border-color', 'red');
                        }
                        if (!pamt) 
                        {
                            $('input[name="pamt"]').css('border-color', 'red');
                        }
                        if (!purchasedDate) 
                        {
                            $('input[name="purdate"]').addClass('error');
                        }
                        if (this.stockList.length === 0) 
                        {
                            $('.form-control[name="unit"]').addClass('error');
                            $('.form-control[name="qty"]').addClass('error');
                        }
                        setTimeout(function() 
                        {
                            $('#ven').css('border-color', '#0a5f81');
                            $('input[name="totamt"]').css('border-color', '#0a5f81');
                            $('input[name="pamt"]').css('border-color', '#0a5f81');
                        }, 5000);

                    }
                },
                validateVendorName() 
                {
                    const regex = /[^\p{L}\s]/u;
                    if (regex.test(this.vendorName)) 
                    {
                        this.vendorName = this.vendorName.replace(regex, '');
                    }
                    this.vendorNameError = !/^[A-Za-z\s]*$/.test(this.vendorName);

                },
            }
        });
    </script>
</body>
