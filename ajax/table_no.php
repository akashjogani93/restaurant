<?php session_start();
$cash_type=$_SESSION['tye'];
$cash_id=$_SESSION['id'];
$name=$_SESSION['name'];
include("../dbcon.php");
if(isset($_POST['search']))
{
    $search = mysqli_real_escape_string($conn,$_POST['search']);
    $query = "SELECT * FROM `addtable` where `table_Name` LIKE '%".$search."%'";
    $result = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['table_Name'],"label"=>$row['table_Name']);
    }

    echo json_encode($response);
}

// if(isset($_POST['wingname']))
// {
//     $search = $_POST['wingname'];
//     $response="none";
//     $query = "SELECT * FROM `addtable` where `table_Name`='$search'";
//     $result = mysqli_query($conn,$query);
    
//     while($row = mysqli_fetch_array($result) )
//     {
//         $response=$row['table_Name'];
//     }

//     echo json_encode($response);
// }

if(isset($_POST['cap_code']))
{
    $search = $_POST['cap_code'];
    $response="none";
    $query = "SELECT `cap_code`,`empname` FROM `empreg` WHERE `type`!='Cashier' AND `cap_code`='$search'";
    // $query = "SELECT `cap_code` FROM `empreg` where `cap_code` != 0 AND `type`!='Cashier' AND `cap_code` LIKE '%".$search."%'";

    $result = mysqli_query($conn,$query);
    $response=[];
    while($row = mysqli_fetch_array($result) )
    {
        
        array_push($response,$row['cap_code'],$row['empname']);
    }

    echo json_encode($response);
}


if(isset($_POST['wingname']))
{
    $search = $_POST['wingname'];
    $response="none";

    $query = "SELECT * FROM `addtable` where `table_Name`='$search'";
    $result = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_array($result) )
    {
        $response=$row['table_Name'];
        if($cash_type=='Captain')
        {
            $query1="SELECT * FROM `temtable` WHERE `capname`!='$name' AND `tabno`='$response'";
            $result1 = mysqli_query($conn,$query1);
            $rows=mysqli_num_rows($result1);
            if($rows > 0)
            {
                while($row1 = mysqli_fetch_array($result1) )
                {
                    // $response1=$row1['tabno'];
                    $response="none";
                }
            }
        }
    }

    echo json_encode($response);
}
exit;
?>