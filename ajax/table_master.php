<?php 
session_start();
$cash_type=$_SESSION['tye'];
$cash_id=$_SESSION['id'];
$name=$_SESSION['name'];
$sheduledate=$_SESSION['sheduledate'];

$editbillno = isset($_SESSION['billno']) ? $_SESSION['billno'] : '';
$billEdit = isset($_SESSION['billEdit']) ? $_SESSION['billEdit'] : '';

date_default_timezone_set('Asia/Kolkata');
include("../dbcon.php");

//search table no
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

//captain code
if(isset($_POST['capcode']))
{
    $search = mysqli_real_escape_string($conn,$_POST['capcode']);
    // $query = "SELECT `empname` FROM `empreg` where `type` ='Captain' AND `empname` LIKE '%".$search."%'";
    $query = "SELECT `cap_code` FROM `empreg` where `cap_code` != 0 AND `type`!='Cashier' AND `cap_code` LIKE '%".$search."%'";
    $result = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_array($result) )
    {
        $response[] = array("value"=>$row['cap_code'],"label"=>$row['cap_code']);
    }
    
    echo json_encode($response);
}

//table master table no on change
if(isset($_POST['tabName']))
{
    $search = $_POST['tabName'];
    $response="none";
    $query = "SELECT * FROM `addtable` WHERE `table_Name`='$search'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) > 0)
    {
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
                        $response="none";
                    }
                }
            }
        }
    }
    echo json_encode($response);
}


//captain code replace
if(isset($_POST['cap_code']))
{
    $search = $_POST['cap_code'];
    $response="none";
    $query = "SELECT `cap_code`,`empname` FROM `empreg` WHERE `type`!='Manager' AND `cap_code`='$search'";
    $result = mysqli_query($conn,$query);
    $response=[];
    while($row = mysqli_fetch_array($result) )
    {
        array_push($response,$row['cap_code'],$row['empname']);
    }

    echo json_encode($response);
}

if(isset($_POST['item_no']))
{
    $itmno=$_POST['item_no'];
    $table_no=$_POST['table_no'];

	$a = array();
	$sql1 = "SELECT `ac` FROM `addtable` WHERE `table_Name`='$table_no'";
	$result1 = mysqli_query($conn, $sql1);
	while($row1 = mysqli_fetch_assoc($result1))
	{
		$ac=$row1['ac'];
		$sql = "SELECT * FROM `item` WHERE `item_code`='$itmno'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) 
		{
			while($row = mysqli_fetch_assoc($result))
            {
                if($ac=='Non Ac')
                {
                    $price=$row['prc'];
                }else if($ac=='Ac')
                {
                    $price=$row['prc2'];
                }else
                {
                    $price=0;
                }
                $pid=$row['pid'];
                array_push($a,$row['item_code'],$row['itmnam'],$price,$pid);
			}
		}else
		{
			array_push($a,'Wrong Code');
		}
	}
	echo json_encode($a);
}


//search item no
if(isset($_POST['itemnamedata']))
{
    $search = mysqli_real_escape_string($conn,$_POST['itemnamedata']);
    $query = "SELECT * FROM `item` where `itmnam` LIKE '%".$search."%'";
    $result = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['slno'],"label"=>$row['itmnam']);
    }
    echo json_encode($response);
}

if(isset($_POST['itemname']))
{
    $itnam=$_POST['itemname'];
    $table_no=$_POST['ite_table_no'];
    $a = array();
    $sql1 = "SELECT `ac` FROM `addtable` WHERE `table_Name`='$table_no'";
    $result1 = mysqli_query($conn, $sql1);
    while($row1 = mysqli_fetch_assoc($result1))
    {
        $ac=$row1['ac'];
        $sql = "SELECT * FROM item WHERE itmnam='$itnam'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result))
            {
                if($ac=='Non Ac')
                {
                    $price=$row['prc'];
                }else if($ac=='Ac')
                {
                    $price=$row['prc2'];
                }else
                {
                    $price=0;
                }
                $pid=$row['pid'];
                array_push($a,$row['item_code'],$row['itmnam'],$price,$pid);
            }
        }
    }
    echo json_encode($a);
}

//INSERTING ORDER STARTING
if(isset($_POST['captain']) && isset($_POST['itmnam']))
{
    $date = $_POST['date'];
    // $ymd = DateTime::createFromFormat('m/d/Y', $sheduledate)->format('Y-m-d');
    $ymd=$sheduledate;
    $itmno = $_POST['itmno'];
    $itmnam = $_POST['itmnam'];
    $captain = $_POST['captain'];
    $prc = $_POST['prc'];
    $qty = $_POST['qty'];
    $tot = $_POST['tot'];
    $pid = $_POST['pid'];
    $captainCode = $_POST['captainname'];
    $tabno = $_POST['tabno'];
    $current_time = date("h:i A");
    $type=0;
    if($billEdit==true)
    {   
        $status=1;
        $bill=$editbillno;
    }else
    {
        $status=0;
        $bill=0;
    }
    $searchTem="SELECT * FROM `temtable` WHERE `kot_num`=0 AND `tabno`='$tabno' AND `itmno`='$itmno' AND `status`='$status' AND `billno`='$bill' AND `type`='$type'";
    $searchResult=mysqli_query($conn,$searchTem);
    if(mysqli_num_rows($searchResult)>0)
    {
        while($row3=mysqli_fetch_assoc($searchResult))
        {
            $slno=$row3['slno'];
            $qty1=$row3['qty']+$qty;
            $tot1=$prc*$qty1;
            mysqli_query($conn,"UPDATE `temtable` SET `capname`='$captain',`cap_code`='$captainCode',`time`='$current_time',`qty`='$qty1',`tot`='$tot1' WHERE `slno`='$slno'");
        }
    }else
    {
            $temInsert="INSERT INTO `temtable`(`date`, `itmno`, `itmnam`, `prc`, `qty`, `tot`, `tabno`, `capname`, `billno`, `status`, `kot`, `kot_num`,`cap_code`,`time`,`type`,`pid`) VALUES ('$ymd','$itmno','$itmnam','$prc','$qty','$tot','$tabno','$captain','$bill','$status',0,0,'$captainCode','$current_time','$type','$pid')";
            $temInsertResult=mysqli_query($conn,$temInsert);
            if($temInsertResult)
            {
                mysqli_query($conn, "UPDATE `temtable` SET `capname`='$captain',`cap_code`='$captainCode' WHERE `tabno`='$tabno' AND `status`='$status' AND `billno`='$bill' AND `type`='$type'");
            }
        else
        {
            echo 'Error: ' . mysqli_error($conn );
        }
    }
}

//KOT-PRINT TABLE
if(isset($_POST['kot']))
{
    if($billEdit==true)
    {   
        $status=1;
        $bill=$editbillno;
    }else
    {
        $status=0;
        $bill=0;
    }
    
    $current_time = date("h:i A");
    $tabno=$_POST['kot'];
    $type=0;
    $sqlkot="SELECT MAX(kot_num) AS kotnumber
                FROM (
                    SELECT kot_num FROM temtable WHERE `date` = '$sheduledate'
                    UNION
                    SELECT kot_num FROM tabledata WHERE `date` = '$sheduledate'
                    UNION
                    SELECT kot_num FROM kot_cancel WHERE `date` = '$sheduledate'
                    UNION
                    SELECT 1 AS kot_num -- Default value if date doesn't match in any table
                ) AS my_alias;";
    $result1=mysqli_query($conn, $sqlkot);
    while($row = mysqli_fetch_array($result1))
    {
        $kotnumber = $row['kotnumber']+1;
    }
       $run=mysqli_query($conn, "UPDATE `temtable` SET `kot_num`='$kotnumber' WHERE `tabno`='$tabno' AND `status`='$status' AND `kot_num`=0 AND `billno`='$bill' AND `type`='$type'");
    if($run)
    {
        echo $kotnumber;
    }else
    {
        echo 'NOT NEW KOT DATA HAVE';
    }
}

//KOT-Cancel
if(isset($_POST['cancel_Kot']) && isset($_POST['reson']) && isset($_POST['tabno']))
{
    $kot=$_POST['cancel_Kot'];
    $reson=$_POST['reson'];
    $tabno=$_POST['tabno'];
    $type=0;
    $cancel_time = date("h:i A");

    $countKotsQuery = "SELECT COUNT(DISTINCT `kot_num`) AS num_kots FROM `temtable` WHERE `tabno`='$tabno'";
    $excCountKots = mysqli_query($conn, $countKotsQuery);
    if($excCountKots)
    {
        // Fetch the result
        $countKotsRow = mysqli_fetch_assoc($excCountKots);
        if($countKotsRow['num_kots'] > 1)
        {
            //  $countKotsRow['num_kots'];
            $query="SELECT * FROM `temtable` WHERE `kot_num`='$kot'";
            $exc=mysqli_query($conn,$query);
            while($row=mysqli_fetch_array($exc))
            {
                $slno = $row['slno'];
                $date = $row['date'];
                $itmno = $row['itmno'];
                $itmnam = $row['itmnam'];
                $prc = $row['prc'];
                $qty = $row['qty'];
                $tot = $row['tot'];
                $tabno = $row['tabno'];
                $captain = $row['capname'];
                $cap_code = $row['cap_code'];
                $kot_time = $row['time'];
                // $reson = 'none';
                $cancel="INSERT INTO `kot_cancel`(`date`, `itmno`, `itmnam`, `prc`, `qty`, `tot`, `tabno`, `kot_num`, `captain`, `cap_code`, `kot_time`, `cancel_time`, `reson`,`cashid`,`type`) VALUES ('$date','$itmno','$itmnam','$prc','$qty','$tot','$tabno','$kot','$captain','$cap_code','$kot_time','$cancel_time','$reson','$cash_id','$type')";
                $exc1=mysqli_query($conn,$cancel);
            }
            mysqli_query($conn,"DELETE FROM `temtable` WHERE `kot_num`='$kot'");
            echo  $countKotsRow['num_kots'];
        }
    }
    
}

//delelte Item
if(isset($_POST['delete'],$_POST['itmno']))
{
    $itmno = $_POST['itmno'];
    $itmno1=$itmno;
    $a=array();
    $sql1="SELECT * FROM `temtable` WHERE `slno`='$itmno'";
    $res=mysqli_query($conn,$sql1);
    while($r=mysqli_fetch_array($res))
    {
        $slno=$r['slno'];
        $date=$r['date'];
        $itmno=$r['itmno'];
        $itmnam=$r['itmnam'];
        $prc=$r['prc'];
        $qty=$r['qty'];
        $tot=$r['tot'];
        $tabno=$r['tabno'];
        $billno=$r['billno'];
        $capname=$r['capname'];
        $kot_num=$r['kot_num'];
        $cap_code=$r['cap_code'];
        $time=$r['time'];
        $query="SELECT * FROM `temtable` WHERE `billno`='$billno' AND `tabno`='$tabno'";
        $exccheck=mysqli_query($conn,$query);
        if(mysqli_num_rows($exccheck) > 1)
        {
            $sql="INSERT INTO `trash`(`date`, `itemname`, `itmno`, `prc`, `qty`, `tot`, `tabno`, `capname`, `kot_num`, `capcode`, `time`) VALUES ('$date','$itmnam','$itmno','$prc','$qty','$tot','$tabno','$capname','$kot_num','$cap_code','$time')";
            $exc=mysqli_query($conn, $sql);
            if($exc)
            {
                mysqli_query($conn,"DELETE FROM `temtable` WHERE `slno`='$slno'");
            }
            array_push($a,$tabno,'Deleted');
        }else
        {
            array_push($a,$tabno,'You cant Delete');
        }
    }
    echo json_encode($a);
    // echo $tabno;
}

//merge Table
// table merge
if(isset($_POST['tabno'],$_POST['merge'],$_POST['x']))
{
    $table = $_POST['tabno'];
    $merge = $_POST['x'];
    $newtable=$table[0];
    $cf=mysqli_query($conn, "SELECT `capname`,`cap_code` FROM `temtable` WHERE `tabno`='$newtable' AND `status`=0");
    $out = mysqli_fetch_array($cf);
    $capname=$out['capname'];
    $cap_code=$out['cap_code'];
    for($i=0;$i<count($table);$i++)
    {
        $id = $table[$i];
        mysqli_query($conn, "UPDATE `temtable` SET `tabno`='$merge',`capname`='$capname',`cap_code`='$cap_code' WHERE `tabno` = '$id' `status`=0;");
        // mysqli_query($conn, "UPDATE `kot` SET `tabno`='$merge',`capname`='$capname',`cap_code`='$cap_code' WHERE `tabno` = '$id';");
    }
}

if(isset($_POST['dayShedule'],$_POST['userid']))
{
    $dayShedule = $_POST['dayShedule'];
    $userid = $_POST['userid'];
    $time = date("h:i A");
    $query="INSERT INTO `dayshedule`(`date`, `time`, `userid`, `shedule`) VALUES ('$dayShedule','$time','$userid',1)";
    $exc=mysqli_query($conn,$query);
    if($exc)
    {
        echo 'Day Sheduled';
    }
}

if(isset($_POST['dayclose'],$_POST['userid']))
{
    $dayShedule = $_POST['dayclose'];
    $userid = $_POST['userid'];
    $time = date("h:i A");
    $query="INSERT INTO `dayshedule`(`date`, `time`, `userid`, `shedule`) VALUES ('$dayShedule','$time','$userid',0)";
    $exc=mysqli_query($conn,$query);
    if($exc)
    {
        unset($_SESSION['sheduledate']);
        unset($_SESSION['sheduleid']);
        echo 'Day Closed';
    }
}
?>