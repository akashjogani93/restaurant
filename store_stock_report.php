<?php
    require_once("header.php"); 
?>
<body class="hold-transition skin-blue sidebar-mini">
    <style>
        .top-headerMain
        {
            margin-top:0;
        }
        .shourtcuts{
            display:flex;
            margin-bottom:10px;
        }
        .shourtcuts > p{
            margin:0 20px;
            text-align:center;
            font-size:11px;
        }
        label{
            font-size:12px;
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
    <script src="js/store_report.js"></script>
    <div class="content-wrapper">
        <section class="content">
            <h3 class="top-headerMain">Purchase Report</h3>
            <div class="box box-primary">
                <div class="box-body form1">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail3" class="control-label">From Date</label>
                            <input type="date" class="form-control pull-right" name="fdate" id="fdate">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail3" class="control-label">To Date</label>
                            <input type="date" class="form-control pull-right" name="tdate" id="tdate">
                        </div>
                        <div class="form-group col-md-4">
                            <button class="btn btn-success" style="margin-top:23px;" id="search">SEARCH</button>
                            <button class="btn btn-danger" style="margin-top:23px;" onclick="exportTableToPdf1()">PDF</button>
                            <button class="btn btn-success" style="margin-top:23px;">Excel</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-body form1">
                    <div class="row">
                        <div class="col-md-12">
                        <table class="table" id="purchaseStore">
                            <thead class="thead-dark">
                                <tr>
                                    <!-- <th scope="col">Vendor Name</th>   -->
                                    <th scope="col">SL.No</th>
                                    <th scope="col">Bill No</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Pname</th>
                                    <th scope="col">Unit</th>  
                                    <th scope="col">Qty</th>  
                                    <th scope="col">Price</th>
                                    <th scope="col">Gross Amount</th>
                                    <th scope="col">Disc</th>
                                    <th scope="col">Tax</th>
                                    <th scope="col">Cess</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody id="kotdata">
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="html2pdf.js/dist/jspdf.min.js"></script>
        <!-- <script src="path/to/jspdf.plugin.autotable.min.js"></script> -->
        <script>
            $(document).ready(function()
            {
                const purchase_report=new Reports();
                purchase_report.store_data();
                $('#search').click(function()
                {
                    purchase_report.store_data();
                });
            });
        </script>
        <script>
            function exportTableToPdf1() {
                var table = document.getElementById("purchaseStore");

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
                    pagebreak: { avoid: '#purchaseStore', mode: 'css' },
                    repeat: {
                        after: clonedTable.getElementsByTagName('thead')[0],
                        every: 1, // Repeat after every page
                    },
                }).then(() => {
                    // Remove the styles after PDF generation
                    removeStylesFromTable(clonedTable);
                });
            }
        function applyStylesToTable(table) 
        {
            // Apply padding to the headers
            var headers = table.querySelectorAll('th');
            headers.forEach(function(header) {
                header.style.fontSize = '8px';
                header.style.fontWeight = 'bold';
                header.style.padding = '2px';
            });
            // Apply padding to the cells
            var cells = table.querySelectorAll('td');
            cells.forEach(function(cell) {
                cell.style.fontSize = '8px';
                cell.style.padding = '2px';
                cell.style.fontWeight = 'normal';
            });
        }

        function removeStylesFromTable(table) {
            // Remove padding from the headers
            var headers = table.querySelectorAll('th');
            headers.forEach(function(header) {
                header.style.removeProperty('padding');
            });

            // Remove padding from the cells
            var cells = table.querySelectorAll('td');
            cells.forEach(function(cell) {
                cell.style.removeProperty('padding');
            });
        }
        </script>
</body>