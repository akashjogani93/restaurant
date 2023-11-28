<table class="table table-bordered table-striped" id="formsettle" >
    <thead>
        
        <tr>
            <th>Bill No</th>
            <th>Table</th>
            <th>Edit</th>
            <th>Total Amount</th>
            <th>Payment</th>
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
                $sql3 = "SELECT * FROM `tabletot` WHERE `Status`=0 AND `orde`='parcel'";
            }
            $result3 = mysqli_query($conn, $sql3);
            if (mysqli_num_rows($result3) > 0)
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
                        <td>Edit</td>
                        <td><?php echo $amount; ?></td>
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
                        <td><button id="settle" class="btn btn-danger" onclick="settle(event)">Settle</button></td>
                    </tr>
        <?php   }
           }  ?>
    </tbody>
</table>

<script>
    // var app = new Vue({
    //     el: '#formsettle',
    //     data: {
    //         slno: 0,
    //         rows: {},
    //         itmnam: '',
    //         qty: 1,
    //         prc: '',
    //         shnam: '',
    //         attemptSubmit: false
    //     },
    //     computed: {
    //         missingItmnam: function() {
    //             return this.itmnam === '';
    //         },
    //         missingQty: function() {
    //             return this.qty === '';
    //         },
    //         missingPrc: function() {
    //             return this.prc === '';
    //         },
    //         missingShnam: function() {
    //             return this.shnam === '';
    //         },
    //     },
    //     methods: {
    //         settle: function(e)
    //         {
    //             var order='<?php echo $order; ?>'
    //             var tar = e.currentTarget;
    //             var chil = tar.parentElement.parentElement.children;
    //             var x1 = chil[2].querySelector('select').value;
    //             var x = chil[0].innerHTML;
    //             $.ajax({
    //                 type: 'POST',
    //                 url: 'ajax/billsettle.php',
    //                 data: { x:x,x1: x1 },
    //                 success: function(response) 
    //                 {
                        
    //                     $('#boxx1').load("final_setelment.php?order="+order);
    //                     console.log(response);
    //                 },
    //                 error: function(jqXHR, textStatus, errorThrown) 
    //                 {
                        
    //                     console.error(errorThrown);
    //                     $('#boxx1').load("final_setelment.php?order="+order);
    //                 }
    //             });
    //         }
    //     }
    // });
</script>