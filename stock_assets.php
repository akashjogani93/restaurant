<?php require_once("header.php");?>
<?php require_once("dbcon.php");?>
<style>
    .error {
        color: red;
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
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Stock Assets
            </h1>
            </br>
            <div class="row">
                <div class="col-md-9 assets">
                    <a class="btn btn-info buga" href="create_assets.php" style="margin-top:27px;">
                        Create Asset
                    </a>
                    <a class="btn btn-info buga" href="purchase_assets.php" style="margin-top:27px;">
                        Purchase
                    </a>
                    <a class="btn btn-success buga" href="stock_assets.php" style="margin-top:27px;">
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
        </section>
        <section class="content">
            <div id="app">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="row">
                                    <!-- <form class="form-horizontal" method="post" action="kitchen_given.php"> -->
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail3" class="col-sm-4 control-label">From Date</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control pull-right" name="from_date" id="fdate">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail3" class="col-sm-4 control-label">To Date</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control pull-right" name="to_date" id="tdate">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <!-- <button class="btn btn-success" style="margin-top:23px;" id="search">SEARCH</button> -->
                                            <button type="submit" name="view_report" class="btn btn-info" id="search" @click="fetchStock()">View</button>
                                            <button class="btn btn-danger" onclick="generateTable()">PDF</button>
                                            <button class="btn btn-success">Excel</button>
                                        </div>
                                    <!-- </form> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">View Assets Total Stock</h3>
                    </div>
                    <div class="box-body tablebox">
                        <table id="example1" class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Product Name</th>
                                    <th>Opening</th>
                                    <th>Purchase</th>
                                    <th>Damage</th>
                                    <th>Closing</th>
                                    <th>Amount</th>
                                    <th>Damaged</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in stockList" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.openingStock }}</td>
                                    <td>{{ item.stocksum }}</td>
                                    <td>{{ item.damage }}</td>
                                    <td>{{ item.cloasing }}</td>
                                    <td>{{ item.cloasinAmt }}</td>
                                    <td>
                                        <button class="btn btn-success" @click="handleIssued(index)"><i class='bx bx-trash-alt'></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="issuedModal" tabindex="-1" role="dialog" aria-labelledby="issuedModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="issuedModalLabel">Damage Stock</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="closingStock">Closing Stock:</label>
                                    <input type="text" class="form-control" id="closingStock" v-model="closingStock" readonly>
                                    <input type="hidden" class="form-control" id="pid" v-model="pid" readonly>
                                    <input type="hidden" class="form-control" id="amount" v-model="amount" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="userInput">Issued:</label>
                                    <input type="text" class="form-control" id="issued">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" @click="handleIssuedConfirm">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script> -->
    <script src="vue.min.js"></script>
    <script src="cdn/dataTables.buttons.min.js"></script>
    <script src="cdn/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() 
        {
            $('#issued').on('input',function()
            {
                var value = $('#issued').val();

                value = value.replace(/[^0-9.]/g, '');
                value = value.replace(/(\.[^.]*)\./g, '$1');
                tdValue = parseFloat($('#closingStock').val());

                if (isNaN(value)) {
                    value = 0;
                } else if (value > tdValue) {
                    value = tdValue;
                }
                $('#issued').val(value);
            });
        });
        function validateInput(input)
        {
            var value = input.value;
            value = value.replace(/[^0-9.]/g, '');
            value = value.replace(/(\..*)\./g, '$1');

            var row = input.closest('tr');
            var tdValue = row.querySelector('.td-class').innerText;
            tdValue = parseFloat(tdValue);

            value = parseFloat(value);

            if (value > tdValue) 
            {
                value = tdValue;
            }
            input.value = value;
        }
        function getDataFromRow(button) 
        {
            var row = button.parentNode.parentNode.parentNode;
            var input = row.querySelector('input[name="inputTag"]'); 
            var inputValue = parseFloat(input.value);
            if (isNaN(inputValue)) 
            {
                return;
            }
            var cells = row.getElementsByTagName('td');
            var rowData = [];
            for (var i = 0; i < cells.length; i++) 
            {
                rowData.push(cells[i].innerText);
            }
            let log=$.ajax({
                url: 'ajax/store_all.php',
                method: 'POST',
                data: {
                    assetsDamage: 'damage',
                    a_id: rowData[0],
                    a_product: rowData[1],
                    a_qty: rowData[2],
                    a_inputValue: inputValue,
                },
                success: function(response) 
                {
                    alert(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        var app= new Vue({
            el:'#app',
            data:{
                catName:'',
                categoys:[],
                stockList:[],
                closingStock: '',
                selectedIndex: null,
                pid:null,
                editMode: false,
                amount:'',
            },
            methods:
            {
                fetchCategory()
                {
                    var yourDateValue = new Date();
                    var formattedDate = yourDateValue.toISOString().substr(0, 10)
                    $('#fdate').val(formattedDate);
                    $('#tdate').val(formattedDate);
                    return;
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
                fetchStock()
                {
                    const vm = this;
                    catName=this.catName;
                    var fdate=$('#fdate').val();
                    var tdate=$('#tdate').val();
                    if(fdate=='')
                    {
                        $('#fdate').css('border-color', 'red');
                        return;
                    }
                    if(tdate=='')
                    {
                        $('#tdate').css('border-color','red');
                        return;
                    }
                    let log=$.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data:{StockAssetsFetch:'stock',fdate:fdate,tdate:tdate},
                        success(response) 
                        {
                            // console.log(response)
                            vm.stockList = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                    console.log(log);
                },
                handleIssued(index)
                {
                    this.selectedIndex = index;

                    this.closingStock =this.stockList[index].cloasing;
                    var closingStock1 = this.closingStock.replace(/,/g, '');
                    this.closingStock=parseFloat(closingStock1);

                    this.pid = parseFloat(this.stockList[index].id);

                    this.amount =this.stockList[index].cloasinAmt;
                    var amount1 = this.amount.replace(/,/g, '');
                    this.amount=parseFloat(amount1);

                    
                    $('#issuedModal').modal('show');
                },
                handleIssuedConfirm()
                {
                    const vm=this;
                    var close=parseFloat(this.closingStock);
                    var amt=this.amount;
                    amt=parseFloat(amt);
                    var per_amt=amt/close;

                    var issued=parseFloat($('#issued').val());
                    var damageAmt=issued*per_amt;
                    var pid=$('#pid').val();
                    if(isNaN(issued)) 
                    {
                        return;
                    }
                    if(issued==0)
                    {
                        return;
                    }
                    let log=$.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data: {
                            damage_pid: pid,
                            damage_issued: issued,
                            damage_amount: damageAmt,
                        },
                        success: function(response) 
                        {
                            console.log(response);
                        },
                        error: function(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                    $('#issuedModal').modal('hide');
                    vm.fetchStock();
                    this.closingStock='';
                    this.selectedIndex=null;
                    this.pid=null;
                    $('#issued').val('');
                }       
            },
            mounted()
            {
                this.fetchCategory()
                this.fetchStock()
            }
        });
    </script>
        <script>
            function generateTable() 
            {
                var fdate=$('#fdate').val();
                var tdate=$('#tdate').val();
                var doc = new jsPDF('p', 'pt', 'letter');
                var y = 20;
                doc.setLineWidth(2);
                doc.text(150, y = y + 10, "Assets Stock From "+fdate+" To "+tdate);
                doc.autoTable({
                    html: '#example1',
                    startY: 40,
                    startX: 40,
                    theme: 'grid',
                    columns: [
                        {dataKey: 'Sl.No'},
                        {dataKey: 'Product Name'},
                        {dataKey: 'Opening'},
                        {dataKey: 'Purchase'},
                        {dataKey: 'Damage'},
                        {dataKey: 'Closing'},
                        {dataKey: 'Amount'},
                    ],
                    styles: {
                        overflow: 'linebreak',
                        lineWidth: 1,
                        fontSize: 8,
                        cellPadding: {horizontal: 5, vertical: 2},
                    },
                    headerStyles: {
                        fillColor: [128, 128, 128],
                        textColor: [255, 255, 255],
                        fontSize: 8,
                        lineWidth: 1,
                    },
                })

                // doc.setProperties({
                //     title: 'Product Detailed Report',
                //     subject: 'This is the Product Detailed Report',
                //     author: 'Author Name',
                //     keywords: 'generated, javascript, web 2.0, ajax',
                //     creator: 'Author Name',
                //     margins: {
                //         top: 0,
                //         bottom: 0,
                //         left: 0,
                //         right: 0,
                //     },
                //     pageSize: 'letter',
                // });
                doc.save('assets_stock');
            }
        </script>
</body>