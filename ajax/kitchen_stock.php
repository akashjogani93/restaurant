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

    $checkQuery = "SELECT COUNT(*) AS count FROM `stock1` WHERE `pname`='$product' AND `unit`='$unit'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $row = mysqli_fetch_assoc($checkResult);
    $recordCount = $row['count'];
    if ($recordCount > 0) 
    {
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
    }else {
      echo "Data Is Expired.";
    }
}

if(isset($_POST['pid1']))
{
  $pid = $_POST['pid1'];
  $pname = $_POST['pname'];
  $pqty = $_POST['pqty'];
  $punit = $_POST['punit'];
  $rqty = $_POST['rqty'];
  $uqty = $_POST['uqty'];
  $gdate = $_POST['gdate'];

  $query = "SELECT * FROM `beverages` WHERE `pid` = '$pid' AND `punit`='$punit' AND `givenDate`='$gdate'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0)
  {
    $updateQuery = "UPDATE `beverages` SET `uqty` = `uqty` + $uqty WHERE pid = '$pid' AND `punit`='$punit' AND `givenDate`='$gdate'"; 
    $updateResult = mysqli_query($conn, $updateQuery);
    if($updateResult)
    {
        mysqli_query($conn,"UPDATE `stock1` SET `qty`=`qty`-'$uqty' WHERE `pname`='$pname' AND `unit`='$punit'");
        echo "Data Updated successfully.";
    }else 
    {
        echo "Failed to update quantity: " . mysqli_error($conn);
    }
  }else
  {
    $insertQuery="INSERT INTO `beverages`(`pname`, `pid`, `punit`, `givenDate`, `uqty`)VALUES('$pname','$pid','$punit','$gdate','$uqty')";
    $insertResult = mysqli_query($conn, $insertQuery);
    if($insertResult) 
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


if(isset($_POST['wastage']))
{
  $id=$_POST['wastage'];
  $sqlMoveData = "INSERT INTO vestage SELECT * FROM stock1 WHERE id = $id";
    
if ($conn->query($sqlMoveData) === TRUE) {
    // echo "Data moved successfully.";
    $sqlDeleteData = "DELETE FROM stock1 WHERE id = $id";
    // mysqli_query($conn,"UPDATE `stock1` SET `qty`=0 WHERE `pname`='$pname' AND `unit`='$punit'");
    if ($conn->query($sqlDeleteData) === TRUE) 
    {
        echo "Stock Added To Wastage.";
    } else {
        echo "Error deleting data from source table: " . $conn->error;
    }
} else {
    echo "Error moving data: " . $conn->error;
}

// Close connection
$conn->close();
}
?>