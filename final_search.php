<?php session_start();
$cash_type=$_SESSION['tye'];
$cash_id=$_SESSION['id'];
$name=$_SESSION['name'];
?>
<h3 class="text-center">Running Table</h3>
<table class="table table-bordered table-striped" id="form2" >
    <thead>
        <tr style="background: #ffff; color: #fff; font-weight: 600; display:none;">
            <td colspan="5">
                <label style="color:black; " for="">Select Table (Alt + B)</label>
                <select class="form-control" name="tabe" id="tabe" onload="items()">
                   
                </select>
            </td>
            <td class="blacnk" style="display: none;"></td>
        </tr>
        <tr style="background: #ffff; color: #fff; font-weight: 600;">
            <td colspan="5">
                <button onclick="select()" id="select" class="btn btn-success">Merge Table</button>
                <button style="display: none;" onclick="merge()"  class="btn btn-success" id="merge">Merge</button>
            </td>
            <td class="blacnk" style="display: none;"></td>
        </tr>
        <tr>
            <th class="tbl" style="display: none; width:20%">Select</th>
            <?php
                     $sec="Ground";
                       if($sec=='Ground')
                           echo "<th>Table No</th>";
                       else if($sec=='First')
                           echo "<th>Table No</th>";
                       else if($sec=='Lodge')
                            echo "<th>Room No</th>";
                       else
                            echo "<th>Parcel No</th>";
             ?>
            <th style="width:15%">Orders</th>
            <th style="width:20%">Discount</th>
            <th style="width:30%">Chargeable</th>
            <th style="width:15%">Print(Alt+c)</th>
        </tr>

    </thead>
    <tbody id="tbody">
        <?php
            require_once("dbcon.php");
            if($cash_type=='Captain')
            {
                $sql3 = "SELECT DISTINCT `tabno`,`capname` FROM `temtable` WHERE `capname`='$name' ORDER BY `tabno`;";
            }else
            {
                $sql3="SELECT DISTINCT tabno,capname FROM temtable ORDER BY tabno";
            }
            $result3 = mysqli_query($conn, $sql3);
            if (mysqli_num_rows($result3) > 0)
            {
                while($row3 = mysqli_fetch_assoc($result3)) 
                {
                    ?>
                    <tr>
                        <td class="tbl" style="display: none; "><input type="checkbox"   name="tableno1" value="<?php echo $row3['tabno']; ?>"></td>
                        <td><?php echo $row3['tabno']; ?></td>
                        <td><button v-on:click="inalItem($event)" class="btn btn-primary btn-sm edit1" data-toggle="modal" data-target="#orderview" id="clc">Order</button></td>
                        <td style="display: none;"><?php echo $row3['capname']; ?></td>
                        <td><input type="number" min="0" style="width:60%;" id="dis"></td>
                        <td>
                            <select class="form-control" name="chargeble" id="chargeble" style="background-color: #4F4557; color: #B0DAFF; width:100%;">
                                <option style="background-color: #333; color: #B0DAFF;" value="0">Chargeable</option>
                                <option style="background-color: #333; color: #B0DAFF;" value="1">Non</option>
                            </select>
                        </td>
                        <td><button v-on:click="finalItem($event)" class="btn btn-danger btn-sm edit1" id="clc1">Print (Alt+c)</button></td>
                    </tr>
        <?php  }
           }  ?>
    </tbody>
</table>

<script>
    items();
    var app = new Vue({
        el: '#form2',
        data: {
            slno: 0,
            rows: {},
            itmnam: '',
            qty: 1,
            prc: '',
            shnam: '',
            attemptSubmit: false
        },
        computed: {
            missingItmnam: function() {
                return this.itmnam === '';
            },
            missingQty: function() {
                return this.qty === '';
            },
            missingPrc: function() {
                return this.prc === '';
            },
            missingShnam: function() {
                return this.shnam === '';
            },
        },
        methods: {

            //click by filnal print module to open cash module then
            finalItem: function(e)
            {
                $('#clc1').prop('disabled',false);
                var tar = e.currentTarget;
                var chil = tar.parentElement.parentElement.children;
                var x = chil[1].innerHTML;
                var x1 = chil[4].querySelector('input').value;
                var x2 = chil[5].querySelector('select').value;
                var captain = chil[3].innerHTML;
                if(captain=='')
                {
                    exit();
                    $('#clc1').prop('disabled',true);
                }
                var i=0;
                if (x != '' && i<1)
                {
                   
                    let log=$.ajax({
                        url: "ajax/table_form_save.php",
                        method: "POST",
                        dataType: 'json',
                        data:
                        {
                            tabno: x,
                            captain:captain,
                            dis:x1,
                            charge:x2,
                          	
                        },
                        success: function(data)
                        {
                            $('#clc1').prop('disabled',true);
                            var tab = data[0];
                            if(tab==0)
                            {
                                alert("Something Went Wrong..");
                                var bill = data[2];
                                var dis = data[3];
                                var date = data[4];
                                var cnt = data[5];
                            }else
                            {
                                var capt = data[1];
                                var bill = data[2];
                                var dis = data[3];
                                var date = data[4];
                                var time = data[5];
                                var dis1 = data[6];
                                window.location.href = "singlebill.php?tabno=" + tab + "&capnam=" + capt + "&billno=" + bill + "&discount=" + dis + "&date=" + date + "&time=" + time + "&amt=" +dis1;
                            }
                            
                            
                        }
                    });
                    // console.log(log);
                    
                }
            },
            shift: function(e) 
            {
                alert('hii');
                // var tar = e.currentTarget;
                // var chil = tar.parentElement.parentElement.children;
                // var form = $("#finalform input");
                // form[0].value = (chil[1].innerHTML);
            },

            inalItem: function(e) 
            {
                var tar = e.currentTarget;
                var chil = tar.parentElement.parentElement.children;
                var x = chil[1].innerHTML;
                $('#itemlist').load("current_data.php?x="+x);
                $('#myInput').attr('autofocus', true);
            },

            cancel: function(e) {
                var tar = e.currentTarget;
                var chil = tar.parentElement.parentElement.children;
                var x = chil[1].innerHTML;
                if (x != '') 
                {
                    $.ajax({
                        url: "table_form_insert.php",
                        method: "POST",
                        data: {
                            tabno: x,
                            cancel: "cancel"
                        },
                        success: function(data) {
                            window.location.href = 'table_form.php?statuscancel='+x;
                        }
                    });
                } else {
                    $('#list').html("");
                }
            }
        }   
    });

function select() {
    $('.tbl').css("display", "block");
    $('.blacnk').css("display", "block");
    $('#merge').css("display", "block");
    $('#select').css("display", "none")
}

function merge()
{
    var tables_no = [];
    $.each($("input[name='tableno1']:checked"), function() {
        tables_no.push($(this).val());
    });
    
    let x = tables_no.join("-");
    k = x.split("-");

    let y = k.filter(function(elem,index,self)
    {
        return index === self.indexOf(elem);
    });
    x = y.join("-");
    if (tables_no.length >= 2) 
    {
        let log=$.ajax({
            url: "ajax/table_form_insert.php",
            method: "POST",
            data: {
                tabno: tables_no,
                x : x,
                merge: "merge"
            },
            success: function(data) {
                // alert(data);
                window.location.href = 'table_form.php?statuscancel='+x;
            }
        });
        // console.log(log);
    }else
    {
        alert('select 2 or More Table');
    }
}


function items()
{
    let log = $.ajax({
        url: 'ajax/ta.php',
        type: "POST",
        dataType: 'json',
        data: {
            catsus : 'catsus',
        },
        success: function(data)
        {
            for (var i = 0; i < data.length; i++) 
            {
                var opt = document.createElement("option");
                opt.text = data[i];
                opt.value =data[i];
                var x = document.getElementById("tabe");
                x.add(opt);
            }
        }
    });
    // console.log(log);
}

// var ii=0;
// document.addEventListener('keydown', function(event) 
// {
//         var f7 = $("#tabe").val();
//         if (event.altKey && event.keyCode === 66)
//         {
//             var selectElement = document.getElementById("tabe");
//             myFunction(selectElement);
//         }else if (event.altKey && event.keyCode === 86)
//         {
//             $('#itemlist').load("current_data.php?x="+f7);
        
//         }else if (event.altKey && event.keyCode === 67)
//         {
//             // debugger;
//             // console.log('click');
        
//             $('#tbody tr').each(function() 
//             {
//                 var td =$(this).find('td:nth-child(2)').text();
//                 // debugger;
//                 if(td==f7)
//                 {
//                     if(ii<1)
//                     {
//                         // debugger;
//                         $(this).find('#clc1').click();
//                         // console.log('pass');
//                     }
//                     ii++;
//                     // debugger;
//                 }
            
//             });
//         }else if (event.altKey && event.keyCode === 90)
//         {
//             window.location.href = 'table_form.php';
//         }
    
// });


function myFunction(selectElement)
{
  console.log(selectElement);
  selectElement.focus();
}
</script>