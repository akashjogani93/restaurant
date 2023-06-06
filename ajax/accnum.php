<?php
include("../dbcon.php");

if(!empty($_POST['itm']))
{
    $acc=$_POST['itm'];
    $query = "SELECT * FROM `item` WHERE `item_code`='$acc'";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    if($count>0) {
        echo "<span style='color:red'>Code Already Existed</span>";
        echo "<script>$('#sub').prop('disabled',true);</script>";
     } else{
            echo "<span style='color:green'>Code Available</span>";
            echo "<script>$('#sub').prop('disabled',false);</script>";

        }


    // echo $acc;
}


if(!empty($_POST['itmm']))
{
    $acc=$_POST['itmm'];
    $sl=$_POST['sl'];
    $query = "SELECT * FROM `item` WHERE `item_code` != '$sl' AND `item_code`='$acc'";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    if($count>0) {
        echo "<span style='color:red'>Code Already Existed</span>";
        echo "<script>$('#sub1').prop('disabled',true);</script>";
     } else{
            echo "<span style='color:green'>Code Available</span>";
            echo "<script>$('#sub1').prop('disabled',false);</script>";

        }


    // echo $acc;
}


if(!empty($_POST['tab']))
{
    $tab=$_POST['tab'];
   
    $query = "SELECT * FROM `addtable` WHERE `table_Name`='$tab'";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    if($count>0) {
        echo "<span style='color:red'>Table Already Existed</span>";
        echo "<script>$('#sub1').prop('disabled',true);</script>";
     } else{
            echo "<span style='color:green'>Table Available</span>";
            echo "<script>$('#sub1').prop('disabled',false);</script>";

        }


    // echo $acc;
}

if(!empty($_POST['tab1']))
{
    $acc=$_POST['tab1'];
    $tid=$_POST['tid'];

    $query = "SELECT * FROM `addtable` WHERE `table_ID` != '$tid' AND `table_Name`='$acc'";
    $result=mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    if($count>0) {
        echo "<span style='color:red'>Table Already Existed</span>";
        echo "<script>$('#adduser').prop('disabled',true);</script>";
     } else{
            echo "<span style='color:green'>Table Available</span>";
            echo "<script>$('#adduser').prop('disabled',false);</script>";

        }


    // echo $acc;
}
?>