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
                                    <div class="form-group col-md-4">
                                        <button class="btn btn-danger" onclick="exportTableToPdf1()">PDF</button>
                                        <button class="btn btn-success">Excel</button>
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
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th>Opening Stock</th>
                                    <th>Unit</th>
                                    <th>Issued Stock</th>
                                    <th>Remain Qty</th>
                                    <th>Use</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in kitchenstock_all" :key="item.id">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.pname }}</td>
                                    <td>{{ item.qty }}</td>
                                    <td>{{ item.unit }}</td>
                                    <td>{{ item.issuedqty }}</td>
                                    <td class="td-class">{{ item.remain }}</td>
                                    <td>
                                        <div style="display:flex;">
                                            <input type="text" name="inputTag" class="form-control" placeholder="Kitchen use Qty" style="width: 40%; margin-right:10px;" oninput="validateInput(this)">
                                            <button class="btn btn-info" onclick="getDataFromRow(this)">Use</button>
                                        </div>
                                    </td>
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
            const kitchen= new Kitchen();
        });
        function validateInput(input)
        {
            // console.log('running')
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
                    use_id: rowData[0],
                    use_remain: rowData[5],
                    use_value: inputValue,
                },
                success: function(response) 
                {
                    console.log(log);
                    location.reload();
                },
                error: function(xhr, status, error) 
                {
                    console.error(error);
                }
            });
        }
    </script>

        <script>
            function exportTableToPdf1()
            {
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