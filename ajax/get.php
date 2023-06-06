<?php

include("../dbcon.php");
$row1="";
$dt = $_REQUEST["id"];
$sql = "select * from store_room where item_name='$dt'";

$result = mysqli_query($conn, $sql) or die("error");

if ($result) {
    while ($row = mysqli_fetch_array($result)) {

     	// $unit=$row['item_unit'];
     	// $qty=$row['item_qty'];
     	 $row1=$row;
    }

// $data=array($unit,$qty);
$data=array($row1);
echo json_encode($data);
}
?>