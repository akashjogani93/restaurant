<?php
include("../dbcon.php");
$bill = $_POST['x'];
$payment = $_POST['x1'];

mysqli_query($conn,"UPDATE `tabletot` SET `paymentmode`='$payment',`status`=1 WHERE `slno`='$bill'");
echo "Bill SETTLED TO: " . $bill;

?>
