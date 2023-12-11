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
            function generateTable() 
            {
                var fdate=$('#fdate').val();
                var tdate=$('#tdate').val();
                var doc = new jsPDF('p', 'pt', 'letter');
                var y = 20;
                doc.setLineWidth(2);
                doc.text(150, y = y + 10, "Purchase Stock From "+fdate+" To "+tdate);
                doc.autoTable({
                    html: '#purchaseStore',
                    startY: 40,
                    startX: 40,
                    theme: 'grid',
                    columns: [
                        {dataKey: 'Sl.No'},
                        {dataKey: 'Bill No'},
                        {dataKey: 'Category'},
                        {dataKey: 'Pname'},
                        {dataKey: 'Unit'},
                        {dataKey: 'Qty'},
                        {dataKey: 'Price'},
                        {dataKey: 'Gross Amount'},
                        {dataKey: 'Disc'},
                        {dataKey: 'Tax'},
                        {dataKey: 'Cess'},
                        {dataKey: 'Total'},
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
                doc.save('purchase_stock');
            }
        </script>
</body>