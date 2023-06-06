<?php require_once("header.php"); ?>

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
    label{
        font-weight:500 !important;
        font-size:14px;
    }
    .col-md-1, .col-md-2 {
        padding:2 !important;
    }
    .col-sm-1, .col-sm-2 {
        padding:2 !important;
    }
    .col-lg-1, .col-lg-2 {
        padding:2 !important;
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
                // console.log(data);
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
            $("#table_no").autocomplete({
                source: function (request, response){
                    let log= $.ajax({
                    url: "ajax/table_no.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        search: request.term,
                    },
                    success: function (data){
                        response(data);
                        // console.log(data);
                    },
                    });
                    // console.log(log)
                },
                select: function (event, ui) {
                    $("#table_no").val(ui.item.label); // display the selected text
                    return false;
                },
                focus: function (event, ui) {
                    $("#table_no").val(ui.item.label);
                    return false;
                },
                });
        });

        $(function() {
            $("#captain12").autocomplete({
                source: function (request, response){
                    let log= $.ajax({
                    url: "captain_code.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        search: request.term,
                    },
                    success: function (data){
                        response(data);
                        // console.log(data);
                    },
                    });
                    // console.log(log)
                },
                select: function (event, ui) {
                    $("#captain12").val(ui.item.label); // display the selected text
                    return false;
                },
                focus: function (event, ui) {
                    $("#captain12").val(ui.item.label);
                    return false;
                },
                });
        });
    </script>
    <!-- <div class="wrapper" id="form1"> -->
        <?php require_once("dbcon.php"); ?>
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <h3>TABLE MASTER<h3>
                        <div class="box box-primary">
                            <form action="" id="form11">
                                <!-- <h3 class="text-center" style="margin-top: 3px;">Select Menu</h3> -->
                                <input type="hidden" name="slno" id="slno">
                                <div class="box-body form1">
                                    <?php 
                                       if($cash_type=='Captain')
                                       {
                                        ?>
                                            <div class="form-group col-md-2">
                                                <label for="fname">Captain Name</label>
                                                <input type="hidden" class="form-control" name="captainname" id="captainname" value="<?php echo $name; ?>" readonly/>
                                                <input type="text" class="form-control" name="captain12" id="captain12" onchange="cap_code(this.value)" value="<?php echo $name; ?>" readonly/>
                                            </div>
                                        <?php
                                       }
                                    ?>
                                    <div class="form-group col-md-1">
                                        <label for="exampleInputFile">Table No</label>
                                        <input type="text" class="form-control" name="tabno" id="table_no" onchange="tab_no(this.value)"/>
                                        <input type="hidden" class="form-control" name="date" id="datepicker" value="<?php echo date("m/d/Y") ?>" required>
                                        <input type="hidden" class="form-control" name="sess" id="sess" value="<?php echo $cash_type; ?>">
                                    </div>
                                    <?php 
                                       if($cash_type!='Captain')
                                       {
                                        ?>
                                            <div class="form-group col-md-2">
                                                <label for="fname">Captain Name</label>
                                                <input type="hidden" class="form-control" name="captainname" id="captainname"/>
                                                <input type="text" class="form-control" name="captain12" id="captain12" onchange="cap_code(this.value)"/>
                                            </div>
                                        <?php
                                       }
                                    ?>
                                    <div class="form-group col-md-1">
                                        <label for="exampleInputFile">Item No</label>
                                        <input type="text" class="form-control" name="itmno"  id="itmno" onkeydown="enter(this.keyCode)" onkeyup="diver1()">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="exampleInputFile">Item Name</label>
                                        <input type="text" class="form-control" id="autocomplete" onchange="store()"/>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="exampleInputFile">Qty</label>
                                        <input type="number" class="form-control" min="1" name="qty" id="qty"  required>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="exampleInputFile">Price</label>
                                        <input type="number" step="0.01" class="form-control" name="prc" id="prc" disabled="disabled"  required>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="exampleInputFile">Total</label>
                                        <input type="text" class="form-control" name="tot" id="tot" disabled="disabled" readonly>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <button type="button" class="btn btn-success col-md-12" style="margin-top:25px;" id="add_order" onclick="insert();"> Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="form-group col-md-7">
                                <div class="box-body" style="background-color:white; padding:0;margin:0;" id="itemlist">
                                    <table id="example1" class="table table-bordered table-striped cell-border">
                                        <tr>
                                                <th>Sl No</th>
                                                <th>Menu No</th>
                                                <th>Menu Name</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                                <th>Delete</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group col-md-5"style="padding:0;margin:0;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="boxx2" id="boxx2">
                                                    
                                        </div>
                                    </div>
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
                                <form role="form" method="POST" action="ajax/table_form_save.php" id="finalform1">
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
                                        <div class="form-group col-md-12" style="display:none;">
                                            <label for="exampleInputFile">Mobile No</label>
                                            <input type="text" class="form-control" name="mobno" id="mobno" maxlength="10" pattern="[6789][0-9]{9}" placeholder="Customer No">
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
                // console.log("hii")
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
                        url: "ajax/table_form_insert.php",
                        data: {
                            itmno: sn,
                            delete: "delete"
                        },
                        success: function(status) 
                        {
                            // alert(status);
                            $('#itemlist').load("current_data.php?x="+status);
                            $('#boxx').load("final_search.php");
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
                // document.addEventListener('keydown', function(event) 
                // {
                //     console.log(event.key);
                //     if (event.altKey && event.keyCode === 88) 
                //     {
                //         // console.log(event.key);
                //         document.getElementById("koot").click();
                //     }
                // });
              	// document.addEventListener('keydown', function(event) 
                // {
                //   	if (event.shiftKey && event.keyCode === 13) 
                //     {
                //     //   alert('hii');
                //     }
                // });
	       });
        </script>
        <script src="js/table_form.js"></script>
    <!-- </div> -->
</body>
</html>