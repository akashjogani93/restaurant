<?php
    require_once("header.php"); 
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
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
        #dayfoodsale{
            background: green;
        }
    </style>
    <script src="js/reports.js"></script>
    <div class="content-wrapper">
        <section class="content">
            <h3 class="top-headerMain">Month Sales</h3>
            <?php include('buttons.html'); ?>
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
                            <button class="btn btn-danger" style="margin-top:23px;" onclick="generateTable()">PDF</button>
                            <button class="btn btn-danger" style="margin-top:23px;" onclick="printTable()">Print</button>
                            <!-- <button class="btn btn-success" style="margin-top:23px;">Excel</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-body form1">
                    <div class="row">
                        <div class="col-md-12">
                        <table class="table" id="dayMenusale">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Menu Item Code</th>
                                    <th scope="col">Menu Item Name</th>
                                    <th scope="col">Quantity</th>
                                </tr>
                            </thead>
                            <tbody id="menuqtySale">
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="html2pdf.js-master/dist/html2pdf.bundle.min.js"></script>
        <script>
            $(document).ready(function()
            {
                const day_sales=new Reports();
                day_sales.menu_Qty()

                $('#search').on('click',function()
                {
                    day_sales.menu_Qty()
                });
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
                doc.text(150, y = y + 10, "Food Sale Qty From "+fdate+" To "+tdate);
                doc.autoTable({
                    html: '#dayMenusale',
                    startY: 40,
                    startX: 40,
                    theme: 'grid',
                    columns: [
                        {dataKey: 'Menu Item Code'},
                        {dataKey: 'Menu Item Name'},
                        {dataKey: 'Quantity'},
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
                    // footStyles: {
                    //     fontSize: 8,
                    //     fillColor: [128, 128, 128],
                    //     textColor: [255, 255, 255],
                    //     lineWidth: 1,
                    // },
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
                doc.save('food_sale');
            }
        </script>

        <script>
            function printTable() 
            {
                var fdate = $('#fdate').val();
                var tdate = $('#tdate').val();
                var tableToPrint = document.getElementById('dayMenusale');

                if (tableToPrint) {
                    // Create a new window
                    var printWindow = window.open('', '_blank');

                    // Create a style element with print-specific styles
                    var printStyles = `
                        body {
                            margin: 2px;
                            text-align: center;
                            font-family: 'Roboto Mono', monospace;
                        }
                        @page {
                            size: auto;
                            margin: 0;
                            /* Hide date and time */
                            @bottom-right {
                                content: '';
                            }
                        }
                        h6 {
                            font-size: 10px;
                            font-weight: bold;
                            margin-bottom: 5px;
                            text-align: center; /* Center the h6 element */
                        }
                        table {
                            border-collapse: collapse;
                            width: 90%; /* Adjust the width as needed */
                            margin: 0 auto; /* Center the table */
                        }
                        table>thead>tr>th {
                            font-weight: 500;
                            color:black;
                        }
                        th, td {
                            border: 1px solid #dddddd;
                            text-align: left;
                            padding: 3px;
                            font-size: 10px;
                            font-weight: 500;
                        }

                        td:last-child, th:last-child
                        {
                            text-align: right; /* Right-align the content in the last column */
                        }
                    `;

                    printWindow.document.write(`<html><head><title>Print</title><style>${printStyles}</style></head><body>`);
                    printWindow.document.write(`<h6>Date ${fdate} TO ${tdate}</h6>`);
                    printWindow.document.write(tableToPrint.outerHTML);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.print();
                } else {
                    console.error('Table with ID dayinvoices not found.');
                }
            }
        </script>
    </div>
</body>