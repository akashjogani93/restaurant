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
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">From Date</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control pull-right" name="from_date" id="fdate" v-model="fdate">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">To Date</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control pull-right" name="to_date" id="tdate" v-model="tdate">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <button name="view_report" class="btn btn-info">View</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">View</h3>
                    </div>
                    <div class="box-body tablebox">
                        <table id="example1" class="table table-bordered table-striped" style="height:100px !important;">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Number</th>
                                    <th>Gross</th>
                                    <th>Discount</th>
                                    <th>CGST</th>
                                    <th>SGST</th>
                                    <th>Round Off(-)</th>
                                    <th>Round Off(+)</th>
                                    <th>Bill Amount</th>
                                </tr>
                            </thead>
                            <tbody id="monthdata">
                                <!-- <tr v-for="(item, index) in stockList" :key="item.id" :class="{ 'red-border': item.qty < 20, 'less-10-days': isLessThan10Days(item.exp) }">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.pname }}</td>
                                    <td>{{ item.qty }}</td>
                                    <td>{{ item.unit }}</td>
                                    <td>{{ item.exp }}</td>
                                    <td><button class="btn btn-info" onclick="if (confirm('Add To Wastage..?')) getDataFromRow(this)">wastage</button></td>
                                </tr> -->
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
    <script src="js/reports.js"></script>
    <script>
        $(document).ready(function()
        {
            const stockdata= new Reports();
        });
    </script>
</body>