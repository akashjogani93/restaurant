<?php
require("../dbcon.php");
if(isset($_POST['cat']))
{
    $cat = ucfirst($_POST['cat']);
    $query="INSERT INTO `item-categories`(`cat_id`, `category`) VALUES ('','$cat');";
    if(mysqli_query($conn, $query))
    {
       echo "success";
    }
}

if(isset($_POST['cat1']))
{
    $itmnam = ucfirst($_POST['itm']);
    $prc = $_POST['prc'];
    $prc1 = $_POST['prc1'];

    $itm_code = $_POST['itm_code'];

    $cat = ucfirst($_POST['cat1']);

    $sql="INSERT INTO `item`(`item_cat`, `itmnam`,`prc`, `prc2`,`item_code`) VALUES ('$cat','$itmnam','$prc','$prc1','$itm_code')";
    $conform=mysqli_query($conn, $sql);
    if($conform)
    {
        echo 'sucees';
    }

}

if(isset($_POST['editcat1']))
{
    $itmnam = ucfirst($_POST['itm']);
    $prc = $_POST['prc'];
    $prc1 = $_POST['prc1'];
    $id = $_POST['sl'];
    $itmm_code = $_POST['itmm_code'];
    $itmm_code1 = $_POST['itmm_code1'];
    $cat = ucfirst($_POST['editcat1']);

    $sql="UPDATE item SET item_cat='$cat', itmnam='$itmnam', prc='$prc',prc2='$prc1',item_code='$itmm_code' WHERE item_code='$itmm_code1'";

    if (!mysqli_query($conn, $sql)) {
        die('Error: ' . mysqli_error($conn ));
    }
    echo 'sucess';
}

if(isset($_GET['del'])){
    $id = $_GET['del'];
    $sql1 = "DELETE FROM item WHERE slno='$id'";

    if (!mysqli_query($conn, $sql1)) {
        die('Error: ' . mysqli_error($conn ));
    }
    echo '<script>alert("Record Deleted");</script>';
    echo '<script>location="../item_form.php";</script>';
}
//final_search.php ajax call by final print button
// if(isset($_POST['tot']))
// {
//     $tabno = $_POST['tabno'];
//     $query="SELECT SUM(`tot`) FROM `temtable` WHERE `tabno`='$tabno';";
//     if($c=mysqli_query($conn, $query))
//     {
//        $out = mysqli_fetch_array($c);
//        echo $out['SUM(`tot`)'];
//     }
// }


if(isset($_POST['catsus']))
{
    $query="SELECT DISTINCT `category` FROM `item-categories`;";
    $c=mysqli_query($conn, $query);
    $a = array();
    if (mysqli_num_rows($c) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($c)) { 
            array_push($a,$row['category']);
        }
    }
    echo json_encode($a);
    
}



//addtable edit 
if(isset($_POST['tedit']))
{
    $tedit = $_POST['tedit'];
    $tid = $_POST['tid'];
    $ac1 = $_POST['ac1'];
     $sql="UPDATE `addtable` SET `table_Name`='$tedit',`ac`='$ac1' where `table_ID`=$tid";

    if (!mysqli_query($conn, $sql)) {
        die('Error: ' . mysqli_error($conn ));
    }
    echo 'Table Updated';
}

//delete
if(isset($_GET['del1'])){
    $id = $_GET['del1'];
    $sql1 = "DELETE FROM addtable WHERE table_ID='$id'";

    if (!mysqli_query($conn, $sql1)) {
        die('Error: ' . mysqli_error($conn ));
    }
    echo '<script>alert("Record Deleted");</script>';
    echo '<script>location="../addtable.php";</script>';
}



//final_search.php ajax call by final print button
if(isset($_POST['tot']))
{
    $tabno = $_POST['tabno'];
    $query="SELECT SUM(`tot`) FROM `temtable` WHERE `tabno`='$tabno';";
    if($c=mysqli_query($conn, $query))
    {
       $out = mysqli_fetch_array($c);
       echo $out['SUM(`tot`)'];
    }
}

?>