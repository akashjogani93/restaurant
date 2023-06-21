<?php session_start(); 
include("../dbcon.php");
date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
$current_time = date('h:i A');
$mobno = "";
$gst=5;
$total=0;
$paymentmode = "none";
$cash_type=$_SESSION['tye'];
$cash_id=$_SESSION['id'];

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
    $capton = "SELECT `cap_code` FROM `empreg` WHERE `empname`='$capnam'";
    $retv = mysqli_query($conn, $capton );
    if(!$retv)
    {
        die('Could not get data: ' . mysqli_error($conn));
    }
    while($row256 = mysqli_fetch_assoc($retv)) {
        $cap_code=$row256['cap_code'];
    }
    $sql44 = "SELECT SUM(prc) FROM temtable WHERE tabno='$tabno'";
    $retval44 = mysqli_query($conn, $sql44 );

    if(! $retval44 ) {
        die('Could not get data: ' . mysqli_error($conn));
    }
    while($row44 = mysqli_fetch_assoc($retval44)) {
        $gndtot=$row44['SUM(prc)'];
    }
    $gstamt=$gndtot * $gst / 100;
    $nettot= $gndtot + $gstamt;

    $cnt = 0;
    $sql2 = "SELECT max(slno) FROM tabletot"; 
    $retval2 = mysqli_query($conn, $sql2 );
    if(! $retval2 )
    {
        die('Could not get data: ' . mysqli_error($conn));
    }
    while($row2 = mysqli_fetch_assoc($retval2))
    {
        $cnt = (int)$row2['max(slno)'];
        $cnt++;
    }

    if(!empty($cnt) && !empty($tabno) && $cnt!=0)
    {
        if($cnt==0)
        {
            $a = array('0','Not Printed',$tabno,$capnam,$discount,$cnt);
            echo json_encode($a);
        }else
        {
            $sql3 = "UPDATE temtable SET billno='$cnt' WHERE tabno='$tabno'";
            $retval3 = mysqli_query($conn, $sql3 );
            if($retval3)
            {
                $update=1;
            }else
            {
                $update=0;
            }
            if($update==1)
            {
                //insert into table
                $sql1 = "INSERT INTO `tabledata`(`date`,`itmno`,`itmnam`,`prc`,`qty`,`tot`,`tabno`,`billno`) SELECT `date`,`itmno`,`itmnam`,`prc`,SUM(`qty`) as `qty`,SUM(`tot`) AS `tot`,`tabno`,`billno` FROM `temtable` GROUP BY `itmno`,`tabno` HAVING `tabno`='$tabno'";
    
                if (!mysqli_query($conn, $sql1)) {
                    echo json_encode('Error: ' . mysqli_error($conn ));
                }
                $sql = "SELECT * FROM `tabledata` WHERE `tabno`='$tabno' AND billno='$cnt'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                    $total += $row['tot'];
                    }
                }
                    // $final1=$total*$gst/100;
                    // $final=($total+$final1);
                    $percentagePattern = '/^\d+(\.\d+)?%$/';
                    $amountPattern = '/^\d+(\.\d+)?$/';

                    if(preg_match($percentagePattern, $discount)) 
                    {
                        $valueWithoutPercentage = str_replace('%', '', $discount);
                        $disPercentage = (float) $valueWithoutPercentage;

                        $dis=($total*$disPercentage)/100;
                        // $final2=$final-$dis;

                    }else if(preg_match($amountPattern, $discount)) 
                    {
                        $disPerc = ($discount / $total) * 100;
                        $disPercentage = number_format($disPerc, 2);
                        $dis=$discount;
                        // $final2=$final-$discount;
                    }
                    $final=$total-$dis;
                    $final1=$final*$gst/100;
                    $final2=$final1+$final;

                $sqltot="INSERT into `tabletot` VALUES('','$total','$gst','$gstamt','$final2','$date','$paymentmode','$capnam','$cap_code','$disPercentage','$mobno','$current_time','$cash_id','0','$dis','hotel')";
                $tabletot = mysqli_query($conn, $sqltot);
                if($tabletot)
                {
                    $stmt = "DELETE FROM `temtable` WHERE `tabno`='$tabno'";
                    mysqli_query($conn,$stmt);
                    $stmtKOT = "DELETE FROM `kot` WHERE `tabno`='$tabno'";
                    mysqli_query($conn,$stmtKOT);

                    if($charge==1)
                    {
                        mysqli_query($conn,"UPDATE `tabletot` SET `gndtot`=0,`gst`=0,`gndtot`=0,`gstamt`=0,`nettot`=0,`discount`=0,`disamt`=0 WHERE `slno`='$cnt'");
                        mysqli_query($conn,"UPDATE `tabledata` SET `prc`=0,`tot`=0 WHERE `tabno`='$tabno'");
                    }

                    $a = array($tabno,$capnam,$cnt,$disPercentage,$date,$current_time,$dis);
                    echo json_encode($a);
                }
            }else
            {
                $a = array('0','Not Printed',$tabno,$capnam,$disPercentage,$cnt);
                echo json_encode($a);
            }
        }
        
    }
    else
    {
        $a = array('0','Not Printed',$tabno,$capnam,$disPercentage,$cnt);
        echo json_encode($a);
    }

}
else
{
    $a = array('0','Not Printed',$tabno,$capnam,$disPercentage);
    echo json_encode($a);
}

?> 