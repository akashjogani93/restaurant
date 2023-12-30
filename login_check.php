<?php
ini_set('display_errors', 1);
session_start();
// $na1=$_POST["uname"];

date_default_timezone_set('Asia/Kolkata');

// Fetch the current date and time


$na2=$_POST["pass"];
$user=$_POST["user"];

include("dbcon.php");
$sql="SELECT * FROM `login` WHERE user='$user' and pass='$na2'";
$retval=mysqli_query($conn,$sql);
if(mysqli_num_rows($retval)!=0)
{
	$row=mysqli_fetch_assoc($retval);
	$main=$row["type"];
	$id=$row["id"];
	$_SESSION['tye']=$main;
  	$_SESSION['id']=$id;
	$_SESSION['user_type']="hii";

	if($id!=0)
	{
		$q="SELECT `empname` FROM `empreg` WHERE `empid`='$id'";
		$conf=mysqli_query($conn,$q);
		while($row1=mysqli_fetch_assoc($conf))
		{
			$name=$row1['empname'];
		}
	}else
	{
		$name=$main;
	}
	$_SESSION['name']=$name;

	if($row['user']==$user && $row['pass']==$na2)
	{  
		$currentDateTime = date('Y-m-d H:i:s');
		$query="INSERT INTO `log_info`(`userid`, `logintime`) VALUES ('$id','$currentDateTime')";
		$exc=mysqli_query($conn,$query);

        echo '<script>alert("Login successfull");</script>';
		if($main=='Captain')
		{
			echo '<script>location="table_master.php"</script>';
		}else
		{
			echo '<script>location="home.php"</script>';
		}
        exit;
	}
}
	
echo '<script>alert("Login Unsucessfull");</script>';
echo '<script>location="index.php"</script>';

?>