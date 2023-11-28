<?php include('dbcon.php'); 
$cat = $_GET['tabno']; 
$table_no = $_GET['tabno']; 
$sum = 0;
$sum1 = 0;
$output="";
$query="SELECT DISTINCT `kot_num` FROM `temtable` WHERE `tabno`='$table_no' AND `status`=0 AND `billno`=0 ORDER BY `kot_num` ASC; ";
$CONFORM=mysqli_query($conn,$query);
if(mysqli_num_rows($CONFORM)>0)
{
    ?>
        <div style="display:flex; padding:0 20px;">
            <!-- <h4 style="color:red; width:60%;">Table No :<?php echo $cat; ?></h4> -->
            <select class="form-control" style="float-right; width:150px;margin-top:10px;" name="shifttables" id="shifttables" onload="shifttables()">
            </select>
            <button onclick="shiftitem()" id="select11" class="btn btn-info" style="float-right; margin-top:10px; margin-left:10px; font-size:10px;">Item Shift</button>
            <button style="display: none; padding:6px 20px; float-right; margin-top:10px; margin-left:10px; font-size:10px;" class="btn btn-info shift2" onclick="shift()">Shift</button>
            <button onclick="printAllItem(this.value)" value="<?php echo $cat; ?>" id="printAllItem" class="btn btn-info" style="float-right; margin-top:10px; margin-left:10px; font-size:10px;">Print Item</button>
        </div>
            <?php
                while($row1=mysqli_fetch_array($CONFORM))
                {
                    $kot_num=$row1["kot_num"];
                    
                    ?>
                        <div style="display:flex; padding:0 20px; justify-content:space-between;">
                            <h4 style="color:red;">KOT NO : 
                                    <?php 
                                        if($kot_num==0) 
                                        {
                                            echo 'Current Data';
                                            ?>
                                                <!-- <a href="kot.php?tabno=<?php echo $table_no; ?>" class="btn btn-danger" style="position:relative; left:50px;" id="koot">KOT (ALT + x )</a> -->
                                                <button onclick="KotPrint(this.value)" value="<?php echo $table_no; ?>" id="kotPrint" class="btn btn-danger" style="position:relative; left:50px; font-size:10px;">KOT (ALT + x)</button>
                                            <?php
                                        }else
                                        {
                                            echo $kot_num; 
                                            ?>
                                            <button onclick="cancel_Kot(this.value)" value="<?php echo $kot_num; ?>" class="btn btn-info" style="position:relative; left:50px; font-size:10px;">Cancel KOT</button>
                                            <!-- <a href="ajax/table_form_insert.php?cancel=<?php echo $kot_num; ?>" style="position:relative; left:50px; font-size:10px;" class="btn btn-info">Cancel KOT</a> -->
                                            <a href="final_kot.php?tabno=<?php echo $kot_num; ?>" style="position:relative; left:50px; font-size:10px;" class="btn btn-danger">Print</a>
                                            <?php
                                        }
                                    ?> 
                            </h4>
                        </div>
                    <?php
                        $qry="SELECT * FROM `temtable` WHERE `tabno`='$cat' AND `kot_num`='$kot_num' AND `status`=0 AND `billno`=0 ORDER BY `kot_num` ASC;";
                        $confirm=mysqli_query($conn,$qry);
                        $sn=0;
                    ?>
                        <table id="example1" class="table  table-striped cell-border">
                            <thead>
                                <tr>
                                    <th>Menu No</th>
                                    <th>Menu Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Delete</th>
                                    <th class="tbl1" style="display: none;">Select</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($row=mysqli_fetch_array($confirm))
                                    {   
                                        $sum+=$row["tot"];
                                        ?>
                                            <tr>
                                                <td><?php echo $row["itmno"]; ?></td>
                                                <td><?php echo $row["itmnam"]; ?></td>
                                                <td><?php echo $row["qty"]; ?></td>
                                                <td><?php echo number_format($row["prc"],2); ?></td>
                                                <td><?php echo number_format($row["tot"],2); ?></td>
                                                <td><button onclick="delitm(this.value)" value="<?php echo $row['slno']; ?>">Delete</button></td>
                                                <td class="tbl1" style="display: none; "><input type="checkbox"   name="item1" value="<?php echo $row['slno']; ?>"></td>
                                            </tr>
                                        <?php   
                                    }
                                    
                                ?>
                            </tbody>
                        </table>
                    <?php
                }
                ?>
                    <div style="display:flex; padding:0 20px; justify-content:space-between; float:right;">
                        <h4 style="color:green;">Total Basic Amount :<?php echo number_format($sum,2); ?></h4>
                    </div>
                <?php
}


    $query="SELECT DISTINCT `capname`,`cap_code` FROM `temtable` WHERE `tabno`='$cat' AND `status`=0 AND `billno`=0";
    $CONFOR=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($CONFOR))
    {
        $capname=$row['capname'];
        $cap_code=$row['cap_code'];
        ?>
            <script>
                var capname='<?php echo $capname; ?>';
                var cap_code='<?php echo $cap_code; ?>';
                var tabno='<?php echo $cat; ?>';
    
                $("#table_no").val(tabno);
                $("#captain12").val(capname);
                $("#captainname").val(cap_code);
                // alert(capname);
            </script>
        <?php
    }
?>
<script>
    shifttables();
function shiftitem() 
{
    $('.tbl1').css("display", "block");
    $('.shift2').css("display", "block");
    $('#select11').css("display", "none");
}

function shifttables()
{
    var tabno='<?php echo $cat; ?>';
    let log = $.ajax({
        url: 'ajax/ta.php',
        type: "POST",
        dataType: 'json',
        data: {
            shifttables : 'catsus2',
            tabno:tabno,
        },
        success: function(data)
        {

            for (var i = 0; i < data.length; i++) 
            {
                var opt = document.createElement("option");
                opt.text = data[i];
                opt.value =data[i];
                var x = document.getElementById("shifttables");
                x.add(opt);
            }
        }
    });
}

function shift()
{
    var item_no = [];
    $.each($("input[name='item1']:checked"), function() 
    {
        item_no.push($(this).val());
    });
    var table=$('#shifttables').val();
    if (item_no.length >= 1) 
    {
        let log=$.ajax({
                url: "ajax/shift_item.php",
                method: "POST",
                data: {
                    item_no: item_no,
                    table: table
                },
                success: function(data)
                {
                    alert("Item Shifted");
                    window.location.href = 'table_master.php?tabno='+table;
                }
            });
    }
}
</script>