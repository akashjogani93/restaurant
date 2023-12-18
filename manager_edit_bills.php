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
        .table>thead,.table>tfoot
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
        #dailysale{
            background: green;
        }
        @media (min-width: 768px){
        .modal-dialog {
            width: 1000px !important; /* Adjust the percentage as needed */
        }}
    </style>
    <script src="js/reports.js"></script>
    <div class="content-wrapper">
        <section class="content">
            <h3 class="top-headerMain">Daily Sales</h3>
                <?php include('buttons.html'); ?>
            <div class="box box-primary">
                <div class="box-body form1">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="inputEmail3" class="control-label">Invoice From</label>
                            <select name="typ" id="typ" class="form-control">  
                                <option>All</option>
                                <option>Table</option>
                                <option>Parcel</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail3" class="control-label">From Date</label>
                            <input type="date" class="form-control pull-right" name="fdate" id="fdate">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail3" class="control-label">To Date</label>
                            <input type="date" class="form-control pull-right" name="tdate" id="tdate">
                        </div>
                        <div class="form-group col-md-3">
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
                        <div class="col-md-12" id="">
                            <div id="mainData">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl custom-width">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Invoice</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-header">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Invoice Number</label>
                                        <input type="text" class="form-control" id="editSlno" readonly>
                                    </div>
                                </div></br>
                                <div class="row">
                                    <div class="col-md-12">
                                    <table class="table" id="editTable">
                                        <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Qty</th>
                                                <th>Prc</th>
                                                <th>Tot</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <script src="html2pdf.js-master/dist/html2pdf.bundle.min.js"></script> -->
        <script>
            $(document).ready(function()
            {
                const day_sales=new Reports();
                day_sales.day_sales();
                $('#search').on('click',function()
                {
                    day_sales.day_sales();
                });

                $('#typ').on('change', function() {
                    day_sales.day_sales();
                });

                
                $(document).on("click", ".edit-btn", function() 
                {
                    var billno = $(this).closest('tr').find('td:eq(1)').text();
                    let billdata=[];
                    localStorage.removeItem('billData');
                    let log=$.ajax({
                            type: "post",
                            url: "ajax/reports.php",
                            dataType: 'json',
                            data: {
                                billno: billno,
                            },
                            cache: false,
                            success:function(status)
                            {
                                billdata = status;
                                updateModal(billdata);
                            }
                        });
                });

                $("#kotdata tbody").on('dblclick', 'tr', function() 
                {
                    var currow = $(this).closest('tr');
                    var item_id = currow.find('td:eq(1)').html();
                    window.location.href = 'finalInvoice.php?billno='+item_id+"&back=0";
                });

                $(document).on("click", ".delete-btn", function() {
                    var storedData = JSON.parse(localStorage.getItem('billData')) || { items: [] };
                    var indexToDelete = $(this).data('index');
                    storedData.items.splice(indexToDelete, 1);

                    // Check if no more items, then hide modal or provide indication
                    if (storedData.items.length === 0) 
                    {
                        $('.bd-example-modal-xl').modal('hide');
                    } else {
                        updateModal(storedData);
                    }
                });

                $(document).on("click", ".quantity-btn", function() {
                    var storedData = JSON.parse(localStorage.getItem('billData')) || { items: [] };
                    var indexToUpdate = $(this).data('index');
                    var action = $(this).data('action');

                    if (action === 'increase') {
                        storedData.items[indexToUpdate].qty++;
                    } else if (action === 'decrease' && storedData.items[indexToUpdate].qty > 0) {
                        storedData.items[indexToUpdate].qty--;
                    }

                    storedData.items[indexToUpdate].tot = storedData.items[indexToUpdate].qty * storedData.items[indexToUpdate].prc;
                    updateModal(storedData);
                });

                $('#saveChanges').on('click',function()
                {
                    var storedData = JSON.parse(localStorage.getItem('billData'));
                    let log=$.ajax({
                            type: "post",
                            url: "ajax/reports.php",
                            dataType: 'json',
                            data: {
                                storedData: storedData,
                            },
                            cache: false,
                            success:function(status)
                            {
                                console.log(status);
                            }
                        });
                    console.log(log);
                });
            });

            function updateModal(data) 
            {
                localStorage.setItem('billData', JSON.stringify(data));
                var tbody = $('#editTable tbody');
                tbody.empty();
                var billno = data.billno;
                $('#editSlno').val(billno);
                var totalSum = 0;
                data.items.forEach(function(item, index)
                {
                    var totValue = parseFloat(item.tot);
                    var qty = parseFloat(item.qty);
                    var row = '<tr>' +
                                    '<td>' + item.itmnam + '</td>' +
                                    '<td>' + 
                                        '<button class="quantity-btn" data-action="decrease" data-index="' + index + '"> - </button>&nbsp;&nbsp;' +
                                        '<span class="quantity">' + qty + '</span>&nbsp;&nbsp;' +
                                        '<button class="quantity-btn" data-action="increase" data-index="' + index + '"> + </button>&nbsp;&nbsp;' +
                                    '</td>' +
                                    '<td>' + item.prc + '</td>' +
                                    '<td>' + totValue + '</td>' +
                                    '<td><button class="delete-btn" data-index="' + index + '">Delete</button></td>' +
                                '</tr>';
                    totalSum += totValue; 
                    tbody.append(row);
                });
                var sumRow = '<tr>' +
                        '<td colspan="2"></td>' +
                        '<td colspan="2"><strong>Total:</strong></td>' +
                        '<td>' + totalSum + '</td>' +
                        '</tr>';
                    tbody.append(sumRow);
                $('.bd-example-modal-xl').modal('show');
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
                doc.text(150, y = y + 10, "Day Food Sale Invoice From "+fdate+" To "+tdate);
                doc.autoTable({
                    html: '#dayinvoices',
                    startY: 40,
                    startX: 40,
                    theme: 'grid',
                    columns: [
                        {dataKey: 'Invoice Date'},
                        {dataKey: 'Invoice Number'},
                        {dataKey: 'Gross Amount'},
                        {dataKey: 'Discount'},
                        {dataKey: 'GST Amount'},
                        {dataKey: 'Round Off(-)'},
                        {dataKey: 'Round Off(+)'},
                        {dataKey: 'Net Amount'},
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
                    footStyles: {
                        fontSize: 8,
                        fillColor: [128, 128, 128],
                        textColor: [255, 255, 255],
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
                doc.save('day_sale');
            }
        </script>
    </div>
</body>