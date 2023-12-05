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
                                            <button type="submit" name="view_report" class="btn btn-info" id="search" @click="beveragesHis()">View</button>
                                            <button class="btn btn-danger" onclick="exportTableToPdf1()">PDF</button>
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
                                    <th>Cloasing</th>
                                    <th>Amount</th>
                                    <!-- <th>Wastage</th> -->
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
                                    <!-- <td><div style="display:flex;">
                                        <input type="text" name="inputTag" class="form-control" placeholder="Wastage Qty" style="width: 50%; margin-right:10px;" oninput="validateInput(this)">
                                        <button class="btn btn-info" onclick="if (confirm('Stock Damaged..?')) getDataFromRow(this)">Damage</button>
                                        </div>
                                    </td> -->
                                </tr>
                            </tbody>
                        </table>
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
                            console.log(response)
                            vm.stockList = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                    console.log(log);
                }
            },
            mounted()
            {
                this.fetchCategory()
                this.fetchStock()
            }
        });
    </script>
</body>