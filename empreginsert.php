<?php 
//     $id=$_POST['empid'];
//     $emp=$_POST['empname'];
//     //$add=$_POST['address'];
//     //$mobile=$_POST['mobile'];
//     $type=$_POST['type'];
//     //$salary=$_POST['salary'];
//    $log="log1";

//     if(isset($_POST['uname']))
//     {
//       $log="log";
//       $uname=$_POST['uname'];
//     }else{
//       $uname="";
//     }

//    if(isset($_POST['password']))
//    {
//      $password=$_POST['password'];
//    }else{
//      $password="";
//    }
//     //if(isset($_POST['cap_code']))
//     //$cap_code=$_POST['cap_code'];
//     //else
//         $cap_code=$id;

    

// include("dbcon.php");
// $sql="INSERT into empreg VALUES('$id','$emp','','','','','','$type','$uname','$password','$cap_code')";
// if (!mysqli_query($conn,$sql))
// {
//   	die('Error: ' . mysqli_error($conn));
// }
// if($password !='')
// {
//   $sql11="INSERT into login VALUES('$id','$uname','$password','Cashier','')";
//   if (!mysqli_query($conn,$sql11))
//   {
//       die('Error: ' . mysqli_error($conn));
//   }
// }
//     echo '<script>alert("User Record Added");</script>';
//     echo '<script>location="empreg.php";</script>';
?>

<?php 
  include("dbcon.php");

  $type=$_POST['ty'];
  $empid=$_POST['empid'];
  $empname=$_POST['empname'];
  $uname=$_POST['uname'];
  $pass=$_POST['pass'];
  $login=$_POST['login'];

  if($login=='get')
  {
    $sql="INSERT into empreg VALUES('$empid','$empname','','','','','','$type','','','$empid')";
    if (!mysqli_query($conn,$sql))
    {
      die('Error: ' . mysqli_error($conn));
    }
    echo 'Success';
  }else
  {
    $sql="INSERT into empreg VALUES('$empid','$empname','','','','','','$type','$uname','$pass','$empid')";
    if (!mysqli_query($conn,$sql))
    {
      die('Error: ' . mysqli_error($conn));
    }
    $sql11="INSERT into login VALUES('$empid','$uname','$pass','$type','')";
    if (!mysqli_query($conn,$sql11))
    {
      die('Error: ' . mysqli_error($conn));
    }
    echo 'Success';
  }

?>