<?php require_once("header.php");?>
<?php require_once("dbcon.php");?>
<style>
    .error {
        color: red;
    }
</style>
<body class="hold-transition skin-blue sidebar-mini">
    <div id="app">
        <div class="wrapper" id="form1"></div>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Beverages Inventory
                </h1>
            </section>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Name :</label>
                                        <div class="col-sm-8">
                                            <select name="pname" id="pid" required class="form-control pname" v-model="selectedOption" onchange="getProductDetails(this.value)">
                                                <option value="">Select Products</option>
                                                <option v-for="option in options" :value="option.id">{{ option.pname }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Sell Unit</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="sellunit" id="sellunit" readonly="readonly" placeholder="sellunit"> 
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Per Case Qty</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="sellqty" id="sellqty" readonly="readonly" placeholder="Quantity">
                                            <input type="hidden" class="form-control" name="perCaseQty" id="perCaseQty" readonly="readonly" placeholder="perCaseQty">
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Sell Qty</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="pqty" id="uqty" placeholder="Sell Qty">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Remain Qty</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="pqty" id="rqty" placeholder="Remain Quantity" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Given Date</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="purdate" id="gdate" placeholder="Purchased Date">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Price/Qty</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="price" id="price" placeholder="Price" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Total Price</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="total" id="total" placeholder="Total Amount" readonly="readonly">
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <center>
                        <button type="button" class="btn btn-primary" onclick="addToKitchen()">Sale</button>
                    </center>
                </div>
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="row">
                                    <form class="form-horizontal" method="post" action="store_beveragesSale.php">
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
                                        <div class="form-group col-md-1">
                                            <button type="submit" name="view_report" class="btn btn-info">View</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Beverages Sale</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Item Name</th>
                                    <th>Used Qty</th>
                                    <th>Item Unit</th>
                                    <th>Given Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if(!isset($_POST['view_report']))
                                    {
                                        $DATE=date('Y-m-d');
                                        $query1 = "SELECT * FROM `beverages` WHERE `givenDate` ='$DATE; '";
                                        $exc=mysqli_query($conn,$query1);
                                        $i=0;
                                        while ($row=mysqli_fetch_array($exc)) 
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $row['pname']; ?></td>
                                                <td class="td-class"><?php echo $row['uqty']; ?></td>
                                                <td class="td-unit"><?php echo $row['punit']; ?></td>
                                                <td><?php echo $row['givenDate']; ?></td>
                                            </tr>
                                            <!--  -->
                                            <?php
                                            $i++;
                                        }
                                    }else
                                    {
                                        $start=$_POST['from_date'];
                                        $end=$_POST['to_date'];
                                        $query1 = "SELECT * FROM `beverages` WHERE `givenDate` BETWEEN '$start' AND '$end'";
                                        $exc=mysqli_query($conn,$query1);
                                        $i=0;
                                        while ($row=mysqli_fetch_array($exc)) 
                                        {
                                            ?>
                                             <tr>
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $row['pname']; ?></td>
                                                <td class="td-class"><?php echo $row['uqty']; ?></td>
                                                <td class="td-unit"><?php echo $row['punit']; ?></td>
                                                <td><?php echo $row['givenDate']; ?></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="vue.min.js"></script>
    <script src="js/kitchen_int.js"></script>
    <script src="cdn/dataTables.buttons.min.js"></script>
    <script src="cdn/buttons.print.min.js"></script>
    <script>
        function getProductDetails(pid)
        {
            $("#pid").css("border-color", "");
            $.ajax({
                url: 'ajax/store_all.php',
                method: 'POST',
                datatype:'JSON',
                data: {
                    productId: pid
                },
                success(response) 
                {
                    $('#sellunit').val(response[0].sellunit);
                    // $('#price').val(response[0].perCase);
                    $('#sellqty').val(response[0].perCaseQty*response[0].qty);
                    $('#rqty').val(response[0].perCaseQty*response[0].qty);
                    $('#perCaseQty').val(response[0].perCaseQty);
                    // console.log(response.total);
                }
            });
        }

        function addToKitchen()
        {
            let pid=$('#pid').val();
            let pname = $('#pid option:selected').text();
            let sellunit=$('#sellunit').val();
            let totalqty=$('#sellqty').val();
            let rqty=$('#rqty').val();
            let uqty=$('#uqty').val();

            let gdate=$('#gdate').val();
            // let price=$('#price').val();
            // let total=$('#total').val();
            // let pqty=$('#pqty').val();
            // let punit=$('#punit').val();
            let perCaseQty=$('#perCaseQty').val();
         
           
            let input=['#pid','#sellqty','#sellunit','#rqty','#uqty'];
            switch (true) 
            {
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
                case !rqty:
                    $('#rqty').css('border-color', 'red');
                    break;
                case !gdate:
                    $('#gdate').css('border-color', 'red');
                    break;
                // case !price:
                //     $('#price').css('border-color', 'red');
                //     break;
                // case !total:
                //     $('#total').css('border-color', 'red');
                    break;
                default:
                   let log= $.ajax({
                        url: 'ajax/store_all.php',
                        method: 'POST',
                        data: {
                            pid1: pid,
                            pname: pname,
                            pqty: totalqty,
                            punit: sellunit,
                            rqty: rqty,
                            uqty: uqty,
                            gdate: gdate,
                            // price: price,
                            // total: total,
                            perCaseQty: perCaseQty
                        },
                        success: function(response) 
                        {
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
                    console.log(log);
                    break;
            }
        }

        $(document).ready(function()
        {
            const bev = new Beaverages();

            var yourDateValue = new Date();
            var formattedDate = yourDateValue.toISOString().substr(0, 10)
            $('#gdate').val(formattedDate);
            $('#uqty').on('input', function () 
            {
                let totalqty=$('#sellqty').val();
                let rqty=$('#rqty').val();

                // let price=$('#price').val();
                let inputValue = $(this).val();
                let regex = /^[0-9]*\.?[0-9]+$/;
               switch (true) 
               {
                    case !regex.test(inputValue):
                        $(this).val('');
                        $('#rqty').val(totalqty);
                        break;
                    case totalqty && parseFloat(inputValue) > parseFloat(totalqty):
                        $(this).val(totalqty);
                        $('#rqty').val(0);
                        break;
                    case !totalqty:
                        $(this).val('');
                        $("#pid").css("border-color", "red");
                        break;
                    default:
                        $('#rqty').val((totalqty-inputValue).toFixed(2));
                        // $('#total').val((inputValue*price).toFixed(2));
                        break;
                }
            });
        });  
    </script>
</body>