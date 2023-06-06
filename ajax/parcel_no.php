<?php 
include("../dbcon.php");
if(isset($_POST['search']))
{
    $search = mysqli_real_escape_string($conn,$_POST['search']);
    $query = "SELECT * FROM `parsetable` where `parce_no` LIKE '%".$search."%'";
    $result = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['parce_no'],"label"=>$row['parce_no']);
    }

    echo json_encode($response);
}

?>