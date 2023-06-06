<?php 

include("../dbcon.php");

if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($conn,$_POST['search']);
    $query = "SELECT * FROM `item` where `itmnam` LIKE '%".$search."%'";
    $result = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['slno'],"label"=>$row['itmnam']);
    }

    echo json_encode($response);
}

exit;
?>

