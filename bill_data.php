<?php session_start();
    $cash_type=$_SESSION['tye'];
    $cash_id=$_SESSION['id'];
    $name=$_SESSION['name'];
?>
<h3 class="text-center">Running Table</h3>
<input type="hidden" id="DirectPrint">
<table class="table table-bordered table-striped" id="form2" >
    <thead>
        <!-- <tr style="background: #ffff; color: #fff; font-weight: 600; display:none;">
            <td colspan="5">
                <label style="color:black; " for="">Select Table (Alt + B)</label>
                <select class="form-control" name="tabe" id="tabe" onload="items()">
                </select>
            </td>
            <td class="blacnk" style="display: none;"></td>
        </tr> -->
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
            require_once("dbcon.php");
            if($cash_type=='Captain')
            {
                $sql3 = "SELECT DISTINCT `tabno`,`capname` FROM `temtable` WHERE `capname`='$name' AND `status`=0 ORDER BY `tabno`;";
            }else
            {
                $sql3="SELECT DISTINCT `tabno`,`capname` FROM `temtable` WHERE `status`=0 ORDER BY `tabno`";
            }
            $result3 = mysqli_query($conn, $sql3);
            if (mysqli_num_rows($result3) > 0)
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
                            <!-- <button v-on:click="inalItem($event)" class="btn btn-primary btn-sm edit1" data-toggle="modal" data-target="#orderview" id="clc">Order</button> -->
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
                            <!-- <button onclick="printData(this.value, event)" value="<?php echo $row3['tabno']; ?>" class="btn btn-danger btn-sm edit1" id="printData">Print</button> -->
                            <button onclick="printData('<?php echo htmlspecialchars($row3['tabno']); ?>', event)" id="printData" class="btn btn-danger btn-sm edit1 printData">Print</button>
                        </td>
                    </tr>
        <?php  }
           }  ?>
    </tbody>
</table>

<script>
    // items();
    // var app = new Vue({
    //     el: '#form2',
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
    //         finalItem: function(e)
    //         {
    //             $('#clc1').prop('disabled',false);
    //             var tar = e.currentTarget;
    //             var chil = tar.parentElement.parentElement.children;
    //             var x = chil[1].innerHTML;
    //             var x1 = chil[4].querySelector('input').value;
    //             if(x1=='%')
    //             {
    //                 x1=0;
    //             }
    //             var x2 = chil[5].querySelector('select').value;
    //             var captain = chil[3].innerHTML;
    //             if(captain=='')
    //             {
    //                 exit();
    //                 $('#clc1').prop('disabled',true);
    //             }
    //             var i=0;
    //             if (x != '' && i<1)
    //             {
    //                 let log=$.ajax({
    //                     url: "ajax/table_form_save.php",
    //                     method: "POST",
    //                     dataType: 'json',
    //                     data:
    //                     {
    //                         tabno: x,
    //                         captain:captain,
    //                         dis:x1,
    //                         charge:x2,
                          	
    //                     },
    //                     success: function(data)
    //                     {
    //                         $('#clc1').prop('disabled',true);
    //                         var directPrint=$('#DirectPrint').val()
    //                         var tab = data[0];
    //                         if(tab==0)
    //                         {
    //                             alert("Something Went Wrong..");
    //                             var bill = data[2];
    //                             var dis = data[3];
    //                             var date = data[4];
    //                             var cnt = data[5];
    //                         }else
    //                         {
    //                             var capt = data[1];
    //                             var bill = data[2];
    //                             var dis = data[3];
    //                             var date = data[4];
    //                             var time = data[5];
    //                             var dis1 = data[6];
    //                             if(directPrint!=1)
    //                             {
    //                                 window.location.href = "singlebill.php?tabno=" + tab + "&capnam=" + capt + "&billno=" + bill + "&discount=" + dis + "&date=" + date + "&time=" + time + "&amt=" +dis1;
    //                             }else
    //                             {
    //                                 window.location='table_form.php';
    //                             }
    //                         }
    //                     }
    //                 });
    //             }
    //         },
    //         shift: function(e) 
    //         {
    //             // alert('hii');
    //             // var tar = e.currentTarget;
    //             // var chil = tar.parentElement.parentElement.children;
    //             // var form = $("#finalform input");
    //             // form[0].value = (chil[1].innerHTML);
    //         },

    //         inalItem: function(e) 
    //         {
    //             var tar = e.currentTarget;
    //             var chil = tar.parentElement.parentElement.children;
    //             var x = chil[1].innerHTML;
    //             $('#itemlist').load("order_data.php?tabno="+x);
    //         },

    //         cancel: function(e) 
    //         {
    //             var tar = e.currentTarget;
    //             var chil = tar.parentElement.parentElement.children;
    //             var x = chil[1].innerHTML;
    //             if (x != '') 
    //             {
    //                 $.ajax({
    //                     url: "table_form_insert.php",
    //                     method: "POST",
    //                     data: {
    //                         tabno: x,
    //                         cancel: "cancel"
    //                     },
    //                     success: function(data) {
    //                         window.location.href = 'table_form.php?statuscancel='+x;
    //                     }
    //                 });
    //             } else {
    //                 $('#list').html("");
    //             }
    //         }
    //     }   
    // });

//lost    
// function items()
// {
//     let log = $.ajax({
//         url: 'ajax/ta.php',
//         type: "POST",
//         dataType: 'json',
//         data: {
//             catsus : 'catsus',
//         },
//         success: function(data)
//         {
//             for (var i = 0; i < data.length; i++) 
//             {
//                 var opt = document.createElement("option");
//                 opt.text = data[i];
//                 opt.value =data[i];
//                 var x = document.getElementById("tabe");
//                 x.add(opt);
//             }
//         }
//     });
// }

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

//lost
// function myFunction(selectElement)
// {
//   console.log(selectElement);
//   selectElement.focus();
// }
</script>