<?php session_start(); 
include("../dbcon.php");
$cash_type=$_SESSION['tye'];
$cash_id=$_SESSION['id'];
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
    // $temSelect="SELECT `temtable`.*,`kot`.`time` AS `kot_time` FROM `temtable`,`kot` WHERE `temtable`.`billno`='$billno' AND `temtable`.`kot_num`=`kot`.`kot_num` ORDER BY `temtable`.`kot_num`";
    // $temResult=mysqli_query($conn,$temSelect);
    // if(mysqli_num_rows($temResult) > 0)
    // {
    //     while($row=mysqli_fetch_assoc($temResult))
    //     {
            // $kot_time=$row['kot_time'];
            // $date=$row['date'];
            // $kot_num=$row['kot_num'];
            // $itmno=$row['itmno'];
            // $itmnam=$row['itmnam'];
            // $qty=$row['qty'];
            // $tabno=$row['tabno'];
            // $capname=$row['capname'];
            // $cap_code=$row['cap_code'];
            // $slno=$row['slno'];
            // $kot_history="INSERT INTO `kot_history`(`date`, `itmno`, `itmnam`, `qty`, `tabno`, `capname`, `cap_code`, `kot_num`) VALUES ('$date','$itmno','$itmnam','$qty','$tabno','$capname','$cap_code','$kot_num')";
            // $resultKot=mysqli_query($conn,$kot_history);
            // mysqli_query($conn,"DELETE FROM `kot` WHERE `status`='$slno'");
    //     }
    // }

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
