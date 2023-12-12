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
        .table>tfoot
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
        #dayfoodinv{
            background: green;
        }
    </style>
    <script src="js/reports.js"></script>
    <div class="content-wrapper">
        <section class="content">
            <h3 class="top-headerMain">Daily Sales</h3>
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
                            <button class="btn btn-success" style="margin-top:23px;">Excel</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-body form1">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="maintable"></div>
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
                day_sales.day_foodInvoice();
                $('#search').on('click',function()
                {
                    day_sales.day_foodInvoice();
                });
            });
        </script>
        <script>
            function generateTable() {
                var fdate = $('#fdate').val();
                var tdate = $('#tdate').val();
                var doc = new jsPDF('p', 'pt', 'letter');
                var y = 20;

                doc.setLineWidth(2);
                doc.text(150, y = y + 10, "Food Sale Table From " + fdate + " To " + tdate);

                // Iterate through each table with class 'table' inside 'maintable'
                $('#maintable .table').each(function (index) {
                    var currentTable = $(this);
                    var tableId = currentTable.attr('id');

                    // Only generate the table if it has an id
                    if (tableId) {
                        if (index > 0) {
                            y = doc.autoTable.previous.finalY + 10; // Set y to the bottom of the previous table plus spacing
                        }

                        var rowStyles = {
                            0: { fontStyle: 'bold', fillColor: [200, 200, 200], fontSize: 8 }, // Apply styles to the first row
                        };
                        doc.autoTable({
                            html: '#' + tableId, // Use the id of the current table
                            startY: y,
                            startX: 40,
                            theme: 'grid',
                            columns: [
                                { dataKey: 'Itme No' },
                                { dataKey: 'Item Name' },
                                { dataKey: 'Rate' },
                                { dataKey: 'Qty' },
                                { dataKey: 'Amount' },
                            ],
                            styles: {
                                overflow: 'linebreak',
                                lineWidth: 1,
                                fontSize: 8,
                                cellPadding: { horizontal: 5, vertical: 2 },
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
                            // didDrawCell: function (data) 
                            // {
                            //     var isInTbody = data.row.index !== 0 && $(data.cell.raw).closest('tbody').length > 0;
                            //     if (isInTbody) 
                            //     {
                            //         console.log(data.cell)
                            //         // Apply your styles or logic here for cells within the first row of tbody
                            //         data.cell.styles = {
                            //             // Your styles for tbody first row cells
                            //             fontStyle: 'bold',
                            //             fillColor: [200, 200, 200],
                            //             fontSize: 8,
                            //         };
                            //     }
                            // },
                        });
                    }
                });

                // Additional settings or modifications can be added here.

                doc.save('food_sale');
            }
        </script>
</body>