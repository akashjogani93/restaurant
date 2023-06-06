<?php
include("../dbcon.php");

if(isset($_POST['itmno'],$_POST['itmnam'],$_POST['tabno']))
{
    // 
    $date = $_POST['date'];
    $ymd = DateTime::createFromFormat('m/d/Y', $date)->format('Y-m-d');
    $itmno = $_POST['itmno'];
    $itmnam = $_POST['itmnam'];
    $prc = $_POST['prc'];
    $qty = $_POST['qty'];
    $tot = $_POST['tot'];
    $tabno = $_POST['tabno'];
    
    if(!empty($itmno) && !empty($itmnam) && !empty($prc) && !empty($qty))
    {
        $q3="SELECT * FROM `parcel` WHERE `kot_num`=0 AND `tabno`='$tabno' AND `itmno`='$itmno'";
        $conf3=mysqli_query($conn,$q3);
        if(mysqli_num_rows($conf3)>0)
        {
            while($row3=mysqli_fetch_assoc($conf3))
            {
                $qty1=$row3['qty']+$qty;
                $tot1=$prc*$qty1;
                mysqli_query($conn, "UPDATE `parcel` SET `qty`='$qty1',`tot`='$tot1' WHERE `kot_num`=0 AND `tabno`='$tabno' AND `itmno`='$itmno';");
                mysqli_query($conn, "UPDATE `kot` SET `qty`='$qty1' WHERE `tabno`='$tabno' AND `itmnam`='$itmnam';");
            }
        }else
        {
            mysqli_query($conn,"INSERT INTO `kot` VALUES('','$ymd','$itmnam','$qty','$tabno','',0,0,0)");

            $q="SELECT `id` FROM `kot` ORDER BY id DESC LIMIT 1";
            $conf=mysqli_query($conn,$q);
            while($row=mysqli_fetch_assoc($conf))
            {
                $id=$row['id'];
                
            }
            $sql="INSERT INTO `parcel`(`slno`, `date`, `itmno`, `itmnam`, `prc`, `qty`, `tot`, `tabno`,`billno`, `status`, `capname`, `kot`,`kot_num`) VALUES('','$ymd','$itmno','$itmnam','$prc','$qty','$tot','$tabno',0,0,'','$id','0')";
            if (!mysqli_query($conn, $sql)) {
                echo 'Error: ' . mysqli_error($conn );
            }
        }
    }
    else{
        echo "all fields are required";
    }
    echo 'success';
}


if(isset($_POST['delete'],$_POST['itmno']))
{
    $itmno = $_POST['itmno'];
      $itmno1=$itmno;
    $sql1="SELECT * FROM `parcel` WHERE `slno`='$itmno'";
    $res=mysqli_query($conn,$sql1);
    while($r=mysqli_fetch_array($res))
    {
        // $date=$r['date'];
        // $itmno=$r['itmno'];
        // $itmnam=$r['itmnam'];
        // $shnam=$r['shnam'];
        // $prc=$r['prc'];
        // $qty=$r['qty'];
        // $tot=$r['tot'];
        $tabno=$r['tabno'];
        $kot=$r['kot'];
        // $tabsec=$r['tabsec'];
        // $billno=$r['billno'];
        // $status=$r['status'];
        // $capname=$r['capname'];
        
       
    }
    $sql2="DELETE FROM `kot` WHERE `id`='".$kot."'";
    mysqli_query($conn, $sql2);
    // $sql="INSERT INTO `trashparcel` (`slno`, `date`, `itmno`, `itmnam`, `shnam`, `prc`, `qty`, `tot`,
    // `tabno`, `tabsec`, `billno`, `status`, `capname`) VALUES
    //             (
    //             '".$itmno."',
    //             '".$date."',
    //             '".$itmno."',
    //             '".$itmnam."',
    //             '".$shnam."',
    //             '".$prc."',
    //             '".$qty."',
    //             '".$tot."',
    //             '".$tabno."',
    //             '".$tabsec."',
    //             '".$billno."',
    //             '".$status."',
    //             '".$capname."')";
    //    mysqli_query($conn, $sql);
              
 $sql1="DELETE FROM `parcel` WHERE `slno`='".$itmno1."'";
mysqli_query($conn, $sql1);
echo $tabno;
       
 
    
}

    // $query="SELECT * FROM `temtable` WHERE `itmno`='$itmno' AND `tabno`='$table_no';";
    // $c=mysqli_query($conn, $query);
    // if(mysqli_num_rows($c)!=0)
    // {
      /*  $sql="DELETE FROM `parcel` WHERE `slno`='$itmno';";
        if (!mysqli_query($conn, $sql)) {
            echo 'Error: ' . mysqli_error($conn );
        }
   // }
}*/


// fetch captain
// if(isset($_POST['Captain'],$_POST['table_no']))
// {
//     $table_no = $_POST['table_no'];
//     $c=mysqli_query($conn, "SELECT `capname` FROM `parcel` WHERE `tabno`='$table_no' LIMIT 1;");
//     if(mysqli_num_rows($c)!=0)
//     {
//         $out = mysqli_fetch_array($c);
//         echo $out['capname'];
//     }
// }

//shift table
// if(isset($_POST['shift'],$_POST['tbl'],$_POST['totbl']))
// {
//     $tbl = $_POST['tbl'];
//     $totbl = $_POST['totbl'];
//     $cfm=mysqli_query($conn, "SELECT * FROM `parcel` WHERE `tabno`='$totbl';");
//     if(mysqli_num_rows($cfm)>0)
//     {
//         echo '<script>alert("Table Already Occupied");</script>';
//         echo '<script>window.location.href="table_form.php";</script>';
//     }else{
//     if(mysqli_query($conn, "UPDATE `parcel` SET `tabno`='$totbl' WHERE `tabno`='$tbl';"))
//     {
//         echo '<script>window.location.href="table_form.php";</script>';
//     }}
// }

// table merge
if(isset($_POST['tabno'],$_POST['merge'],$_POST['x']))
{
     $table = $_POST['tabno'];
     $merge = $_POST['x'];
     for($i=0;$i<count($table)-1;$i++)
     {
        $id = $table[$i];
        $cmf = mysqli_query($conn, "SELECT `itmno`,`qty`,`prc` FROM `parcel` WHERE `tabno`='$id';");
        while($row=mysqli_fetch_array($cmf))
        {
            $itm = $row['itmno'];
            $qty = $row['qty'];
            $prc = $row['prc'];
            for($j=$i+1;$j<count($table);$j++)
            {
                // $id2 = $table[$j];
                // $cf=mysqli_query($conn, "SELECT `qty` FROM `parcel` WHERE `itmno`='$itm' AND `tabno`='$id2';");
                // if(mysqli_num_rows($cf)>0)
                // {
                //     $out = mysqli_fetch_array($cf);
                //     $qty += $out['qty'];
                //     $tot = $prc * $qty;
                //     mysqli_query($conn, "UPDATE `parcel` SET `qty`='$qty',`tot`='$tot' WHERE `itmno`='$itm' AND `tabno`='$id';");
                //     mysqli_query($conn, "DELETE FROM `parcel` WHERE `itmno`='$itm' AND `tabno`='$id2';");
                // }
            }
        }
        
    }
    for($i=0;$i<count($table);$i++)
    {
        $id = $table[$i];
        mysqli_query($conn, "UPDATE `parcel` SET `tabno`='$merge' WHERE `tabno` = '$id';");
        mysqli_query($conn, "UPDATE `kot` SET `tabno`='$merge' WHERE `tabno` = '$id';");
    }
   
}


if(isset($_GET['cancel']))
{
    $kot_num=$_GET['cancel'];
    $sql2 = "INSERT INTO kot_cancel (date,itmno,itmnam,prc,qty,tot,tabno,kot_num) SELECT `date`,`itmno`,`itmnam`,`prc`,`qty`,`tot`,`tabno`,`kot_num` FROM `parcel` HAVING kot_num='$kot_num'";
    if (!mysqli_query($conn, $sql2)) {
        echo json_encode('Error: ' . mysqli_error($conn ));
    }

    $sql3="DELETE FROM `parcel` WHERE `kot_num`='$kot_num'";
    mysqli_query($conn, $sql3);
    echo '<script>window.location.href="../parcel.php"</script>';

}
?>
