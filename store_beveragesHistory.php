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
        #bevhis{
            background: green;
        }
</style>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Sold Beverages
            </h1>
            </br>
            <?php include('bevbutton.html'); ?>
        </section>
        <section class="content">
            <div id="app">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="row">
                                    <!-- <form class="form-horizontal" method="post" action="kitchen_given.php"> -->
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail3" class="control-label">From Date</label>
                                            <input type="date" class="form-control pull-right" name="from_date" id="fdate">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail3" class="control-label">To Date</label>
                                            <input type="date" class="form-control pull-right" name="to_date" id="tdate">
                                        </div>
                                        <div class="form-group col-md-2" style="margin-top:25px;">
                                            <button type="submit" name="view_report" class="btn btn-info" id="search" @click="beveragesHis()">View</button>
                                            <button class="btn btn-danger" onclick="generateTable()">PDF</button>
                                            <!-- <button class="btn btn-success">Excel</button> -->
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail3" class="control-label">search</label>
                                            <input type="text" class="form-control pull-right" name="sear1" id="sear1" v-model="sear1">
                                        </div>
                                    <!-- </form> -->
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
                        <table id="example1" class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Slno</th>
                                    <th>Item Name</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Issued</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in bevhis" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.pname }}</td>
                                    <td>{{ item.sellunit }}</td>
                                    <td class="right-align">{{ formatNumber(item.stock) }}</td>
                                    <td class="right-align">{{ formatNumber(item.issued) }}</td>
                                    <td>{{ item.date }}</td>
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
    <script src="html2pdf.js/dist/jspdf.min.js"></script>
    <script>
        $(document).ready(function()
        {
            const bev = new Beaverages();
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
                doc.text(150, y = y + 10, "Beaverages Stock From "+fdate+" To "+tdate);
                doc.autoTable({
                    html: '#example1',
                    startY: 40,
                    startX: 40,
                    theme: 'grid',
                    columns: [
                        {dataKey: 'Sl.No'},
                        {dataKey: 'Item Name'},
                        {dataKey: 'Unit'},
                        {dataKey: 'Qty'},
                        {dataKey: 'Issued'},
                        {dataKey: 'Date'},
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
                doc.save('beaverages_history');
            }
    </script>
</body>