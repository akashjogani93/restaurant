<?php
include('../dbcon.php');
$currentDate = date('Y-m-d');
//store_purchase_product categorys show   and store_product.php category;
if(isset($_POST['cat']) && isset($_POST['catTypeitem']))
{
    $catType=$_POST['catTypeitem'];
    $sql = "SELECT id,CategoryName FROM categoroy WHERE catType='$catType'";
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

if(isset($_POST['catStoreStock']))
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

if(isset($_POST['catTypeName']))
{
    $sql = "SELECT catType FROM categoroy GROUP BY catType";
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


if(isset($_POST['cateByEdit']))
{
    $catType=$_POST['cateByEdit'];
    $sql = "SELECT id,CategoryName FROM categoroy WHERE catType='$catType'";
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

//Insert product From store_Product;      //want to work on edit
if(isset($_POST['catName']))
{
    $currentDate = date('Y-m-d');
    $catName = ucfirst($_POST['catName']);
    $product = ucfirst($_POST['product']);
   
    $cess = $_POST['cess'];
    $tax = $_POST['tax'];

    $insert = ucfirst($_POST['insert']);

    $catName = mysqli_real_escape_string($conn, $catName);
    $product = mysqli_real_escape_string($conn, $product);
    //while inserting
    if($insert=="Insert")
    {
        $unit = $_POST['unit'];
        $sellUnit = $_POST['sellUnit'];
        $catType = $_POST['catTypeinsert'];

        $unit = mysqli_real_escape_string($conn, $unit);
        $sellUnit = mysqli_real_escape_string($conn, $sellUnit);
        $twoMonthsLater = date('Y-m-d', strtotime('+2 months', strtotime($currentDate)));

        $checkQuery = "SELECT * FROM `products` WHERE `pname` = '$product' AND `category` = '$catName'";
        $result=$conn->query($checkQuery);
        if($result->num_rows > 0)
        {
            $matchingproduct = false;
            while ($row = $result->fetch_assoc()) 
            {
                    $matchingproduct = true;
                    echo 1;
            }
        }else
        {
            $sql="INSERT INTO `products`(`pname`,`category`,`unit`,`sellunit`,`tax`,`cess`) VALUES ('$product','$catName','$unit','$sellUnit','$tax','$cess')";
            if ($conn->query($sql) === TRUE)
            {
                $lastInsertedId = $conn->insert_id;
                $stockid = $conn->insert_id;
                $store_stock="INSERT INTO `store_stock`(`pid`,`date`,`perCaseQty`) VALUES ('$lastInsertedId','$currentDate',1)";
                $excQuery=mysqli_query($conn,$store_stock);

                if($catType=='Bevarages')
                {
                    $cat='Veg';
                    $prc=$_POST['prc'];
                    $prc1=$_POST['prc1'];
                    $itemcode=$_POST['itemcode'];
                    $sqlitem="INSERT INTO `item`(`item_cat`, `itmnam`,`prc`, `prc2`,`item_code`,`status`,`pid`) VALUES ('$cat','$product','$prc','$prc1','$itemcode',0,'$lastInsertedId')";
                    $conform=mysqli_query($conn, $sqlitem);
                    if($conform)
                    {
                        // echo 'sucees';
                    }
                }
                echo 0;
            } else
            {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
        }
    }else
    {
        $id=$_POST['productId'];
        $oldProduct=$_POST['oldProduct'];
        $id = mysqli_real_escape_string($conn, $id);
        $productUpdate="UPDATE `products` SET `pname`='$product',`tax`='$tax',`cess`='$cess',`category`='$catName' WHERE `pid`='$id'";
        $result=mysqli_query($conn,$productUpdate);
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
    $sql = "SELECT `unit`,`sellunit`,`tax`,`cess` FROM `products` WHERE `pname`='$pname' AND `category`='$categoryName'";
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
    $vendorNameId = $_POST['vendorNameId'];
    $purchasedDate = $_POST['purchasedDate'];
    
    $remark = $_POST['remark'];
    $billNo = $_POST['billNo'];
    $venId = $_POST['venId'];
    $currentDate = date('Y-m-d');
    $totamt = floatval($_POST['totamt']); //nett amount
    $pamt = floatval($_POST['pamt']); //paid amount

    $taxamount = floatval($_POST['taxamount']); //tax amount
    $gamount = floatval($_POST['gamount']); //tax amount
    $discamt = floatval($_POST['discamt']); //disc amount
    $cessamount = floatval($_POST['cessamount']); //cessamount amount
    $otheramt = floatval($_POST['otheramt']); //otheramt amount

    $stockList = $_POST['stockList'];
    $paymentmode = $_POST['paymentmode'];
    
    if($pamt > $totamt)
    {
        $remain=0;
    }else
    {
        $remain=$totamt-$pamt;
    }

    $sql="INSERT INTO `purchase_data`(`vendor`,`purchase_date`,`totalamt`,`pamt`,`remark`,`venId`,`bill`,`gamt`,`tax`,`paymentMode`,`disc`,`cessamount`,`otheramt`) VALUES ('$vendorName', '$purchasedDate', '$totamt', '$pamt', '$remark','$venId','$billNo','$gamount','$taxamount','$paymentmode','$discamt','$cessamount','$otheramt')";
    $exc=mysqli_query($conn,$sql);
    if($exc)
    {
        $vendorId=mysqli_insert_id($conn);
    }
    $ven_pay="INSERT INTO `vendor_payment`(`date`, `amt`, `paid`, `remain`, `pending`, `disc`,`billno`,`venId`) VALUES('$purchasedDate','$totamt','$pamt','$remain',0,'$discamt','$vendorId','$vendorNameId')";
    $excven_pay=mysqli_query($conn,$ven_pay);
    if($excven_pay)
    {
        foreach ($stockList as $stockItem)
        {
            $name = $stockItem['name']; //pname
            $pid = $stockItem['pid']; //pname
            $category = $stockItem['cat']; //category
            $unit = $stockItem['purunit']; //purunit
            $sellunit = $stockItem['sellunit']; //sell Unit
            $qty = $stockItem['qty'];
            $insideqty = $stockItem['insideqty'];
            $pric = $stockItem['pric'];

            $baseamt = $stockItem['baseamt'];
            $discamt = $stockItem['disc'];
            $tax = $stockItem['tax'];
            $amt = $stockItem['amt'];
            $cess = $stockItem['cessAmt'];
            $exp = $stockItem['exp'];

            $mainQty=$qty*$insideqty;

            $stockData="INSERT INTO `stock`(`qty`,`venid`,`price`,`total`,`bamt`,`tax`,`disc`,`cess`,`perCaseQty`,`pid`,`exp`,`date`) VALUES ('$qty', '$vendorId', '$pric', '$amt','$baseamt','$tax','$discamt','$cess','$insideqty','$pid','$exp','$purchasedDate')";
            $stock1exc=mysqli_query($conn,$stockData);

		$stock1exc=mysqli_query($conn,$stockData);
            $categoryTrim=trim($category);
            if($categoryTrim == 'Meat & Sea Food' || $categoryTrim == 'Vegitable' || $categoryTrim == 'Chicken' || $categoryTrim == 'Dairy Fresh')
            {
                $insertStore="INSERT INTO `store_stock`(`pid`,`issuedStock`,`date`)VALUES('$pid','$qty','$purchasedDate')";
                $excinsert=mysqli_query($conn,$insertStore);
                $query="INSERT INTO `store_kitchen`(`pid`,`stock`,`date`) VALUES ('$pid','$qty','$purchasedDate')";
                $exc = mysqli_query($conn, $query);
            }
        }
    }
$response = array('status' => 'success', 'message' => 'Data submitted successfully');
echo json_encode($response);
}

// Retrieve products from the product table for kichen in store_kitchen_given.php
if(isset($_POST['kit']))
{
    $category=$_POST['kit'];
    $sql = "SELECT `pname`,`pid` FROM `products` WHERE `products`.`category`='$category'"; //0 qty
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

//product On change in store_kitchen_given.php  //want to work
if(isset($_POST['productKitchenChange']))
{
    $productId = $_POST['productKitchenChange'];
    $currentDate = date('Y-m-d');
    $options=array();
    $query = "SELECT
                p.pname AS 'Product Name',
                p.sellunit AS 'unit',
                p.pid AS 'pid',
            IFNULL((SELECT SUM(ss.stockReturn) - SUM(ss.issuedStock + ss.wastageStock)
                FROM store_stock ss
                WHERE ss.pid = p.pid
            ), 0) AS 'Opening Stock',
            IFNULL((SELECT SUM(s.qty)
                FROM stock s
                WHERE s.pid = p.pid
            ), 0) AS 'purstock'
            FROM products p WHERE p.pid='$productId'";
            
    $exc=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($exc))
    {
        $sellStock=$row['Opening Stock'];
        $allStock=$row['purstock'];
        $stock=$allStock+$sellStock;
        $netStock=number_format($stock,2);
        $row['netStock']=$netStock;
        $options[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($options);
}

//adding a Kitchen in store_kitchen_given.php
if(isset($_POST['cattype']))
{
    $cattype = $_POST['cattype'];
    $kitchenData=$_POST['kitchenData'];
    $currentDate = date('Y-m-d');
    foreach($kitchenData as $item)
    {
        $pid = $item['pid'];
        $pqty = $item['pqty']; //total stock have
        $punit = $item['punit'];

        $uqty = $item['uqty']; //add to kitchen
        $gdate = $item['gdate']; 

        $insertStore="INSERT INTO `store_stock`(`pid`,`issuedStock`,`date`)VALUES('$pid','$uqty','$gdate')";
        $excinsert=mysqli_query($conn,$insertStore);
        $insertId=mysqli_insert_id($conn);
        if($cattype=="bev")
        {
            $query="INSERT INTO `beverages`(`pid`, `stock`, `date`) VALUES ('$pid','$uqty','$gdate')";
            $exc = mysqli_query($conn, $query);
            // echo 'Sold';
        }else if($cattype=="parcel")
        {
            $query="INSERT INTO `parcelmaterial`(`pid`, `stock`, `date`) VALUES ('$pid','$uqty','$gdate')";
            $exc = mysqli_query($conn, $query);
            // echo 'Sold';
        }
        else
        {
            $query="INSERT INTO `store_kitchen`(`pid`,`stock`,`date`,`stock_id`) VALUES ('$pid','$uqty','$gdate','$insertId')";
            $exc = mysqli_query($conn, $query);
            // echo 'Added To Kitchen';
        }
    }
    echo 'Added To Kitchen';
}

//show beaverages Category
if(isset($_POST['bevcat']))
{
    $sql="SELECT `CategoryName` AS `category` FROM `categoroy` WHERE `catType`='Bevarages'";
    $result = $conn->query($sql);
    $options = array();
    if ($result->num_rows > 0) {
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

// if(isset($_POST['BeaveragesStock']))
// {
//     $fdate=$_POST['fdate'];
//     $tdate=$_POST['tdate'];
//     $fdate = mysqli_real_escape_string($conn,$fdate);
//     $tdate = mysqli_real_escape_string($conn,$tdate);
//     $sql="SELECT SUM(beverages.stock) AS stockdata, beverages.date, products.pname, products.sellunit 
//             FROM beverages
//             LEFT JOIN products ON beverages.pid = products.pid
//             WHERE beverages.date BETWEEN '$fdate' AND '$tdate'
//             GROUP BY beverages.pid, beverages.date, products.pname, products.sellunit";
//     $result=$conn->query($sql);
//     $options=array();
//     if($result->num_rows > 0)
//     {
//         while($row=$result->fetch_assoc())
//         {
//             $options[]=$row;
//         }
//     }
//     header('Content-Type: application/json');
//     echo json_encode($options);

//     $conn->close();
// }

if(isset($_POST['BeaveHistory']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];
    $fdate = mysqli_real_escape_string($conn,$fdate);
    $tdate = mysqli_real_escape_string($conn,$tdate);
    $sql="SELECT `beverages`.`stock` AS `stockdata`,`beverages`.`date`,`products`.`pname`,`products`.`sellunit` FROM `beverages`,`products` WHERE `beverages`.`pid`=`products`.`pid` AND `beverages`.`date` BETWEEN '$fdate' AND '$tdate'";
    $result=$conn->query($sql);
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

// if(isset($_POST['materialStock']))
// {
//     $fdate=$_POST['fdate'];
//     $tdate=$_POST['tdate'];
//     $fdate = mysqli_real_escape_string($conn,$fdate);
//     $tdate = mysqli_real_escape_string($conn,$tdate);
//     $sql = "SELECT SUM(parcelmaterial.stock) AS stockdata, parcelmaterial.date, products.pname, products.sellunit 
//         FROM parcelmaterial
//         LEFT JOIN products ON parcelmaterial.pid = products.pid
//         WHERE parcelmaterial.date BETWEEN '$fdate' AND '$tdate'
//         GROUP BY parcelmaterial.pid, parcelmaterial.date, products.pname, products.sellunit";
//     $result=$conn->query($sql);
//     $options=array();
//     if($result->num_rows > 0)
//     {
//         while($row=$result->fetch_assoc())
//         {
//             $options[]=$row;
//         }
//     }
//     header('Content-Type: application/json');
//     echo json_encode($options);

//     $conn->close();
// }

if(isset($_POST['materialHistory']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];
    $fdate = mysqli_real_escape_string($conn,$fdate);
    $tdate = mysqli_real_escape_string($conn,$tdate);
    $sql="SELECT `parcelmaterial`.`stock` AS `stockdata`,`parcelmaterial`.`date`,`products`.`pname`,`products`.`sellunit` FROM `parcelmaterial`,`products` WHERE `parcelmaterial`.`pid`=`products`.`pid` AND `parcelmaterial`.`date` BETWEEN '$fdate' AND '$tdate'";
    $result=$conn->query($sql);
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

//show beaverages Category
if(isset($_POST['parcelcat']))
{
    $sql="SELECT `CategoryName` AS `category` FROM `categoroy` WHERE `catType`='Material'";
    $result = $conn->query($sql);
    $options = array();
    if ($result->num_rows > 0) {
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

if(isset($_POST['assetsProduct']) && isset($_POST['check']))
{
    $product=$_POST['assetsProduct'];
    $check=$_POST['check'];
    if($check=='insert')
    {
        $checkQuery = "SELECT * FROM `assetsProduct` WHERE `product`='$product'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($checkResult) > 0) {
            echo 'Product already exists';
        } else {
            $query="INSERT INTO `assetsProduct`(`product`)VALUES('$product')";
            $exc=mysqli_query($conn,$query);
            if($exc)
            {
                $id=mysqli_insert_id($conn);
                $inv="INSERT INTO `assetsstock`(`pur_id`,`date`) VALUES ('$id','$currentDate')";
                $out=mysqli_query($conn,$inv);
                echo 'Product Added';
            }
        }
    }else
    {
        $idp=$_POST['idp'];
        $checkQuery = "SELECT * FROM `assetsProduct` WHERE `product`='$product' AND `id` != '$idp'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($checkResult) > 0) {
            echo 'Product name already exists';
        } else {
            $query="UPDATE `assetsProduct` SET `product`='$product' WHERE `id`='$idp'";
            $exc=mysqli_query($conn,$query);
            if($exc)
            {
                echo 'Product Updated';
            }
        }
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
    $assetremark=$_POST['assetremark'];
    $stockLists=$_POST['assets_stockList'];
    
    $query="INSERT INTO `assetspurchase`(`amount`, `date`, `remark`) VALUES ('$totamt','$date','$assetremark')";
    $exc=mysqli_query($conn,$query);
    if($exc)
    {
        $insertId = mysqli_insert_id($conn);
        foreach($stockLists as $stock)
        {
            $product=$stock['product'];
            $productid=$stock['productid'];
            $qty=$stock['qty'];
            $total=$stock['total'];
            $price=$stock['price'];

            $assetspurchasedata="INSERT INTO `assetspurchasedata`(`pur_id`, `amount`, `qty`, `total`,`venId`,`date`) VALUES ('$productid','$price','$qty','$total','$insertId','$date')";
            $assetpur=mysqli_query($conn,$assetspurchasedata);

            $qu="INSERT INTO `assetsstock`(`pur_id`, `stock`,`amount`, `date`) VALUES ('$productid','$qty','$total','$date')";
            $exc1=mysqli_query($conn,$qu);
        }
        echo 'Assets Purchased';
    }
}

if(isset($_POST['stockOpening']) && isset($_POST['catName1']) && isset($_POST['fdate']) && isset($_POST['tdate']))
{
    $options=array();

    $cat_name=$_POST['catName1'];
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];
    $fdate = mysqli_real_escape_string($conn,$fdate);
    $tdate = mysqli_real_escape_string($conn,$tdate);
    if($cat_name=='')
    {
        $sql="SELECT
                    p.pname AS 'Product Name',
                    p.sellunit AS 'unit',
                    p.pid AS 'pid',
                IFNULL((SELECT SUM(ss.stockReturn) - SUM(ss.issuedStock + ss.wastageStock)
                    FROM store_stock ss
                    WHERE ss.pid = p.pid AND ss.date < '$fdate'
                ), 0) AS 'Opening Stock',
                IFNULL((SELECT SUM(s.qty)
                    FROM stock s
                    WHERE s.pid = p.pid AND s.date < '$fdate'
                ), 0) AS 'lastclose',
                IFNULL((SELECT SUM(total)
                            FROM stock s
                            WHERE s.pid = p.pid AND s.date <= '$tdate'
                        ), 0) AS 'totalPurchasAmount',
                IFNULL((SELECT SUM(qty)
                            FROM stock s
                            WHERE s.pid = p.pid AND s.date <= '$tdate'
                        ), 0) AS 'totalPurchaseQty',
                IFNULL((SELECT SUM(s.qty)
                        FROM stock s
                        WHERE s.pid = p.pid AND s.date BETWEEN '$fdate' AND '$tdate'
                ), 0) AS 'Purchase Stock',
                IFNULL((SELECT SUM(ss.issuedStock)
                        FROM store_stock ss
                        WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
                ), 0) AS 'Issued Stock',
                IFNULL((SELECT SUM(ss.stockReturn)
                        FROM store_stock ss
                        WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
                ), 0) AS 'Return Stock',
                IFNULL((SELECT SUM(ss.wastageStock)
                        FROM store_stock ss
                        WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
                ), 0) AS 'Wastage Stock',
                IFNULL((SELECT (SUM(ss.stock + ss.stockReturn) + IFNULL(o.openingStock, 0)) -
                                (SUM(ss.issuedStock) + SUM(ss.wastageStock))
                        FROM store_stock ss
                        LEFT JOIN (SELECT pid, SUM(stock + stockReturn) - SUM(issuedStock + wastageStock) AS openingStock
                                FROM store_stock
                                WHERE date < '$fdate'
                                GROUP BY pid) o ON o.pid = ss.pid
                        WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
                ), 0) AS 'Closing Stock'
            FROM products p
        ";
    }else
    {
        $sql="SELECT
                    p.pname AS 'Product Name',
                    p.sellunit AS 'unit',
                    p.pid AS 'pid',
                IFNULL((SELECT SUM(ss.stockReturn) - SUM(ss.issuedStock + ss.wastageStock)
                    FROM store_stock ss
                    WHERE ss.pid = p.pid AND ss.date < '$fdate'
                ), 0) AS 'Opening Stock',
                IFNULL((SELECT SUM(s.qty)
                    FROM stock s
                    WHERE s.pid = p.pid AND s.date < '$fdate'
                ), 0) AS 'lastclose',
                IFNULL((SELECT SUM(total)
                            FROM stock s
                            WHERE s.pid = p.pid AND s.date <= '$tdate'
                        ), 0) AS 'totalPurchasAmount',
                IFNULL((SELECT SUM(qty)
                            FROM stock s
                            WHERE s.pid = p.pid AND s.date <= '$tdate'
                        ), 0) AS 'totalPurchaseQty',
                IFNULL((SELECT SUM(s.qty)
                        FROM stock s
                        WHERE s.pid = p.pid AND s.date BETWEEN '$fdate' AND '$tdate'
                ), 0) AS 'Purchase Stock',
                IFNULL((SELECT SUM(ss.issuedStock)
                        FROM store_stock ss
                        WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
                ), 0) AS 'Issued Stock',
                IFNULL((SELECT SUM(ss.stockReturn)
                        FROM store_stock ss
                        WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
                ), 0) AS 'Return Stock',
                IFNULL((SELECT SUM(ss.wastageStock)
                        FROM store_stock ss
                        WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
                ), 0) AS 'Wastage Stock',
                IFNULL((SELECT (SUM(ss.stock + ss.stockReturn) + IFNULL(o.openingStock, 0)) -
                                (SUM(ss.issuedStock) + SUM(ss.wastageStock))
                        FROM store_stock ss
                        LEFT JOIN (SELECT pid, SUM(stock + stockReturn) - SUM(issuedStock + wastageStock) AS openingStock
                                FROM store_stock
                                WHERE date < '$fdate'
                                GROUP BY pid) o ON o.pid = ss.pid
                        WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
                ), 0) AS 'Closing Stock'
            FROM products p WHERE p.category ='$cat_name'
        ";
    }
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $name=$row['Product Name'];

        $totalPurchasAmount=$row['totalPurchasAmount'];
        $totalPurchaseQty=$row['totalPurchaseQty'];

        $unit=$row['unit'];
        $pid=$row['pid'];
        $ope=$row['lastclose']+$row['Opening Stock'];
        $openingStock=number_format($ope,2);
        $purchaseStock=number_format($row['Purchase Stock'],2);
        $issuedStock=number_format(($row['Issued Stock']),2);
        $returnStock=number_format($row['Return Stock'],2);
        $wastageStock=number_format($row['Wastage Stock'],2);

        $cloasingStock=number_format(($ope+$row['Purchase Stock']+$row['Return Stock'])-($row['Issued Stock']+$row['Wastage Stock']),2);
        $cloasingStocknum = floatval($cloasingStock);

        if($totalPurchaseQty !=0)
        {
            $cloaQtyAmt=$totalPurchasAmount/$totalPurchaseQty;
            $cloasingTotal=$cloaQtyAmt*$cloasingStocknum;
            $wastageTotal=$cloaQtyAmt*$row['Wastage Stock'];
            $returnTotal=$cloaQtyAmt*$row['Return Stock'];
            $issuedTotal=$cloaQtyAmt*$row['Issued Stock'];
            $purTotal=$cloaQtyAmt*$row['Purchase Stock'];
            $openingTotal=$cloaQtyAmt*$ope;
        }else
        {
            $cloaQtyAmt=0;
            $cloasingTotal=0;
            $wastageTotal=0;
            $returnTotal=0;
            $issuedTotal=0;
            $openingTotal=0;
            $purTotal=0;
        }
        
        $data=[
            'name'=>$name,
            'pid'=>$pid,
            'unit'=>$unit,
            'openingStock'=>$openingStock,
            'stocksum'=>$purchaseStock,
            'issued'=>$issuedStock,
            'retur'=>$returnStock,
            'wastage'=>$wastageStock,
            'cloasing'=>$cloasingStock,
            'opeTotal'=>number_format($openingTotal,2),
            'purTotal'=>number_format($purTotal,2),
            'issedTotal'=>number_format($issuedTotal,2),
            'returnTotal'=>number_format($returnTotal,2),
            'wastotal'=>number_format($wastageTotal,2),
            'cloTotal'=>number_format($cloasingTotal,2),
            'avgprice'=>number_format($cloaQtyAmt,2)
        ];
        $options[]=$data;
    }
    header('Content-Type: application/json');
    echo json_encode($options);
    // $conn->close();
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
        $query1 = "SELECT `wastage`.*,`products`.`pname`,`products`.`sellunit` FROM `wastage`,`products` WHERE `wastage`.`pid`=`products`.`pid`";
    }else
    {
        $query1 = "SELECT `wastage`.*,`products`.`pname`,`products`.`sellunit` FROM `wastage`,`products` WHERE `wastage`.`pid`=`products`.`pid` AND `products`.`category`='$cat_name'";
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
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];
    $fdate = mysqli_real_escape_string($conn,$fdate);
    $tdate = mysqli_real_escape_string($conn,$tdate);
    if($cat_name=='')
    {
        $query1 = "SELECT
                        p.product AS 'product',
                        p.id AS 'id',
                    IFNULL((SELECT SUM(s.stock) - SUM(s.damage)
                        FROM assetsstock s
                        WHERE s.pur_id = p.id AND s.date < '$fdate'
                    ), 0) AS 'Opening Stock',
                    IFNULL((SELECT SUM(s.amount) - SUM(s.damageAmount)
                        FROM assetsstock s
                        WHERE s.pur_id = p.id AND s.date < '$fdate'
                        ), 0) AS 'OpeningAmt',
                    IFNULL((SELECT SUM(s.stock)
                        FROM assetsstock s
                        WHERE s.pur_id = p.id AND s.date BETWEEN '$fdate' AND '$tdate'
                    ), 0) AS 'Purchase Stock',
                    IFNULL((SELECT SUM(s.amount)
                        FROM assetsstock s
                        WHERE s.pur_id = p.id AND s.date BETWEEN '$fdate' AND '$tdate'
                    ), 0) AS 'Purchaseamt',
                    IFNULL((SELECT SUM(s.damage)
                        FROM assetsstock s
                        WHERE s.pur_id = p.id AND s.date BETWEEN '$fdate' AND '$tdate'
                    ), 0) AS 'damage',
                    IFNULL((SELECT SUM(s.damageAmount)
                        FROM assetsstock s
                        WHERE s.pur_id = p.id AND s.date BETWEEN '$fdate' AND '$tdate'
                    ), 0) AS 'damageAmount'
                    FROM assetsproduct p";

    }else
    {
        // $query1 = "SELECT * FROM `assetsstock` WHERE `product`='$cat_name'";
    }
    $result=$conn->query($query1);
    $options=array();
    if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc())
        {
            $name=$row['product'];
            $id=$row['id'];
            $openingStock=number_format($row['Opening Stock'],2);
            $purchaseStock=number_format($row['Purchase Stock'],2);
            $damage=number_format($row['damage'],2);

            $openingAmt=number_format($row['OpeningAmt'],2);
            $Purchaseamt=number_format($row['Purchaseamt'],2);
            $damageAmount=number_format($row['damageAmount'],2);

        $cloasingStock=number_format(($row['Opening Stock']+$row['Purchase Stock'])-($row['damage']),2);
        $cloasinamt=number_format(($row['OpeningAmt']+$row['Purchaseamt'])-($row['damageAmount']),2);
        $data=[
            'name'=>$name,
            'id'=>$id,
            'openingStock'=>$openingStock,
            'stocksum'=>$purchaseStock,
            'damage'=>$damage,
            'openingAmt'=>$openingAmt,
            'Purchaseamt'=>$Purchaseamt,
            'damageAmount'=>$damageAmount,
            'cloasing'=>$cloasingStock,
            'cloasinAmt'=>$cloasinamt,
        ];
            $options[]=$data;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($options);

    $conn->close();
}


//use kitchen stock
if(isset($_POST['damage_pid']))
{
    $id=$_POST['damage_pid'];
    $isued=$_POST['damage_issued'];
    $amount=$_POST['damage_amount'];
    $currentDate = date('Y-m-d');
    $qu="INSERT INTO `assetsstock`(`pur_id`, `damage`,`damageAmount`, `date`) VALUES ('$id','$isued','$amount','$currentDate')";
    $exc1=mysqli_query($conn,$qu);

    $que="INSERT INTO `assetsdamage`(`pur_id`, `qty`, `amount`,`date`) VALUES ('$id','$isued','$amount','$currentDate')";
    $exc=mysqli_query($conn,$que);
    echo 'Damaged';
}

//kitchen category show
if(isset($_POST['kitcencat']))
{
    $sql="SELECT `CategoryName` AS `category` FROM `categoroy` WHERE `catType`='Kitchen'";
    $result = $conn->query($sql);
    $options = array();
    if ($result->num_rows > 0) {
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

// kitch stock 
if(isset($_POST['kitchenallStock']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];
    $fdate = mysqli_real_escape_string($conn,$fdate);
    $tdate = mysqli_real_escape_string($conn,$tdate);

    if($_POST['kitchenallStock']=='bevStock')
    {
        $tableName='beverages';
    }else if($_POST['kitchenallStock']=='material')
    {
        $tableName='parcelmaterial';
    }else
    {
        $tableName='store_kitchen';
    }
    $sql = "SELECT
                p.pname AS 'Product Name',
                p.pid AS 'pid',
                p.sellunit AS 'unit',
                IFNULL((
                    SELECT SUM(ss.stock) - SUM(ss.issued + ss.stockreturn)
                    FROM $tableName ss
                    WHERE ss.pid = p.pid AND ss.date < '$fdate'
                ), 0) AS 'Opening Stock',
                IFNULL((
                    SELECT SUM(ss.stock)
                    FROM $tableName ss
                    WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
                ), 0) AS 'Purchase Stock',
                IFNULL((
                    SELECT SUM(ss.issued)
                    FROM $tableName ss
                    WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
                ), 0) AS 'Issued Stock',
                IFNULL((SELECT SUM(total)
                            FROM stock s
                            WHERE s.pid = p.pid AND s.date <= '$tdate'
                        ), 0) AS 'totalPurchasAmount',
                IFNULL((SELECT SUM(qty)
                            FROM stock s
                            WHERE s.pid = p.pid AND s.date <= '$tdate'
                        ), 0) AS 'totalPurchaseQty',
                IFNULL((
                    SELECT SUM(ss.stockreturn)
                    FROM $tableName ss
                    WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
                ), 0) AS 'Return Stock'
            FROM products p
            WHERE p.pid IN (
            SELECT DISTINCT pid
                FROM $tableName
        );";
    $result=$conn->query($sql);
    $options=array();
    if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc())
        {
            $name=$row['Product Name'];
            $unit=$row['unit'];
            $pid=$row['pid'];
            $openingStock=number_format($row['Opening Stock'],2);
            $purchaseStock=number_format($row['Purchase Stock'],2);
            $issuedStock=number_format($row['Issued Stock'],2);
            $returnStock=number_format($row['Return Stock'],2);

            $totalPurchasAmount=$row['totalPurchasAmount'];
            $totalPurchaseQty=$row['totalPurchaseQty'];

            $cloasingStock=number_format(($row['Opening Stock']+$row['Purchase Stock'])-($row['Issued Stock']+$row['Return Stock']),2);
            $cloasingStocknum = floatval($cloasingStock);

            if($totalPurchaseQty !=0)
            {
                $price=$totalPurchasAmount/$totalPurchaseQty;
                $opeTotal=$price*$openingStock;
                $purTotal=$price*$purchaseStock;
                $retTotal=$price*$returnStock;
                $issuedTotal=$price*$issuedStock;
                $cloasingTotal=$price*$cloasingStocknum;

            }else
            {
                $price=0;
                $opeTotal=0;
                $purTotal=0;
                $retTotal=0;
                $issuedTotal=0;
                $cloasingTotal=0;
            }

            $data=[
                'pid'=>$pid,
                'name'=>$name,
                'unit'=>$unit,
                'openingStock'=>$openingStock,
                'stocksum'=>$purchaseStock,
                'issued'=>$issuedStock,
                'retur'=>$returnStock,
                'cloasing'=>$cloasingStock,
                'price'=>number_format($price,2),
                'opeTotal'=>number_format($opeTotal,2),
                'purTotal'=>number_format($purTotal,2),
                'retTotal'=>number_format($retTotal,2),
                'issuedTotal'=>number_format($issuedTotal,2),
                'cloTotal'=>number_format($cloasingTotal,2)
            ];
            $options[]=$data;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($options);

    $conn->close();
}

//kitchen purchase 
if(isset($_POST['kitchenHistory']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];

    if($_POST['kitchenHistory']=='bevhist')
    {
        $tableName='beverages';
    }else if($_POST['kitchenHistory']=="parcelhis")
    {
        $tableName='parcelmaterial';
    }else
    {
        $tableName='store_kitchen';
    }
    $result = $conn->query("SELECT
                            $tableName.*,
                            `products`.`pname`,
                            `products`.`sellunit`
                        FROM
                            $tableName,
                            `products`
                        WHERE
                            $tableName.`pid` = `products`.`pid`
                            AND ($tableName.`stock` != 0 OR $tableName.`stockreturn` != 0 OR $tableName.`issued` != 0)
                            AND $tableName.`date` BETWEEN '$fdate' AND '$tdate'
                    ");
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

//use kitchen stock
if(isset($_POST['issuType']))
{
    $pid=$_POST['use_pid'];
    $isued=$_POST['use_issued'];
    $currentDate = date('Y-m-d');
    if($_POST['issuType']=='parcel')
    {
        $tableName='parcelmaterial';
    }else if($_POST['issuType']=='bev')
    {
        $tableName='beverages';
    }else
    {
        $tableName='store_kitchen';
    }
    $query="INSERT INTO $tableName(`pid`,`issued`,`date`) VALUES ('$pid','$isued','$currentDate')";
    $exc = mysqli_query($conn, $query);
    echo 'Issued';
}

//use kitchen stock
if(isset($_POST['return_pid']))
{
    $pid=$_POST['return_pid'];
    $return_retur=$_POST['return_retur'];
    $currentDate = date('Y-m-d');

    $query="INSERT INTO `store_kitchen`(`pid`,`stockreturn`,`date`) VALUES ('$pid','$return_retur','$currentDate')";
    $exc = mysqli_query($conn, $query);

    $insertStore="INSERT INTO `store_stock`(`pid`,`stockReturn`,`date`)VALUES('$pid','$return_retur','$currentDate')";
    $excinsert=mysqli_query($conn,$insertStore);
    echo 'Return';
}

if(isset($_POST['wastage_pid']))
{
    $pid=$_POST['wastage_pid'];
    $wastage_qty=$_POST['wastage_qty'];
    $wastage_reson=$_POST['wastage_reson'];
    $currentDate = date('Y-m-d');

    $insertStore="INSERT INTO `store_stock`(`pid`,`wastageStock`,`date`)VALUES('$pid','$wastage_qty','$currentDate')";
    $excinsert=mysqli_query($conn,$insertStore);

    $query="INSERT INTO `wastage`(`pid`, `qty`, `date`) VALUES ('$pid','$wastage_qty','$currentDate')";
    $wastage=mysqli_query($conn,$query);

    echo 'Added To Wastage';
}

if(isset($_POST['addStockToDamage']))
{
    $query="SELECT * FROM `assetspurchasedata` ORDER BY `id`";
    $exc=mysqli_query($conn,$query);
    $rows=array();
    while($row=mysqli_fetch_assoc($exc))
    {
        $rows[]=$row;
    }
    echo json_encode($rows);
}
if(isset($_POST['editid']))
{
    $editid=$_POST['editid'];
    $rows=array();
    $query = "SELECT `purchase_data`.*, `vendor`.`slno` 
    FROM `purchase_data`, `vendor` 
    WHERE `purchase_data`.`id` = '$editid' 
    AND `purchase_data`.`vendor` = `vendor`.`vendor`";

    $exc=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($exc))
    {
        $rows[]=$row;
    }
    echo json_encode($rows);
}
if(isset($_POST['editfetchstock']))
{
    $id=$_POST['editfetchstock'];
    $rows=array();
    $query="SELECT `stock`.*,`products`.`category`,`products`.`pname`,`products`.`pid`,`products`.`unit`,`products`.`sellunit`,`products`.`tax` AS `taxper`,`products`.`cess` AS `cessper` FROM `stock`,`products` WHERE `stock`.`venid`='$id' AND `stock`.`pid`=`products`.`pid`";
    $exc=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($exc))
    {
        $rows[]=$row;
    }
    echo json_encode($rows);
}

//Purchase Update From store_purchase_product
if(isset($_POST['edit_stockList']))
{
    $vendorName = $_POST['edit_vendorName'];
    $purchasedDate = $_POST['edit_purchasedDate'];
    
    $remark = $_POST['edit_remark'];
    $billNo = $_POST['edit_billNo'];
    $venId = $_POST['edit_venId'];
    $currentDate = date('Y-m-d');
    $totamt = floatval($_POST['edit_totamt']); //nett amount
    $pamt = floatval($_POST['edit_pamt']); //paid amount

    $taxamount = floatval($_POST['edit_taxamount']); //tax amount
    $gamount = floatval($_POST['edit_gamount']); //tax amount
    $discamt = floatval($_POST['edit_discamt']); //disc amount
    $cessamount = floatval($_POST['edit_cessamount']); //cessamount amount
    $otheramt = floatval($_POST['edit_otheramt']); //otheramt amount

    $stockList = $_POST['edit_stockList'];
    // $edit_deletestock = $_POST['edit_deletestock'];
    $paymentmode = $_POST['edit_paymentmode'];
    $editbill=$_POST['editbill'];
    if($pamt > $totamt)
    {
        $remain=0;
    }else
    {
        $remain=$totamt-$pamt;
    }

    $sql="UPDATE `purchase_data` SET `vendor`='$vendorName',`purchase_date`='$purchasedDate',`totalamt`='$totamt',`pamt`='$pamt',`remark`='$remark',`venId`='$venId',`bill`='$billNo',`gamt`='$gamount',`tax`='$taxamount',`paymentMode`='$paymentmode',`disc`='$discamt',`cessamount`='$cessamount',`otheramt`='$otheramt' WHERE `id`='$editbill'";
    $exc=mysqli_query($conn,$sql);
    if($exc)
    {
        $ven_pay="UPDATE `vendor_payment` SET `venId`='$venId',`date`='$purchasedDate',`amt`='$totamt',`paid`='$pamt',`remain`='$remain',`pending`=0,`disc`='$discamt' WHERE `billno`='$editbill'";
        $excven_pay=mysqli_query($conn,$ven_pay);
    }
    if($excven_pay)
    {
        $del="DELETE FROM `stock` WHERE `venid`='$editbill'";
        $delQuery=mysqli_query($conn,$del);
        foreach ($stockList as $stockItem)
        {
            $name = $stockItem['name']; //pname
            $pid = $stockItem['pid']; //pname
            $category = $stockItem['cat']; //category
            $unit = $stockItem['purunit']; //purunit
            $sellunit = $stockItem['sellunit']; //sell Unit
            $qty = $stockItem['qty'];
            $insideqty = $stockItem['insideqty'];
            $pric = $stockItem['pric'];

            $baseamt = $stockItem['baseamt'];
            $discamt = $stockItem['disc'];
            $tax = $stockItem['tax'];
            $amt = $stockItem['amt'];
            $cess = $stockItem['cessAmt'];
            $exp = $stockItem['exp'];

            $mainQty=$qty*$insideqty;

            $stockData="INSERT INTO `stock`(`qty`,`venid`,`price`,`total`,`bamt`,`tax`,`disc`,`cess`,`perCaseQty`,`pid`,`exp`,`date`) VALUES ('$qty', '$editbill', '$pric', '$amt','$baseamt','$tax','$discamt','$cess','$insideqty','$pid','$exp','$purchasedDate')";
            $stock1exc=mysqli_query($conn,$stockData);
        }
        
    }
$response = array('status' => 'success', 'message' => 'Data submitted successfully');
echo json_encode($response);
}

if(isset($_POST['kitchenstockEdit']))
{
    $kitchenstockEdit=$_POST['kitchenstockEdit'];
    $rows=array();
    $query = "SELECT 
                `store_kitchen`.*,
                `store_stock`.`issued`
            FROM `purchase_data`, `vendor` 
            WHERE `purchase_data`.`id` = '$editid' 
            AND `purchase_data`.`vendor` = `vendor`.`vendor`";

    $exc=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($exc))
    {
        $rows[]=$row;
    }
    echo json_encode($rows);
}


if(isset($_POST['checkStoreBill']) && isset($_POST['stobill_bill']) && isset($_POST['store_vendor']) && isset($_POST['store_venName']) && isset($_POST['store_editid']))
{
    $billNo=$_POST['stobill_bill'];
    $vendorId=$_POST['store_vendor'];
    $vendorName=$_POST['store_venName'];
    $editid=$_POST['store_editid'];
    
    if($editid=='')
    {
        $query="SELECT `bill` FROM `purchase_data` WHERE `venId`='$vendorId' AND `bill`='$billNo'";
    }else
    {
        $query="SELECT `bill` FROM `purchase_data` WHERE `venId`='$vendorId' AND `bill`='$billNo' AND `bill`!='$editid'";
    }
    $exc=mysqli_query($conn,$query);
    if(mysqli_num_rows($exc) > 0)
    {
        $status=0;  
    }else
    {
        $status=1;
    }
    echo $status;
}
?>