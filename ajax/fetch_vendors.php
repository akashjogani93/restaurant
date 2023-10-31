<?php include('../dbcon.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "SELECT * FROM vendor";
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
?>