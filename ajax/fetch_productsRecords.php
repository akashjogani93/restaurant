<?php
// fetch_products.php

// Assuming you have already established a database connection
include("../dbcon.php");

// Retrieve the ID from the POST data
$id = $_POST['id'];

$purchaseQuery = "SELECT * FROM purchase_data WHERE id = $id";
$purchaseResult = mysqli_query($conn, $purchaseQuery);

if (!$purchaseResult) {
    die('Could not fetch purchase details: ' . mysqli_error($conn));
}

$purchaseRow = mysqli_fetch_assoc($purchaseResult);
$vendor = $purchaseRow['vendor'];
$purchaseDate = $purchaseRow['purchase_date'];
$totalamt = number_format($purchaseRow['totalamt'],2);
$id = $purchaseRow['id'];
$bill = $purchaseRow['bill'];


// Query the database to fetch the products for the provided ID
$sql = "SELECT `stock`.*,`products`.`pname`,`products`.`unit` FROM `stock`,`products` WHERE `stock`.`venid` = '$id' AND `stock`.`pid`=`products`.`pid`";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Could not fetch products: ' . mysqli_error($conn));
}

// Generate the HTML for the product table
echo '<center><label>Vendor: ' . $vendor . '</label>&nbsp;&nbsp;<label>Bill No: ' . $bill . '</label><br>';
echo '<label>Purchase Date: ' . $purchaseDate . '</label><br>';
echo '<label>Total Amount: ' . $totalamt . '</label></center><br>';
echo '<table class="table table-striped table-bordered table-hover">';
echo '<thead>';
echo '<tr>';
echo '<th>Product Name</th>';
echo '<th>Unit</th>';
echo '<th>Qty</th>';
echo '<th>Price</th>';
echo '<th>Base Amount</th>';
echo '<th>Tax</th>';
echo '<th>Total</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['pname'] . '</td>';
    echo '<td>' . $row['unit'] . '</td>';
    echo '<td>' . $row['qty'] . '</td>';
    echo '<td>' . number_format($row['price'],2) . '</td>';
    echo '<td>' . number_format($row['bamt'],2) . '</td>';
    echo '<td>' . number_format($row['tax'],2) . '</td>';
    echo '<td>' . number_format($row['total'],2) . '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';

// Close the database connection
mysqli_close($conn);
?>
