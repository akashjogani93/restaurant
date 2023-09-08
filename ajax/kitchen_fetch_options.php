<?php include('../dbcon.php');

// Retrieve options from the database
if(isset($_POST['kit']))
{
    $sql = "SELECT Distinct id,pname FROM stock1  WHERE category!='Beverages And Desserts'";
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

if(isset($_POST['bev']))
{
    $sql = "SELECT Distinct id,pname FROM stock1 WHERE category='Beverages And Desserts'";
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
?>