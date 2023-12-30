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
                                    <div class="col-md-3">
                                        <label for="inputPassword3" class="control-label">Select Category</label>
                                        <select class="form-control" id="cat12" name="cat" placeholder="category" required v-model="catName" @change="fetchStock">
                                            <option value="">All</option>
                                            <option v-for="category in categoys" :value="category.CategoryName">{{ category.CategoryName }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                            <label for="inputEmail3" class="control-label">From Date</label>
                                            <input type="date" class="form-control pull-right" name="from_date" id="fdate">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail3" class="control-label">To Date</label>
                                            <input type="date" class="form-control pull-right" name="to_date" id="tdate">
                                        </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-success" style="margin-top:23px;" @click="search">Search</button>
                                        <button class="btn btn-danger" style="margin-top:23px;" id="pdfgenerate">PDF</button>
                                        <!-- <button class="btn btn-success" style="margin-top:23px;" onclick="exportToExcel()">Excel</button> -->
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
                        <table id="example1" class="table">
                            <thead>
                                <tr>
                                    <!-- <th>Pid</th> -->
                                    <th>Sl.No</th>
                                    <th>Item Name</th>
                                    <th>Unit</th>
                                    <th>Avg U/P</th>
                                    <th>Opening</th>
                                    <!-- <th>Total</th> -->
                                    <!-- <td>{{ item.opeTotal }}</td> -->
                                    <th>Purchase</th>
                                    <th>Price</th>
                                    <th>Issued</th>
                                    <th>Price</th>
                                    <th>Return</th>
                                    <th>Price</th>
                                    <th>Wastage</th>
                                    <th>Price</th>
                                    <th>Closing</th>
                                    <th>Price</th>
                                    <th>Wastage</th>

                                </tr>
                            </thead>
                            <tbody id="tableData">
                                <tr v-for="(item, index) in stockList" :key="item.id">
                                    <!-- <td>{{ item.pid }}</td> -->
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.unit }}</td>
                                    <td class="right-align">{{ item.avgprice }}</td>
                                    <td class="right-align">{{ item.openingStock }}</td>
                                    <td class="right-align">{{ item.stocksum }}</td>
                                    <td class="right-align">{{ item.purTotal }}</td>
                                    <td class="right-align">{{ item.issued }}</td>
                                    <td class="right-align">{{ item.issedTotal }}</td>
                                    <td class="right-align">{{ item.retur }}</td>
                                    <td class="right-align">{{ item.returnTotal }}</td>
                                    <td class="right-align">{{ item.wastage }}</td>
                                    <td class="right-align">{{ item.wastotal }}</td>
                                    <td class="right-align">{{ item.cloasing }}</td>
                                    <td class="right-align">{{ item.cloTotal }}</td>
                                    <td>
                                        <button class="btn btn-success align-center" @click="handlewastage(index)" style="padding: 2px 5px;"><i class='bx bx-trash-alt'></i></button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>Purchase:</td>
                                    <td class="right-align">{{ stockList.reduce((sum, item) => sum + parseFloat((item.purTotal || '0').replace(/,/g, '')), 0).toFixed(2) }}</td>
                                    <td>Issued:</td>
                                    <td class="right-align">{{ stockList.reduce((sum, item) => sum + parseFloat((item.issedTotal || '0').replace(/,/g, '')), 0).toFixed(2) }}</td>
                                    <td>Return:</td>
                                    <td class="right-align">{{ stockList.reduce((sum, item) => sum + parseFloat((item.returnTotal || '0').replace(/,/g, '')), 0).toFixed(2) }}</td>
                                    <td>Wastage:</td>
                                    <td class="right-align">{{ stockList.reduce((sum, item) => sum + parseFloat((item.wastotal || '0').replace(/,/g, '')), 0).toFixed(2) }}</td>
                                    <td>Closing:</td>
                                    <td class="right-align">{{ stockList.reduce((sum, item) => sum + parseFloat((item.cloTotal || '0').replace(/,/g, '')), 0).toFixed(2) }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                 <!-- Modal -->
                 <div class="modal fade" id="wastageModal" tabindex="-1" role="dialog" aria-labelledby="wastageModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="wastageModalLabel">Wastage Stock</h5>
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
                                    <label for="userInput">Wastage:</label>
                                    <input type="text" class="form-control" id="wastage">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" @click="handlewastageConfirm">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="cdn/dataTables.buttons.min.js"></script>
    <script src="cdn/buttons.print.min.js"></script>

    <!-- Include js-xlsx library from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-xlsx/0.17.0/xlsx.core.min.js"></script>

    <!-- Include tableexport.min.js from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.min.js"></script>

    <script src="js/kitchen_int.js"></script>
    <script src="js/pdfMake.js"></script>
    <script>
        $(document).ready(function()
        {
            const stockdata= new Stock_table();
            stockdata.searchdata();
            $('#pdfgenerate').on('click',function()
            {
                const pdf= new pdfMake();
                var header="Store Stock From ";
                var save="Store-stock";
                columns=[
                    { dataKey: 'Sl.No'},
                    { dataKey: 'Item Name'},
                    { dataKey: 'Unit'},
                    { dataKey: 'Avg Unit Price'},
                    { dataKey: 'Opening'},
                    { dataKey: 'Purchase'},
                    { dataKey: 'Total'},
                    { dataKey: 'Issued'},
                    { dataKey: 'Total'},
                    { dataKey: 'Return'},
                    { dataKey: 'Total'},
                    { dataKey: 'Wastage'},
                    { dataKey: 'Total'},
                    { dataKey: 'Closing'},
                    { dataKey: 'Total'},
                    ];

                jsonArray=[
                        {halign: "left" },
                        {halign: "left" },
                        {halign: "left" },
                        {halign: "right" },
                        {halign: "right" },
                        {halign: "right" },
                        {halign: "right" },
                        {halign: "right" },
                        {halign: "right" },
                        {halign: "right" },
                        {halign: "right" },
                        {halign: "right" },
                        {halign: "right" },
                        {halign: "right" },
                        {halign: "right" },
                    ];
                pdf.generate(columns,header,save,jsonArray);
            });

            $('#wastage').on('input',function()
            {
                var value = $('#wastage').val();
                value = value.replace(/[^0-9.]/g, '');
                value = value.replace(/(\.[^.]*)\./g, '$1');
                tdValue = parseFloat($('#closingStock').val());
                if (isNaN(value)) {
                    value = 0;
                } else if (value > tdValue) {
                    value = tdValue;
                }
                $('#wastage').val(value);
            });
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
                // console.log(log);
            }
        </script>
        <!-- <script>
            function generateTable() 
            {
                var fdate=$('#fdate').val();
                var tdate=$('#tdate').val();
                var y = 20;
                var doc = new jsPDF({
                    unit: 'pt',
                    format: 'A4',
                    putOnlyUsedFonts: true,
                    orientation: 'p',
                    margin: 0,
                });
                doc.setLineWidth(2);
                doc.text(150, y = y + 10, "Store Stock From "+fdate+" To "+tdate);
                doc.autoTable({
                    margin: {top: 40, left: 10, right: 10, bottom: 20},
                    html: '#example1',
                    theme: 'grid',
                    columns: [
                        {dataKey: 'Sl'},
                        {dataKey: 'Item Name'},
                        {dataKey: 'Unit'},
                        {dataKey:'Avg Unit Price'},
                        {dataKey:'Opening'},
                        {dataKey:'Purchase'},
                        {dataKey:'Total'},
                        {dataKey:'Issued'},
                        {dataKey:'Total'},
                        {dataKey:'Return'},
                        {dataKey:'Total'},
                        {dataKey:'Wastage'},
                        {dataKey:'Total'},
                        {dataKey:'Closing'},
                        {dataKey:'Total'},
                    ],
                    styles: {
                        overflow: 'linebreak',
                        lineWidth: 1,
                        fontSize: 7,
                        cellPadding: {horizontal: 4, vertical: 2},
                        textColor: [0, 0, 0],
                    },
                    headerStyles: {
                        fillColor: [128, 128, 128],
                        textColor: [255, 255, 255],
                        fontSize: 8,
                        lineWidth: 1,
                    },
                    footStyles: {
                        fontSize: 8,
                        fillColor: [128, 128, 128],
                        textColor: [255, 255, 255],
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
                //     pageSize: 'A4',
                // });
                doc.save('store_stock');
            }
        </script> -->
</body>