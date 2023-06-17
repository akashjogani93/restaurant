<?php
include("dbcon.php");


// DELETE
// if(isset($_GET['del'])){
//     $id = $_GET['del'];
//     $sql1 = "DELETE FROM store_room WHERE store_id='$id'";

//     if (!mysqli_query($conn, $sql1)) {
//         die('Error: ' . mysqli_error($conn ));
//     }
//     echo '<script>alert("Record Deleted");</script>';
//     echo '<script>location="store_form.php";</script>';
// }
// End Delete


$id = $_POST['slno'];

$itmnam = $_POST['itmnam'];
$oldqty = $_POST['itmqty'];

$newqty = $_POST['removed'];

$prc = $_POST['itmprc'];

// $tot1=$qty * $prc;

$sql1 = "SELECT * FROM store_room WHERE `store_id`='$id'";
$result1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result1) > 0) 
{
    while($row1 = mysqli_fetch_assoc($result1))
    {
        $itmnam1=$row1['item_name'];
        $purchase=$row1['item_qty'];
        $itmtot=$row1['item_total'];
        $rem=$row1['remain'];

    }
}

if($oldqty >= $newqty)
{
    $qty=$oldqty-$newqty;
    $purchase1=$purchase-$qty;
    $remain=$rem-$qty;
    //removed

}
else
{
    $qty=$newqty-$oldqty;
    $purchase1=$qty+$purchase;
    $remain=$rem+$qty;
}

$total=$purchase1*$prc;
$sql="UPDATE `store_room` SET `item_qty`='$purchase1',`remain`='$remain',`item_rate`='$prc',`item_total`='$total' WHERE `store_id`='$id' ";

if (!mysqli_query($conn, $sql)) {
    die('Error: ' . mysqli_error($conn ));
}
echo '<script>alert("Record Updated");</script>';
echo '<script>location="store_form.php";</script>';

?>