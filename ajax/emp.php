<?php
include('../dbcon.php');

if(isset($_POST['usertype']))
{
    $query="SELECT DISTINCT `user` FROM `userlist`;";
    $c=mysqli_query($conn, $query);
    $a = array();
    if (mysqli_num_rows($c) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($c)) { 
            array_push($a,$row['user']);
        }
    }
    echo json_encode($a);
    
}

if(isset($_POST['user']))
{
    $user = ucfirst($_POST['user']);
    $query="INSERT INTO `userlist`(`id`, `user`) VALUES ('','$user');";
    if(mysqli_query($conn, $query))
    {
       echo "success";
    }
}
?>