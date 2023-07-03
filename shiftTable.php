<h4 class="text-center">Shift Table</h4> 
<table class="table table-bordered table-striped" id="form3" >
    <thead>
        <tr style="background: #ffff; color: #fff; font-weight: 600;">
            <td colspan="2">
                <label style="color:black;" for="">Table From</label>
                <select class="form-control" name="tabe2" id="tabe2" onload="table()">
                   
                </select>
                <!-- <input type="text" class="form-control" name="tabe2" id="tabe2" onchange="tab_no(this.value)"/> -->
            </td>
            <td colspan="1">
                <label style="color:black;" for="">Table To</label>
                <select class="form-control" name="tabe1" id="tabe1" onload="tables()">
                   <option value="none">None</option>
                </select>
            </td>
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
        });console.log(log);
    }

    function shiftTable()
    {
       
        let tabe2=$("#tabe2").val();
        let tabe1=$("#tabe1").val();
        let tabe3='';
        if(tabe1=="none")
        {
            tabe3=$("#latebill").val();
           if(tabe3=='')
           {
                $("#latebill").css('border-color','red');
                exit();
           }else
           {
                $("#latebill").css('border-color','');
           }    
        }else
        {
            $("#latebill").css('border-color','');
        }
        
        if(tabe2 !='' && tabe1 !='')
        {
            let log = $.ajax({
            url: 'ajax/ta.php',
            type: "POST",
            dataType: 'json',
            data: {
                table1 : tabe2,
                table2 : tabe1,
                latebill : tabe3,
            },
            success: function(data)
            {
                // alert(data)
                $('#boxx2').load("shiftTable.php");
                $('#itemlist').load("current_data.php?x="+tabe1);
                $('#boxx').load("final_search.php");
            }
        });
        }
    }
</script>