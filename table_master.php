<?php require_once("header.php"); ?>
<?php require_once("dbcon.php"); ?>
<script src="js/table_master.js"></script>
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

        /* .table>thead,.table>tfoot
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
        } */
    </style>
    <div class="content-wrapper">
        <section class="content">
            <h3 class="top-headerMain">TABLE MASTER</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="shourtcuts">
                        <p>Print(ALT+C)</p>
                        <p>Without Print(ALT+t)</p>
                        <p>KOT Print(ALT+x)</p>
                        <p>Refresh (ALT+z)</p>
                        <p>All Item Print (ALT+a)</p>
                        <p>Next Field(Enter)</p>
                        <p>Back Field(Shift)</p>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                        <!-- <form action="" id="form11"> -->
                <div class="box-body form1">
                    <div class="row">
                        <?php 
                            if($cash_type=='Captain')
                            {
                                ?>
                                <div class="form-group col-md-2">
                                    <label for="fname">Captain Name</label>
                                    <input type="hidden" class="form-control" name="captainname" id="captainname" value="<?php echo $cash_id; ?>" readonly/>
                                    <input type="text" class="form-control" name="captain12" id="captain12" value="<?php echo $name; ?>" readonly/>
                                </div>
                                <?php
                            }
                        ?>
                        <div class="col-md-2">
                            <label for="exampleInputFile">Table No</label>
                            <input type="text" class="form-control" name="tabno" id="table_no" onchange="tab_no(this.value)"/>
                            <input type="hidden" class="form-control" name="date" id="datepicker" value="<?php echo date("m/d/Y") ?>" required>
                            <input type="hidden" class="form-control" name="cashType" id="cashType" value="<?php echo $cash_type; ?>">
                        </div>
                        <?php 
                            if($cash_type!='Captain')
                            {
                            ?>
                                <div class="col-md-2">
                                    <label for="fname">Captain Name</label>
                                    <input type="hidden" class="form-control" name="captainname" id="captainname"/>
                                    <input type="text" class="form-control" name="captain12" id="captain12" onchange="cap_codeCange(this.value)"/>
                                </div>
                            <?php
                            }
                        ?>
                        <div class="col-md-1">
                            <label for="exampleInputFile">Item No</label>
                            <input type="text" class="form-control" name="itmno"  id="itmno" onkeyup="item_no()">
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputFile">Item Name</label>
                            <input type="text" class="form-control" id="autocomplete" onchange="store()"/>
                        </div>
                        <div class="col-md-1">
                            <label for="exampleInputFile">Qty</label>
                            <input type="number" class="form-control" min="1" name="qty" id="qty"  required>
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputFile">Price</label>
                            <input type="number" step="0.01" class="form-control" name="prc" id="prc" disabled="disabled"  required>
                            <input type="hidden"  class="form-control" name="pid" id="pid" disabled="disabled"  required>
                        </div>
                        <div class="col-md-2">
                            <!-- <label for="exampleInputFile">Total</label> -->
                            <input type="hidden" class="form-control" name="tot" id="tot" disabled="disabled" readonly>
                            <button type="button" class="btn btn-success col-md-12" style="margin-top:25px;" id="add_order" onclick="OrderAdd();">Order</button>
                        </div>
                        <div class="col-md-1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-body form1">
                    <div class="row">
                        <div class="form-group col-md-7">
                            <div class="box-body" style="background-color:white; padding:0;margin:0;" id="itemlist">
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
                <div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel1"><b>Cancel Kot</b></h4>
                            </div>
                            <div class="modal-body">
                                <div class="box-body form1">
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputFile">KOT No</label>
                                        <input type="text" class="form-control" id="kot_cancelNum" placeholder="Kot Number" readonly>
                                        <!-- <label id="catempty"></label> -->
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputFile">Reason</label>
                                        <select name="cancel_reson" id="cancel_reson" class="form-control">
                                            <option>Order Cancelled</option>
                                            <option>Item Is Not Available</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" onclick="cancel();" id="adduser" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <!-- </div>
                    </form> -->
            <!-- </div> -->
        </section>
    </div>
</body>