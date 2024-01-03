<?php 
session_start();
$cash_type=$_SESSION['tye'];
$cash_id=$_SESSION['id'];
$name=$_SESSION['name'];

include("../dbcon.php");

if(isset($_POST['search']))
{
    $search = mysqli_real_escape_string($conn,$_POST['search']);
    $query = "SELECT DISTINCT `tabno` FROM `temtable` where `tabno` LIKE '%".$search."%'";
    $result = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['tabno'],"label"=>$row['tabno']);
    }

    echo json_encode($response);
}


if(isset($_POST['catsus']))
{
    $catsus2=$_POST['catsus'];
    if($cash_type == 'Captain')
    {
        $query="SELECT DISTINCT `tabno` AS `tabno` FROM `temtable` WHERE `capname`='$name' AND `status`=0 AND `type`=0;";
    }else
    {
        $query="SELECT DISTINCT `tabno` AS `tabno` FROM `temtable` WHERE `status`=0 AND `type`=0";
    }
    $c=mysqli_query($conn, $query);
    $a = array();
    if (mysqli_num_rows($c) > 0) 
    {
        while($row = mysqli_fetch_assoc($c)) 
        {
            array_push($a,$row['tabno']);
        }
    }
    echo json_encode($a);
}

if(isset($_POST['catsus2']))
{
    $query = "SELECT addtable.table_Name
                FROM addtable
                LEFT JOIN temtable
                ON addtable.table_Name = temtable.tabno
            WHERE temtable.tabno IS NULL";
    $c1=mysqli_query($conn, $query);
    $a1 = array();
    if (mysqli_num_rows($c1) > 0) 
    {
        while($row1 = mysqli_fetch_assoc($c1)) 
        { 
            $id='false';
            $tabname1=$row1['table_Name'];
            array_push($a1,$tabname1);
        }
    }
    echo json_encode($a1);
}

if(isset($_POST['catsus1']))
{
    $query="SELECT DISTINCT `tabno` FROM `parcel`;";
    $c=mysqli_query($conn, $query);
    $a = array();
    if (mysqli_num_rows($c) > 0) 
    {
        // output data of each row
        while($row = mysqli_fetch_assoc($c)) { 
            array_push($a,$row['tabno']);
        }
    }
    echo json_encode($a);
}

//table Shift
if(isset($_POST['table1']))
{
   $table1=$_POST['table1'];
   $table2=$_POST['table2'];

    if($table2=="none")
    {
        $table2=$_POST['latebill'];
    }else
    {
        $table2=$_POST['table2'];
    }
    mysqli_query($conn,"UPDATE `temtable` SET `tabno`='$table2' WHERE `tabno`='$table1' AND `status`=0");
    // mysqli_query($conn,"UPDATE `kot` SET `tabno`='$table2' WHERE `tabno`='$table1'");
    echo json_encode('Table Shifted');
}

if(isset($_POST['tabe3']))
{
    $tabe3=$_POST['tabe3'];
    $result = $conn->query("SELECT * FROM `temtable` WHERE `tabno` = '$tabe3' AND `status`=0");
    if ($result->num_rows > 0) {
        echo json_encode('Match found');
    } else {
        echo json_encode('No match found');
    }
}


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




if(isset($_POST['shifttables']))
{
    $shifttables=$_POST['shifttables'];
    $tabno=$_POST['tabno'];
    $query="SELECT DISTINCT `table_Name` AS `tabno` FROM `addtable` WHERE `table_Name`!='$tabno';";
    $c=mysqli_query($conn, $query);
    $a = array();
    if (mysqli_num_rows($c) > 0) {
        while($row = mysqli_fetch_assoc($c)) { 
            array_push($a,$row['tabno']);
        }
    }
    echo json_encode($a);
    
}


?>