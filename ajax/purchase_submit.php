<?php
include('../dbcon.php');

$vendorName = $_POST['vendorName'];
$purchasedDate = $_POST['purchasedDate'];
$totamt = $_POST['totamt'];
$gamount = $_POST['gamount'];
$taxamount = $_POST['taxamount'];

$pamt = $_POST['pamt'];
$remark = $_POST['remark'];
$billNo = $_POST['billNo'];
$venId = $_POST['venId'];
$stockList = $_POST['stockList'];
$remain=$totamt-$pamt;

$stmt = $conn->prepare("INSERT INTO `purchase_data` (`vendor`,`purchase_date`,`totalamt`,`pamt`,`remark`,`venId`,`bill`,`gamt`,`tax`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
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
$paymentstmt=$conn->prepare("INSERT INTO `vendor_payment`(`vendor`, `date`, `amt`, `paid`, `remain`, `pending`, `disc`) VALUES(?, ?, ?, ?, ?, ?, ?)");
$paymentstmt->bind_param("ssddddd",$vendorName,$purchasedDate,$totamt,$pamt,$remain,$pendingAmt,$disc);
$paymentstmt->execute();


foreach ($stockList as $stockItem)
{
    $name = $stockItem['name'];
    $qty = $stockItem['qty'];
    $unit = $stockItem['unit'];
    $category = $stockItem['cat'];
    $price = $stockItem['price'];
    $totalAmt = $stockItem['total'];
    $tax = $stockItem['tax'];
    $amt = $stockItem['amt'];

    $exp = $stockItem['exp'];


    $selectStmt = $conn->prepare("SELECT qty FROM stock1 WHERE pname = ? AND unit = ?");
    $selectStmt->bind_param("ss", $name, $unit);
    $selectStmt->execute();
    $selectStmt->bind_result($existingQty);
    $selectStmt->fetch();
    $selectStmt->close();

    if ($existingQty !== null) 
    {
        $updatedQty = $existingQty + $qty;
        $updateStmt = $conn->prepare("UPDATE stock1 SET qty = ? WHERE pname = ? AND unit = ?");
        $updateStmt->bind_param("iss", $updatedQty, $name, $unit);
        $updateStmt->execute();
    }else
    {
        $insertStmt = $conn->prepare("INSERT INTO stock1 (category,pname, unit, qty, venid,exp) VALUES (?, ?, ?, ?, ?, ?)");
        $insertStmt->bind_param("sssiis",$category, $name, $unit, $qty, $vendorId,$exp);
        $insertStmt->execute();
    }
    $stmt = $conn->prepare("INSERT INTO stock (category, pname, unit, qty, venid,price,total,bamt,tax) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiidddd",$category, $name, $unit, $qty, $vendorId,$price,$totalAmt,$amt,$tax);
    $stmt->execute();
}

$stmt->close();

// $paymentstmt->close();
$conn->close();
$response = array('status' => 'success', 'message' => 'Data submitted successfully');
echo json_encode($response);




// Assuming you have a PDO database connection named $pdo
// $stmt = $pdo->prepare("INSERT INTO `purchase_data` (`vendor`, `purchase_date`, `totalamt`, `pamt`, `remark`) VALUES (?, ?, ?, ?, ?)");
// $stmt->execute([$vendorName, $purchasedDate, $totamt, $pamt, $remark]);

// $vendorId = $pdo->lastInsertId();
?>
