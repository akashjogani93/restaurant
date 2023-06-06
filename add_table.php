<?php
include("dbcon.php");
if(isset($_POST['t1']))
{
  $table_Name = $_POST['t1'];
  $ac = $_POST['ac'];


  $sql="INSERT INTO `addtable`(`table_Name`,`ac`) VALUES ('$table_Name','$ac')";
  mysqli_query($conn, $sql) ;
//print_r($sql);

  echo '<script>alert("The Table was Added Successfully");</script>';
  echo '<script>location="addtable.php";</script>'; 

}
 
?>
<?php
if(isset($_POST['p1']))
{
  $na1=$_POST['p1'];
  $sql="INSERT into products VALUES('','$na1')";
  if (!mysqli_query($conn,$sql))
  {
    die('Error: ' . mysql_error($conn));
    }
  echo '<script>alert("Record Added Successfully");</script>';
  echo '<script>location="add_prodct1.php";</script>';

}

?>
