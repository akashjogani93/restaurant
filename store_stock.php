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
            padding: 2px;
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
                                        <button class="btn btn-danger" style="margin-top:23px;" onclick="generateTable()">PDF</button>
                                        <button class="btn btn-success" style="margin-top:23px;" onclick="exportToExcel()">Excel</button>
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
                                    <th>Sl.No</th>
                                    <th>Item Name</th>
                                    <th>Unit</th>
                                    <th>Opening Stock</th>
                                    <th>Purchase</th>
                                    <th>Issued Stock</th>
                                    <th>Return</th>
                                    <th>Wastage Stock</th>
                                    <th>Closing Stock</th>
                                    <th>Wastage</th>
                                </tr>
                            </thead>
                            <tbody id="tableData">
                                <tr v-for="(item, index) in stockList" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.unit }}</td>
                                    <td>{{ item.openingStock }}</td>
                                    <td>{{ item.stocksum }}</td>
                                    <td>{{ item.issued }}</td>
                                    <td>{{ item.retur }}</td>
                                    <td>{{ item.wastage }}</td>
                                    <td>{{ item.cloasing }}</td>
                                    <td>
                                        <button class="btn btn-success" @click="handlewastage(index)">wastage</button>
                                    </td>
                                </tr>
                            </tbody>
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

    <!-- <script src="html2pdf.js/dist/html2pdf.bundle.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script> -->
    <!-- <script src="path/to/jspdf.plugin.autotable.min.js"></script> -->

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script> -->
    <!-- Include js-xlsx library from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-xlsx/0.17.0/xlsx.core.min.js"></script>

    <!-- Include tableexport.min.js from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.min.js"></script>

    <script src="js/kitchen_int.js"></script>
    <script>
        $(document).ready(function()
        {
            const stockdata= new Stock_table();
            stockdata.searchdata();

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
        <script>
            function generateTable() 
            {
                var fdate=$('#fdate').val();
                var tdate=$('#tdate').val();
                var doc = new jsPDF('p', 'pt', 'letter');
                var y = 20;
                doc.setLineWidth(2);
                doc.text(150, y = y + 10, "Store Stock From "+fdate+" To "+tdate);
                doc.autoTable({
                    html: '#example1',
                    startY: 40,
                    startX: 40,
                    theme: 'grid',
                    columns: [
                        {dataKey: 'Sl.No'},
                        {dataKey: 'Item Name'},
                        {dataKey: 'Unit'},
                        {dataKey: 'Opening Stock'},
                        {dataKey: 'Purchase'},
                        {dataKey: 'Issued Stock'},
                        {dataKey: 'Return'},
                        {dataKey: 'Wastage Stock'},
                        {dataKey: 'Closing Stock'},
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
                doc.save('store_stock');
            }

            function exportToExcel() {
                var table = document.getElementById("example1");
                TableExport(table, {
                    formats: ["xlsx"],
                    filename: "myTableData",
                    exportButtons: false
                });
            }
        </script>
</body>