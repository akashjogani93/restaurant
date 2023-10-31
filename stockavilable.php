<?php require_once("header.php");?>
<?php require_once("dbcon.php");?>
<style>
    .error {
        color: red;
    }
    .red-border {
        background-color: red !important;
        color: white;
    }

    .less-10-days {
        background-color: red !important;
        color: white;
    }

</style>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Stock Details
            </h1>
        </section>
        <section class="content">
            <div id="app">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="inputPassword3" class="control-label">Select Category</label>
                                        <select class="form-control" id="cat12" name="cat" placeholder="category" required v-model="catName" @change="fetchStock">
                                            <option value="">All</option>
                                            <option v-for="category in categoys" :value="category.CategoryName">{{ category.CategoryName }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">View Stock</h3>
                    </div>
                    <div class="box-body tablebox">
                        <table id="example1" class="table table-bordered table-striped" style="height:100px !important;">
                            <thead>
                                <tr>
                                    <th>Sr no</th>
                                    <th>Item name</th>
                                    <th>Remaining Qty</th>
                                    <th>Item unit</th>
                                    <th>Expiry Date</th>
                                    <th>wastage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in stockList" :key="item.id" :class="{ 'red-border': item.qty < 20, 'less-10-days': isLessThan10Days(item.exp) }">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.pname }}</td>
                                    <td>{{ item.qty }}</td>
                                    <td>{{ item.unit }}</td>
                                    <td>{{ item.exp }}</td>
                                    <td><button class="btn btn-info" onclick="if (confirm('Add To Wastage..?')) getDataFromRow(this)">wastage</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="cdn/dataTables.buttons.min.js"></script>
    <script src="cdn/buttons.print.min.js"></script>
    <script src="js/kitchen_int.js"></script>
    <script>
        $(document).ready(function()
        {
            const stockdata= new Stock();
        });
            function getDataFromRow(button)
            {
                var row = button.closest("tr");
                var cells = row.getElementsByTagName('td');
                var rowData = [];
                for (var i = 0; i < cells.length; i++) {
                    rowData.push(cells[i].innerText);
                }
                let log=$.ajax({
                    url: 'ajax/store_all.php',
                    method: 'POST',
                    data: {
                        Stock_wastage: rowData[0]
                    },
                    success: function(response) 
                    {
                        console.log(log);
                        alert(response);
                        window.location="stockavilable.php";
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
                console.log(log);
            }
    </script>
</body>