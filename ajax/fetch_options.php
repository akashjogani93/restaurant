<?php include('../dbcon.php');

// Retrieve options from the database
$sql = "SELECT pid,pname FROM products";
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
?>