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
                                                <option value="">Select Beverages</option>
                                                <option v-for="option in options" :value="option.id">{{ option.pname }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Qty :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="pqty" id="pqty" readonly="readonly" placeholder="Quantity">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Unit :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="punit" id="punit" readonly="readonly" placeholder="Unit">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Sale Qty</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="pqty" id="uqty" placeholder="Kitchen Qty">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Remain Qty</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="pqty" id="rqty" placeholder="Remain Quantity" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Sale Date</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="purdate" id="gdate" placeholder="Purchased Date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <center>
                        <button type="button" class="btn btn-primary" onclick="addToKitchen()">Sale</button>
                    </center>
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
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="cdn/dataTables.buttons.min.js"></script>
    <script src="cdn/buttons.print.min.js"></script>
    <script>
        function getProductDetails(pid)
        {
            $("#pid").css("border-color", "");
            let log=$.ajax({
                url: 'ajax/fetch_product_details.php',
                method: 'POST',
                datatype:'JSON',
                data: {
                    productId: pid
                },
                success(response) 
                {
                    $('#pqty').val(response.qty);
                    $('#punit').val(response.unit);
                }
            });
        }

        function addToKitchen()
        {
            // alert('running');
            let pid=$('#pid').val();
            let pname = $('#pid option:selected').text();
            let pqty=$('#pqty').val();
            let punit=$('#punit').val();
            let rqty=$('#rqty').val();
            let uqty=$('#uqty').val();
            let gdate=$('#gdate').val();
            let input=['#pid','#pqty','#punit','#rqty','#uqty'];
            $('.input-field').css('border-color', '');
            switch (true) 
            {
                case !pid:
                    $('#pid').css('border-color', 'red');
                    break;
                case !pqty:
                    $('#pqty').css('border-color', 'red');
                    break;
                case !punit:
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
                default:
                   let log= $.ajax({
                        url: 'ajax/kitchen_stock.php',
                        method: 'POST',
                        data: {
                            pid1: pid,
                            pname: pname,
                            pqty: pqty,
                            punit: punit,
                            rqty: rqty,
                            uqty: uqty,
                            gdate: gdate
                        },
                        success: function(response) 
                        {
                            alert(response);
                            for(i=0; input.length>i; i++)
                            {
                                $(input[i]).val('');
                            }
                            window.location="beveragesSale.php";
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
            var yourDateValue = new Date();
            var formattedDate = yourDateValue.toISOString().substr(0, 10)
            // alert(formattedDate)
            $('#gdate').val(formattedDate);
            // $('#fdate').val(formattedDate);
            // $('#tdate').val(formattedDate);
            $('#uqty').on('input', function () 
            {
                let qty=$('#pqty').val();
                let rqty=$('#rqty').val();
                let inputValue = $(this).val();
                let regex = /^[0-9]*\.?[0-9]+$/;
                switch (true) 
                {
                    case !regex.test(inputValue):
                        $(this).val('');
                        break;
                    case qty && parseFloat(inputValue) > parseFloat(qty):
                        $(this).val(qty);
                        $('#rqty').val(0);
                        break;
                    case !qty:
                        $(this).val('');
                        $("#pid").css("border-color", "red");
                        break;
                    default:
                        $('#rqty').val(qty-inputValue);
                        break;
                }
            });
        });  

            var app= new Vue({
                el:'#app',
                data:{
                    options:[],
                    selectedOption:'',
                },
                methods:{
                    fetchOptions()
                    {
                        const vm=this;
                        $.ajax({
                            url: 'ajax/kitchen_fetch_options.php',
                            method: 'POST',
                            data:{bev:"bev"},
                            success(response) 
                            {
                                vm.options = response;
                            },
                            error(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }
                },
                mounted()
                {
                    this.fetchOptions();
                }
            });
    </script>
</body>