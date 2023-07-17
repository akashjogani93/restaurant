<?php
include('../dbcon.php');

$vendorName = $_POST['vendorName'];
$purchasedDate = $_POST['purchasedDate'];
$stockList = $_POST['stockList'];

$stmt = $conn->prepare("INSERT INTO purchase_data (`vendor`, purchase_date) VALUES (?, ?)");
$stmt->bind_param("ss", $vendorName, $purchasedDate);
$stmt->execute();

$vendorId = $stmt->insert_id;

foreach ($stockList as $stockItem) 
{
    $name = $stockItem['name'];
    $qty = $stockItem['qty'];
    $unit = $stockItem['unit'];

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
    } else
    {
        $insertStmt = $conn->prepare("INSERT INTO stock1 (pname, unit, qty, venid) VALUES (?, ?, ?, ?)");
        $insertStmt->bind_param("ssii", $name, $unit, $qty, $vendorId);
        $insertStmt->execute();
    }
    $stmt = $conn->prepare("INSERT INTO stock (pname, unit, qty, venid) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $name, $unit, $qty, $vendorId);
    $stmt->execute();
}

$stmt->close();
$conn->close();
$response = array('status' => 'success', 'message' => 'Data submitted successfully');
echo json_encode($response);
?>
