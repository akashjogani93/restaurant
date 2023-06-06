<?php include('../dbcon.php');
    $empid=$_POST['empid'];
    $login=$_POST['login'];
    $uname=$_POST['uname'];

    $q="DELETE FROM `empreg` WHERE `empid`='$empid'";
    $r=mysqli_query($conn,$q);

    if($login=='not')
    {
        $q1="DELETE FROM `login` WHERE `type`='$uname' AND `id`='$empid'";
        $r=mysqli_query($conn,$q1);
    }
    echo 'Deleted';
?>