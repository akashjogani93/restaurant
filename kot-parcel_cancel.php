<?php include("dbcon.php");

    $tab=$_GET['tab'];
    $kotnumber=$_GET['kotnumber'];
    $sql="UPDATE `parcel` SET `status`='1',`kot_num`='$kotnumber' WHERE `tabno`='$tab' AND `status`='0'";
    $c=mysqli_query($conn, $sql);

    
    $current_date = date('Y-m-d');
    $sql="UPDATE `kot` SET `kot`='1',`kot_num`='$kotnumber' WHERE `tabno`='$tab' AND `date`='$current_date';";
    $c=mysqli_query($conn, $sql);

    $sql1 = "INSERT INTO kot_history (date,itmnam,qty,tabno,kot_num) SELECT `date`,`itmnam`,`qty`,`tabno`,`kot_num` FROM `kot` HAVING tabno='$tab'";
    if (!mysqli_query($conn, $sql1))
    {
        echo json_encode('Error: ' . mysqli_error($conn ));
    }

    $stmt ="DELETE FROM kot WHERE tabno='$tab' AND kot_num='$kotnumber'";
    if (!mysqli_query($conn, $stmt)) 
    {
        echo json_encode('Error: ' . mysqli_error($conn ));
    }
    header('Location: parcel.php?statuscancel='.urlencode($tab));
?>