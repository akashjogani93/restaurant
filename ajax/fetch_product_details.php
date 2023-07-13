<?php
include('../dbcon.php');

$productId = $_POST['productId'];

$stmt = $conn->prepare("SELECT qty, unit FROM stock1 WHERE id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$stmt->bind_result($quantity, $unit);
$stmt->fetch();
$stmt->close();

$response = array('qty' => $quantity, 'unit' => $unit);
header('Content-Type: application/json');
echo json_encode($response);
?>
