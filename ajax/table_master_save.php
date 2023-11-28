<?php session_start(); 
include("../dbcon.php");
date_default_timezone_set("Asia/Kolkata");
$cash_type=$_SESSION['tye'];
$cash_id=$_SESSION['id'];
$date = date("Y-m-d");
$time = date('h:i A');
$gst=5;
$paymentmode = "Not Setteled";
$table = "Table";

$tabno = $_POST['tabno'];
$capnam = $_POST['captain'];
$discount = $_POST['dis'];
$charge = $_POST['charge'];

if($discount=='')
{
    $discount=0;
}

if(!empty($tabno) && !empty($capnam) && $discount!='')
{
    $sql= "SELECT SUM(tot) AS `tot`,`cap_code` FROM `temtable` WHERE `tabno`='$tabno' AND `status`=0 AND `billno`=0";
    $retval44 = mysqli_query($conn, $sql );
    if(! $retval44 ) 
    {
        die('Could not get data: ' . mysqli_error($conn));
    }
    while($row44 = mysqli_fetch_assoc($retval44)) 
    {
        $gndtot=(float) $row44['tot'];
        $capcode=$row44['cap_code'];
    }

    if(!empty($gndtot))
    {
        $percentagePattern = '/^\d+(\.\d+)?%$/';
        $amountPattern = '/^\d+(\.\d+)?$/';
        if(preg_match($percentagePattern, $discount)) 
        {
            $valueWithoutPercentage = str_replace('%', '', $discount);
            $disPercentage = (float) $valueWithoutPercentage;
            $dis=($gndtot*$disPercentage)/100;

        }else if(preg_match($amountPattern, $discount)) 
        {
            $disPerc = ($discount / $gndtot) * 100;
            $disPercentage = number_format($disPerc,  2, '.', '');
            $dis=$discount;
        }
        $amountAfterDiscount = max(0, $gndtot - $dis);

        $gstAmount=($amountAfterDiscount*$gst)/100;

        $amountAfterGst=$amountAfterDiscount+$gstAmount;
        $round = fmod($amountAfterGst, 1);

        $roundMinus=0;
        $roundPlus=0;
        if($round < 0.50)
        {
            $roundMinus=number_format($round, 2, '.', '');
        }else
        {
            $roundPlus=number_format(1-$round, 2, '.', '');
        }
        $nettot=round($amountAfterGst);

        // $gndtot=number_format($gndtot,2);
        $gndtot = number_format($gndtot, 2, '.', '');
        $disPercentage=number_format($disPercentage,2, '.', '');
        $disAmt=number_format($dis, 2, '.', '');
        $amountAfterDiscount=number_format($amountAfterDiscount, 2, '.', '');
        $gstAmount=number_format($gstAmount, 2, '.', '');
        $amountAfterGst=number_format($amountAfterGst, 2, '.', '');
        $nettot=number_format($nettot, 2, '.', '');
        $invoice="INSERT INTO `invoice`(`date`, `time`, `capname`, `cap_code`, `gtot`, `discount`, `discAmt`, `afterDisc`, `gst`, `gstAmt`, `afterGst`, `roundplus`, `roundminus`, `nettot`, `cashId`, `orde`, `pmode`,`tabno`) VALUES ('$date','$time','$capnam','$capcode','$gndtot','$disPercentage','$disAmt','$amountAfterDiscount','$gst','$gstAmount','$amountAfterGst','$roundPlus','$roundMinus','$nettot','$cash_id','$table','$paymentmode','$tabno')";
        $exc=mysqli_query($conn,$invoice);
        if($exc)
        {
            $insertedId = mysqli_insert_id($conn);
            $tem="UPDATE `temtable` SET `billno`='$insertedId',`status`=1 WHERE `status`=0 AND `billno`=0 AND `tabno`='$tabno'";
            $exc1=mysqli_query($conn,$tem);
            if($exc1)
            {
                echo 'CLEAR';
            }
        }else
        {
            echo "Error: " . mysqli_error($conn);
        }
    }
}else
{
    echo json_encode('working');
}

error_log("Debug: Something happened");

?>