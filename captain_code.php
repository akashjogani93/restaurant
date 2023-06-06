<?php
include('dbcon.php');
    
    //get search term
    // $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    // $sql = "SELECT `cap_code` FROM `empreg` WHERE `cap_code` != 0 AND `cap_code` LIKE '%".$searchTerm."%'";
    // $retval=mysqli_query($conn, $sql);
    // while ($row = mysqli_fetch_array($retval)) {
    //     $data[] = $row['cap_code'];
    // }
    

if(isset($_POST['search']))
{
    $search = mysqli_real_escape_string($conn,$_POST['search']);
    // $query = "SELECT `empname` FROM `empreg` where `type` ='Captain' AND `empname` LIKE '%".$search."%'";
    $query = "SELECT `cap_code` FROM `empreg` where `cap_code` != 0 AND `type`!='Cashier' AND `cap_code` LIKE '%".$search."%'";
    $result = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_array($result) )
    {
        $response[] = array("value"=>$row['cap_code'],"label"=>$row['cap_code']);
    }
    
    echo json_encode($response);
}
?>