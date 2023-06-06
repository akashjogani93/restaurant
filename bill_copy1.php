<?php
include("dbcon.php");
echo $bill_no = $_GET['bill_no'];


$sql="SELECT `tabletot`.*,`tabledata`.`tabno` FROM `tabletot`,`tabledata` WHERE `tabletot`.`slno`='$bill_no' AND `tabletot`.`slno`=`tabledata`.`billno`";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) 
{
    $tabno=$row['tabno'];
    $capnam=$row['cap_code'];
    $cnt=$bill_no;
    $discount=$row['discount'];
    $date=$row['date'];
   $time=$row['time'];
}
echo '<script>window.location.href="singlebilldouble1.php?tabno='.$tabno.'&capnam='.$capnam.'&billno='.$cnt.'&discount='.$discount.'&date='.$date.'&time='.$time.'";</script>';

?>