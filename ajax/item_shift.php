<?php include("../dbcon.php");
if(isset($_POST['item_no']))
{
    $item_no=$_POST['item_no'];
    $table=$_POST['table'];
    $q22="SELECT `capname` FROM `temtable` WHERE `tabno`='$table'";
    $conf11=mysqli_query($conn,$q22);
    if(mysqli_num_rows($conf11)>0)
    {
        while($row111=mysqli_fetch_assoc($conf11))
        {
            $capname1=$row111['capname'];
        }
    }else
    {
        $capname1='';
    }

    // echo $capname1;
    foreach($item_no as $item)
    {
        $q1="SELECT * FROM `temtable` WHERE `slno`='$item'";
        $co=mysqli_query($conn,$q1);
        while($row=mysqli_fetch_assoc($co))
        {
            $kot_num=$row['kot_num'];
            if($capname1=='')
            {
                $capname1=$row['capname'];
            }
            $capname1;
            $date=$row['date'];
            $itmnam=$row['itmnam'];
            $qty=$row['qty'];
            $kot=$row['kot'];

            if($kot_num !=0)
            {
                $exc=mysqli_query($conn,"INSERT INTO `kot` VALUES('','$date','$itmnam','$qty','$table','$capname1',0,0,0)");
                if($exc)
                {
                    $q2="SELECT `id` FROM `kot` ORDER BY `id` DESC LIMIT 1";
                    $conf=mysqli_query($conn,$q2);
                    while($row1=mysqli_fetch_assoc($conf))
                    {
                        $id=$row1['id'];
                        $exc1=mysqli_query($conn,"UPDATE `temtable` SET `tabno`='$table', `status`=0, `kot_num`=0, `capname`='$capname1',`kot`='$id' WHERE `slno`='$item'");
                    }
                }
            }else
            {
                
                mysqli_query($conn,"UPDATE `temtable` SET `tabno`='$table',`capname`='$capname1' WHERE `slno`='$item'");
                mysqli_query($conn,"UPDATE `kot` SET `tabno`='$table',`capname`='$capname1' WHERE `id`='$kot'");
            }
                
        }        
    }
    
}
?>