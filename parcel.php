<?php require_once("header.php"); ?>
<script type="text/javascript">
</script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->

<!-- <script src="cdn/jquery.min.js"></script>
    <link rel="stylesheet" href="cdn/jquery-ui.css">
    <script src="cdn/jquery-ui.min.js"></script> -->
<style>
.form1 .col-md-6 {
    padding-right: 2px;
    padding-left: 2px;
}

#add_order:focus {
    background-color:red;
}
.table-bordered {
    border: 1px solid #2a2a2a;
}
tr:nth-child(even) {
  background-color: #D6EEEE;
}
.boxx{
     height:65%;overflow-y:scroll;
}

input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    input[type="number"] 
    {
    /* For Firefox */
    -moz-appearance: number-input;
    /* For other browsers */
    appearance: textfield;
    }
</style>
</head>

<body class="hold-transition skin-blue sidebar-mini">

    <script type="text/javascript">
      $(function () {
        
        $("#autocomplete").autocomplete({
           
          source: function (request, response){
           let log= $.ajax({
              url: "ajax/fetchData.php",
              type: "post",
              dataType: "json",
              data: {
                search: request.term,
              },
              success: function (data){
                response(data);
                console.log(data);
              },
            });
            // console.log(log)
          },
          select: function (event, ui) {
            $("#autocomplete").val(ui.item.label); // display the selected text
            return false;
          },
          focus: function (event, ui) {
            $("#autocomplete").val(ui.item.label);
            return false;
          },
        });
      });

        $(function() {
            $("#captain12").autocomplete({
                source: 'captain_code.php'
            });
        });

        // $(function() {
        //     $("#parcel_no").autocomplete({
        //         source: function (request, response){
        //             let log= $.ajax({
        //             url: "ajax/parcel_no.php",
        //             type: "post",
        //             dataType: "json",
        //             data: {
        //                 search: request.term,
        //             },
        //             success: function (data){
        //                 response(data);
        //                 // console.log(data);
        //             },
        //             });
        //             // console.log(log)
        //         },
        //         select: function (event, ui) {
        //             $("#parcel_no").val(ui.item.label); // display the selected text
        //             return false;
        //         },
        //         focus: function (event, ui) {
        //             $("#parcel_no").val(ui.item.label);
        //             return false;
        //         },
        //         });
        // });
    </script>
    <!-- <div class="wrapper" id="form1"> -->
        
        <?php require_once("dbcon.php"); ?>
        <div class="content-wrapper">
            <section class="content">
                <p style="font-size:24px;">PARCEL MASTER</p>
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="box box-primary">
                        <form action="" id="form11">
                            <!-- <h3 class="text-center" style="margin-top: 3px;">Select Menu</h3> -->
                            <input type="hidden" name="slno" id="slno">
                            <div class="box-body form1">
                                <input type="hidden" class="form-control" name="date" id="datepicker" value="<?php echo date("m/d/Y") ?>" required>
                                <div class="form-group col-md-2">
                                    <label for="exampleInputFile">Parcel No </label>
                                        <select class="form-control" name="tabno" id="table_no" onchange="tab_no(this.value);">
                                                <option value="">
                                                        SELECT NUMBER
                                                </option>
                                            <?php 
                                                for($i=1; $i<=50; $i++)
                                                {
                                                    ?>
                                                        <option value="<?php echo "PARCEL_$i";?>">
                                                            <?php echo "PARCEL_$i";?>
                                                        </option>
                                            <?php  } ?>
                                        </select>
                                    
                                </div>
                                <div id="tb_no" style="display:none">
                                      hello
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="exampleInputFile">Item No</label>
                                    <input type="text" class="form-control" name="itmno" id="itmno"  onkeyup="itmmm()">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="exampleInputFile">Search Item Name</label>
                                    <input type="text" class="form-control" id="autocomplete" onchange="store()"/>
                                </div>
                                 <div class="form-group col-md-1">
                                    <label for="exampleInputFile">Qty</label>
                                    <input type="number" class="form-control" min="1" name="qty" id="qty"
                                        required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="exampleInputFile">Price</label>
                                    <input type="number" step="0.01" class="form-control" name="prc" id="prc"
                                        disabled="disabled"  required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="exampleInputFile">Total</label>
                                    <input type="text" class="form-control" name="tot" id="tot" disabled="disabled" readonly>
                                </div>
                                <div class="form-group col-md-1">
                                <button type="button" class="btn btn-success col-md-12" style="margin-top:25px;" id="add_order" 
                                        onclick="insert();"> Add</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                                <div class="form-group col-md-8">
                                    <div class="box-body" style="background-color:white;padding:0;margin:0;" id="itemlist">
                                    </div>
                                </div>
                                <div class="form-group col-md-4"style="padding:0;margin:0;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="boxx" id="boxx">
                                                    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="boxx1" id="boxx1">
                                                    
                                        </div>
                                    </div>
                                </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            <div class="modal fade" id="finalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><b>Final Order</b></h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="POST" action="ajax/parcel_form_save.php" id="finalform1">
                                <div class="box-body form1">
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputFile">Table No</label>
                                        <input type="text" class="form-control" name="tableno" readonly placeholder="Table No" id="tableno">
                                    </div> 
                                    <div class="form-group col-md-12" style="display: none;">
                                        <label for="exampleInputFile">Table Section</label>
                                        <input type="text" class="form-control" name="tabsec" readonly placeholder="Table No" id="tabsec">
                                    </div>
                                    <div class="form-group col-md-12" style="display: none;">
                                        <label for="exampleInputFile">Captain Name</label>
                                        <input type="text" class="form-control" name="capnam" id="capnam1" readonly>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="exampleInputFile">Mobile No</label>
                                        <input type="text" class="form-control" name="mobno" maxlength="10" pattern="[6789][0-9]{9}" placeholder="Customer No">
                                    </div>
                                    <div class="radio" style="display: inline-block; padding-left: 8px;">
                                        <label>
                                            <input type="radio" name="paymentmode" id="optionsRadios1" value="Cash" checked>
                                            Cash
                                        </label>
                                    </div>
                                    <div class="radio" style="display: inline-block; padding-left: 8px;">
                                        <label>
                                            <input type="radio" name="paymentmode" id="optionsRadios2" value="online">
                                            Online
                                        </label>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputFile">Ammout</label>
                                        <input type="text" class="form-control" name="grand" id="grand" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputFile">GST 5%</label>
                                        <input type="text" class="form-control" name="gst" id="gst" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputFile">Discount</label>
                                        <input type="text" class="form-control" name="discount" value="0" id="disc">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputFile">Grand Total</label>
                                        <input type="text" class="form-control" name="totalamt" id="tot_amt" readonly>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            </section>
        </div>
        <?php require_once("footer.php"); ?>
        <div class="control-sidebar-bg"></div>
        <script>
            $('#disc').keyup(function() 
            {
                console.log("hii")
                let amt = parseFloat($('#grand').val());
                let gst = parseFloat($('#gst').val());
                let discount = $(this).val();
                // let dis=parseFloat(discount);
                let amt1=amt+gst;
                let tott=amt1-discount;
                $('#tot_amt').val(tott);
            });

            // to delete item from bill
            function delitm(sn) 
            {
                // alert(sn);
                if (sn != "") {
                    $.ajax({
                        type: "post",
                        url: "ajax/parcel_form_insert.php",
                        data: {
                            itmno: sn,
                            delete: "delete"
                        },
                        success: function(status) 
                        {
                            // alert(status);
                            $('#itemlist').load("parcel_data.php?x="+status);
                            $('#boxx').load("parcel_search.php");
                        }
                    });
                } else {
                    alert("Please Select Item");
                }
            }
        </script>

        <script>
            $(document).ready(function()
            {
                let lastKeyPressTime = 0;
                let enterCount = 1;
                document.getElementById("qty").addEventListener("keydown", function(event) 
                {
                    if (event.key === "Enter") 
                    {
                        const currentTime = new Date().getTime();
                        const timeSinceLastKeyPress = currentTime - lastKeyPressTime;
                        // console.log(timeSinceLastKeyPress)

                        if (timeSinceLastKeyPress < 400) 
                        { 
                            enterCount++;         
                            if (enterCount === 2) 
                            {
                                insert();
                            }
                        }
                        else 
                        {
                            enterCount = 1;
                        }
                        
                        lastKeyPressTime = currentTime;
                    }else 
                    {
                        enterCount = 1;
                    }
                });

                const select = document.getElementById('table_no');
                
                select.addEventListener('keydown', function(event) 
                {
                    
                    if (event.key === 'Enter') 
                    {
                        const itmno = document.getElementById('itmno');
                        event.preventDefault();
                        itmno.focus();
                    }
                });
            });
            function itmmm()
            {
                var wingname = document.getElementById('itmno').value;
                let log= $.ajax({
                    url: 'ajax/item_ajax1.php',
                    type: "POST",
                    dataType: 'json',
                    data: {
                        wingname: wingname,
                        table_no: 1
                    },
                    success: function(data) {
                        // console.log(data);

                        if(data[0]=='Wrong Code')
                        {
                            $("#itmno").css("border", "1px solid orange");
                        }else
                        {
                            $("#itmno").css("border", "1px solid green");
                        }
                        $("#autocomplete").val(data[1]);
                        $("#prc").val(data[2]);
                        total();
                    }
                });
            }
        </script>
        <script src="js/parcel_form.js"></script>
    <!-- </div> -->
</body>
</html>