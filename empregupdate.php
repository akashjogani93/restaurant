
<?php 
  include("dbcon.php");

  $type=$_POST['ty'];
  $empid=$_POST['empid'];
  $empname=$_POST['empname'];
  $mobile=$_POST['mobile'];
  $uname=$_POST['uname'];
  $pass=$_POST['pass'];
  $login=$_POST['login'];

  if($login=='get')
  {
    $sql="UPDATE `empreg` SET `empname`='$empname',`mobile`='$mobile',`type`='$type' WHERE `empid`='$empid'";
    if (!mysqli_query($conn,$sql))
    {
      die('Error: ' . mysqli_error($conn));
    }
    $que="DELETE FROM `login` WHERE `id`='$empid'";
    $co=mysqli_query($conn,$que);
    echo 'Success';
  }else
  {
    $sql="UPDATE `empreg` SET `empname`='$empname',`mobile`='$mobile',`type`='$type' WHERE `empid`='$empid'";
    if (!mysqli_query($conn,$sql))
    {
      die('Error: ' . mysqli_error($conn));
    }
    $sql11="INSERT INTO `login`(`id`,`user`,`pass`, `type`) VALUES ('$empid','$uname','$pass','$type')";
    if (!mysqli_query($conn,$sql11))
    {
      die('Error: ' . mysqli_error($conn));
    }
    echo 'update';
  }

?>