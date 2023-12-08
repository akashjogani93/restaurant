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
    </style>
    <script src="js/store_report.js"></script>
    <div class="content-wrapper">
        <section class="content">
            <h3 class="top-headerMain">Purchase Assets</h3>
            <div class="box box-primary">
                <div class="box-body form1">
                    <div class="row">
                        <div class="col-md-9 assets">
                            <a class="btn btn-info buga" href="create_assets.php" style="margin-top:27px;">
                                Create Asset
                            </a>
                            <a class="btn btn-info buga" href="purchase_assets.php" style="margin-top:27px;">
                                Purchase
                            </a>
                            <a class="btn btn-info buga" href="stock_assets.php" style="margin-top:27px;">
                                View Stock
                            </a>
                            <a class="btn btn-info buga" href="damage_assets.php" style="margin-top:27px;">
                                Damage Stock
                            </a>
                            <a class="btn btn-success buga" href="purchaseRecord_assets.php" style="margin-top:27px;">
                                Purchase Records
                            </a>
                        </div>
                    </div></br>
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
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <!-- <th scope="col">Vendor Name</th>   -->
                                    <th scope="col">SL.No</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Amount</th>  
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
        <script src="html2pdf.js-master/dist/html2pdf.bundle.min.js"></script>
        <script>
            $(document).ready(function()
            {
                const purchase_report=new Reports();
                purchase_report.assets_data()

                $('#search').click(function()
                {
                    purchase_report.assets_data();
                });
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