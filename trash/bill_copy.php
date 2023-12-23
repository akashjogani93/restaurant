<?php
include("dbcon.php");
echo $bill_no = $_GET['bill_no'];


$sql="SELECT `tabletot`.*,`tabledata`.`tabno` FROM `tabletot`,`tabledata` WHERE `tabletot`.`slno`='$bill_no' AND `tabletot`.`slno`=`tabledata`.`billno`";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) 
{
    $tabno=$row['tabno'];
    $capcode=$row['cap_code'];
    $capnam=$row['capnam'];
    $cnt=$bill_no;
    $discount=$row['discount'];
    $date=$row['date'];
    $time=$row['time'];
    $disamt=$row['disamt'];

}
echo '<script>window.location.href="singlebilldouble.php?tabno='.$tabno.'&capnam='.$capnam.'&billno='.$cnt.'&discount='.$discount.'&date='.$date.'&time='.$time.'&amt='.$disamt.'";</script>';

?>