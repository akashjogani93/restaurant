<?php
include("dbcon.php");

if(isset($_POST['submit']))
{
    $itmid = $_POST['itmid'];
    $itmnam = $_POST['itmname'];
    $itmunit = $_POST['itmunit'];
    $remqty = $_POST['remqty'];
    $itmqty = $_POST['itmqty'];
    $gdate = $_POST['gvndate'];
    $remqty1 = $remqty - $itmqty;
    
    $sql="INSERT into  store_room_finish VALUES('','$itmid', '$itmnam','$itmunit','$remqty1','$itmqty','$gdate','kitchen1')";
    mysqli_query($conn, $sql);
    $sql1="UPDATE store_room SET remain='$remqty1' WHERE item_name='$itmid' ";
    
    if (!mysqli_query($conn, $sql1)) {
        die('Error: ' . mysqli_error($conn ));
    }
    echo '<script>alert("Record Updated");</script>';
    echo '<script>location="kitchen_form.php";</script>';
}


if(isset($_POST['update']))
{
    
    $fid = $_POST['fid'];
    $sql1 = "DELETE FROM store_room_finish WHERE fid='$fid'";
    if (!mysqli_query($conn, $sql1)) 
    {
        die('Error: ' . mysqli_error($conn ));
    }
    $itmid = $_POST['itmid'];
    $itmnam = $_POST['itmname'];
    $itmunit = $_POST['itmunit'];
    $remqty = $_POST['remqty'];
    $itmqty = $_POST['itmqty'];
    $gdate = $_POST['gvndate'];
    $remqty1 = $remqty - $itmqty;
    
    $sql="INSERT into  store_room_finish VALUES('','$itmid', '$itmnam','$itmunit','$remqty1','$itmqty','$gdate','kitchen1')";
    mysqli_query($conn, $sql);
    $sql1="UPDATE store_room SET item_qty='$remqty1' WHERE item_name='$itmid' ";
    
    if (!mysqli_query($conn, $sql1)) {
        die('Error: ' . mysqli_error($conn ));
    }
    echo '<script>alert("Record Updated");</script>';
    echo '<script>location="kitchen_form.php";</script>';
}
?>