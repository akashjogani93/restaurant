<?php include('dbcon.php'); 
$cat = $_GET['x']; 
$sum = 0;
$sum1 = 0;
$output="";
$query="SELECT DISTINCT `kot_num` FROM `parcel` WHERE `tabno`='$cat' ORDER BY `kot_num` ASC; ";
$CONFORM=mysqli_query($conn,$query);
if(mysqli_num_rows($CONFORM)>0)
{
    ?>
        <div style="display:flex; padding:0 20px; justify-content:space-between;">
            <h4 style="color:red;">Table No :<?php echo $cat; ?></h4>
        </div>
            <?php
                while($row1=mysqli_fetch_array($CONFORM))
                {
                    $kot_num=$row1["kot_num"];
                    
                    ?>
                        <div style="display:flex; padding:0 20px; justify-content:space-between;">
                            <h4 style="color:red;">KOT NO : 
                                    <?php 
                                        if($kot_num==0) {
                                            echo 'Current Data';
                                            ?><a href="parcel-kot.php?tabno=<?php echo $cat; ?>" id="koot" class="btn btn-success" style="position:relative; left:50px;">KOT (ALT + x )</a><?php
                                        }else
                                        {
                                            echo $kot_num; 
                                            ?><a href="ajax/parcel_form_insert.php?cancel=<?php echo $kot_num; ?>" style="position:relative; left:50px;" class="btn btn-danger">Cancel KOT</a>
                                            <a href="kot_reprint_parcel.php?tabno=<?php echo $cat; ?>&print=<?php echo $kot_num; ?>" style="position:relative; left:50px;" class="btn btn-success">Print</a>
                                            <?php
                                        }
                                    ?> 
                            </h4>
                        </div>
                    <?php
                        $qry="SELECT * FROM `parcel` WHERE `tabno`='$cat' AND `kot_num`='$kot_num' ORDER BY `kot_num` ASC;";
                        $confirm=mysqli_query($conn,$qry);
                        $sn=0;
                    ?>
                        <table id="example1" class="table table-bordered table-striped cell-border">
                            <thead>
                                <tr>
                                    <th>Menu No</th>
                                    <th>Menu Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Delete</th>
                                    <?php 
                                        // if($kot_num==0)
                                        // {
                                        //     echo '<th>Delete</th>';
                                        // }
                                    ?>
                                    
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
                                            </tr>
                                        <?php   
                                    }
                                    
                                ?>
                            </tbody>
                            <!-- <tr>
                                <td colspan="2"></td>
                                <td colspan="2" style="font-weight:bold; font-size:14pt; color:green; text-align:center">Total:</td>
                                <td style="font-weight:bold; font-size:14pt; color:green;"><?php echo $sum; ?></td>
                                <td style="padding:15px 0;"><a href="kot.php?tabno=<?php echo $cat; ?>" id="koot" style="padding:4px; background-color:green;color:white;">KOT (ALT + x )</a></td>
                            </tr> -->
                        </table>
                    <?php
                }
                ?>
                    <div style="display:flex; padding:0 20px; justify-content:space-between; float:right;">
                        <h4 style="color:green;">Total Basic Amount :<?php echo number_format($sum,2); ?></h4>
                    </div>
                <?php
}
    ?>
        <script>
            var tabno='<?php echo $cat; ?>';
            var selectField = document.getElementById("table_no");
            for (var i = 0; i < selectField.options.length; i++) 
            {
               if(selectField.options[i].value==tabno)
               {
                    selectField.selectedIndex = i;
                    break;
               }
            }
        </script>


