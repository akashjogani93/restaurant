<?php
include('../dbcon.php');
$currentDate = date('Y-m-d');
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

        $unit = mysqli_real_escape_string($conn, $unit);
        $sellUnit = mysqli_real_escape_string($conn, $sellUnit);
        
        $twoMonthsLater = date('Y-m-d', strtotime('+2 months', strtotime($currentDate)));

        $checkQuery = "SELECT * FROM `products` WHERE `pname` = '$product' AND `category` = '$sellUnit'";
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
        $productUpdate="UPDATE `products` SET `pname`='$product',`tax`='$tax',`cess`='$cess' WHERE `pid`='$id'";
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
        $sql1="UPDATE `vendor` SET `totalamt` = `totalamt` + '$totamt', `paid` = `paid` + '$pamt' WHERE `vendor` = '$vendorName'";
        $exc1=mysqli_query($conn,$sql1);
    }

    $search="SELECT `totalamt`, `paid` FROM `vendor` WHERE `vendor` = '$vendorName'";
    $searchexc=mysqli_query($conn,$search);
    while($row=mysqli_fetch_assoc($searchexc))
    {
        $updatedTotalAmt=$row['totalamt'];
        $updatedPaid=$row['paid'];
    }
    $pendingAmt=$updatedTotalAmt-$updatedPaid;
    $ven_pay="INSERT INTO `vendor_payment`(`vendor`, `date`, `amt`, `paid`, `remain`, `pending`, `disc`) VALUES('$vendorName','$purchasedDate','$totamt','$pamt','$remain','$pendingAmt','$discamt')";
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

            $stockData="INSERT INTO `stock`(`qty`,`venid`,`price`,`total`,`bamt`,`tax`,`disc`,`cess`,`perCaseQty`,`pid`,`exp`) VALUES ('$qty', '$vendorId', '$pric', '$amt','$baseamt','$tax','$discamt','$cess','$insideqty','$pid','$exp')";
            $stock1exc=mysqli_query($conn,$stockData);

            $insertStore="INSERT INTO `store_stock`(`pid`,`stock`,`date`,`exp`)VALUES('$pid','$mainQty','$currentDate','$exp')";
            $excinsert=mysqli_query($conn,$insertStore);
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
    $query = "SELECT p.pid,p.sellunit,
                    (SUM(s.stock + s.stockReturn) - SUM(s.issuedStock + s.wastageStock)) AS netStock
                FROM `products` p
                LEFT JOIN `store_stock` s ON p.pid = s.pid
                WHERE p.pid = $productId
                GROUP BY p.pid,p.sellunit";
    $exc=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($exc))
    {
        $netStock=number_format($row['netStock'],2);
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

    $pid = $_POST['pid'];

    $pqty = $_POST['pqty']; //total stock have
    $punit = $_POST['punit'];

    $uqty = $_POST['uqty']; //add to kitchen
    $gdate = $_POST['gdate']; 
    $currentDate = date('Y-m-d');

    $insertStore="INSERT INTO `store_stock`(`pid`,`issuedStock`,`date`)VALUES('$pid','$uqty','$gdate')";
    $excinsert=mysqli_query($conn,$insertStore);

    if($cattype=="bev")
    {
        $query="INSERT INTO `beverages`(`pid`, `stock`, `date`) VALUES ('$pid','$uqty','$gdate')";
        $exc = mysqli_query($conn, $query);
        echo 'Selled';
    }else if($cattype=="parcel")
    {
        $query="INSERT INTO `parcelmaterial`(`pid`, `stock`, `date`) VALUES ('$pid','$uqty','$gdate')";
        $exc = mysqli_query($conn, $query);
        echo 'Selled';
    }
    else
    {
        $query="INSERT INTO `store_kitchen`(`pid`,`stock`,`date`) VALUES ('$pid','$uqty','$gdate')";
        $exc = mysqli_query($conn, $query);
        echo 'Added To Kitchen';
    }
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

if(isset($_POST['BeaveragesStock']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];
    $fdate = mysqli_real_escape_string($conn,$fdate);
    $tdate = mysqli_real_escape_string($conn,$tdate);
    $sql="SELECT SUM(beverages.stock) AS `stockdata`,`products`.`pname`,`products`.`sellunit` FROM `beverages`,`products` WHERE `beverages`.`pid`=`products`.`pid` AND `beverages`.`date` BETWEEN '$fdate' AND '$tdate'";
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

if(isset($_POST['materialStock']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];
    $fdate = mysqli_real_escape_string($conn,$fdate);
    $tdate = mysqli_real_escape_string($conn,$tdate);
    $sql="SELECT SUM(parcelmaterial.stock) AS `stockdata`,`products`.`pname`,`products`.`sellunit` FROM `parcelmaterial`,`products` WHERE `parcelmaterial`.`pid`=`products`.`pid` AND `parcelmaterial`.`date` BETWEEN '$fdate' AND '$tdate'";
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
    $sql="SELECT `CategoryName` AS `category` FROM `categoroy` WHERE `catType`='ParcelMaterial'";
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
            $qty=$stock['qty'];
            $total=$stock['total'];
            $price=$stock['price'];
            $select="SELECT * FROM `assetsstock` WHERE `product`='$product'";
            $selectcon=mysqli_query($conn,$select);
            if(mysqli_num_rows($selectcon) > 0)
            {
                while($row=mysqli_fetch_assoc($selectcon))
                {
                    $qu="UPDATE `assetsstock` SET `qty`=`qty`+'$qty',`amount`=`amount`+'$total' WHERE `product`='$product'";
                    $exc1=mysqli_query($conn,$qu);
                }
            }else
            {
                $qu="INSERT INTO `assetsstock`(`product`,`qty`,`amount`) VALUES ('$product','$qty','$total')";
                $exc1=mysqli_query($conn,$qu);
            }
            $qu="INSERT INTO `assetspurchasedata`(`pur_id`, `product`, `amount`,`qty`,`total`,`remainQty`,`remainTotal`) VALUES ('$insertId','$product','$price','$qty','$total','$qty','$total')";
            $exc1=mysqli_query($conn,$qu);
        }
        echo 'Assets Purchased';
    }
}

//Purchase Stock Details
// if(isset($_POST['stock']))
// {
//     $cat_name=$_POST['catName1'];
//     if($cat_name=='')
//     {
//         // $query1 = "SELECT stock1.*, SUM(kitchen_stock.qty) as total_qty
//         // FROM stock1
//         // JOIN kitchen_stock ON stock1.pname = kitchen_stock.pname
//         // GROUP BY stock1.pname;";
//         $query1 = "SELECT * FROM `stock1`";
//     }else
//     {
//         $query1 = "SELECT * FROM `stock1` WHERE `category`='$cat_name'";
//     }
//     $result=$conn->query($query1);
//     $options=array();
//     if($result->num_rows > 0)
//     {
//         while($row=$result->fetch_assoc())
//         {

//             $pname=$row['pname'];
//             $perCaseQty=$row['perCaseQty'];
//             $total_qty = 0;
//             $remain_qty=($row['qty']*$perCaseQty)/100;

//             // $query2="SELECT * FROM `kitchen_data` WHERE `pname`='$pname'";
//             // $result1=$conn->query($query2);
//             // while($row1=$result1->fetch_assoc())
//             // {
//             //     $total_qty=$row1['qty'];
//             //     // $remain_qty=$row1['remain_qty'];
//             // }
//             // $query2 = "SELECT SUM(qty) As `total_qty` FROM `stock` WHERE `pname`='$pname'";
//             $query2 = "SELECT SUM(s.qty) AS total_qty
//            FROM stock s
//            INNER JOIN purchase_data v ON s.venid = v.id
//            WHERE s.pname = '$pname'
//              AND MONTH(v.purchase_date) = MONTH(CURRENT_DATE())
//              AND YEAR(v.purchase_date) = YEAR(CURRENT_DATE())";

//             $result1=$conn->query($query2);
//             while($row1=$result1->fetch_assoc())
//             {
//                 $total_qty=$row1['total_qty'];
//             }
//             $kitchenQty=0;
//             $remain=0;
//             // if ($perCaseQty != 0)
//             // {
//             //     $kitchenQty=$total_qty/$perCaseQty;
//             //     $remain=$remain_qty/$perCaseQty;
//             // }
//             $row['total_qty'] = number_format($kitchenQty,2);
//             $row['remain_qty'] = number_format($remain,2);
//             $row['curMonth'] = number_format($total_qty,2);



//             $row['qty'] = number_format($row['qty'],2);
//             $row['issued'] = number_format($row['issued'],2);
//             $row['remain'] = number_format($row['remain'],2);

//             $options[]=$row;
//         }
//     }
//     header('Content-Type: application/json');
//     echo json_encode($options);

//     $conn->close();
// }

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
        $sql = "
            SELECT
                p.pname AS 'Product Name',
                p.sellunit AS 'unit',
                p.pid AS 'pid',
                IFNULL((SELECT SUM(ss.stock + ss.stockReturn) - SUM(ss.issuedStock + ss.wastageStock)
                        FROM store_stock ss
                        WHERE ss.pid = p.pid AND ss.date < '$fdate'
                ), 0) AS 'Opening Stock',
                IFNULL((SELECT SUM(ss.stock)
                        FROM store_stock ss
                        WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
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
        $sql = "
            SELECT
                p.pname AS 'Product Name',
                p.sellunit AS 'unit',
                p.pid AS 'pid',
                IFNULL((SELECT SUM(ss.stock + ss.stockReturn) - SUM(ss.issuedStock + ss.wastageStock)
                        FROM store_stock ss
                        WHERE ss.pid = p.pid AND ss.date < '$fdate'
                ), 0) AS 'Opening Stock',
                IFNULL((SELECT SUM(ss.stock)
                        FROM store_stock ss
                        WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
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
            WHERE p.category = '$cat_name';
        ";
    }
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $name=$row['Product Name'];
        $unit=$row['unit'];
        $pid=$row['pid'];
        $openingStock=number_format($row['Opening Stock'],2);
        $purchaseStock=number_format($row['Purchase Stock'],2);
        $issuedStock=number_format(($row['Issued Stock']),2);
        $returnStock=number_format($row['Return Stock'],2);
        $wastageStock=number_format($row['Wastage Stock'],2);

        $cloasingStock=number_format(($row['Opening Stock']+$row['Purchase Stock']+$row['Return Stock'])-($row['Issued Stock']+$row['Wastage Stock']),2);
        $data=[
            'name'=>$name,
            'pid'=>$pid,
            'unit'=>$unit,
            'openingStock'=>$openingStock,
            'stocksum'=>$purchaseStock,
            'issued'=>$issuedStock,
            'retur'=>$returnStock,
            'wastage'=>$wastageStock,
            'cloasing'=>$cloasingStock  
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
    $sql = "
        SELECT
        p.pname AS 'Product Name',
        p.pid AS 'pid',
        p.sellunit AS 'unit',
        IFNULL((
            SELECT SUM(ss.stock) - SUM(ss.issued + ss.stockreturn)
            FROM store_kitchen ss
            WHERE ss.pid = p.pid AND ss.date < '$fdate'
        ), 0) AS 'Opening Stock',
        IFNULL((
            SELECT SUM(ss.stock)
            FROM store_kitchen ss
            WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
        ), 0) AS 'Purchase Stock',
        IFNULL((
            SELECT SUM(ss.issued)
            FROM store_kitchen ss
            WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
        ), 0) AS 'Issued Stock',
        IFNULL((
            SELECT SUM(ss.stockreturn)
            FROM store_kitchen ss
            WHERE ss.pid = p.pid AND ss.date BETWEEN '$fdate' AND '$tdate'
        ), 0) AS 'Return Stock'
    FROM products p
    WHERE p.pid IN (
        SELECT DISTINCT pid
        FROM store_kitchen
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

            $cloasingStock=number_format(($row['Opening Stock']+$row['Purchase Stock'])-($row['Issued Stock']+$row['Return Stock']),2);
            $data=[
                'pid'=>$pid,
                'name'=>$name,
                'unit'=>$unit,
                'openingStock'=>$openingStock,
                'stocksum'=>$purchaseStock,
                'issued'=>$issuedStock,
                'retur'=>$returnStock,
                'cloasing'=>$cloasingStock  
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

    $result = $conn->query("SELECT
                            `store_kitchen`.*,
                            `products`.`pname`,
                            `products`.`sellunit`
                        FROM
                            `store_kitchen`,
                            `products`
                        WHERE
                            `store_kitchen`.`pid` = `products`.`pid`
                            AND (`store_kitchen`.`stock` != 0 OR `store_kitchen`.`stockreturn` != 0)
                            AND `store_kitchen`.`date` BETWEEN '$fdate' AND '$tdate'
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
if(isset($_POST['use_pid']))
{
    $pid=$_POST['use_pid'];
    $isued=$_POST['use_issued'];
    $currentDate = date('Y-m-d');

    $query="INSERT INTO `store_kitchen`(`pid`,`issued`,`date`) VALUES ('$pid','$isued','$currentDate')";
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
    echo json_encode($row);
}
?>