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
        #monthsale{
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
                            <button class="btn btn-success" style="margin-top:23px;">SEARCH</button>
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
                        <table class="table" id="kotdata">
                            <thead class="thead-dark">
                                <!-- <tr>
                                    <th></th>
                                </tr> -->
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Invoice Number</th>
                                    <th scope="col">Gross Amount</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">C.GST</th>
                                    <th scope="col">S.GST</th>
                                    <th scope="col">Round Off(-)</th>  
                                    <th scope="col">Round Off(+)</th>
                                    <th scope="col">Net Amount</th>
                                </tr>
                            </thead>
                            <tbody id="monthData">
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
                day_sales.month_sales()
            });
            // function generatePDF() 
            // {
            //     console.log('running');
            //     const doc = new jsPDF();
            //     const table = document.getElementById("kotdata");
            //     doc.fromHTML(table, 15, 15);
            //     doc.save("table.pdf");
            // }
        </script>
        <script>
            function exportTableToPdf1() 
            {
                var table = document.getElementById("kotdata");
                console.log(table)
                var options = {
                    margin: 10,
                    filename: "table.pdf",
                    image: { type: "jpeg", quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: "mm", format: "a4", orientation: "portrait" },
                };
                html2pdf().from(table).set(options).outputPdf();
            }
        </script>
    </div>
</body>