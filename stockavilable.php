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

    <script>

            function getDataFromRow(button)
            {
                var row = button.closest("tr");
                var cells = row.getElementsByTagName('td');
                var rowData = [];
                for (var i = 0; i < cells.length; i++) {
                    rowData.push(cells[i].innerText);
                }
                // console.log(rowData[0])
                let log=$.ajax({
                    url: 'ajax/kitchen_stock.php',
                    method: 'POST',
                    data: {
                        wastage: rowData[0]
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
                    // alert(catName);
                    $.ajax({
                        url: 'ajax/fetch_options.php',
                        method: 'POST',
                        data:{stock:'stock',catName1:catName},
                        success(response) 
                        {
                            console.log(response)
                            vm.stockList = response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                isLessThan10Days(expDate) {
                    const today = new Date();
                    const expiration = new Date(expDate);
                    const timeDifference = expiration.getTime() - today.getTime();
                    const daysDifference = timeDifference / (1000 * 3600 * 24);
                    return daysDifference < 10;
                },
            },
            mounted()
            {
                this.fetchCategory()
                this.fetchStock()
            }
        });
    </script>
</body>

<?php /* 
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <?php
            require_once("header.php"); 
        ?>
        <style>
            .form-horizontal .form-group
            {
                margin:0 0 15px 0;
            }
            th{
                background-color:rgba(21, 22, 23, 0.06);
            }
            th,td{
                text-align:center;
            }
            .boxx{
                background-color:rgba(255, 255, 255, 0.4);
                margin:20px;
            }
            .box-body1{
                overflow-x:scroll;
            }
        </style>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    AVAILABLE STOCKS
                </h1>
            </section>

            <div class="boxx"><br>
                <div class="box-body">
                <div class="box-body1">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr no</th>
                                <th>Item name</th>
                                <th>Remaining Qty</th>
                                <th>Item unit</th>
                            </tr>
                        </thead>
                       <tbody>
                            <?php
                                require_once("dbcon.php");
                                    $query1 = "SELECT * FROM `stock1`";
                                    $exc=mysqli_query($conn,$query1);
                                    $i=0;
                                    while ($row=mysqli_fetch_array($exc)) 
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $i+1; ?></td>
                                            <td><?php echo $row['pname']; ?></td>
                                            <td><?php echo $row['qty']; ?></td>
                                            <td class="td-class"><?php echo $row['unit']; ?></td>
                                        </tr>
                                        <!--  -->
                                        <?php
                                        $i++;
                                    }
                                ?>
                       </tbody>
                    </table>
                    </div>
                    <br><br>
                    
                    </div>
                </div>
            
        </div>
        <!-- End Table -->

        </section>
        <!-- /.content -->
    </div>
    </div>
    <div class="control-sidebar-bg"></div>
    </div>
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="cdn/dataTables.buttons.min.js"></script>
            <script src="cdn/buttons.print.min.js"></script>
            <script src="cdn/sum().js"></script>
    <script>
    $(function() {
        $("#example1").DataTable({
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [
                [25, 10, 100, -1],
                [25, 10, 100, "All"]
            ],
            buttons: [
                'print'
            ]
        });
    });
    </script>

</body>

</html>*/
?>