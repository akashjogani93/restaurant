<?php


require_once('../dbcon.php');
//lost
$itnam=$_POST['wingname'];
// $priceform=$_POST['priceform'];
$table_no=$_POST['table_no'];



$a = array();

$sql1 = "SELECT `ac` FROM `addtable` WHERE `table_Name`='$table_no'";
$result1 = mysqli_query($conn, $sql1);
while($row1 = mysqli_fetch_assoc($result1))
{
    $ac=$row1['ac'];
    $sql = "SELECT * FROM item WHERE itmnam='$itnam'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result))
        {
            if($ac=='Non Ac')
            {
                $price=$row['prc'];
            }else if($ac=='Ac')
            {
                $price=$row['prc2'];
            }else
            {
                $price=0;
            }
            array_push($a,$row['item_code'],$row['itmnam'],$price);
        }
    }
}
echo json_encode($a);

?>