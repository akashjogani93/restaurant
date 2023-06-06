<h3 class="text-center">Running Table</h3>

<table class="table table-bordered table-striped" id="form2">
    <thead>
        <tr style="background: #ffff; color: #fff; font-weight: 600;">
            <td colspan="4" style="display:none">
                <label style="color:black;" for="">Select Parcel (Alt + b)</label>
                <select class="form-control" name="tabe" id="tabe">
                </select>
            </td>
            <td class="blacnk" style="display: none;"></td>
        </tr>
        <tr style="background: #ffff; color: #fff; font-weight: 600;">
            <td colspan="4">
                <button onclick="select()" id="select" class="btn btn-success" style="display:none">Merge Table</button>
                <button style="display: none;" onclick="merge()"  class="btn btn-success" id="merge">Merge</button>
            </td>
            <td class="blacnk" style="display: none;"></td>
        </tr>
        <tr>
            <th class="tbl" style="display: none;">Select</th>
            <?php
                     $sec="Ground";
                       if($sec=='Ground')
                           echo "<th>Parcel No</th>";
                       else if($sec=='First')
                           echo "<th>Parcel No</th>";
                       else if($sec=='Lodge')
                            echo "<th>Room No</th>";
                       else
                            echo "<th>Parcel No</th>";
             ?>
            <th>Orders</th>
            <th>Discount</th>
            <th>Print(Alt+c)</th>
            <!-- <th>Action</th> -->
        </tr>

    </thead>
    <tbody id="tbody">
        <?php
            require_once("dbcon.php");
            $sql3 = "SELECT DISTINCT tabno FROM parcel ORDER BY tabno;";
            $result3 = mysqli_query($conn, $sql3);
            if (mysqli_num_rows($result3) > 0) {
                // output data of each row
                while($row3 = mysqli_fetch_assoc($result3)) 
                {
                    ?>
                    <tr>
                        <td class="tbl" style="display: none;"><input type="checkbox" name="tableno1" value="<?php echo $row3['tabno']; ?>"></td>
                        <td><?php echo $row3['tabno']; ?></td>
                        <td><button v-on:click="inalItem($event)" class="btn btn-primary btn-sm edit1" data-toggle="modal" data-target="#orderview" id="clc">Order(Alt+V)</button></td>
                        <td><input type="number" min="0" style="width:60%;" id="dis"></td>
                        <td> <button v-on:click="finalItem($event)" class="btn btn-danger btn-sm edit1" id="clc1">Print(Alt+c)</button></td>
                    </tr>
        <?php  }
           }  ?>
    </tbody>
</table>

<script>
    
$(document).ready(function()
{
    items();
});
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
                var x = chil[1].innerHTML;
                var x1 = chil[3].querySelector('input').value;

                // alert(x1);
                // exit();
                if (x != '')
                {
                    let log =$.ajax({
                        url: "ajax/parcel_form_save.php",
                        method: "POST",
                        dataType: 'json',
                        data: {
                            tabno: x,
                            tot: "tot",
                            dis:x1,
                        },
                        success: function(data)
                        {
                            var tab = data[0];
                            if(tab==0)
                            {
                                alert("Something Went Wrong..");
                                
                            }else
                            {
                                var capt = data[1];
                                var bill = data[2];
                                var dis = data[3];
                                var date = data[4];
                                var time = data[5];
                                var dis1 = data[6];
                                window.location.href = "parcel_print.php?tabno=" + tab + "&capnam=" + capt + "&billno=" + bill + "&discount=" + dis + "&date=" + date + "&time=" + time+ "&amt=" +dis1;
                            }
                        }
                    });
                    console.log(log)
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
                $('#itemlist').load("parcel_data.php?x="+x);
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
    let y = k.filter(function(elem,index,self){
        return index === self.indexOf(elem);
    });
    x = y.join("-");
    if (tables_no.length >= 2) {
        $.ajax({
            url: "ajax/parcel_form_insert.php",
            method: "POST",
            data: {
                tabno: tables_no,
                x : x,
                merge: "merge"
            },
            success: function(data) {
                //alert(data);
                window.location.href = 'parcel.php';
            }
        });
    } else {
        alert('select 2 or More Table');
    }
}

function myFunction(selectElement)
{
  console.log(selectElement);
  selectElement.focus();
} 

// var ii=0;
// document.addEventListener('keydown', function(event) 
// {
//     // console.log(event.key);
//     var f7 = $("#tabe").val();
//     if (event.altKey && event.keyCode === 66)
//     {
//         var selectElement = document.getElementById("tabe");
//         myFunction(selectElement);
//     }else  if (event.altKey && event.keyCode === 86)
//     {
       
//         $('#itemlist').load("parcel_data.php?x="+f7);
     
//     }else if (event.altKey && event.keyCode === 67)
//     {
        
//         $('#tbody tr').each(function() 
//         {
            
//             var td =$(this).find('td:nth-child(2)').text();
            
//             if(td==f7)
//             {
//                 if(ii<1)
//                 {
//                     $(this).find('#clc1').click();
//                 }
//                 ii++;
//             }
            

//         });
//     }else if (event.altKey && event.keyCode === 90)
//     {
//         window.location.href = 'parcel.php';
//     }  
// });


function items()
{
    let log = $.ajax({
        url: 'ajax/ta.php',
        type: "POST",
        dataType: 'json',
        data: {
            catsus1 : 'catsus1',
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
    console.log(log)
}
</script>