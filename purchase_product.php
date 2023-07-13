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
                                        <label for="inputEmail3" class="col-sm-4 control-label">Product Name</label>
                                        <div class="col-sm-8">
                                            <select name="pname" id="pid" required class="form-control pname" v-model="selectedOption">
                                                <option value="">Select Products</option>
                                                <option v-for="option in options" :value="option.pid">{{ option.pname }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword3" class="col-sm-4 control-label">Item Unit</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="unit" v-model="unit">
                                                <option value="">Select Unit</option>
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
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Item Quantity</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="qty" min="1" placeholder="Quantity" v-model="qty">
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
                                    <th>Purchase Qty</th>
                                    <th>Item Unit</th>
                                    <th>Edit/Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in stockList" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.name }}</td>
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
                                            <!-- <input type="text" class="form-control" name="ven" placeholder="Vendor Name"> -->
                                            <input type="text" class="form-control" name="ven" placeholder="Vendor Name" v-model="vendorName" @input="validateVendorName">
                                            <span v-if="vendorNameError" class="error">Vendor name should only contain letters.</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-5 control-label">Purchased Date</label>
                                        <div class="col-sm-7">
                                            <input type="date" class="form-control" name="purdate" placeholder="Purchased Date" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-sm btn-danger" style="width:100%;"  @click="clearData">Cancel</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-sm btn-info" style="width:100%;" @click="submitData">Submit</button>
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
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    
   <script>
        var app = new Vue({
            el: '#app',
            data: {
                options: [],
                selectedOption: '',
                unit: '',
                qty: '',
                stockList: [],
                nextId: 1,
                editMode: false,
                index: null,
                vendorName: '',
                vendorNameError: false

            },
            mounted() {
                this.fetchOptions();
                this.retrieveData();
            },
            methods: {
                fetchOptions() {
                    const vm = this;
                    $.ajax({
                        url: 'ajax/fetch_options.php',
                        method: 'POST',
                        success(response) {
                            vm.options = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                addItem() {
                    const selectedItem = this.options.find(option => option.pid === this.selectedOption);
                    
                    if (selectedItem) {
                        if (this.unit && this.qty) 
                        {
                            const newItem = {
                                id: this.nextId++,
                                name: selectedItem.pname,
                                qty: this.qty,
                                unit: this.unit
                            };
                                
                                this.stockList.push(newItem);

                                this.saveData();
                            this.selectedOption = '';
                            this.unit = '';
                            this.qty = '';
                        } else {
                            if (!this.unit) {
                                document.querySelector('.form-control[name="unit"]').classList.add('error');
                            } else {
                                document.querySelector('.form-control[name="unit"]').classList.remove('error');
                            }
                            if (!this.qty) {
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
                    localStorage.removeItem('stockListData');
                },
                submitData() {
                    const vendorName = $('input[name="ven"]').val();
                    const purchasedDate = $('input[name="purdate"]').val();

                    if (vendorName && purchasedDate && this.stockList.length > 0) 
                    {
                        const vm = this;
                       let log= $.ajax({
                            url: 'ajax/purchase_submit.php',
                            method: 'POST',
                            data: {
                            vendorName: vendorName,
                            purchasedDate: purchasedDate,
                            stockList: vm.stockList
                            },
                            success(response) {
                                console.log(response);
                                alert("Data Submited")
                                vm.stockList = [];
                                $('input[name="ven"]').val('');
                                $('input[name="purdate"]').val('');
                                localStorage.removeItem('stockListData');
                            },
                            error(xhr, status, error) {
                                console.error(error);
                            }
                        });
                        console.log(log)
                    } else {
                        $('.form-control').removeClass('error');
                        if (!vendorName) 
                        {
                            $('input[name="ven"]').addClass('error');
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

                    }
                },
                validateVendorName() 
                {
                    const regex = /\d/;
                    if (regex.test(this.vendorName))
                    {
                        this.vendorName = this.vendorName.replace(/\d/g, '');
                    }
                    this.vendorNameError = !/^[A-Za-z\s]*$/.test(this.vendorName);
                }

            }
        });
    </script>
</body>
