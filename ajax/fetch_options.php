<?php include('../dbcon.php');

// Retrieve options from the database
if(isset($_POST['opt']))
{
    $categoryOption=$_POST['categoryOption'];
    $sql = "SELECT pid,pname FROM products WHERE `category`='$categoryOption'";
    $result = $conn->query($sql);

    $options = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options[] = $row;
        }
    }

    // Return the options as JSON response
    header('Content-Type: application/json');
    echo json_encode($options);

    $conn->close();
}

if(isset($_POST['ven']))
{
    $sql = "SELECT slno,vendor FROM vendor";
    $result = $conn->query($sql);
    $options = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options[] = $row;
        }
    }

    // Return the options as JSON response
    header('Content-Type: application/json');
    echo json_encode($options);

    $conn->close();
}

if(isset($_POST['cat']))
{
    $sql = "SELECT id,CategoryName FROM categoroy";
    $result = $conn->query($sql);
    $options = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options[] = $row;
        }
    }

    // Return the options as JSON response
    header('Content-Type: application/json');
    echo json_encode($options);

    $conn->close();
}

if(isset($_POST['addcat']))
{
    $addcat = $_POST['addcat'];
    $sqli= "INSERT INTO categoroy(`CategoryName`) VALUES ('$addcat') ";
    if (!mysqli_query($conn, $sqli)) {
        die('Error: ' . mysqli_error($conn ));
    }
    echo 'Category Added';

}

if(isset($_POST['catName']))
{
    $catName = $_POST['catName'];
    $product = $_POST['product'];
    $unit = $_POST['unit'];
    $insert = $_POST['insert'];
    $catName = mysqli_real_escape_string($conn, $catName);
    $product = mysqli_real_escape_string($conn, $product);
    $unit = mysqli_real_escape_string($conn, $unit);

    if($insert=="Insert")
    {
        $tax = $_POST['tax'];
        $checkQuery = "SELECT * FROM `products` WHERE `pname` = '$product'";
        $result=$conn->query($checkQuery);
        if($result->num_rows > 0)
        {
            $matchingproduct = false;
            while ($row = $result->fetch_assoc()) 
            {
                if ($row['pname'] === $product) 
                {
                    $matchingproduct = true;
                    echo 1;
                }
            }
        }else
        {
            $sql="INSERT INTO `products`(`pname`, `category`, `unit`,`tax`) VALUES ('$product','$catName','$unit','$tax')";
            if ($conn->query($sql) === TRUE) 
            {
                echo 0;
            } else {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
        }
    }else
    {
        $id=$_POST['productId'];
        $id = mysqli_real_escape_string($conn, $id);
        $checkQuery = "SELECT * FROM `products` WHERE (`pname` = '$product') AND `pid` != '$id'";
        $result=$conn->query($checkQuery);
        if($result->num_rows > 0)
        {
            $matchingproduct = false;
            while ($row = $result->fetch_assoc()) 
            {
                if ($row['pname'] === $product) 
                {
                    $matchingproduct = true;
                    echo 1;
                }
            }
        }else
        {
            $checkQuery1 = "SELECT * FROM `stock1` WHERE `pname` = '$product' AND `unit`='$unit'";
            $result1=$conn->query($checkQuery1);
            if($result1->num_rows > 0)
            {
                while ($row = $result1->fetch_assoc()) 
                {
                    if ($row['pname'] === $product) 
                    {
                        echo 2;
                    }
                }
            }else
            {
                $tax1 = $_POST['tax'];
                $query="UPDATE `products` SET `pname`='$product',`unit`='$unit',`category`='$catName',`tax`='$tax1' WHERE `pid`='$id'";
                if ($conn->query($query) === TRUE)
                {
                    echo 0;
                } else {
                    echo "Error: " . $query . "<br>" . $conn->error;
                }
            }
        }
    }
}

if(isset($_POST['selectedpname']))
{
    $pname=$_POST['selectedpname'];
    $sql = "SELECT `unit`,`tax` FROM `products` WHERE `pname`='$pname'";
    $result = $conn->query($sql);
    $options = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // $unit=$row['unit'];
            $options[]=$row;
        }
    }
    // Return the options as JSON response
    header('Content-Type: application/json');
    echo json_encode($options);

    $conn->close();
}

if(isset($_POST['vendorOption']))
{
    $venId=$_POST['vendorOption'];
    $query="SELECT * FROM `vendor_payment` WHERE `venId`='$venId'";
    $result=$conn->query($query);
    $options=array();
    if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc())
        {
            $options[]=$row;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($options);

    $conn->close();
}

if(isset($_POST['amountPay']))
{
    $amountPay=$_POST['amountPay'];
    $discount=$_POST['discount'];
    $pendingAmount=$_POST['pendingAmount'];
    $vendorName=$_POST['vendorName'];

    $lastPending=$pendingAmount-($amountPay+$discount);
    $currentDate = date("Y-m-d");
    // $updatevendor=($amountPay+$discount);
    $settle=1;
    $zero=0;
    $paymentstmt=$conn->prepare("INSERT INTO `vendor_payment`(`date`,`amt`,`paid`, `remain`, `disc`,`settle`,`venId`) VALUES(?, ?, ?, ?, ?, ?, ?)");
    $paymentstmt->bind_param("sddddii",$currentDate,$zero,$amountPay,$zero,$discount,$settle,$vendorName);
    $paymentstmt->execute();
    $paymentstmt->close();

    // $updateStmt = $conn->prepare("UPDATE `vendor` SET `paid` = `paid` + ? WHERE `vendor` = ?");
    // $updateStmt->bind_param("ds",$updatevendor,$vendorName);
    // $updateStmt->execute();
    // $updateStmt->close();

    $conn->close();
    $response = array('status' => 'success', 'message' => 'Data submitted successfully');
    echo json_encode($response);
    // header('Content-Type: application/json');
    // echo json_encode($currentDate);
}


if(isset($_POST['stock']))
{
    $cat_name=$_POST['catName1'];
    if($cat_name=='')
    {
        $query1 = "SELECT * FROM `stock1`";
    }else
    {
        $query1 = "SELECT * FROM `stock1` WHERE `category`='$cat_name'";
    }
    // $exc=mysqli_query($conn,$query1);
    // $query="SELECT * FROM `stock1`";
    $result=$conn->query($query1);
    $options=array();
    if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc())
        {
            $options[]=$row;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($options);

    $conn->close();
}


if(isset($_POST['wastageStock']))
{
    $cat_name=$_POST['WastagecatName1'];
    if($cat_name=='')
    {
        $query1 = "SELECT * FROM `vestage`";
    }else
    {
        $query1 = "SELECT * FROM `vestage` WHERE `category`='$cat_name'";
    }
    $result=$conn->query($query1);
    $options=array();
    if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc())
        {
            $options[]=$row;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($options);

    $conn->close();
}
?>