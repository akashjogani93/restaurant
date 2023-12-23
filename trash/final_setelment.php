<table class="table table-bordered table-striped" id="formsettle" >
    <thead>
        
        <tr>
            <th>Bill No</th>
            <th>Total Amount</th>
            <th>Payment</th>
            <th>Settle</th>
        </tr>

    </thead>
    <tbody id="tbody">
        <?php
            require_once("dbcon.php");
            $order=$_GET['order'];
            if($order==0)
            {
                $sql3 = "SELECT * FROM `tabletot` WHERE `Status`=0 AND `orde`='hotel'";
            }else
            {
                $sql3 = "SELECT * FROM `tabletot` WHERE `Status`=0 AND `orde`='parcel'";
            }
            $result3 = mysqli_query($conn, $sql3);
            if (mysqli_num_rows($result3) > 0)
            {
                while($row3 = mysqli_fetch_assoc($result3)) 
                {
                    $amount=number_format(round($row3['nettot']),2);
                    if ($amount == 0) 
                    {
                        echo '<script>document.getElementById("payment").disabled = true;</script>';
                    }
                    ?>
                    <tr>
                        <td><?php echo $row3['slno']; ?></td>
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
                        <td><button id="settle" class="btn btn-danger" v-on:click="settle($event)">Settle</button></td>
                    </tr>
        <?php   }
           }  ?>
    </tbody>
</table>

<script>
    var app = new Vue({
        el: '#formsettle',
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
            settle: function(e)
            {
                var order='<?php echo $order; ?>'
                var tar = e.currentTarget;
                var chil = tar.parentElement.parentElement.children;
                var x1 = chil[2].querySelector('select').value;
                var x = chil[0].innerHTML;
                $.ajax({
                    type: 'POST',
                    url: 'ajax/billsettle.php',
                    data: { x:x,x1: x1 },
                    success: function(response) 
                    {
                        
                        $('#boxx1').load("final_setelment.php?order="+order);
                        console.log(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) 
                    {
                        
                        console.error(errorThrown);
                        $('#boxx1').load("final_setelment.php?order="+order);
                    }
                });
            }
        }
    });
</script>

<!-- <script>
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
                var tar = e.currentTarget;
                var chil = tar.parentElement.parentElement.children;
                // console.log(chil);
                // var form = $("#finalform1 input");
                var x = chil[1].innerHTML;
                var captain = chil[3].innerHTML;
                // alert(x);
                // exit();
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
                          	
                        },
                        success: function(data)
                        {
                            // alert("pass");
                            // console.log(data);
                            var tab = data[0];
                            var capt = data[1];
                            var bill = data[2];
                            var dis = data[3];
                            var date = data[4];
                          	var time = data[5];
                            // alert(data[3]);
                            // data1=parseFloat(data);
                            // form[6].value = data1;
                            // gst=data1*5/100;
                            // form[7].value = gst;
                            // total=gst + data1;
                            // form[9].value =total;
                           window.location.href = "singlebill.php?tabno=" + tab + "&capnam=" + capt + "&billno=" + bill + "&discount=" + dis + "&date=" + date + "&time=" + time;
                            
                        }
                    });
                    console.log(log);
                    
                }
            },
            shift: function(e) 
            {
                var tar = e.currentTarget;
                var chil = tar.parentElement.parentElement.children;
                var form = $("#finalform input");
                form[0].value = (chil[1].innerHTML);
            },

            inalItem: function(e) 
            {
                var tar = e.currentTarget;
                var chil = tar.parentElement.parentElement.children;
                var x = chil[1].innerHTML;
                console.log(x)
                $('#itemlist').load("current_data.php?x="+x);
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
                            window.location.href = 'table_form.php';
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
        $.ajax({
            url: "ajax/table_form_insert.php",
            method: "POST",
            data: {
                tabno: tables_no,
                x : x,
                merge: "merge"
            },
            success: function(data) {
                //alert(data);
                window.location.href = 'table_form.php';
            }
        });
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
    console.log(log);
}

var ii=0;
document.addEventListener('keydown', function(event) 
{
        var f7 = $("#tabe").val();
        if (event.altKey && event.keyCode === 66)
        {
            var selectElement = document.getElementById("tabe");
            myFunction(selectElement);
        }else if (event.altKey && event.keyCode === 86)
        {
            $('#itemlist').load("current_data.php?x="+f7);
        
        }else if (event.altKey && event.keyCode === 67)
        {
            // debugger;
            console.log('click');
        
            $('#tbody tr').each(function() 
            {
                var td =$(this).find('td:nth-child(2)').text();
                // debugger;
                if(td==f7)
                {
                    if(ii<1)
                    {
                        // debugger;
                        $(this).find('#clc1').click();
                        console.log('pass');
                    }
                    ii++;
                    // debugger;
                }
            
            });
        }else if (event.altKey && event.keyCode === 90)
        {
            window.location.href = 'table_form.php';
        }
    
});


function myFunction(selectElement)
{
  console.log(selectElement);
  selectElement.focus();
}

// $(function() {
//     $("#ta").autocomplete({
//         source: function (request, response){
//             let log= $.ajax({
//             url: "ajax/ta.php",
//             type: "post",
//             dataType: "json",
//             data: {
//                 search: request.term,
//             },
//             success: function (data){
//                 response(data);
//                 // console.log(data);
//             },
//             });
//             // console.log(log)
//         },
//         select: function (event, ui) {
//             $("#ta").val(ui.item.label); // display the selected text
//             return false;
//         },
//         focus: function (event, ui) {
//             $("#ta").val(ui.item.label);
//             return false;
//         },
//         });
// });



</script> -->