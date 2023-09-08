<?php include('../dbcon.php');

if(isset($_POST['fetchTable']))
{
    $query="SELECT DISTINCT `tabno` FROM `temtable`";
    $result=$conn->query($query);
    $tables=array();
    $parcels=array();
    if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc())
        {
            $tables[]=$row;
        }
    }
    $query1="SELECT DISTINCT `tabno` FROM `parcel`";
    $result1=$conn->query($query1);
    if($result1->num_rows > 0)
    {
        while($row1=$result1->fetch_assoc())
        {
            $parcels[]=$row1;
        }
    }

    header('Content-Type: application/json');
    echo json_encode(array("tables" => $tables, "parcels" => $parcels));
    $conn->close();
}

if(isset($_POST['tabno']))
{
    $tabno=$_POST['tabno'];
    $status=$_POST['status'];

    $tabno=mysqli_real_escape_string($conn, $tabno);
    $status=mysqli_real_escape_string($conn, $status);

    if($status==0)
    {
        $tableName='temtable';
    }else
    {
        $tableName='parcel';
    }
    $query="SELECT DISTINCT `kot_num` FROM $tableName WHERE `tabno`='$tabno' AND `kot_num`!=0";
    $result=$conn->query($query);
    $kots=array();
    if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc())
        {
            $kotNum=$row['kot_num'];
            $query_search="SELECT `itmnam`,`qty` FROM $tableName WHERE `kot_num`='$kotNum' AND `kot_num`!=0";
            $result_search=$conn->query($query_search);
            if($result_search->num_rows > 0)
            {
                $kotData = array();
                while($row1=$result_search->fetch_assoc())
                {
                    $itmnam=$row1['itmnam'];
                    $qty=$row1['qty'];
                    $kotData[] = array('itmnam' => $itmnam, 'qty' => $qty);
                }
                $kots[$kotNum] = $kotData;
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode($kots);
}

if(isset($_POST['kotNum']))
{
    $kotNum=$_POST['kotNum'];
    $kotNum=mysqli_real_escape_string($conn, $kotNum);
    $query="SELECT `itmnam`,`qty` FROM `temtable` WHERE `kot_num`='$kotNum' AND `kot_num`!=0";
    $result=$conn->query($query);
    $data=array();
    if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc())
        {
            $data[]=$row;
        }
    }
    $response = new stdClass();
    $response->kotNum = $kotNum;
    $response->data = $data;
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>