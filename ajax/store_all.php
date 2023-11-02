<?php
include('../dbcon.php');

//store_purchase_product categorys show   and store_product.php category;
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

//Insert Category from store_product;
if(isset($_POST['addcat']))
{
    $addcat = $_POST['addcat'];
    $typeCat = $_POST['typeCat'];
    $addcat = ucfirst($addcat);

    $select="SELECT * FROM `categoroy` WHERE `CategoryName`='$addcat' AND `catType`='$typeCat'";
    $exc=mysqli_query($conn,$select);
    if(mysqli_num_rows($exc) > 0)
    {
        $sqli= "UPDATE `categoroy` SET `CategoryName`='$addcat',`catType`='$typeCat' WHERE `CategoryName`='$addcat' AND 'catType'='$typeCat'";
        if (!mysqli_query($conn, $sqli))
        {
            die('Error: ' . mysqli_error($conn ));
        }
        echo 'Category Updated';
    }
    else
    {
        $sqli= "INSERT INTO `categoroy`(`CategoryName`,`catType`) VALUES ('$addcat','$typeCat')";
        if (!mysqli_query($conn, $sqli)) 
        {
            die('Error: ' . mysqli_error($conn ));
        }
        echo 'Category Added';
    }
}

//Insert product From store_Product;
if(isset($_POST['catName']))
{
    $catName = ucfirst($_POST['catName']);
    $product = ucfirst($_POST['product']);
    $unit = $_POST['unit'];
    $sellUnit = $_POST['sellUnit'];
    $tax = $_POST['tax'];

    $insert = ucfirst($_POST['insert']);

    $catName = mysqli_real_escape_string($conn, $catName);
    $product = mysqli_real_escape_string($conn, $product);
    $unit = mysqli_real_escape_string($conn, $unit);
    $sellUnit = mysqli_real_escape_string($conn, $sellUnit);

    //while inserting
    if($insert=="Insert")
    {
        $checkQuery = "SELECT * FROM `products` WHERE `pname` = '$product' AND `category` = '$sellUnit'";
        $result=$conn->query($checkQuery);
        if($result->num_rows > 0)
        {
            $matchingproduct = false;
            while ($row = $result->fetch_assoc()) 
            {
                // if ($row['pname'] === $product)
                // {
                    $matchingproduct = true;
                    echo 1;
                // }
            }
        }else
        {
            $sql="INSERT INTO `products`(`pname`,`category`,`unit`,`sellunit`,`tax`) VALUES ('$product','$catName','$unit','$sellUnit','$tax')";
            if ($conn->query($sql) === TRUE)
            {
                echo 0;
            } else 
            {
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
                // $matchingproduct = false;
                while ($row = $result1->fetch_assoc()) 
                {
                    if ($row['pname'] === $product) 
                    {
                        // $matchingproduct = true;
                        echo 2;
                    }
                }
            }else
            {
                $query="UPDATE `products` SET `pname`='$product',`unit`='$unit',`category`='$catName' WHERE `pid`='$id'";
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

// get Vendors from database and show in store_purchase_product.php
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

//select products by category change in store_purchase_product
if(isset($_POST['opt']))
{
    $categoryOption=$_POST['categoryOption'];
    $sql = "SELECT `pid`,`pname` FROM `products` WHERE `category`='$categoryOption'";
    $result = $conn->query($sql);
    $options = array();
    if ($result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            $options[] = $row;
        }
    }
    // Return the options as JSON response
    header('Content-Type: application/json');
    echo json_encode($options);
    $conn->close();
}

//After Changing Product Name in store_purchase_product
if(isset($_POST['selectedpname']))
{
    $pname=$_POST['selectedpname'];
    $categoryName=$_POST['categoryName'];
    $sql = "SELECT `unit`,`sellunit`,`tax` FROM `products` WHERE `pname`='$pname' AND `category`='$categoryName'";
    $result = $conn->query($sql);
    $unit = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) 
        {
            $unit[]=$row;
        }
    }
    // Return the options as JSON response
    header('Content-Type: application/json');
    echo json_encode($unit);

    $conn->close();
}

//Purchase Submit From store_purchase_product
if(isset($_POST['stockList']))
{
    $vendorName = $_POST['vendorName'];
    $purchasedDate = $_POST['purchasedDate'];
    $totamt = $_POST['totamt'];
    $pamt = $_POST['pamt'];
    $remark = $_POST['remark'];
    $billNo = $_POST['billNo'];
    $venId = $_POST['venId'];
    $gamount = $_POST['gamount'];
    $taxamount = $_POST['taxamount'];
    $stockList = $_POST['stockList'];
    $remain=$totamt-$pamt;

    $stmt = $conn->prepare("INSERT INTO `purchase_data`(`vendor`,`purchase_date`,`totalamt`,`pamt`,`remark`,`venId`,`bill`,`gamt`,`tax`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdsiidd", $vendorName, $purchasedDate, $totamt, $pamt, $remark,$venId,$billNo,$gamount,$taxamount);
    $stmt->execute();
    $vendorId = $stmt->insert_id;

    $updateStmt = $conn->prepare("UPDATE `vendor` SET `totalamt` = `totalamt` + ?, `paid` = `paid` + ? WHERE `vendor` = ?");
    $updateStmt->bind_param("dds", $totamt,$pamt,$vendorName);
    $updateStmt->execute();
    $updateStmt->close();

    $selectStmt1 = $conn->prepare("SELECT `totalamt`, `paid` FROM `vendor` WHERE `vendor` = ?");
    $selectStmt1->bind_param("s", $vendorName);
    $selectStmt1->execute();
    $selectStmt1->bind_result($updatedTotalAmt, $updatedPaid);
    $selectStmt1->fetch();
    $pendingAmt=$updatedTotalAmt-$updatedPaid;
    $selectStmt1->close();

    $disc=0;
    $paymentstmt=$conn->prepare("INSERT INTO `vendor_payment`(`vendor`, `date`, `amt`, `paid`, `remain`, `disc`) VALUES(?, ?, ?, ?, ?, ?)");
    $paymentstmt->bind_param("ssdddd",$vendorName,$purchasedDate,$totamt,$pamt,$remain,$disc);
    $paymentstmt->execute();

    foreach ($stockList as $stockItem)
    {
        $name = $stockItem['name'];
        $category = $stockItem['cat'];
        $unit = $stockItem['purunit']; //purunit
        $sellunit = $stockItem['sellunit'];
        $qty = $stockItem['qty'];
        $insideqty = $stockItem['insideqty'];
        $pric = $stockItem['pric'];
        $total = $stockItem['total'];

        $tax = $stockItem['tax'];
        $amt = $stockItem['amt'];
        $exp = $stockItem['exp'];

        $perCase=$pric/$insideqty;
        $perCase = number_format($perCase, 2);

        $selectStmt = $conn->prepare("SELECT `qty` FROM stock1 WHERE pname = ? AND unit = ? AND category = ? AND sellunit = ? ");
        $selectStmt->bind_param("ssss", $name, $unit, $category, $sellunit);
        $selectStmt->execute();
        $selectStmt->bind_result($existingQty);
        $selectStmt->fetch();
        $numRows = $selectStmt->num_rows;
        $selectStmt->execute();
        
            $selectStmt->bind_result($existingQty);
            $selectStmt->fetch();
            $selectStmt->close();
            if($existingQty == '')
            {
                $insertStmt = $conn->prepare("INSERT INTO stock1(`category`, `pname`, `unit`, `sellunit`,`qty`,`perCaseQty`,`venid`,`exp`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $insertStmt->bind_param("ssssddis",$category, $name, $unit,$sellunit, $qty,$insideqty,$vendorId,$exp);
                $insertStmt->execute();
                $insertStmt->close();
                $code='1';
            }
            else if($existingQty !== null) 
            {
                $updateQty=$existingQty+$qty;
                $updateStmt = $conn->prepare("UPDATE stock1 SET qty = ? , perCaseQty = ? , `exp`= ? WHERE pname = ? AND unit = ? AND category = ? AND sellunit = ? ");
                $updateStmt->bind_param("ddsssss",$updateQty,$insideqty,$exp,$name, $unit, $category, $sellunit);
                $updateStmt->execute();
                $updateStmt->close();
                $code="up";
            }
            else if($existingQty=='0')
            {
                $updateQty=$existingQty+$qty;
                $updateStmt = $conn->prepare("UPDATE stock1 SET qty = ? , perCaseQty = ? , `exp`= ? WHERE pname = ? AND unit = ? AND category = ? AND sellunit = ? ");
                $updateStmt->bind_param("ddsssss",$updateQty,$insideqty,$exp,$name, $unit, $category, $sellunit);
                $updateStmt->execute();
                $updateStmt->close();
                $code="up0";
            }
            $stmt = $conn->prepare("INSERT INTO stock (category, pname, unit, qty, venid, price, total,bamt,tax) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssiidddd",$category, $name, $unit, $qty, $vendorId, $pric, $total,$amt,$tax);
            $stmt->execute();
    }

$stmt->close();
$paymentstmt->close();
$conn->close();
$response = array('status' => 'success', 'message' => 'Data submitted successfully');
echo json_encode($code);
}

// Retrieve products from the product table for kichen in store_kitchen_given.php
if(isset($_POST['kit']))
{
    $sql = "SELECT `stock1`.`id`,`stock1`.`pname` FROM `stock1`,`categoroy`  WHERE `stock1`.`category`=`categoroy`.`CategoryName` AND `categoroy`.`catType`='Kitchen'"; //0 qty
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

//product On change in store_kitchen_given.php
if(isset($_POST['productId']))
{
    $productId = $_POST['productId'];

    $stmt = $conn->prepare("SELECT * FROM stock1 WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    // $stmt->bind_result($quantity, $unit, $price);
    // $stmt->fetch();
    // $stmt->close();
    $options = array();
    $result = $stmt->get_result();
        if ($result->num_rows > 0) 
        {
            $row = $result->fetch_assoc();
            $options[] = $row;
        }
        $stmt->close();
    // $response = array('qty' => $quantity, 'unit' => $unit, 'price' => $price);
    header('Content-Type: application/json');
    echo json_encode($options);
}






//adding a Kitchen in store_kitchen_given.php
if(isset($_POST['pid']))
{
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pqty = $_POST['pqty'];
    $punit = $_POST['punit'];
    $rqty = $_POST['rqty'];
    $uqty = $_POST['uqty'];
    $gdate = $_POST['gdate'];

    // $price = $_POST['price'];
    // $total = $_POST['total'];
    $perCaseQty = $_POST['perCaseQty'];
    $updateQty=$rqty/$perCaseQty;
    $updateQty = number_format($updateQty, 2);
    $query = "SELECT * FROM `kitchen_used` WHERE `pid` = '$pid' AND `givenDate`='$gdate'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)
    {
        $updateQuery = "UPDATE `kitchen_used` SET `uqty` = `uqty` + $uqty,`rqty`='$rqty' WHERE `pid` = '$pid'";
        $updateResult = mysqli_query($conn, $updateQuery);
        if($updateResult)
        {
            // mysqli_query($conn,"UPDATE `stock1` SET `qty`=`qty`-'$uqty',`total`=`total`-'$total' WHERE `pname`='$pname' AND `unit`='$punit' AND `price`='$price'");
            mysqli_query($conn,"UPDATE `stock1` SET `qty`='$updateQty' WHERE `pname`='$pname'");
            echo "Added To Kitchen successfully";
        }else 
        {
            echo "Failed to update quantity: " . mysqli_error($conn);
        }
    }else
    {
      $insertQuery="INSERT INTO `kitchen_used`(`pname`,`pid`,`punit`,`givenDate`,`uqty`,`rqty`)VALUES('$pname','$pid','$punit','$gdate','$uqty','$rqty')";
      $insertResult = mysqli_query($conn, $insertQuery);
      if($insertResult)
      {
            mysqli_query($conn,"UPDATE `stock1` SET `qty`='$updateQty' WHERE `pname`='$pname'");
        // mysqli_query($conn,"UPDATE `stock1` SET `qty`=`qty`-'$uqty',`total`=`total`-'$total' WHERE `pname`='$pname' AND `unit`='$punit' AND `price`='$price'");
        echo "Added To Kitchen successfully.";
      }else
      {
        echo "Failed to insert data: " . mysqli_error($conn);
      }
    }
    mysqli_close($conn);
}


// return kitchen to stock
if (isset($_POST['product'])) 
{
    $id = $_POST['id'];
    $product = $_POST['product'];
    $unit = $_POST['unit'];
    $date = $_POST['date'];
    $inputValue = $_POST['inputValue'];
    $price = $_POST['price'];
    $total = $price * $inputValue;
  
    $qu="SELECT * FROM `stock1` WHERE `pname`='$product'";
    $quex=mysqli_query($conn,$qu);
    while($row=mysqli_fetch_assoc($quex))
    {
        $qty=$row['qty'];
        $perCaseQty=$row['perCaseQty'];
        $stockPrice=$row['price'];
        $perCase=$row['perCase'];
        $stockTotal=$row['total']+$total;

        $updateQty=($perCaseQty*$qty)+$inputValue;
        $lastQty=$updateQty/$perCaseQty;

        $exc=mysqli_query($conn,"UPDATE `stock1` SET `qty`='$lastQty',`total`='$stockTotal'");
        if($exc)
        {
            $affectedRows = mysqli_affected_rows($conn);
            if ($affectedRows > 0) 
            {
                $query = "UPDATE `kitchen_used` SET `uqty` = `uqty` - '$inputValue', `total` = `total` - '$total' WHERE `pname` = '$product' AND `id` = '$id'";
                $insertResult = mysqli_query($conn, $query);
                if ($insertResult) 
                {
                    $affected = mysqli_affected_rows($conn);
                    
                    if ($affected > 0) {
                        echo 'Added To Store Back';
                    } else {
                        echo 'No matching records found in kitchen_used.';
                    }
                } else {
                    echo 'Error updating kitchen_used: ' . mysqli_error($conn);
                }
            }
        }
    }
  }


//show beaverages
if(isset($_POST['bev']))
{
    $sql = "SELECT `stock1`.`id`,`stock1`.`pname` FROM `stock1`,`categoroy`  WHERE `stock1`.`category`=`categoroy`.`CategoryName` AND `categoroy`.`catType`='Bevarages' AND `stock1`.`qty`!=0";
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




//sale beaverages
if(isset($_POST['pid1']))
{
    $pid = $_POST['pid1'];
    $pname = $_POST['pname'];
    $pqty = $_POST['pqty'];
    $punit = $_POST['punit'];
    $rqty = $_POST['rqty'];
    $uqty = $_POST['uqty'];
    $gdate = $_POST['gdate'];

    // $price = $_POST['price'];
    // $total = $_POST['total'];
    $perCaseQty = $_POST['perCaseQty'];
    $updateQty=$rqty/$perCaseQty;
    $query = "SELECT * FROM `beverages` WHERE `pid` = '$pid' AND `givenDate`='$gdate'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)
    {
        $updateQuery = "UPDATE `beverages` SET `uqty` = `uqty` + '$uqty' WHERE `pid` = '$pid' AND `givenDate`='$gdate'";
        $updateResult = mysqli_query($conn, $updateQuery);
        if($updateResult)
        {
            mysqli_query($conn,"UPDATE `stock1` SET `qty`='$updateQty' WHERE `pname`='$pname'");
            echo "Added successfully";
        }else 
        {
            echo "Failed to update quantity: " . mysqli_error($conn);
        }
    }else
    {
      $insertQuery="INSERT INTO `beverages`(`pname`,`pid`,`punit`,`givenDate`,`uqty`)VALUES('$pname','$pid','$punit','$gdate','$uqty')";
      $insertResult = mysqli_query($conn, $insertQuery);
      if($insertResult)
      {
            mysqli_query($conn,"UPDATE `stock1` SET `qty`='$updateQty' WHERE `pname`='$pname'");
        echo "Added successfully.";
      }else
      {
        echo "Failed to insert data: " . mysqli_error($conn);
      }
    }
    mysqli_close($conn);
}


if(isset($_POST['wastage']))
{
    $product = $_POST['w_product'];
    $qty1 = $_POST['w_qty'];
    $unit = $_POST['w_unit'];
    $inputValue = $_POST['w_inputValue'];
    $price = $_POST['w_price'];
    $total = $price * $inputValue;
    
    $lastQty=$qty1-$inputValue;
    $stockTotal=$price*$inputValue;

        $exc=mysqli_query($conn,"UPDATE `stock1` SET `qty`='$lastQty',`total`=`total`-'$stockTotal' WHERE `pname`='$product'");
        if($exc)
        {
            $affectedRows = mysqli_affected_rows($conn);
            if ($affectedRows > 0) 
            {
                $query="INSERT INTO `vastage`(`product`, `unit`, `qty`, `price`) VALUES('$product','$unit','$inputValue','$total')";
                $exc=mysqli_query($conn,$query);
                if($exc)
                {
                    echo 'Added To Wastage';
                }
            }
        }
}

if(isset($_POST['assetsProduct']))
{
    $product=$_POST['assetsProduct'];

    $query="INSERT INTO `assetsProduct`(`product`)VALUES('$product')";
    $exc=mysqli_query($conn,$query);
    if($exc)
    {
        echo 'Product Added';
    }
}


if(isset($_POST['assetsdata']))
{
    $options=array();
    $query="SELECT * FROM `assetsProduct`";
    $exc=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($exc))
    {
        $options[]=$row;
    }
    header('Content-Type: application/json');
    echo json_encode($options);
}

if(isset($_POST['assetsSubmitData']))
{
    $totamt=$_POST['assetsSubmitData'];
    $date=$_POST['assetsdate'];
    $stockLists=$_POST['assets_stockList'];
    
    $query="INSERT INTO `assetspurchase`(`amount`, `date`) VALUES ('$totamt','$date')";
    $exc=mysqli_query($conn,$query);
    if($exc)
    {
        $insertId = mysqli_insert_id($conn);
        foreach($stockLists as $stock)
        {
            $product=$stock['product'];
            $qty=$stock['qty'];
            $total=$stock['total'];
            $select="SELECT * FROM `assetsstock` WHERE `product`='$product'";
            $selectcon=mysqli_query($conn,$select);
            if(mysqli_num_rows($selectcon) > 0)
            {
                while($row=mysqli_fetch_assoc($selectcon))
                {
                    $qu="UPDATE `assetsstock` SET `qty`=`qty`+'$qty' WHERE `product`='$product'";
                    $exc1=mysqli_query($conn,$qu);
                }
            }else
            {
                $qu="INSERT INTO `assetsstock`(`product`,`qty`) VALUES ('$product','$qty')";
                $exc1=mysqli_query($conn,$qu);
            }
            $qu="INSERT INTO `assetspurchasedata`(`pur_id`, `product`, `amount`, `qty`) VALUES ('$insertId','$product','$total','$qty')";
            $exc1=mysqli_query($conn,$qu);
        }
        echo 'Assets Purchased';
    }
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


//wastage products
if(isset($_POST['Stock_wastage']))
{
    $id=$_POST['Stock_wastage'];

    $sqlMoveData = "INSERT INTO `vestage`(`category`, `pname`, `unit`, `qty`, `venId`, `exp`, `sellunit`, `percaseQty`) SELECT `category`, `pname`, `unit`, `qty`, `venid`, `exp`,`sellunit`, `perCaseQty` FROM `stock1` WHERE `id` = $id";
    
    if ($conn->query($sqlMoveData) === TRUE) 
    {
        $sqlDeleteData = "DELETE FROM `stock1` WHERE `id` = $id";
        if ($conn->query($sqlDeleteData) === TRUE) 
        {
            echo "Stock Added To Wastage.";
        } else {
            echo "Error deleting data from source table: " . $conn->error;
        }
    } else {
        echo "Error moving data: " . $conn->error;
    }
}

// wastage Stocks
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


if(isset($_POST['fetch_vendors']))
{
    $sql = "SELECT * FROM `vendor`";
    $result = $conn->query($sql);
    $options = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) 
        {
            $options[] = array(
                'id' => $row['slno'],
                'name' => $row['vendor'],
                'mobile' =>$row['mobile'],
                'gst' => $row['gst'],
                'fssi' => $row['fssi'],
                'adds' => $row['adds']
            );
        }
    }
    header('Content-Type: application/json');
    echo json_encode($options);
    $conn->close();
}



if(isset($_POST['StockAssetsFetch']))
{
    $cat_name='';
    if($cat_name=='')
    {
        $query1 = "SELECT * FROM `assetsstock`";
    }else
    {
        $query1 = "SELECT * FROM `assetsstock` WHERE `product`='$cat_name'";
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

if(isset($_POST['assetsDamage']))
{
    $product = $_POST['a_product'];
    $qty1 = $_POST['a_qty'];
    $id = $_POST['a_id'];
    $inputValue = $_POST['a_inputValue'];
    // $total = $price * $inputValue;
    
    $lastQty=$qty1-$inputValue;
    // $stockTotal=$price*$inputValue;

        $exc=mysqli_query($conn,"UPDATE `assetsstock` SET `qty`='$lastQty' WHERE `product`='$product'");
        if($exc)
        {
            $affectedRows = mysqli_affected_rows($conn);
            if ($affectedRows > 0)
            {
                $query="INSERT INTO `assetsdamage`(`product`,`qty`) VALUES('$product','$inputValue')";
                $exc=mysqli_query($conn,$query);
                if($exc)
                {
                    echo 'Added To Damage Stock';
                }
            }
        }
}

// wastage Stocks
if(isset($_POST['damageStockview']))
{
    $cat_name='';
    if($cat_name=='')
    {
        $query1 = "SELECT * FROM `assetsdamage`";
    }else
    {
        $query1 = "SELECT * FROM `assetsdamage` WHERE `category`='$cat_name'";
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