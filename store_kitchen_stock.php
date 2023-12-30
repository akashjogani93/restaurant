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
        #kitchenhis{
            background: green;
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
                                            <button type="submit" name="view_report" class="btn btn-info" id="search" @click="kitchenHistory()">View</button>
                                            <button class="btn btn-danger" onclick="generateTable()">PDF</button>
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
                                    <th>Purchase Stock</th>
                                    <th>Issued Stock</th>
                                    <th>Return Stock</th>
                                    <th>Date</th>
                                    <!-- <th>Edit</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in kitchenpurchase" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.pname }}</td>
                                    <td>{{ item.sellunit }}</td>
                                    <td class="right-align">{{ formatNumber(item.stock) }}</td>
                                    <td class="right-align">{{ formatNumber(item.issued) }}</td>
                                    <td class="right-align">{{ formatNumber(item.stockreturn) }}</td>
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
        function generateTable() 
        {
            var fdate=$('#fdate').val();
            var tdate=$('#tdate').val();
            var doc = new jsPDF('p', 'pt', 'letter');
            var y = 20;
            doc.setLineWidth(2);
            doc.text(150, y = y + 10, "Kitchen History From "+fdate+" To "+tdate);
            doc.autoTable({
                html: '#example1',
                startY: 40,
                startX: 40,
                theme: 'grid',
                columns: [
                    {dataKey: 'Sl.No'},
                    {dataKey: 'Item Name'},
                    {dataKey: 'Unit'},
                    {dataKey: 'Purchase'},
                    {dataKey: 'Issued'},
                    {dataKey: 'Return Stock'},
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
            doc.save('kitchen_history');
        }
    </script>
</body>