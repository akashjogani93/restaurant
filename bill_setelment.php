<table class="table table-bordered table-striped" id="formsettle" >
    <thead>
        <tr>
            <th>Bill No</th>
            <th>Table</th>
            <th>Total</th>
            <th>Payment</th>
            <th>Edit</th>
            <th>Settle</th>
        </tr>
    </thead>
    <tbody id="tbody1">
        <?php
            require_once("dbcon.php");
            $order=$_GET['order'];
            if($order==0)
            {
                $sql3 = "SELECT * FROM `invoice` WHERE `Status`=0 AND `orde`='Table'";
            }else
            {
                $sql3 = "SELECT * FROM `invoice` WHERE `Status`=0 AND `orde`='Parcel'";
            }
            $result3 = mysqli_query($conn, $sql3);
            if(mysqli_num_rows($result3) > 0)
            {
                while($row3 = mysqli_fetch_assoc($result3)) 
                {
                    $amount=$row3['nettot'];
                    if ($amount == 0) 
                    {
                        echo '<script>document.getElementById("payment").disabled = true;</script>';
                    }
                    ?>
                    <tr>
                        <td><?php echo $row3['slno']; ?></td>
                        <td><?php echo $row3['tabno']; ?></td>
                        <td><?php echo number_format($amount,2); ?></td>
                        <td>
                            <select class="form-control" name="payment" id="payment" style="background-color: #4F4557; color: #B0DAFF;">
                            <?php
                                 if($amount == 0) 
                                 {
                                    echo '<option style="background-color: #333; color: #B0DAFF;">NC</option>';
                                 }else
                                 {

                                 ?>
                                    <option style="background-color: #333; color: #B0DAFF;">Cash</option>
                                    <option style="background-color: #333; color: #B0DAFF;">Online</option>
                                    <option style="background-color: #333; color: #B0DAFF;">Card</option>
                                    <?php
                                 }
                                 ?>
                            </select>
                        </td>
                        <td><button id="edit" class="btn btn-info" onclick="editBill(event)">Edit</button></td>
                        <td><button id="settle" class="btn btn-danger" onclick="settle(event)">Settle</button></td>
                    </tr>
        <?php   }
           }  ?>
    </tbody>
</table>