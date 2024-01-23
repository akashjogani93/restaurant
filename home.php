<?php require_once("header.php"); ?>
<style>
    .main{
        margin:20px;
    }
    .boxx1{
        padding:10px 0;
        background-color:rgba(248, 7, 7, 0.6);
    }
    .boxx2{
        padding:10px 0;
        background-color:rgba(29, 225, 49, 0.6);
    }
    .boxx3{
        padding:10px 0;
        background-color:rgba(181, 0, 255, 0.6);
    }
    .boxx4{
        padding:10px 0;
        background-color:rgba(29, 120, 115, 0.6);
    }
    h1{
        color:white;
    }
    .imag{
        padding:30px 10px 0 0;
    }
    .boxx1 ,  .boxx2 , .boxx3, .boxx4{
        margin:0 5px;
    }
</style>
<?php 
    $cash_type=$_SESSION['tye'];
    $cash_id=$_SESSION['id'];
    $sheduleid=$_SESSION['sheduleid'];
    $sheduledate=$_SESSION['sheduledate'];
?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="main">
                <div class="row">
                    <div class=" col-md-3">
                        <a href="item_form.php"> 
                            <div class="boxx1 col-md-11">
                                <div class="col-md-8">
                                    <h1>Menu Master</h1>
                                </div>
                                <div class="imag col-md-4">
                                    <img src="img/box1.png" alt="" width="70" height="70">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class=" col-md-3">
                       <a href="table_master.php">
                            <div class="boxx2 col-md-11">
                                <div class="col-md-8">
                                    <h1>Table Master</h1>
                                </div>
                                <div class="imag col-md-4">
                                    <img src="img/box2.png" alt="" width="70" height="70">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class=" col-md-3">
                        <a href="reports.php">
                            <div class="boxx3 col-md-11">
                                <div class="col-md-8">
                                    <h1>Report Master</h1>
                                </div>
                                <div class="imag col-md-4">
                                    <img src="img/box3.png" alt="" width="70" height="70">
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- <div class=" col-md-3">
                        <a href="parcel_master.php">
                            <div class="boxx4 col-md-11">
                                <div class="col-md-8">
                                    <h1>Parcel Master</h1>
                                </div>
                                <div class="imag col-md-4">
                                    <img src="img/box4.png" alt="" width="70" height="70">
                                </div>
                            </div>
                        </a>
                    </div> -->
                </div><br>
                <?php 
                    if($cash_type=='Manager')
                    {
                        if($sheduleid==0)
                        {
                        ?>
                        <div class="row">
                            <div class=" col-md-3">
                                <!-- <a href="item_form.php">  -->
                                    <div class="boxx1 col-md-11" id="dayshedule">
                                        <div class="col-md-8">
                                            <h1>Day Shedule</h1>
                                        </div>
                                        <div class="imag col-md-4">
                                            <img src="img/box1.png" alt="" width="70" height="70">
                                        </div>
                                    </div>
                                <!-- </a> -->
                            </div>
                        </div>
               <?php    }else
                        {
                            
                                ?>
                                <div class="row">
                                    <div class=" col-md-3">
                                        <!-- <a href="item_form.php">  -->
                                            <div class="boxx1 col-md-11" id="closeshedule">
                                                <div class="col-md-8">
                                                    <h1>Close Shedule</h1>
                                                </div>
                                                <div class="imag col-md-4">
                                                    <img src="img/box1.png" alt="" width="70" height="70">
                                                </div>
                                            </div>
                                        <!-- </a> -->
                                    </div>
                                </div>
                            <?php
                        }
                  }?>
                
                <div class="modal fade" id="daypopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel1"><b>Shedule Day</b></h4>
                            </div>
                            <div class="modal-body">
                                <div class="box-body form1">
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputFile">Select Date</label>
                                        <input type="date" class="form-control" id="dateShedule" placeholder="Date">
                                        <input type="hidden" class="form-control" id="userid" placeholder="Date" value="<?php echo $cash_id;?>" readonly>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" onclick="shedule()" id="adduser" class="btn btn-primary">Shedule</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="closeshedulepopoup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel1"><b>Shedule Day</b></h4>
                            </div>
                            <div class="modal-body">
                                <div class="box-body form1">
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputFile">Select Date</label>
                                        <input type="date" class="form-control" id="dateclose" placeholder="Date"   value="<?php echo $sheduledate; ?>" readonly>
                                        <input type="hidden" class="form-control" id="closeuserid" placeholder="Date" value="<?php echo $cash_id;?>" readonly>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" onclick="closeShedule()" id="adduser" class="btn btn-primary">close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<script>
    $(document).ready(function()
    {
        $('#dayshedule').on('click',function()
        {
            var currentDate = new Date();
            var formattedDate = currentDate.toISOString().split('T')[0];
            $("#dateShedule").val(formattedDate);
            $('#daypopup').modal('show');
        });

        $('#closeshedule').on('click',function()
        {
            // var currentDate = new Date();
            // var formattedDate = currentDate.toISOString().split('T')[0];
            // $("#dateShedule").val(formattedDate);
            $('#closeshedulepopoup').modal('show');
        })
    });

    function shedule()
    {
        var date=$('#dateShedule').val();
        var userid=$('#userid').val();

        let log=$.ajax({
                type: "post",
                url: "ajax/table_master.php",
                data:{
                        dayShedule: date,
                        userid:userid,
                    },
                cache: false,
                success: function(status)
                {
                    console.log(status);
                    alert(status);
                    location.reload();
                }
            });
    }

    function closeShedule()
    {
        var date=$('#dateclose').val();
        var userid=$('#closeuserid').val();

        let log=$.ajax({
            type: "post",
            url: "ajax/table_master.php",
            data:{
                    dayclose: date,
                    userid:userid,
                },
            cache: false,
            success: function(status)
            {
                alert(status);
                location.reload();
            }
        });
    }
</script>
        
    </div>
            <?php require_once("footer.php"); ?>

    </body>
</html>
