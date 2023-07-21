<?php 
    include("../dbcon.php");

    $vendor=$_POST['vendor'];
    $mobile=$_POST['mobile'];
    $gst=$_POST['gst'];

    $vendor = mysqli_real_escape_string($conn, $vendor);
    $mobile = mysqli_real_escape_string($conn, $mobile);
    $gst = mysqli_real_escape_string($conn, $gst);


    $insert=$_POST['insert'];

    if($insert=='insert')
    {
        $checkQuery = "SELECT * FROM `vendor` WHERE `vendor` = '$vendor' OR `mobile` = '$mobile'";
    }else
    {
        $id=$_POST['id'];
        $id = mysqli_real_escape_string($conn, $id);
        $checkQuery = "SELECT * FROM `vendor` WHERE (`vendor` = '$vendor' OR `mobile` = '$mobile') AND `slno` != '$id'";
    }
        $result = $conn->query($checkQuery);
        if ($result->num_rows > 0) 
        {
            $matchingVendor = false;
            $matchingMobile = false;

            while ($row = $result->fetch_assoc()) {
                if ($row['vendor'] === $vendor) {
                    $matchingVendor = true;
                }
                if ($row['mobile'] === $mobile) {
                    $matchingMobile = true;
                }
            }

            if ($matchingVendor && $matchingMobile) {
                // echo "Both vendor and mobile already exist.";
                echo 1;
            } elseif ($matchingVendor) 
            {
                // echo "Vendor with the same name already exists.";
                echo 2;
            } elseif ($matchingMobile) {
                // echo "Mobile number already exists.";
                echo 3;
            }
        }else
        {
            if($insert=='insert')
            {
                $query="INSERT INTO `vendor`(`vendor`, `mobile`, `gst`)VALUES('$vendor','$mobile','$gst')";
                if ($conn->query($query) === TRUE) 
                {
                    echo 0;
                } else {
                    echo "Error: " . $query . "<br>" . $conn->error;
                }
            }else
            {
                if($conn->query("UPDATE `purchase_data` SET `vendor`='$vendor' WHERE `venId`='$id'")==TRUE)
                {
                    $query="UPDATE `vendor` SET `vendor`='$vendor',`mobile`='$mobile',`gst`='$gst' WHERE `slno`='$id'";
                    if ($conn->query($query) === TRUE) 
                    {
                        echo 0;
                    } else {
                        echo "Error: " . $query . "<br>" . $conn->error;
                    }
                }else
                {
                    echo "Error: " . $query . "<br>" . $conn->error;
                }
                
            }
            
        }
    $conn->close();

?>
