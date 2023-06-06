<?php
include("dbcon.php");
$itmnam = $_POST['pname'];
$itmnam1="";
$itmunit = $_POST['unit'];
$qty = $_POST['qty'];
$prc = $_POST['prc'];
$purdate = $_POST['purdate'];
$tot = $qty * $prc;

$remain=$qty;

$sql1 = "SELECT * FROM store_room";
$result1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result1) > 0) 
{
    while($row1 = mysqli_fetch_assoc($result1))
    {
        $itmnam1=$row1['item_name'];
        $qty2=$row1['item_qty'];
        $itmtot=$row1['item_total'];
        $rem=$row1['remain'];

    }
}

if($itmnam1==$itmnam)
{
	$qty1=$qty2+$qty;
    $remain=$qty+$rem;
	$tot1=$tot + $itmtot;
    $sql="UPDATE  `store_room` SET `item_qty`='$qty1',`item_total`='$tot1',`remain`='$remain' where `item_name`='$itmnam'";
    mysqli_query($conn, $sql) ;
    echo '<script>alert("The item was Added Successfully");</script>';
    echo '<script>window.location="store_form.php";</script>'; 
}
else
{
	$sql="INSERT into  store_room VALUES('','$itmnam','$itmunit','$qty','$prc','$purdate','$tot','$remain')";
    mysqli_query($conn, $sql);
    echo '<script>alert("The item was Added Successfully");</script>';
    echo '<script>window.location="store_form.php";</script>'; 
}



?>