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
                                    <div class="form-group col-md-4">
                                        <button class="btn btn-danger" onclick="exportTableToPdf1()" style="margin-top:23px;">PDF</button>
                                        <button class="btn btn-success"  style="margin-top:23px;">Excel</button>
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
                                    <th>Sl No</th>
                                    <th>Item name</th>
                                    <th>Qty</th>
                                    <th>Item unit</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in stockList" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.pname }}</td>
                                    <td>{{ item.qty }}</td>
                                    <td>{{ item.sellunit }}</td>
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
            const wastage= new Wastage();
        });
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

                // var wastageButtons = table.querySelectorAll('.btn-info');
                // wastageButtons.forEach(function(button) {
                //     button.parentNode.style.display = 'none';
                // });

                // var wastageHeaderText = 'Retun';
                // headers.forEach(function(header) {
                //     if (header.innerText.trim() === wastageHeaderText) {
                //         header.style.display = 'none';
                //     }
                // });
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

                // var wastageButtons = table.querySelectorAll('.btn-info');
                // wastageButtons.forEach(function(button) {
                // });

                // var wastageHeaderText = 'Retun';
                // headers.forEach(function(header) {
                //     if (header.innerText.trim() === wastageHeaderText) {
                //         header.style.display = '';
                //     }
                // });
            }
        </script>
</body>