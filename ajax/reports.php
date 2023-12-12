<?php session_start(); 
$cash_type=$_SESSION['tye'];
$cash_id=$_SESSION['id'];
$name=$_SESSION['name']; 
include('../dbcon.php');

$Totalgtot=0;
$totaldisc=0;
$totalgst=0;
$totalminus=0;
$totalplus=0;
$toatlnet=0;

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

    ?>
        <table class="table" id="dayinvoices">
            <thead class="thead-dark" style="background-color: grey; color: white;">
                <tr>
                    <th scope="col">Invoice Date</th>
                    <th scope="col">Invoice Number</th>
                    <th scope="col">Gross Amount</th>
                    <th scope="col">Discount</th>
                    <th scope="col">GST Amount</th>
                    <th scope="col">Round Off(-)</th>  
                    <th scope="col">Round Off(+)</th>
                    <th scope="col">Net Amount</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody id="dayData">
    <?php
    while($row=mysqli_fetch_assoc($exc))
    {
        $Totalgtot=$Totalgtot+$row['gtot'];
        $totaldisc=$totaldisc+$row['discAmt'];
        $totalgst=$totalgst+$row['gstAmt'];
        $totalminus=$totalminus+$row['roundminus'];
        $totalplus=$totalplus+$row['roundplus'];
        $toatlnet=$toatlnet+$row['nettot'];

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
                    <button type="button" class="btn btn-danger edit-btn">Edit</button>
                </td>
            </tr>
        <?php
    }
    ?>
        </tbody>
        <tfoot class="thead-dark" id="tfoot">
            <tr>
                <th colspan="2"></th>
                <th><?php echo number_format($Totalgtot,2); ?></th>
                <th><?php echo number_format($totaldisc,2); ?></th>
                <th><?php echo number_format($totalgst,2); ?></th>
                <th><?php echo number_format($totalminus,2); ?></th>
                <th><?php echo number_format($totalplus,2); ?></th>
                <th><?php echo number_format($toatlnet,2); ?></th>
                <th></th>
            </tr>
        </tfoot>
        </table>
    <?php
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
    ?>
        <table class="table" id="monthsalebill">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Invoice Number</th>
                    <th scope="col">Gross Amount</th>
                    <th scope="col">Discount</th>
                    <th scope="col">C.GST</th>
                    <th scope="col">S.GST</th>
                    <th scope="col">Round Off(-)</th>  
                    <th scope="col">Round Off(+)</th>
                    <th scope="col">Net Amount</th>
                </tr>
            </thead>
            <tbody>
    <?php
    while($row=mysqli_fetch_assoc($exc))
    {
        $Totalgtot=$Totalgtot+$row['gross'];
        $totaldisc=$totaldisc+$row['disc'];
        $totalgst=$totalgst+$row['gstamt'];
        $totalminus=$totalminus+$row['minus'];
        $totalplus=$totalplus+$row['plus'];
        $toatlnet=$toatlnet+$row['total'];


        $date=$row['day'];
        $start_id=$row['start_id'];
        $end_id=$row['end_id'];
        $gtot=number_format($row['gross'],2);
        $disc=number_format($row['disc'],2);
        $gstAmt=number_format($row['gstamt'],2);
        $gst=$row['gstamt']/2;
        $roundplus=$row['plus'];
        $roundminus=$row['minus'];
        $nettot=number_format($row['total'],2);
        ?>
            <tr>
                <td><?php echo $date; ?></td>
                <td><?php echo $start_id.' To '.$end_id; ?></td>
                <td><?php echo $gtot; ?></td>
                <td><?php echo $disc; ?></td>
                <td><?php echo number_format($gst,2); ?></td>
                <td><?php echo number_format($gst,2); ?></td>
                <td><?php echo $roundminus; ?></td>
                <td><?php echo $roundplus; ?></td>
                <td><?php echo $nettot; ?></td>
            </tr>
        <?php
    }
    ?>
        </tbody>
        <tfoot class="thead-dark">
            <tr>
                <th colspan="2"></th>
                <th><?php echo number_format($Totalgtot,2); ?></th>
                <th><?php echo number_format($totaldisc,2); ?></th>
                <th><?php echo number_format($totalgst/2,2); ?></th>
                <th><?php echo number_format($totalgst/2,2); ?></th>
                <th><?php echo number_format($totalminus,2); ?></th>
                <th><?php echo number_format($totalplus,2); ?></th>
                <th><?php echo number_format($toatlnet,2); ?></th>
            </tr>
        </tfoot>
    </table>
    <?php
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
               i.status=1 AND i.date BETWEEN '$fdate' AND '$tdate'
          GROUP BY 
                i.slno";
    $exc=mysqli_query($conn,$query);
    $net=0;
    while($row=mysqli_fetch_assoc($exc))
    {
        $gtot=$row['gtot'];
        $net=$net+$gtot;
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
                        <th colspan="3">Table-No : <?php echo $row['tabno'];?>&nbsp;/&nbsp;UID : <?php echo $row['cashId'];?></th>
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
                            <td style="width:60%;"><?php echo $productNames[$i]; ?></td>
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
                        <th><?php echo number_format($gtot,2);?></th>
                    </tr>
                </tfoot>
            </table>
        <?php
    }
    ?>
        <table class="table" id="kotdata" style="width:100%;">
            <thead class="thead-dark">
                <tr>
                    <th colspan="4"></th>
                    <th><?php echo "Grand Total:".$net;?></th>
                </tr>
            <thead>
        </table>
    <?php
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
        <tr class="thead-dark likethead">
            <td colspan="2" class="text-right"><?php echo number_format($qty,2);?></td>
            <td colspan="4"><?php echo $itmnam; ?></td>
        </tr>
        <?php
        }
    }
}

if(isset($_POST['cashier']) && isset($_POST['fdate']) && isset($_POST['tdate']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];
    $query = "SELECT `date`, `cashId`,
                    SUM(`gtot`) as `total_gtot`,
                    SUM(`discAmt`) as `total_discAmt`,
                    SUM(`gstAmt`) as `total_gstAmt`,
                    SUM(`roundplus`) as `total_plus`,
                    SUM(`roundminus`) as `total_minus`,
                    SUM(`nettot`) as total_nettot
                FROM `invoice`
                WHERE `status`=1 AND `date` BETWEEN '$fdate' AND '$tdate'
                GROUP BY `date`, `cashId`";

    $exc=mysqli_query($conn,$query);
    ?>
        <table class="table" id="cashierdd">
            <thead class="thead-dark" style="background-color: grey; color: white;">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">UID</th>
                    <th scope="col">Cashier Name</th>
                    <th scope="col">Gross Amount</th>
                    <th scope="col">Discount</th>
                    <th scope="col">GST Amount</th>
                    <th scope="col">Round Off(-)</th>  
                    <th scope="col">Round Off(+)</th>
                    <th scope="col">Net Amount</th>
                </tr>
            </thead>
            <tbody id="dayData">
    <?php
    while($row=mysqli_fetch_assoc($exc))
    {
        $Totalgtot=$Totalgtot+$row['total_gtot'];
        $totaldisc=$totaldisc+$row['total_discAmt'];
        $totalgst=$totalgst+$row['total_gstAmt'];
        $totalminus=$totalminus+$row['total_minus'];
        $totalplus=$totalplus+$row['total_plus'];
        $toatlnet=$toatlnet+$row['total_nettot'];

        $date=$row['date'];
        $chashId=$row['cashId'];
        if($chashId==0)
        {
            $cashierName="Admin";
        }else
        {
            $query="SELECT `empname` FROM `empreg` WHERE `cap_code`='$chashId'";
            $exc=mysqli_query($conn,$query);
            while($row=mysqli_fetch_assoc($exc))
            {
                $cashierName=$row['empname'];
            }
        }
        $total_gtot=number_format($row['total_gtot'],2);
        $total_discAmt=number_format($row['total_discAmt'],2);
        $total_gstAmt=number_format($row['total_gstAmt'],2);
        $total_plus=$row['total_plus'];
        $total_minus=$row['total_minus'];
        $total_nettot=number_format($row['total_nettot'],2);
        ?>
            <tr>
                <td><?php echo $date; ?></td>
                <td><?php echo $chashId; ?></td>
                <td><?php echo $cashierName; ?></td>
                <td><?php echo $total_gtot; ?></td>
                <td><?php echo $total_discAmt; ?></td>
                <td><?php echo $total_gstAmt; ?></td>
                <td><?php echo $total_minus; ?></td>
                <td><?php echo $total_plus; ?></td>
                <td><?php echo $total_nettot; ?></td>
            </tr>
        <?php
    }
    ?>
        </tbody>
        <tfoot class="thead-dark">
            <tr>
                <th colspan="3"></th>
                <th><?php echo number_format($Totalgtot,2); ?></th>
                <th><?php echo number_format($totaldisc,2); ?></th>
                <th><?php echo number_format($totalgst,2); ?></th>
                <th><?php echo number_format($totalminus,2); ?></th>
                <th><?php echo number_format($totalplus,2); ?></th>
                <th><?php echo number_format($toatlnet,2); ?></th>
            </tr>
        </tfoot>
        </table>
    <?php
}

if(isset($_POST['captainData']) && isset($_POST['fdate']) && isset($_POST['tdate']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];
    $query = "SELECT `date`, `cap_code`,`capname`,
                    SUM(`gtot`) as `total_gtot`,
                    SUM(`discAmt`) as `total_discAmt`,
                    SUM(`gstAmt`) as `total_gstAmt`,
                    SUM(`roundplus`) as `total_plus`,
                    SUM(`roundminus`) as `total_minus`,
                    SUM(`nettot`) as total_nettot
                FROM `invoice`
                WHERE `status`=1 AND `date` BETWEEN '$fdate' AND '$tdate'
                GROUP BY `date`, `cap_code`";

    $exc=mysqli_query($conn,$query);
    ?>
        <table class="table" id="captaintable">
            <thead class="thead-dark" style="background-color: grey; color: white;">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">UID</th>
                    <th scope="col">Captain Name</th>
                    <th scope="col">Gross Amount</th>
                    <th scope="col">Discount</th>
                    <th scope="col">GST Amount</th>
                    <th scope="col">Round Off(-)</th>  
                    <th scope="col">Round Off(+)</th>
                    <th scope="col">Net Amount</th>
                </tr>
            </thead>
            <tbody id="dayData">
    <?php
    while($row=mysqli_fetch_assoc($exc))
    {
        $Totalgtot=$Totalgtot+$row['total_gtot'];
        $totaldisc=$totaldisc+$row['total_discAmt'];
        $totalgst=$totalgst+$row['total_gstAmt'];
        $totalminus=$totalminus+$row['total_minus'];
        $totalplus=$totalplus+$row['total_plus'];
        $toatlnet=$toatlnet+$row['total_nettot'];

        $date=$row['date'];
        $chashId=$row['cap_code'];
        $capname=$row['capname'];
        $total_gtot=number_format($row['total_gtot'],2);
        $total_discAmt=number_format($row['total_discAmt'],2);
        $total_gstAmt=number_format($row['total_gstAmt'],2);
        $total_plus=$row['total_plus'];
        $total_minus=$row['total_minus'];
        $total_nettot=number_format($row['total_nettot'],2);
        ?>
            <tr>
                <td><?php echo $date; ?></td>
                <td><?php echo $chashId; ?></td>
                <td><?php echo $capname; ?></td>
                <td><?php echo $total_gtot; ?></td>
                <td><?php echo $total_discAmt; ?></td>
                <td><?php echo $total_gstAmt; ?></td>
                <td><?php echo $total_minus; ?></td>
                <td><?php echo $totalplus; ?></td>
                <td><?php echo $total_nettot; ?></td>
            </tr>
        <?php
    }
    ?>
        </tbody>
            <tfoot class="thead-dark">
                <tr>
                    <th colspan="3"></th>
                    <th><?php echo number_format($Totalgtot,2); ?></th>
                    <th><?php echo number_format($totaldisc,2); ?></th>
                    <th><?php echo number_format($totalgst,2); ?></th>
                    <th><?php echo number_format($totalminus,2); ?></th>
                    <th><?php echo number_format($totalplus,2); ?></th>
                    <th><?php echo number_format($toatlnet,2); ?></th>
                </tr>
            </tfoot>
        </table>
    <?php
}

if(isset($_POST['paymentMode']) && isset($_POST['fdate']) && isset($_POST['tdate']) && isset($_POST['pay']))
{
    $fdate=$_POST['fdate'];
    $tdate=$_POST['tdate'];
    $pay=$_POST['pay'];

    if($pay=='All')
    {
        $query="SELECT * FROM `invoice` WHERE `status`=1 AND `date` BETWEEN '$fdate' AND '$tdate'";
    }else
    {
        $query="SELECT * FROM `invoice` WHERE `status`=1 AND `pmode`='$pay' AND `date` BETWEEN '$fdate' AND '$tdate'";
    }
        
    $exc=mysqli_query($conn,$query);

    ?>
        <table class="table" id="paymode">
            <thead class="thead-dark" style="background-color: grey; color: white;">
                <tr>
                    <th scope="col">Invoice Date</th>
                    <th scope="col">Invoice Number</th>
                    <th scope="col">Gross Amount</th>
                    <th scope="col">Discount</th>
                    <th scope="col">GST Amount</th>
                    <th scope="col">Round Off(-)</th>  
                    <th scope="col">Round Off(+)</th>
                    <th scope="col">Net Amount</th>
                    <th scope="col">Payment</th>
                </tr>
            </thead>
            <tbody id="dayData">
    <?php
    while($row=mysqli_fetch_assoc($exc))
    {
        $Totalgtot=$Totalgtot+$row['gtot'];
        $totaldisc=$totaldisc+$row['discAmt'];
        $totalgst=$totalgst+$row['gstAmt'];
        $totalminus=$totalminus+$row['roundminus'];
        $totalplus=$totalplus+$row['roundplus'];
        $toatlnet=$toatlnet+$row['nettot'];

        $date=$row['date'];
        $slno=$row['slno'];
        $gtot=number_format($row['gtot'],2);
        $discAmt=number_format($row['discAmt'],2);
        $gstAmt=number_format($row['gstAmt'],2);
        $roundplus=$row['roundplus'];
        $roundminus=$row['roundminus'];
        $pmod=$row['pmode'];
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
                <td><?php echo $pmod; ?></td>
            </tr>
        <?php
    }
    ?>
        </tbody>
        <tfoot class="thead-dark">
            <tr>
                <th colspan="2"></th>
                <th><?php echo number_format($Totalgtot,2); ?></th>
                <th><?php echo number_format($totaldisc,2); ?></th>
                <th><?php echo number_format($totalgst,2); ?></th>
                <th><?php echo number_format($totalminus,2); ?></th>
                <th><?php echo number_format($totalplus,2); ?></th>
                <th><?php echo number_format($toatlnet,2); ?></th>
                <th></th>
            </tr>
        </tfoot>
        </table>
    <?php
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