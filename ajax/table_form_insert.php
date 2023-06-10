<?php
include("../dbcon.php");

if(isset($_POST['captain']))
{
    $date = $_POST['date'];
    $ymd = DateTime::createFromFormat('m/d/Y', $date)->format('Y-m-d');
    $itmno = $_POST['itmno'];
    $itmnam = $_POST['itmnam'];
    $captain = $_POST['captain'];
    $prc = $_POST['prc'];
    $qty = $_POST['qty'];
    $tot = $_POST['tot'];
    $captainname = $_POST['captainname'];
    $tabno = $_POST['tabno'];

    $q3="SELECT * FROM `temtable` WHERE `kot_num`=0 AND `tabno`='$tabno' AND `itmno`='$itmno'";
    $conf3=mysqli_query($conn,$q3);
    if(mysqli_num_rows($conf3)>0)
    {
        while($row3=mysqli_fetch_assoc($conf3))
        {
            $qty1=$row3['qty']+$qty;
            $tot1=$prc*$qty1;
            mysqli_query($conn, "UPDATE `temtable` SET `capname`='$captainname',`qty`='$qty1',`tot`='$tot1' WHERE `kot_num`=0 AND `tabno`='$tabno' AND `itmno`='$itmno';");
            mysqli_query($conn, "UPDATE `kot` SET `capname`='$captainname',`qty`='$qty1' WHERE `tabno`='$tabno' AND `itmnam`='$itmnam';");
        }
    }else
    {
        mysqli_query($conn,"INSERT INTO `kot` VALUES('','$ymd','$itmnam','$qty','$tabno','$captainname',0,0,0)");

        $q="SELECT `id` FROM `kot` ORDER BY id DESC LIMIT 1";
        $conf=mysqli_query($conn,$q);
        while($row=mysqli_fetch_assoc($conf))
        {
            $id=$row['id'];
        }
    
        $sql="INSERT into temtable VALUES('','$ymd','$itmno','$itmnam','$prc','$qty','$tot','$tabno','$captainname',0,0,$id,0);";
       
        if (!mysqli_query($conn, $sql)) {
            echo 'Error: ' . mysqli_error($conn );
        }
        
        mysqli_query($conn, "UPDATE `temtable` SET `capname`='$captainname' WHERE `tabno`='$tabno';");
        mysqli_query($conn, "UPDATE `kot` SET `capname`='$captainname' WHERE `tabno`='$tabno';");
    }
}


if(isset($_POST['delete'],$_POST['itmno']))
{
    $itmno = $_POST['itmno'];
    $itmno1=$itmno;
    $sql1="SELECT * FROM `temtable` WHERE `slno`='$itmno'";
    $res=mysqli_query($conn,$sql1);
    while($r=mysqli_fetch_array($res))
    {
        $date=$r['date'];
        $itmno=$r['itmno'];
        $itmnam=$r['itmnam'];
        // $shnam=$r['shnam'];
        $prc=$r['prc'];
        $qty=$r['qty'];
        $tot=$r['tot'];
        $tabno=$r['tabno'];
        // $tabsec=$r['tabsec'];
        $billno=$r['billno'];
        // $status=$r['status'];
        $capname=$r['capname'];
        $kot=$r['kot'];
        
       
    }
$sql2="DELETE FROM `kot` WHERE `id`='".$kot."'";
mysqli_query($conn, $sql2);

$sql1="DELETE FROM `temtable` WHERE `slno`='".$itmno1."'";
mysqli_query($conn, $sql1);
       echo $tabno;
 
    
}



// table merge
if(isset($_POST['tabno'],$_POST['merge'],$_POST['x']))
{
   
    $table = $_POST['tabno'];
    $merge = $_POST['x'];

    $newtable=$table[0];

    $cf=mysqli_query($conn, "SELECT `capname` FROM `temtable` WHERE `tabno`='$newtable'");
    $out = mysqli_fetch_array($cf);
    $capname=$out['capname'];

    for($i=0;$i<count($table)-1;$i++)
    {
        $id = $table[$i];
        $cmf = mysqli_query($conn, "SELECT `itmno`,`qty`,`prc`,`itmnam` FROM `temtable` WHERE `tabno`='$id';");
        while($row=mysqli_fetch_array($cmf))
        {
            $itm = $row['itmno'];
            $itmnam = $row['itmnam'];
            $qty = $row['qty'];
            $prc = $row['prc'];
            for($j=$i+1;$j<count($table);$j++)
            {
                $id2 = $table[$j];
                $cf=mysqli_query($conn, "SELECT `qty` FROM `temtable` WHERE `itmno`='$itm' AND `tabno`='$id2' AND `kot_num`='0';");
                if(mysqli_num_rows($cf)>0)
                {
                        // echo $id;
                        $out = mysqli_fetch_array($cf);
                        $qty += $out['qty'];
                        $tot = $prc * $qty;
                       
                }
            }
        }
    }
    // for($i=0;$i<count($table);$i++)
    // {
    //     $id = $table[$i];
    //     mysqli_query($conn, "UPDATE `temtable` SET `tabno`='$merge' WHERE `tabno` = '$id';");
    //     mysqli_query($conn, "UPDATE `kot` SET `tabno`='$merge' WHERE `tabno` = '$id';");
    // }
    for($i=0;$i<count($table);$i++)
    {
        $id = $table[$i];
        mysqli_query($conn, "UPDATE `temtable` SET `tabno`='$merge',`capname`='$capname' WHERE `tabno` = '$id';");
        mysqli_query($conn, "UPDATE `kot` SET `tabno`='$merge',`capname`='$capname'WHERE `tabno` = '$id';");
    }
}


if(isset($_GET['cancel']))
{
    $kot_num=$_GET['cancel'];
    // $sql1="DELETE FROM `kot_history` WHERE `kot_num`='$kot_num'";
    // mysqli_query($conn, $sql1);

    $sql2 = "INSERT INTO kot_cancel (date,itmno,itmnam,prc,qty,tot,tabno,kot_num) SELECT `date`,`itmno`,`itmnam`,`prc`,`qty`,`tot`,`tabno`,`kot_num` FROM `temtable` HAVING kot_num='$kot_num'";
    if (!mysqli_query($conn, $sql2)) {
        echo json_encode('Error: ' . mysqli_error($conn ));
    }

    $q="SELECT `tabno` FROM `temtable` WHERE kot_num='$kot_num'";
    $conf=mysqli_query($conn,$q);
    while($row=mysqli_fetch_assoc($conf))
    {
        $tabno=$row['tabno'];
        
    }

    $sql3="DELETE FROM `temtable` WHERE `kot_num`='$kot_num'";
    mysqli_query($conn, $sql3);
    echo '<script>window.location.href="../table_form.php?statuscancel='.$tabno.'"</script>';
    // echo '<script>window.location.href="../singlebill.php?tabno='.$tabno.'&capnam='.$capnam.'&billno='.$cnt.'&discount='.$discount.'&date='.$date.'&time='.$current_time.'";</script>';

}
?>