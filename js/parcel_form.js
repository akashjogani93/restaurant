$(document).ready(function()
{
    const urlParams = new URLSearchParams(window.location.search);
    const statuscancel = urlParams.get('statuscancel');
    if(statuscancel===null)
    {
        $('#itemlist').load("parcel_data.php?x=PARCEL_1");
    }else
    {
        $('#itemlist').load("parcel_data.php?x="+statuscancel);
    }
    $('.poi').css( 'cursor', 'pointer' );
    $('#boxx').load("parcel_search.php");
    $('#boxx1').load("final_setelment.php?order=1");
    document.getElementById("table_no").focus();
    $('#example1').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
});


$("input").bind('keydown', function(e)
{
    console.log(e.key)
    if (e.key === "Enter") 
    {
        var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }else if(e.key === "Shift")
    {
      	var currentInput = document.activeElement.id;
      	console.log(currentInput);
        if(currentInput=='qty')
        {
            autocomplete.focus();
        }else if(currentInput=='autocomplete')
        {
            itmno.focus();
        }
        else if(currentInput=='itmno')
        {
            table_no.focus();
        }
    }
});

function diver()
{
    // alert("12");
    var wingname = document.getElementById('itmno').value;
    let log= $.ajax({
        url: 'ajax/item_ajax1.php',
        type: "POST",
        dataType: 'json',
        data: {
            wingname: wingname,
            priceform: 1
        },
        success: function(data) {
            console.log(data);
            // alert(data[1])
            $("#itmno").val(data[0]);
            // $("#itmnam").val(data[1]);
            $("#qty").val(1);
            $("#autocomplete").val(data[1]);
            $("#prc").val(data[2]);
            total();
        }
    });
}

function store()
{
    // alert('hii');
    var wingname = document.getElementById('autocomplete').value;
    // // let priceform=$("#priceform").val();
    // let table_no=$("#table_no").val();

    $.ajax({
        url: 'ajax/item_nam_ajax1.php',
        type: "POST",
        dataType: 'json',
        data: {
            wingname: wingname,
            table_no: 1
        },
        success: function(data)
         {
            // console.log(data);
            console.log(data);
            // alert(data[1])
            // $("#itmno").val(data[0]);
            // // $("#itmnam").val(data[1]);
            // $("#qty").val(1);
            // $("#autocomplete").val(data[1]);
            // $("#prc").val(data[2]);

            $("#itmno").val(data[0]);
            $("#itmnam").val(data[1]);
            // $("#qty").val(1);
            $("#prc").val(data[2]);
            total();
            
        }
    });
    // tab_no();
}

$("#qty").keyup(total);
function total()
{
    var qt = parseFloat($("#qty").val());
    var prc = parseFloat($("#prc").val());
    var x = (qt * prc).toFixed(2);
    $("#tot").val(x);
}



function insert() 
{
    var itdate = $('#datepicker').val();
    let captain = $('#captain12').val();
    
    var table_no = $('#table_no').val();
    // console.log(table_no);
    var itmno = $("#itmno").val();
    var itname = $("#autocomplete").val();
    var qty = $("#qty").val();
//    console.log(qty);
    var prc = $("#prc").val();
    var total = $("#tot").val();
    var z=document.getElementById("table_no").value;
    if(qty=="")
    {
        qty=1;
        total=prc*qty;
    }
    if (itdate != "" && table_no != ""  && total != "" && itmno != "" &&  qty!= "" && itname != "" && captain != 'Select') 
    {
        // alert('hii');
        $.ajax({
            type: "post",
            url: "ajax/parcel_form_insert.php",
        
        data: {
                captain: captain,
                date: itdate,
                itmno: itmno,
                itmnam: itname,
                prc: prc,
                qty: qty,
                tot: total,
                tabno: z
            },
            cache: false,
            success: function(status) 
            {
                // alert(status);
                $("#itmno").val("");
                $("#autocomplete").val("");
                $("#qty").val("");
                $("#prc").val("");
                $("#tot").val("");
                $('#itemlist').load("parcel_data.php?x="+z);
                $('#boxx').load("parcel_search.php");
                // $('#final').load("parcel_fetch.php");
                // document.getElementById('autocomplete').value='';
            }
            
        });
    } else {
        alert("Missing Field...");
    }
    document.getElementById("itmno").focus();
}

function tab_no(wing)
{
    $('#itemlist').load("parcel_data.php?x="+wing);
}

document.addEventListener('keydown', function(event) 
{
    var table_no = $("#table_no").val();
    if (event.altKey && event.keyCode === 88) 
    {
        document.getElementById("koot").click();
    }else if (event.altKey && event.keyCode === 67)
    {
        $('#tbody tr').each(function()
        {
            var td =$(this).find('td:nth-child(2)').text();
            if(td==table_no)
            {
                $(this).find('#clc1').click();
            }
        });
    }
    else if(event.altKey && event.keyCode === 90)
    {
        window.location='parcel.php';
    }
});