<?php
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

?>