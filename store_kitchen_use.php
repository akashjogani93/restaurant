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
</style>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Kitchen Store
            </h1>
            </br>
            <?php include('kitchenbutton.html'); ?>
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
                        <h3 class="box-title">View Stock</h3>
                    </div>
                    <div class="box-body tablebox">
                        <table id="example1" class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Slno</th>
                                    <th>Item Name</th>
                                    <th>Unit</th>
                                    <th>Opening Stock</th>
                                    <th>Purchase Stock</th>
                                    <th>Issued Stock</th>
                                    <th>Return Stock</th>
                                    <th>Cloasing Stock</th>
                                    <th>Use/Return</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in kitchenstock" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.unit }}</td>
                                    <td>{{ item.openingStock }}</td>
                                    <td>{{ item.stocksum }}</td>
                                    <td>{{ item.issued }}</td>
                                    <td>{{ item.retur }}</td>
                                    <td>{{ item.cloasing }}</td>
                                    <td>
                                        <button class="btn btn-success" @click="handleIssued(index)">Issued</button>
                                        <button class="btn btn-info" @click="handleReturn(index)">Return</button>
                                    </td>
                                </tr>
                            </tbody>
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
                <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true">
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
            const kitchen= new Kitchen();
            $('#issued').on('input',function()
            {
                var value = $('#issued').val();
                value = value.replace(/[^0-9.]/g, '');
                value = value.replace(/(\..*)\./g, '$1');
                tdValue = parseFloat($('#closingStock').val());

                value = parseFloat(value);
                if (value > tdValue) 
                {
                    value = tdValue;
                }
                $('#issued').val(value);
            });
            $('#return').on('input',function()
            {
                var value = $('#return').val();
                value = value.replace(/[^0-9.]/g, '');
                value = value.replace(/(\..*)\./g, '$1');
                tdValue = parseFloat($('#returnStock').val());

                value = parseFloat(value);

                if (value > tdValue) 
                {
                    value = tdValue;
                }
                $('#return').val(value);
            });
        });
    </script>

        <script>
            function exportTableToPdf1() {
                var table = document.getElementById("example1");

                var clonedTable = table.cloneNode(true);
                applyStylesToTable(clonedTable);
                html2pdf(clonedTable, {
                    margin: 3,
                    filename: 'table.pdf',
                    html2canvas: { scale: 2 },
                    jsPDF: {
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'portrait',
                    },
                    pagebreak: { avoid: '#example1', mode: 'css' },
                    repeat: {
                        after: clonedTable.getElementsByTagName('thead')[0],
                        every: 1, // Repeat after every page
                    },
                }).then(() => {
                    removeStylesFromTable(clonedTable);
                });
            }
            function applyStylesToTable(table) 
            {
                var headers = table.querySelectorAll('th');
                headers.forEach(function(header) {
                    header.style.fontSize = '8px';
                    header.style.fontWeight = 'bold';
                    header.style.padding = '2px';
                });

                var cells = table.querySelectorAll('td');
                cells.forEach(function(cell) {
                    cell.style.fontSize = '8px';
                    cell.style.padding = '2px';
                    cell.style.fontWeight = 'normal';
                });

                var wastageButtons = table.querySelectorAll('.btn-info');
                wastageButtons.forEach(function(button) {
                    button.parentNode.style.display = 'none';
                });

                var wastageHeaderText = 'Use';
                headers.forEach(function(header) {
                    if (header.innerText.trim() === wastageHeaderText) {
                        header.style.display = 'none';
                    }
                });
            }

            function removeStylesFromTable(table) {
                var headers = table.querySelectorAll('th');
                headers.forEach(function(header) {
                    header.style.removeProperty('padding');
                });

                var cells = table.querySelectorAll('td');
                cells.forEach(function(cell) {
                    cell.style.removeProperty('padding');
                });

                var wastageButtons = table.querySelectorAll('.btn-info');
                wastageButtons.forEach(function(button) {
                });

                var wastageHeaderText = 'Use';
                headers.forEach(function(header) {
                    if (header.innerText.trim() === wastageHeaderText) {
                        header.style.display = '';
                    }
                });
            }
        </script>
</body>