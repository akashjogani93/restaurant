<!-- <h4 class="text-center">Shift Table</h4> -->
<div class="row">
    <div class="col-md-offset-9 col-md-2">
        <button class="btn btn-info" style="margin:5px 0; float:right" onclick="showTable()" id="showTable">Shift Table</button>
        <button class="btn btn-info" style="margin:5px 0; display:none; float:right" id="hideTable" onclick="hideTable()">Hide</button>
    </div>
</div>
<table class="table table-bordered table-striped" id="form3" style="display:none;">
    <thead>
        <tr style="background: #ffff; color: #fff; font-weight: 600;">
            <td>
                <label style="color:black;" for="">From</label>
                <select class="form-control" name="tabe2" id="tabe2" onload="table()">
                </select>
            </td>
            <!-- <td>
                <label style="color:black;" for="">To</label>
                <select class="form-control" name="tabe1" id="tabe1" onload="tables()">
                   <option value="none">None</option>
                </select>
            </td> -->
            <td>
                <label style="color:black;" for="">Table To</label>
                <input class="form-control" type="text" id="latebill" name="latebill">
            </td>
            <td><button class="btn btn-info" style="margin-top:25px;" onclick="shiftTable()">Shift</button></td>
        </tr>
    </thead>
</table>
<div id="table-shifted" style="color:green; Display:none;"><center><h5>Table Shifted</h5></center></div>
<script>
    tables()
    table()
    function tables()
    {
        let log = $.ajax({
            url: 'ajax/ta.php',
            type: "POST",
            dataType: 'json',
            data: {
                catsus2 : 'catsus2',
            },
            success: function(data)
            {

                for (var i = 0; i < data.length; i++) 
                {
                    var opt = document.createElement("option");
                    opt.text = data[i];
                    opt.value =data[i];
                    var x = document.getElementById("tabe1");
                    x.add(opt);
                }
            }
        });
    
    }

    function table()
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
                    var x1 = document.getElementById("tabe2");
                    x1.add(opt);
                }
            }
        });
        // console.log(log);
    }

    $('#latebill').on('input',function()
    {
        var tab=$(this).val();
        var tabUpperCase = tab.toUpperCase();
        $(this).val(tabUpperCase);
    });

    function shiftTable()
    {
        let tabe2=$("#tabe2").val();
        // let tabe1=$("#tabe1").val();
        let latebill=$("#latebill").val()

        let log = $.ajax({
            url: 'ajax/ta.php',
            type: "POST",
            dataType: 'json',
            data: {
                table1 : tabe2,
                latebill : latebill,
            },
            success: function(data)
            {
                if(data=='Match found')
                {
                    $("#latebill").css('border-color','red');
                }else
                {
                    $('#boxx2').load("tableShift.php");
                    $('#itemlist').load("order_data.php?tabno="+latebill);
                    $('#boxx').load("bill_data.php");
                }
                
            }
        });
        // let tabe3='';
        // let tocheck=false;
        // if(tabe1=="none")
        // {
            // tabe3=$("#latebill").val();
            // if(tabe3=='')
            // {
            //         $("#latebill").css('border-color','red');
            //         return;
            // }else
            // {
            //         let sam=$.ajax({
            //             url: 'ajax/ta.php',
            //             type: "POST",
            //             dataType: 'json',
            //             data: {
            //                 tabe3 : tabe3,
            //             },
            //             success: function(data)
            //             {
                            // if(data=='Match found')
                            // {
                            //     $("#latebill").css('border-color','red');
                            // }else
                            // {
                            //     $("#latebill").css('border-color','');
                            //     tocheck=true;
                            //     to_check(tocheck)
                            // }
            //             }
            //         });
            //         // console.log(sam);
            // }    
        // }else
        // {
            // $("#latebill").css('border-color','');
            // tocheck=true;
            // to_check(tocheck)
        // }
        
        // function to_check()
        // {
        //     if(tabe2 !='' && tabe1 !='' && tocheck==true)
        //     {
                // let log = $.ajax({
                //     url: 'ajax/ta.php',
                //     type: "POST",
                //     dataType: 'json',
                //     data: {
                //         table1 : tabe2,
                //         table2 : tabe1,
                //         latebill : tabe3,
                //     },
                //     success: function(data)
                //     {
                //         $('#boxx2').load("tableShift.php");
                //         $('#itemlist').load("order_data.php?tabno="+tabe1);
                //         $('#boxx').load("bill_data.php");
                //     }
                // });
        //         // console.log(log);
        //     }
        // }
    }

    function showTable()
    {
        $('#form3').show();
        $('#hideTable').show();
        $('#showTable').hide();
    }

    function hideTable()
    {
        $('#form3').hide();
        $('#hideTable').hide();
        $('#showTable').show();
    }
</script>