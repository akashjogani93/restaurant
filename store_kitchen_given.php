<?php require_once("header.php"); ?>
<?php require_once("dbcon.php"); ?>
<style>
    .error 
    {
        color: red;
    }
</style>
<body class="hold-transition skin-blue sidebar-mini">
    <div id="app">
        <div class="wrapper" id="form1"></div>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Kitchen Inventory
                </h1>
                </br>
                <?php include('kitchenbutton.html'); ?>
                <!-- <button class="btn">View</button> -->
            </section>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="control-label">Select Category</label>
                                        <select name="catename" id="catename" required class="form-control pname" v-model="categoryOption" @change="categoryChange">
                                            <option value="">Select Category</option>
                                            <option v-for="option in categorys" :value="option.category">{{ option.category }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="control-label">Product Name</label>
                                        <select name="pname" id="pid" required class="form-control pname" v-model="selectedOption" onchange="getProductDetails(this.value)">
                                            <option value="">Select Products</option>
                                            <option v-for="option in options" :value="option.pid">{{ option.pname }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="control-label">Sell Unit</label>
                                        <input type="text" class="form-control" name="sellunit" id="sellunit" readonly="readonly" placeholder="sellunit"> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="control-label">Stock</label>
                                        <input type="text" class="form-control" name="sellqty" id="sellqty" readonly="readonly" placeholder="Quantity">
                                        <input type="hidden" class="form-control" name="perCaseQty" id="perCaseQty" readonly="readonly" placeholder="perCaseQty">
                                        <input type="hidden" class="form-control" name="perCaseQty" id="stockid" readonly="readonly" placeholder="perCaseQty">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="control-label">Kitchen Qty</label>
                                        <input type="text" class="form-control" name="pqty" id="uqty" placeholder="Kitchen Qty">
                                    </div>
                                    <!-- <div class="form-group col-md-3">
                                        <label for="inputEmail3" class="control-label">Remain Stock</label>
                                        <input type="number" class="form-control" name="pqty" id="rqty" placeholder="Remain Quantity" readonly="readonly">
                                    </div> -->
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="control-label">Given Date</label>
                                        <input type="date" class="form-control" name="purdate" id="gdate" placeholder="Purchased Date">
                                    </div>
                                </div>
                                </br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <center>
                        <button type="button" class="btn btn-primary" onclick="addToKitchen()">Add</button>
                    </center>
                </div>
            </section>
        </div>
    </div>
    <script src="vue.min.js"></script>
    <script src="cdn/dataTables.buttons.min.js"></script>
    <script src="cdn/buttons.print.min.js"></script>
    <script src="js/kitchen_int.js"></script>
    <script>
        function validateInput(input)
        {
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
        function getProductDetails(pid)
        {
            $("#pid").css("border-color", "");
            let log=$.ajax({
                url: 'ajax/store_all.php',
                method: 'POST',
                datatype:'JSON',
                data: {
                    productKitchenChange: pid
                },
                success(response)
                {
                    $('#sellunit').val(response[0].sellunit);
                    $('#sellqty').val(response[0].netStock);

                    // var sellqty= response[0].qty;
                    // var sellqty=response[0].remain;
                    // $('#sellunit').val(response[0].sellunit);
                    // $('#sellqty').val(response[0].perCaseQty*response[0].remain);
                    // $('#rqty').val(response[0].perCaseQty*response[0].remain);
                    // $('#perCaseQty').val(response[0].perCaseQty);
                    // $('#stockid').val(response[0].pid)
                }
            });
        }
    </script>
    <script>
        $(document).ready(function()
        {
            const kitchen= new Kitchen();

            $('input').on('focus',function()
            {
                $("#pid").css("border-color", "");
            });
            var yourDateValue = new Date();
            var formattedDate = yourDateValue.toISOString().substr(0, 10)
            $('#gdate').val(formattedDate);
            // $('#fdate').val(formattedDate);
            // $('#tdate').val(formattedDate);

            $('#uqty').on('input', function ()
            {
                let totalqty=$('#sellqty').val();
                // let rqty=$('#rqty').val();

                let inputValue = $(this).val();
                // let regex = /^[0-9]*\.?[0-9]+$/;
                let regex = /^\d*\.?\d*$/;

                switch (true) 
                {
                    case !regex.test(inputValue):
                        $(this).val('');
                        // $('#rqty').val(totalqty);
                        break;
                    // case totalqty && parseFloat(inputValue) > parseFloat(totalqty):
                    //     $(this).val(totalqty);
                    //     $('#rqty').val(0);
                    //     break;
                    case !totalqty:
                        $(this).val('');
                        $("#pid").css("border-color", "red");
                        // $("#catename").css("border-color", "red");
                        break;
                    // default:
                        // $('#rqty').val((totalqty-inputValue).toFixed(2));
                        // break;
                }
            });
        });

        function addToKitchen()
        {
            let catename=$('#catename').val();
            let pid=$('#pid').val();
            let pname = $('#pid option:selected').text();
            let sellunit=$('#sellunit').val();
            let totalqty=$('#sellqty').val();
            // let rqty=$('#rqty').val();
            let uqty=$('#uqty').val();

            let gdate=$('#gdate').val();
            // let perCaseQty=$('#perCaseQty').val();
        //    let stockid =$('#stockid').val()
           
            let input=['#pid','#sellqty','#sellunit','#uqty'];
            $('.input-field').css('border-color', '');
            switch (true) 
            {
                case !catename:
                    $('#catename').css('border-color', 'red');
                    break;
                case !pid:
                    $('#pid').css('border-color', 'red');
                    break;
                case !totalqty:
                    $('#pqty').css('border-color', 'red');
                    break;
                case !sellunit:
                    $('#punit').css('border-color', 'red');
                    break;
                case !uqty:
                    $('#uqty').css('border-color', 'red');
                    break;
                case !gdate:
                    $('#gdate').css('border-color', 'red');
                    break;
                case totalqty==0:
                    alert('Please Add Stock First');
                    $('#sellqty').css('border-color', 'red');
                    break;
                default:
                    let log= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data: {
                            pid: pid,
                            // pname: pname,
                            pqty: totalqty,
                            punit: sellunit,
                            // rqty: rqty,
                            uqty: uqty,
                            gdate: gdate,
                            // perCaseQty: perCaseQty,
                            // catename:catename,
                            // stockid:stockid
                        },
                        success: function(response) 
                        {
                            // console.log(response);
                            // return;
                            alert(response);
                            for(i=0; input.length>i; i++)
                            {
                                $(input[i]).val('');
                            }
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                    break;
            }
        }
    </script>
</body>