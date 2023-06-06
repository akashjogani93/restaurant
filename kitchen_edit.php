<?php
include("dbcon.php");


// DELETE
// if(isset($_GET['del'])){
//     $id = $_GET['del'];
//     $sql1 = "DELETE FROM store_room_finish WHERE fid='$id'";

//     if (!mysqli_query($conn, $sql1)) {
//         die('Error: ' . mysqli_error($conn ));
//     }
//     echo '<script>alert("Record Deleted");</script>';
//     echo '<script>location="kitchen_form.php";</script>';
// }
// End Delete


$id = $_POST['slno'];
$itmnam = $_POST['itmname'];
$itmunit= $_POST['itmunit'];
$itmqty = $_POST['itmqty'];

$kitchenitmqty = $_POST['itmqty'];

$itm_rem = $_POST['itm_rem'];
$remain_itm_rem = $_POST['itm_rem'];

$oldrem = $_POST['oldrem'];

// $pdate= $_POST['g_date'];
$remqty1 = $itm_rem - $itmqty;




$sql="UPDATE `store_room_finish` SET `fid`='$id',`item_id`='$itmnam',`item_name_finish`='$itmnam',`f_item_unit`='$itmunit',`f_item_rem_qty`='$remqty1',`f_item_finish_qty`='$itmqty',`given_date`='$pdate',`type`='kitchen11' WHERE `fid`='$id'";


if (!mysqli_query($conn, $sql)) {
    die('Error: ' . mysqli_error($conn ));
}
echo '<script>alert("Record Updated");</script>';
echo '<script>location="kitchen_form.php";</script>';

?>