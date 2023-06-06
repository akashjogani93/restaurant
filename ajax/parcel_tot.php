<?php 
include("../dbcon.php");
    if(isset($_POST['tot']))
    {
        $tabno = $_POST['tabno'];
        $query="SELECT SUM(`tot`) FROM `parcel` WHERE `tabno`='$tabno';";
        if($c=mysqli_query($conn, $query))
        {
           $out = mysqli_fetch_array($c);
           echo $out['SUM(`tot`)'];
        }
    }
?>