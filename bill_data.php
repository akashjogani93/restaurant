<?php session_start();
require_once("dbcon.php");
    $cash_type=$_SESSION['tye'];
    $cash_id=$_SESSION['id'];
    $name=$_SESSION['name'];

    $billno = isset($_SESSION['billno']) ? $_SESSION['billno'] : '';
    $billEdit = isset($_SESSION['billEdit']) ? $_SESSION['billEdit'] : '';
    if($billEdit==true)
    {   
        ?>
            <h3 class="text-center">Edit Bill</h3>
            <table class="table table-bordered table-striped" id="form2">
                <thead>
                    <tr>
                        <th style="display: none;"></th>
                        <th>Table No</th>
                        <th style="width:15%">Orders</th>
                        <th style="width:20%">Discount</th>
                        <th style="width:20%">Charge</th>
                        <th style="width:15%">Print</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php
                        $sql3="SELECT DISTINCT `tabno`,`capname` FROM `temtable` WHERE `status`=1 AND `billno`='$billno'";
                        $result3 = mysqli_query($conn, $sql3);
                        if(mysqli_num_rows($result3) > 0)
                        {
                            while($row3 = mysqli_fetch_assoc($result3)) 
                            {
                                ?>
                                <tr>
                                    <td style="display: none; ">
                                        <input type="checkbox" name="tableno1" value="<?php echo $row3['tabno']; ?>">
                                    </td>
                                    <td><?php echo $row3['tabno']; ?></td>
                                    <td>
                                        <button onclick="viewData('<?php echo htmlspecialchars($row3['tabno']); ?>')" id="viewData" class="btn btn-info btn-sm edit1">View</button>
                                    </td>
                                    <td style="display: none;"><?php echo $row3['capname']; ?></td>
                                    <td>
                                        <input type="text" min="0" style="width:60%;" id="dis" class="disPer">
                                    </td>
                                    <td>
                                        <select class="form-control" name="chargeble" id="chargeble" style="background-color: #4F4557; color: #B0DAFF; width:100%;">
                                            <option style="background-color: #333; color: #B0DAFF;" value="0">Charge</option>
                                            <option style="background-color: #333; color: #B0DAFF;" value="1">Non</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button onclick="printData('<?php echo htmlspecialchars($row3['tabno']); ?>', event)" id="printData" class="btn btn-danger btn-sm edit1 printData">Print</button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        <?php
    }else
    {
        ?>
            <h3 class="text-center">Running Table</h3>
            <table class="table table-bordered table-striped" id="form2" >
                <thead>
                    <tr style="background: #ffff; color: #fff; font-weight: 600;">
                        <td colspan="5">
                            <button onclick="mergeTable()" id="select" class="btn btn-success">Merge Table</button>
                            <button style="display: none;" onclick="merge()"  class="btn btn-success" id="merge">Merge</button>
                        </td>
                        <td class="blacnk" style="display: none;"></td>
                    </tr>
                    <tr>
                        <th class="tbl" style="display: none; width:20%">Select</th>
                        <th>Table No</th>
                        <th style="width:15%">Orders</th>
                        <th style="width:20%">Discount</th>
                        <th style="width:20%">Charge</th>
                        <th style="width:15%">Print</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                <?php
                    if($cash_type=='Captain')
                    {
                        $sql3 = "SELECT DISTINCT `tabno`,`capname` FROM `temtable` WHERE `capname`='$name' AND `status`=0 ORDER BY `tabno`;";
                    }else
                    {
                        $sql3="SELECT DISTINCT `tabno`,`capname` FROM `temtable` WHERE `status`=0 ORDER BY `tabno`";
                    }   
                    $result3 = mysqli_query($conn, $sql3);
                    if(mysqli_num_rows($result3) > 0)
                    {
                        while($row3 = mysqli_fetch_assoc($result3)) 
                        {
                            ?>
                                <tr>
                                    <td class="tbl" style="display: none; ">
                                        <input type="checkbox" name="tableno1" value="<?php echo $row3['tabno']; ?>">
                                    </td>
                                    <td><?php echo $row3['tabno']; ?></td>
                                    <td>
                                        <button onclick="viewData('<?php echo htmlspecialchars($row3['tabno']); ?>')" id="viewData" class="btn btn-info btn-sm edit1">View</button>
                                    </td>
                                    <td style="display: none;"><?php echo $row3['capname']; ?></td>
                                    <td>
                                        <input type="text" min="0" style="width:60%;" id="dis" class="disPer">
                                    </td>
                                    <td>
                                        <select class="form-control" name="chargeble" id="chargeble" style="background-color: #4F4557; color: #B0DAFF; width:100%;">
                                            <option style="background-color: #333; color: #B0DAFF;" value="0">Charge</option>
                                            <option style="background-color: #333; color: #B0DAFF;" value="1">Non</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button onclick="printData('<?php echo htmlspecialchars($row3['tabno']); ?>', event)" id="printData" class="btn btn-danger btn-sm edit1 printData">Print</button>
                                    </td>
                                </tr>
                <?php  }
                    }  ?>
                </tbody>
            </table>
        <?php
    }
?>
<script>
$(".disPer").keyup(function()
{
    var input = $(this).val();
    var regex = /^(\d+(\.\d*)?|\.\d+)%?$/;

    if (regex.test(input) && input.includes('%')) 
    {
        var valueWithoutPercent = input.replace('%', '');
        if(valueWithoutPercent>100)
        {
            $(this).val('100%');
        }
    }
    if (!regex.test(input))
    {
        var sanitizedInput = input.replace(/[^0-9.%]/g, '');
        sanitizedInput = sanitizedInput.replace(/\.{2,}/g, '.');
        sanitizedInput = sanitizedInput.replace(/\.$/, '');
        sanitizedInput = sanitizedInput.replace(/\.(?=%)/g, '');
        $(this).val(sanitizedInput);
    } 
});
</script>