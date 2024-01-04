<?php session_start(); 
include("../dbcon.php");
$cash_type=$_SESSION['tye'];
$cash_id=$_SESSION['id'];
$sheduledate=$_SESSION['sheduledate'];
// if(isset($_POST['x']) && isset($_POST['x1']))
// {
//     $bill = $_POST['x'];
//     $payment = $_POST['x1'];

//     mysqli_query($conn,"UPDATE `tabletot` SET `paymentmode`='$payment',`status`=1 WHERE `slno`='$bill'");
//     echo "Bill SETTLED TO: " . $bill;
// }
if(isset($_POST['billno']) && isset($_POST['paymentMethod']))
{
    $billno=$_POST['billno'];
    $paymentMethod=$_POST['paymentMethod'];
    $temSelect="SELECT * FROM `temtable` WHERE `pid`!=0";
    $temResult=mysqli_query($conn,$temSelect);
    if(mysqli_num_rows($temResult) > 0)
    {
        while($row=mysqli_fetch_assoc($temResult))
        {
            $pid=$row['pid'];
            $qty=$row['qty'];
            $date=$row['date'];
            $beaverages="INSERT INTO `beverages`(`pid`,`date`,`issued`) VALUES ('$pid','$date','$qty')";
            $resultKot=mysqli_query($conn,$beaverages);
        }
    }

    $sql1 = "INSERT INTO `tabledata`(`date`,`itmno`,`itmnam`,`prc`,`qty`,`tot`,`tabno`,`billno`,`time`,`kot_num`,`type`) SELECT `date`,`itmno`,`itmnam`,`prc`,SUM(`qty`) as `qty`,SUM(`tot`) AS `tot`,`tabno`,`billno`,`time`,`kot_num`,`type` FROM `temtable` GROUP BY `itmno`,`tabno` HAVING `billno`='$billno'";
    if (!mysqli_query($conn, $sql1)) 
    {
        echo json_encode('Error: ' . mysqli_error($conn ));
    }else
    {
        mysqli_query($conn,"DELETE FROM `temtable` WHERE `billno`='$billno'");
        mysqli_query($conn,"UPDATE `invoice` SET `pmode`='$paymentMethod',`status`=1,`cashId`='$cash_id' WHERE `slno`='$billno'");
    }
    echo 'BILL SETTELED';
}
?>
