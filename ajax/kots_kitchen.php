<?php include('../dbcon.php');

if(isset($_POST['fetchTable']))
{
    $query="SELECT DISTINCT `tabno` FROM `temtable`";
    $result=$conn->query($query);
    $tables=array();
    if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc())
        {
            $tables[]=$row;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($tables);
    $conn->close();
}

if(isset($_POST['tabno']))
{
    $tabno=$_POST['tabno'];
    $tabno=mysqli_real_escape_string($conn, $tabno);
    $query="SELECT DISTINCT `kot_num` FROM `temtable` WHERE `tabno`='$tabno' AND `kot_num`!=0";
    $result=$conn->query($query);
    $kots=array();
    if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc())
        {
            $kotNum=$row['kot_num'];
            $query_search="SELECT `itmnam`,`qty` FROM `temtable` WHERE `kot_num`='$kotNum' AND `kot_num`!=0";
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