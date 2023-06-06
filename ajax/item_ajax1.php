<?php
require_once('../dbcon.php');
$itmno=$_POST['wingname'];
// $priceform=$_POST['priceform'];
$ac=$_POST['table_no'];
$a = array();

// $sql1 = "SELECT `ac` FROM `addtable` WHERE `table_Name`='$table_no'";
// $result1 = mysqli_query($conn, $sql1);
// while($row1 = mysqli_fetch_assoc($result1))
// {
	// $ac=$row1['ac'];
	$sql = "SELECT * FROM `item` WHERE `item_code`='$itmno'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) 
	{
		while($row = mysqli_fetch_assoc($result)){
				// if($ac !=1)
				// {
					$price=$row['prc'];
				// }else
				// {
				// 	$price=$row['prc2'];
				// }
			array_push($a,$row['item_code'],$row['itmnam'],$price);
		}
	}else
	{
		array_push($a,'Wrong Code');
	}
// }
echo json_encode($a);
?>