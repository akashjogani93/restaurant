<?php
// fetch_products.php

// Assuming you have already established a database connection
include("../dbcon.php");

// Retrieve the ID from the POST data
$id = $_POST['id'];

$purchaseQuery = "SELECT vendor, purchase_date FROM purchase_data WHERE id = $id";
$purchaseResult = mysqli_query($conn, $purchaseQuery);

if (!$purchaseResult) {
    die('Could not fetch purchase details: ' . mysqli_error($conn));
}

$purchaseRow = mysqli_fetch_assoc($purchaseResult);
$vendor = $purchaseRow['vendor'];
$purchaseDate = $purchaseRow['purchase_date'];


// Query the database to fetch the products for the provided ID
$sql = "SELECT * FROM stock WHERE venid = $id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Could not fetch products: ' . mysqli_error($conn));
}

// Generate the HTML for the product table
echo '<center><label>Vendor: ' . $vendor . '</label><br>';
echo '<label>Purchase Date: ' . $purchaseDate . '</label></center><br>';
echo '<table class="table table-striped table-bordered table-hover">';
echo '<thead>';
echo '<tr>';
echo '<th>Product Name</th>';
echo '<th>Unit</th>';
echo '<th>Qty</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['pname'] . '</td>';
    echo '<td>' . $row['unit'] . '</td>';
    echo '<td>' . $row['qty'] . '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';

// Close the database connection
mysqli_close($conn);
?>
