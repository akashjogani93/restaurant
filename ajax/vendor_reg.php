<?php 
    include("../dbcon.php");

    $vendor=$_POST['vendor'];
    $mobile=$_POST['mobile'];
    $gst=$_POST['gst'];
    $fssi=$_POST['fssi'];
    $adds=$_POST['adds'];

    $vendor = mysqli_real_escape_string($conn, $vendor);
    $mobile = mysqli_real_escape_string($conn, $mobile);
    $gst = mysqli_real_escape_string($conn, $gst);
    $fssi = mysqli_real_escape_string($conn, $fssi);
    $adds = mysqli_real_escape_string($conn, $adds);

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

            if ($matchingVendor && $matchingMobile) 
            {
                // echo "Both vendor and mobile already exist.";
                echo 1;
            } elseif ($matchingVendor) 
            {
                // echo "Vendor with the same name already exists.";
                echo 2;
            } elseif ($matchingMobile) 
            {
                // echo "Mobile number already exists.";
                echo 3;
            }
        }else
        {
            if($insert=='insert')
            {
                $query="INSERT INTO `vendor`(`vendor`, `mobile`, `gst`, `fssi`, `adds`)VALUES('$vendor','$mobile','$gst','$fssi','$adds')";
                if ($conn->query($query) === TRUE) 
                {
                    echo 0;
                } else {
                    echo "Error: " . $query . "<br>" . $conn->error;
                }
            }else
            {
                // if($conn->query("UPDATE `purchase_data` SET `vendor`='$vendor' WHERE `venId`='$id'")==TRUE)
                // {
                //     $getVendorName="SELECT `vendor` FROM `vendor` WHERE `slno`='$id'"; $getVendorNameResult = $conn->query($getVendorName);
                //     while ($getVendorNameRow = $getVendorNameResult->fetch_assoc()) 
                //     {
                //         $oldVendorName=$getVendorNameRow['vendor'];
                //         $query="UPDATE `vendor` SET `vendor`='$vendor',`mobile`='$mobile',`gst`='$gst',`fssi`='$fssi',`adds`='$adds' WHERE `slno`='$id'";
                //         if ($conn->query($query) === TRUE) 
                //         {
                //             $vendor_payment="UPDATE `vendor_payment` SET `vendor`='$vendor' WHERE `vendor`='$oldVendorName'";
                //             $conn->query($vendor_payment);
                //             echo 0;
                //         } else {
                //             echo "Error: " . $query . "<br>" . $conn->error;
                //         }
                //     }
                // }else
                // {
                //     echo "Error: " . $query . "<br>" . $conn->error;
                // }
                $getVendorName="SELECT `vendor` FROM `vendor` WHERE `slno`='$id'"; $getVendorNameResult = $conn->query($getVendorName);
                while ($getVendorNameRow = $getVendorNameResult->fetch_assoc())
                {
                    $oldVendorName=$getVendorNameRow['vendor'];
                    $query="UPDATE `vendor` SET `vendor`='$vendor',`mobile`='$mobile',`gst`='$gst',`fssi`='$fssi',`adds`='$adds' WHERE `slno`='$id'";
                    if($conn->query($query) === TRUE) 
                    {
                        if($conn->query("UPDATE `purchase_data` SET `vendor`='$vendor' WHERE `venId`='$id'")==TRUE)
                        {
                            $vendor_payment="UPDATE `vendor_payment` SET `vendor`='$vendor' WHERE `vendor`='$oldVendorName'";
                            if ($conn->query($vendor_payment) === TRUE)
                            {
                                echo 0;
                            }
                        }else
                        {
                            echo 0;
                        }
                    }
                }
            }
            
        }
    $conn->close();

?>
