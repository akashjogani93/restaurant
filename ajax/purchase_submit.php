<?php
include('../dbcon.php');

$vendorName = $_POST['vendorName'];
$purchasedDate = $_POST['purchasedDate'];
$stockList = $_POST['stockList'];

// Insert vendor details into the database
$stmt = $conn->prepare("INSERT INTO purchase_data (`vendor`, purchase_date) VALUES (?, ?)");
$stmt->bind_param("ss", $vendorName, $purchasedDate);
$stmt->execute();

// Get the inserted vendor ID
$vendorId = $stmt->insert_id;

// Insert stock items into the database
foreach ($stockList as $stockItem) 
{
    $name = $stockItem['name'];
    $qty = $stockItem['qty'];
    $unit = $stockItem['unit'];

    $selectStmt = $conn->prepare("SELECT qty FROM stock1 WHERE pname = ?");
    $selectStmt->bind_param("s", $name);
    $selectStmt->execute();
    $selectStmt->bind_result($existingQty);
    $selectStmt->fetch();
    $selectStmt->close();

    if ($existingQty !== null) {
        // Update the existing stock item
        $updatedQty = $existingQty + $qty;

        $updateStmt = $conn->prepare("UPDATE stock1 SET qty = ? WHERE pname = ?");
        $updateStmt->bind_param("is", $updatedQty, $name);
        $updateStmt->execute();
    } else
    {
        // Insert a new stock item
        $insertStmt = $conn->prepare("INSERT INTO stock1 (pname, unit, qty, venid) VALUES (?, ?, ?, ?)");
        $insertStmt->bind_param("ssii", $name, $unit, $qty, $vendorId);
        $insertStmt->execute();
    }
    $stmt = $conn->prepare("INSERT INTO stock (pname, unit, qty, venid) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $name, $unit, $qty, $vendorId);
    $stmt->execute();
}

// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();

// Send a response back to the client-side
$response = array('status' => 'success', 'message' => 'Data submitted successfully');
echo json_encode($response);
?>
