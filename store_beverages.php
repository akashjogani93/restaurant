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
    .tablebox{
            width: 100%;
            overflow-x: auto;
        }
    .table>thead,tfoot
        {
            background-color:grey;
            color:white;
        }
        .table{
            width: 100%;
            border-collapse: collapse;
        }
        .table th,
        .table td 
        {
            border: 1px solid black;
            padding: 5px;
            /* text-align: left; */
            white-space: nowrap;
        }
        #bevstock{
            background: green;
        }
</style>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Beverages Store
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
                                            <button type="submit" name="view_report" class="btn btn-info" id="search" @click="stockbyDate()">View</button>
                                            <button class="btn btn-danger" id="pdfgenerate">PDF</button>
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
                        <h3 class="box-title">View Stock</h3>
                    </div>
                    <div class="box-body tablebox">
                        <table id="example1" class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Slno</th>
                                    <th>Item Name</th>
                                    <th>Unit</th>
                                    <th>Avg U/P</th>
                                    <th>Opening</th>
                                    <!-- <th>Total</th> -->
                                    <th>Purchase</th>
                                    <th>Price</th>
                                    <th>Issued</th>
                                    <th>Price</th>
                                    <!-- <th>Return</th>
                                    <th>Price</th> -->
                                    <th>Closing</th>
                                    <th>Price</th>
                                    <th>Use</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in bevstock" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.unit }}</td>
                                    <td class="right-align">{{ item.price }}</td>
                                    <td class="right-align">{{ item.openingStock }}</td>
                                    <!-- <td>{{ item.opeTotal}}</td> -->
                                    <td class="right-align">{{ item.stocksum }}</td>
                                    <td class="right-align">{{ item.purTotal}}</td>
                                    <td class="right-align">{{ item.issued }}</td>
                                    <td class="right-align">{{ item.issuedTotal}}</td>
                                    <!-- <td>{{ item.retur }}</td>
                                    <td>{{ item.retTotal}}</td> -->
                                    <td class="right-align">{{ item.cloasing }}</td>
                                    <td class="right-align">{{ item.cloTotal}}</td>
                                    <td>
                                        <button class="btn btn-success" @click="handleIssued(index)">Issue</button>
                                        <!-- <button class="btn btn-info">Return</button> -->
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>Purchase:</td>
                                    <td class="right-align">{{ bevstock.reduce((sum, item) => sum + parseFloat((item.purTotal || '0').replace(/,/g, '')), 0).toFixed(2) }}</td>
                                    <td>Issued:</td>
                                    <td class="right-align">{{ bevstock.reduce((sum, item) => sum + parseFloat((item.issuedTotal || '0').replace(/,/g, '')), 0).toFixed(2) }}</td>
                                    <td>Cloasing:</td>
                                    <td class="right-align">{{ bevstock.reduce((sum, item) => sum + parseFloat((item.cloTotal || '0').replace(/,/g, '')), 0).toFixed(2) }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="issuedModal" tabindex="-1" role="dialog" aria-labelledby="issuedModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="issuedModalLabel">Issued Stock</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="closingStock">Closing Stock:</label>
                                    <input type="text" class="form-control" id="closingStock" v-model="closingStock" readonly>
                                    <input type="hidden" class="form-control" id="pid" v-model="pid" readonly>
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
                <!-- <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="returnModalLabel">Return Stock</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="closingStock">Closing Stock:</label>
                                    <input type="text" class="form-control" id="returnStock" v-model="closingStock" readonly>
                                    <input type="hidden" class="form-control" id="pid" v-model="pid" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="userInput">Return:</label>
                                    <input type="text" class="form-control" id="return">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" @click="handleReturnConfirm">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="cdn/dataTables.buttons.min.js"></script>
    <script src="cdn/buttons.print.min.js"></script>
    <script src="js/kitchen_int.js"></script>
    <script src="js/pdfMake.js"></script>
    <script src="html2pdf.js/dist/jspdf.min.js"></script>
    <script>
        $(document).ready(function()
        {
            const bev = new Beaverages();
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

            $('#pdfgenerate').on('click',function()
            {
                const pdf= new pdfMake();
                var header="Beverages Stock From ";
                var save="beaverages_stock";
                columns=[
                    {dataKey: 'Slno'},
                        {dataKey: 'Item Name'},
                        {dataKey: 'Unit'},
                        {dataKey: 'Avg U/P'},
                        {dataKey: 'Opening'},
                        {dataKey: 'Purchase'},
                        {dataKey: 'Price'},
                        {dataKey: 'Issued'},
                        {dataKey: 'Price'},
                        // {dataKey: 'Return'},
                        // {dataKey: 'Price'},
                        {dataKey: 'Closing'},
                        {dataKey: 'Price'},
                    ];
                pdf.generate(columns,header,save);
            });

            $('#return').on('input',function()
            {
                var value = $('#return').val();
                value = value.replace(/[^0-9.]/g, '');
                value = value.replace(/(\.[^.]*)\./g, '$1');
                tdValue = parseFloat($('#returnStock').val());

                if (isNaN(value)) {
                    value = 0;
                } else if (value > tdValue) {
                    value = tdValue;
                }
                $('#return').val(value);
            });
        });
    </script>

        <!-- <script>
            function generateTable() 
            {
                var fdate=$('#fdate').val();
                var tdate=$('#tdate').val();
                var doc = new jsPDF('p', 'pt', 'letter');
                var y = 20;
                doc.setLineWidth(2);
                doc.text(150, y = y + 10, "Beverages Stock From "+fdate+" To "+tdate);
                doc.autoTable({
                    html: '#example1',
                    startY: 40,
                    startX: 40,
                    theme: 'grid',
                    columns: [
                        {dataKey: 'Slno'},
                        {dataKey: 'Item Name'},
                        {dataKey: 'Unit'},
                        {dataKey: 'Avg U/P'},
                        {dataKey: 'Opening'},
                        {dataKey: 'Purchase'},
                        {dataKey: 'Price'},
                        {dataKey: 'Issued'},
                        {dataKey: 'Price'},
                        // {dataKey: 'Return'},
                        // {dataKey: 'Price'},
                        {dataKey: 'Closing'},
                        {dataKey: 'Price'},
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
                doc.save('beaverages_stock');
            }
        </script> -->
</body>