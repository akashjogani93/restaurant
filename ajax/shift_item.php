<?php include("../dbcon.php");
if(isset($_POST['item_no']))
{
    $item_no=$_POST['item_no'];
    $table=$_POST['table'];
    $q22="SELECT `capname`,`cap_code` FROM `temtable` WHERE `tabno`='$table' AND `status`=0";
    $conf11=mysqli_query($conn,$q22);
    if(mysqli_num_rows($conf11)>0)
    {
        while($row111=mysqli_fetch_assoc($conf11))
        {
            $capname1=$row111['capname'];
            $cap_code1=$row111['cap_code'];
        }
    }else
    {
        $capname1='';
        $cap_code1='';
    }
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
                $cap_code1=$row['cap_code'];
            }
            $capname1;
            $cap_code1;
            $date=$row['date'];
            $itmnam=$row['itmnam'];
            $qty=$row['qty'];
            $kot=$row['kot'];

            if($kot_num !=0)
            {

                $exc=mysqli_query($conn,"UPDATE `temtable` SET `tabno`='$table',`kot_num`=0,`capname`='$capname1',`cap_code`='$cap_code1' WHERE `slno`='$item'");
                if($exc)
                {
                    mysqli_query($conn,"DELETE FROM `kot` WHERE `status`='$item'");
                }
            }else
            {
                $exc=mysqli_query($conn,"UPDATE `temtable` SET `tabno`='$table',`kot_num`=0,`capname`='$capname1',`cap_code`='$cap_code1' WHERE `slno`='$item'");
            }
        }        
    }
}
?>