<?php session_start(); 
$cash_type=$_SESSION['tye'];
$cash_id=$_SESSION['id'];
$name=$_SESSION['name']; 
include('../dbcon.php');

//store_purchase_product categorys show   and store_product.php category;
if(isset($_POST['cancelkot']) && isset($_POST['fdate']) && isset($_POST['tdate']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];

    $query="SELECT * FROM `kot_cancel` WHERE `date` BETWEEN '$fdate' AND '$tdate'";
    $exc=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($exc))
    {
        $table=$row['tabno'];
        $date=$row['date'];
        $cap_code=$row['cap_code'];
        $captain=$row['captain'];
        $itmno=$row['itmno'];
        $itmnam=$row['itmnam'];
        $qty=$row['qty'];
        $prc=$row['prc'];
        $tot=$row['tot'];
        $kot_time=$row['cancel_time'];
        ?>
            <tr>
                <td><?php echo $table; ?></td>
                <td><?php echo $cap_code; ?></td>
                <td><?php echo $captain; ?></td>
                <td><?php echo $itmno; ?></td>
                <td><?php echo $itmnam; ?></td>
                <td><?php echo $qty; ?></td>
                <td><?php echo $prc; ?></td>
                <td><?php echo $tot; ?></td>
                <td></td>
                <td><?php echo $date; ?></td>
                <td><?php echo $kot_time; ?></td>
            </tr>
        <?php
    }
}

if(isset($_POST['daysale']) && isset($_POST['fdate']) && isset($_POST['tdate']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];
    $query="SELECT * FROM `invoice` WHERE `status`=1 AND `date` BETWEEN '$fdate' AND '$tdate'";
    $exc=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($exc))
    {
        $date=$row['date'];
        $slno=$row['slno'];
        $gtot=number_format($row['gtot'],2);
        $discAmt=number_format($row['discAmt'],2);
        $gstAmt=number_format($row['gstAmt'],2);
        $roundplus=$row['roundplus'];
        $roundminus=$row['roundminus'];
        $nettot=number_format($row['nettot'],2);
        ?>
            <tr>
                <td><?php echo $date; ?></td>
                <td><?php echo $slno; ?></td>
                <td><?php echo $gtot; ?></td>
                <td><?php echo $discAmt; ?></td>
                <td><?php echo $gstAmt; ?></td>
                <td><?php echo $roundminus; ?></td>
                <td><?php echo $roundplus; ?></td>
                <td><?php echo $nettot; ?></td>
                <td>
                    <!-- <button class="btn btn-danger edit-btn" data-toggle="modal" data-target="#editModal">Edit</button> -->
                    <button type="button" class="btn btn-danger edit-btn">Edit</button>
                </td>
            </tr>
        <?php
    }
}

if(isset($_POST['monthsale']) && isset($_POST['fdate']) && isset($_POST['tdate']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];
    $query = "SELECT 
              DATE(`date`) AS day, 
              MIN(slno) AS start_id, 
              MAX(slno) AS end_id,
              SUM(gtot) AS gross,
              SUM(gstAmt) AS gstamt,
              SUM(discAmt) AS disc,
              SUM(roundplus) AS plus,
              SUM(roundminus) AS minus,
              SUM(nettot) AS total
          FROM 
              `invoice`
          WHERE 
              `status` = 1 AND `date` BETWEEN '$fdate' AND '$tdate' 
          GROUP BY 
              DATE(`date`)";
    $exc=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($exc))
    {
        $date=$row['day'];
        $start_id=$row['start_id'];
        $end_id=$row['end_id'];
        $gtot=number_format($row['gross'],2);
        $disc=number_format($row['disc'],2);
        $gstAmt=number_format($row['gstamt'],2);
        $gst=$gstAmt/2;
        $roundplus=$row['plus'];
        $roundminus=$row['minus'];
        $nettot=number_format($row['total'],2);
        ?>
            <tr>
                <td><?php echo $date; ?></td>
                <td><?php echo $start_id.'To'.$end_id; ?></td>
                <td><?php echo $gtot; ?></td>
                <td><?php echo $disc; ?></td>
                <td><?php echo $gst; ?></td>
                <td><?php echo $gst; ?></td>
                <td><?php echo $roundminus; ?></td>
                <td><?php echo $roundplus; ?></td>
                <td><?php echo $nettot; ?></td>
            </tr>
        <?php
    }
}

if(isset($_POST['dayFoodInvoice']) && isset($_POST['fdate']) && isset($_POST['tdate']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];
    $query ="SELECT 
                i.*, 
                GROUP_CONCAT(td.itmnam SEPARATOR ', ') AS product_names,
                GROUP_CONCAT(td.itmno SEPARATOR ', ') AS item_code,
                GROUP_CONCAT(td.qty SEPARATOR ', ') AS quantities,
                GROUP_CONCAT(td.prc SEPARATOR ', ') AS prc,
                GROUP_CONCAT(td.tot SEPARATOR ', ') AS tot
            FROM 
                invoice i
            LEFT JOIN 
                tabledata td ON i.slno = td.billno
            WHERE 
                i.date BETWEEN '$fdate' AND '$tdate'
          GROUP BY 
                i.slno";
    $exc=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($exc))
    {

        ?>
            <table class="table" id="kotdata" style="width:100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>Itme No</th>
                        <th>Item Name</th>
                        <th>Rate</th>
                        <th>Qty</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th colspan="2">Bill NO : <?php echo $row['slno'].'&nbsp;/&nbsp;'.$row['date'].'&nbsp;/&nbsp;'.$row['time']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Captain Name : <?php echo $row['capname']; ?></th>
                        <th colspan="3">Table-No : <?php echo $row['tabno'];?></th>
                    </tr>
                <?php
                    $productNames = explode(', ', $row['product_names']);
                    $quantities = explode(', ', $row['quantities']);
                    $prc = explode(', ', $row['prc']);
                    $tot = explode(', ', $row['tot']);
                    $item_code = explode(', ', $row['item_code']);

                    for ($i = 0; $i < count($productNames); $i++) {
                        ?>
                        <tr>
                            <td style="width:10%;"><?php echo $item_code[$i]; ?></td>
                            <td style="width:50%;"><?php echo $productNames[$i]; ?></td>
                            <td style="width:10%;"><?php echo number_format($prc[$i],2); ?></td>
                            <td style="width:10%;"><?php echo number_format($quantities[$i],2); ?></td>
                            <td style="width:10%;"><?php echo number_format($tot[$i],2); ?></td>
                        </tr>
                    <?php
                    }
                ?>
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th colspan="4"></th>
                        <th><?php echo number_format($row['gtot'],2);?></th>
                    </tr>
                </tfoot>
            </table>
        <?php
    }
}

if(isset($_POST['menuQty']) && isset($_POST['fdate']) && isset($_POST['tdate']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];
    $query = "SELECT `itmnam`, `itmno`, SUM(qty) AS `total_qty`
              FROM `tabledata`
              WHERE `date` BETWEEN '$fdate' AND '$tdate'
              GROUP BY `itmnam`, `itmno`";
    $exc=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($exc))
    {
        ?>
            <tr>
                <td><?php echo $row['itmno']; ?></td>
                <td><?php echo $row['itmnam']; ?></td>
                <td><?php echo $row['total_qty']; ?></td>
            </tr>
        <?php
    }
}

if(isset($_POST['singlefood']) && isset($_POST['fdate']) && isset($_POST['tdate']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];

    $query1="SELECT DISTINCT `itmnam` FROM `tabledata`";
    $run=mysqli_query($conn,$query1);
    while($row1=mysqli_fetch_assoc($run))
    {
        $itmnam=$row1['itmnam'];
        $query="SELECT 
            td.qty as total_qty,
            td.tabno,
            td.date,
            td.time,
            i.slno,
            i.cap_code,
            i.cashId
        FROM 
            `tabledata` td
        JOIN 
            `invoice` i ON i.slno = td.billno
        WHERE td.itmnam='$itmnam' AND i.date BETWEEN '$fdate' AND '$tdate';
        ";
        $qty=0;
        $exc=mysqli_query($conn,$query);
        while($row=mysqli_fetch_assoc($exc))
        {
            ?>
                
                <tr>
                    <td class="text-right"><?php echo $row['slno'];?></td>
                    <td class="text-right"><?php echo number_format($row['total_qty'],2);?></td>
                    <td><?php echo $row['tabno'];?></td>
                    <td><?php echo $row['cap_code'];?></td>
                    <td><?php echo $row['cashId'];?></td>
                    <td><?php echo $row['date'].' & '.$row['time'];?></td>
                </tr>
            <?php
            $qty=$qty+$row['total_qty'];
        }
        if($qty!=0)
        {
       ?>
        <tr class="thead-dark">
            <td colspan="2" class="text-right"><?php echo number_format($qty,2);?></td>
            <td colspan="4"><?php echo $itmnam; ?></td>
        </tr>
        <?php
        }
    }
}


if(isset($_POST['billno']))
{
    $bill=$_POST['billno'];
    $options = array();
    $options['billno'] = $bill;
    $query="SELECT `slno`,`itmno`,`itmnam`,`qty`,`prc`,`tot` FROM `tabledata` WHERE `billno`='$bill'";
    $exc=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($exc))
    {
        $options['items'][] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($options);
}

if(isset($_POST['storedData']))
{
    $cash_id=$_SESSION['id'];
    $data=$_POST['storedData'];
    if (isset($data['billno']) && isset($data['items']) && is_array($data['items'])) 
    {
        $bill = $data['billno'];
        // Fetch existing data
        $result = $conn->query("SELECT * FROM tabledata WHERE billno = '$bill'");
        $existing_data = [];
        while($row = $result->fetch_assoc()) {
            $existing_data[$row['slno']] = $row;
        }
        $currentDate = date("Y-m-d");
        $currentTime = date("h:i:s A");

        // Update existing data and delete removed items
        foreach ($data['items'] as $item) 
        {
            if (isset($existing_data[$item['slno']])) 
            {
                $updt=$item['qty'];
                $qty_diff = abs($item['qty'] - $existing_data[$item['slno']]['qty']);
                $tot_diff = abs($item['tot'] - $existing_data[$item['slno']]['tot']);

                // Update qty and tot
                $conn->query("UPDATE `tabledata` SET qty = '$item[qty]', tot = '$item[tot]' WHERE slno = '$item[slno]'");


                $id=$item['slno'];
                $result1 = $conn->query("SELECT * FROM tabledata WHERE billno = '$bill' AND `slno`='$id'");
                while($out = $result1->fetch_assoc()) 
                {
                    $date=$out['date'];
                    $itmno=$out['itmno'];
                    $itmnam=$out['itmnam'];
                    $prc=$out['prc'];
                    $tabno=$out['tabno'];
                    $time=$out['time'];
                    $kot_num=$out['kot_num'];
                    $qty=$out['qty'];
                    if($qty != $updt)
                    {
                        $conn->query("INSERT INTO `trash_bill`(`date`, `itmno`, `itemnam`, `prc`, `qty`, `tot`, `tabno`, `billno`, `time`, `kot_num`, `trashDate`, `trashTime`,`uid`) VALUES ('$date','$itmno','$itmnam','$prc','$qty_diff','$tot_diff','$tabno','$bill','$time','$kot_num','$currentDate','$currentTime','$cash_id')");
                    }
                }
            }
        }

        // Delete removed items
        foreach ($existing_data as $slno => $item) 
        {
            if (!in_array($slno, array_column($data['items'], 'slno'))) 
            {
                // Move item to trash
                $result1 = $conn->query("SELECT * FROM tabledata WHERE billno = '$bill' AND `slno`='$slno'");
                while($out = $result1->fetch_assoc()) 
                {
                    $date=$out['date'];
                    $itmno=$out['itmno'];
                    $itmnam=$out['itmnam'];
                    $prc=$out['prc'];
                    $tabno=$out['tabno'];
                    $time=$out['time'];
                    $kot_num=$out['kot_num'];
                    $qty=$out['qty'];
                    $tot=$out['tot'];
                    $conn->query("INSERT INTO `trash_bill`(`date`, `itmno`, `itemnam`, `prc`, `qty`, `tot`, `tabno`, `billno`, `time`, `kot_num`, `trashDate`, `trashTime`,`uid`) VALUES ('$date','$itmno','$itmnam','$prc','$qty','$tot','$tabno','$bill','$time','$kot_num','$currentDate','$currentTime','$cash_id')");
                }

                // Delete item from tabledata
                $conn->query("DELETE FROM `tabledata` WHERE slno = '$slno'");
            }
        }
    }

    $query1 = $conn->query("SELECT SUM(`tabledata`.tot) AS gtot, `invoice`.discount 
          FROM `invoice`
          JOIN `tabledata` ON `invoice`.slno = `tabledata`.billno
          WHERE `invoice`.slno = '$bill'");
    while($out = $query1->fetch_assoc())
    {
        $gndtot=(float) $out['gtot'];
        $discount=(float) $out['discount'];

        $discAmt=($gndtot*$discount)/100;
        $afterDisc=$gndtot-$discAmt;

        $gstAmt=($afterDisc*5)/100;
        $afterGst=$afterDisc+$gstAmt;

        $round = fmod($afterGst, 1);

        $roundMinus=0;
        $roundPlus=0;
        if($round < 0.50)
        {
            $roundMinus=number_format($round, 2, '.', '');
        }else
        {
            $roundPlus=number_format(1-$round, 2, '.', '');
        }
        $nettot=round($afterGst);

        $gndtot = number_format($gndtot, 2, '.', '');
        $disAmt=number_format($discAmt, 2, '.', '');
        $amountAfterDiscount=number_format($afterDisc, 2, '.', '');
        $gstAmt=number_format($gstAmt, 2, '.', '');
        $afterGst=number_format($afterGst, 2, '.', '');
        $nettot=number_format($nettot, 2, '.', '');

        $conn->query("UPDATE `invoice` 
                        SET `gtot` = '$gndtot', 
                            `discAmt` = '$disAmt',
                            `afterDisc`='$amountAfterDiscount',
                            `gstAmt`='$gstAmt',
                            `afterGst`='$afterGst',
                            `roundplus`='$roundPlus',
                            `roundminus`='$roundMinus',
                            `nettot`='$nettot' WHERE slno = '$bill'");
    }
    header('Content-Type: application/json');
    echo json_encode('running');
}

?>