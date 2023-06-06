<?php 
include("dbcon.php");

if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($conn,$_POST['search']);
    $sql = "SELECT * FROM  products WHERE pname LIKE '%".$search."%'";
    $result = mysqli_query($conn,$sql);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['pname'],"label"=>$row['pname']);
    }

    echo json_encode($response);
}

exit;
?>