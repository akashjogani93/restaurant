<?php
include('../dbcon.php');

//store_purchase_product categorys show   and store_product.php category;
if(isset($_POST['store_report']) && isset($_POST['fdate']) && isset($_POST['tdate']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];

    $query="SELECT `stock`.*,`purchase_data`.`purchase_date`,`purchase_data`.`bill`,`products`.`pname`,`products`.`unit`,`products`.`category` FROM `stock`,`purchase_data`,`products` WHERE  `stock`.`pid`=`products`.`pid` AND `stock`.`venid`=`purchase_data`.`id` AND `purchase_data`.`purchase_date` BETWEEN '$fdate' AND '$tdate'";
    $exc=mysqli_query($conn,$query);
    $i=0;
    while($row=mysqli_fetch_assoc($exc))
    {
        $category=$row['category'];
        $pname=$row['pname'];
        $unit=$row['unit'];
        $qty=$row['qty'];
        $price=$row['price'];
        $total=$row['total'];
        $bamt=$row['bamt'];
        $tax=$row['tax'];
        $cess=$row['cess'];
        $disc=$row['disc'];
        $purchase_date=$row['purchase_date'];

        $bill=$row['bill'];
        ?>
            <tr>
                <td><?php echo $i+1; ?></td>
                <td><?php echo $bill; ?></td>
                <td><?php echo $category; ?></td>
                <td><?php echo $pname; ?></td>
                <td><?php echo $unit; ?></td>
                <td class="right-align"><?php echo number_format($qty,2); ?></td>
                <td class="right-align"><?php echo number_format($price,2); ?></td>
                <td class="right-align"><?php echo number_format($bamt,2); ?></td>
                <td class="right-align"><?php echo number_format($disc,2); ?></td>
                <td class="right-align"><?php echo number_format($tax,2); ?></td>
                <td class="right-align"><?php echo number_format($cess,2); ?></td>
                <td class="right-align"><?php echo number_format($total,2); ?></td>
                <td class="right-align"><?php echo $purchase_date; ?></td>
            </tr>
        <?php
        $i++;
    }
}




// assets Store purchase Data;
if(isset($_POST['assets']) && isset($_POST['fdate']) && isset($_POST['tdate']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];

    $query="SELECT `assetspurchasedata`.*,`assetsproduct`.`product` FROM `assetspurchasedata`,`assetsproduct` WHERE `assetspurchasedata`.`pur_id`=`assetsproduct`.`id` AND `assetspurchasedata`.`date` BETWEEN '$fdate' AND '$tdate'";
    $exc=mysqli_query($conn,$query);
    $i=0;
    while($row=mysqli_fetch_assoc($exc))
    {
        $pur_id=$row['pur_id'];
        $product=$row['product'];
        $amount=$row['amount'];
        $qty=$row['qty'];
        $total=$row['total'];
        $date=$row['date'];
        ?>
            <tr>
                <td><?php echo $i+1; ?></td>
                <td><?php echo $product; ?></td>
                <td class="right-align"><?php echo number_format($qty,2); ?></td>
                <td class="right-align"><?php echo number_format($amount,2); ?></td>
                <td class="right-align"><?php echo number_format($total,2); ?></td>
                <td><?php echo $date; ?></td>
            </tr>
        <?php
        $i++;
    }
}



// assets Store Damage Data;
if(isset($_POST['damData']) && isset($_POST['fdate']) && isset($_POST['tdate']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];

    $query="SELECT `assetsdamage`.*,`assetsproduct`.`product` FROM `assetsdamage`,`assetsproduct` WHERE `assetsdamage`.`pur_id`=`assetsproduct`.`id` AND `assetsdamage`.`date` BETWEEN '$fdate' AND '$tdate'";
    $exc=mysqli_query($conn,$query);
    $i=0;
    while($row=mysqli_fetch_assoc($exc))
    {
        $pur_id=$row['pur_id'];
        $product=$row['product'];
        $amount=$row['amount'];
        $qty=$row['qty'];
        $date=$row['date'];
        ?>
            <tr>
                <td><?php echo $i+1; ?></td>
                <td><?php echo $product; ?></td>
                <td class="right-align"><?php echo number_format($qty,2); ?></td>
                <td class="right-align"><?php echo number_format($amount,2); ?></td>
                <td><?php echo $date; ?></td>
            </tr>
        <?php
        $i++;
    }
}
?>