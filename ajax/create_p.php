<?php 
require("../dbcon.php");

//addtable edit 
if(isset($_POST['tedit']))
{
    $tedit = $_POST['tedit'];
    $tid = $_POST['tid'];
     $sql="UPDATE `products` SET `pname`='$tedit' where `pid`=$tid";

    if (!mysqli_query($conn, $sql)) {
        die('Error: ' . mysqli_error($conn ));
    }
    echo 'Updated';
}


//delete
if(isset($_GET['del1'])){
    $id = $_GET['del1'];
    $sql1 = "DELETE FROM products WHERE pid='$id'";

    if (!mysqli_query($conn, $sql1)) {
        die('Error: ' . mysqli_error($conn ));
    }
    echo '<script>alert("Record Deleted");</script>';
    echo '<script>location="../add_prodct1.php";</script>';
}
?>