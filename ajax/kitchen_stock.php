<?php
include('../dbcon.php');


if(isset($_POST['pid']))
{
    $pid = $_POST['pid'];
$pname = $_POST['pname'];
$pqty = $_POST['pqty'];
$punit = $_POST['punit'];
$rqty = $_POST['rqty'];
$uqty = $_POST['uqty'];
$gdate = $_POST['gdate'];

$query = "SELECT * FROM `kitchen_used` WHERE `pid` = '$pid' AND `punit`='$punit' AND `givenDate`='$gdate'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) 
{
    $updateQuery = "UPDATE `kitchen_used` SET `uqty` = `uqty` + $uqty WHERE pid = '$pid' AND `punit`='$punit' AND `givenDate`='$gdate'"; 
    $updateResult = mysqli_query($conn, $updateQuery);
    if($updateResult)
    {
        mysqli_query($conn,"UPDATE `stock1` SET `qty`=`qty`-'$uqty' WHERE `pname`='$pname' AND `unit`='$punit'");
        echo "Data Updated successfully.";
    }else 
    {
        echo "Failed to update quantity: " . mysqli_error($conn);
    }
}else{
  $insertQuery="INSERT INTO `kitchen_used`(`pname`, `pid`, `punit`, `givenDate`, `uqty`)VALUES('$pname','$pid','$punit','$gdate','$uqty')";
  $insertResult = mysqli_query($conn, $insertQuery);
  if ($insertResult) 
  {
    mysqli_query($conn,"UPDATE `stock1` SET `qty`=`qty`-'$uqty' WHERE `pname`='$pname' AND `unit`='$punit'");
    echo "Data inserted successfully.";
  }else
  {
    echo "Failed to insert data: " . mysqli_error($conn);
  }
}

mysqli_close($conn);

}


if(isset($_POST['product']))
{   
    $product = $_POST['product'];
    $unit = $_POST['unit'];
    $date = $_POST['date'];
    $inputValue = $_POST['inputValue'];
    mysqli_query($conn,"UPDATE `stock1` SET `qty`=`qty`+'$inputValue'  WHERE `pname`='$product' AND `unit`='$unit'");
    $query="UPDATE `kitchen_used` SET `uqty`=`uqty`-'$inputValue'  WHERE `pname`='$product' AND `punit`='$unit' AND `givenDate`='$date'";
    $insertResult=mysqli_query($conn,$query);
  //  echo $date;
    if($insertResult) 
    {
      echo 'Added To Store Back'; 
    }else
    {
      echo "Failed to insert data: " . mysqli_error($conn);
    }
}
?>