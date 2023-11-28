<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Report</title>
</head>
<body>

<?php
// Assuming you have a database connection established earlier
include("dbcon.php");
$fdate='2023-11-23';
$tdate='2023-11-23';

$fdate = mysqli_real_escape_string($conn,$fdate);
$tdate = mysqli_real_escape_string($conn,$tdate);

$sql = "
    SELECT
        p.pname AS 'Product Name',
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

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    echo '<table border="1">';
    echo '<tr>
            <th>Item Name</th>
            <th>Opening Stock</th>
            <th>Purchase</th>
            <th>Issued Stock</th>
            <th>Return</th>
            <th>Wastage</th>
            <th>Closing Stock</th>
        </tr>';

    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['Product Name'] . '</td>';
        echo '<td>' . $row['Opening Stock'] . '</td>';
        echo '<td>' . $row['Purchase Stock'] . '</td>';
        echo '<td>' . $row['Issued Stock'] . '</td>';
        echo '<td>' . $row['Return Stock'] . '</td>';
        echo '<td>' . $row['Wastage Stock'] . '</td>';
        echo '<td>' . ($row['Opening Stock']+$row['Purchase Stock']+$row['Return Stock'])-($row['Issued Stock']+$row['Wastage Stock']) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo 'No data found';
}
// Close the database connection
mysqli_close($conn);
?>

</body>
</html>
