
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
    $sql="INSERT INTO `empreg`(`empname`,`mobile`,`type`,`cap_code`) VALUES ('$empname','$mobile','$type','$empid')";
    if (!mysqli_query($conn,$sql))
    {
      die('Error: ' . mysqli_error($conn));
    }
    echo 'Success';
  }else
  {
    $sql="INSERT INTO `empreg`(`empname`,`mobile`,`type`,`cap_code`) VALUES ('$empname','$mobile','$type','$empid')";
    if (!mysqli_query($conn,$sql))
    {
      die('Error: ' . mysqli_error($conn));
    }
    $sql11="INSERT INTO `login`(`id`,`user`,`pass`, `type`) VALUES ('$empid','$uname','$pass','$type')";
    if (!mysqli_query($conn,$sql11))
    {
      die('Error: ' . mysqli_error($conn));
    }
    echo 'Success';
  }

?>