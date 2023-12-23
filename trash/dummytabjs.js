$(document).ready(function()
{
        const urlParams = new URLSearchParams(window.location.search);
        const statuscancel = urlParams.get('statuscancel');
        $('#itemlist').load("current_data.php?x="+statuscancel);
        $('.poi').css( 'cursor', 'pointer' );
        $('#boxx').load("final_search.php");
        let sess=$('#sess').val();
        if(sess!='Captain')
        {
            $('#boxx1').load("final_setelment.php?order=0");
        }
        $('#boxx2').load("shiftTable.php");
        document.getElementById("table_no").focus();
        $('#example1').DataTable
        ({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
});

$('#priceform').keyup(function () { 
    this.value = this.value.replace(/[^1-2\.]/g,'');
});


function diver()
{
    var wingname = document.getElementById('itmno').value;
    let priceform=$("#priceform").val();
    let table_no=$("#table_no").val();
    
    let log= $.ajax({
        url: 'ajax/item_ajax.php',
        type: "POST",
        dataType: 'json',
        data: {
            wingname: wingname,
            priceform: priceform,
            table_no: table_no,
        },
        success: function(data) {
            $("#itmno").val(data[0]);
            $("#qty").val(1);
            $("#autocomplete").val(data[1]);
            $("#prc").val(data[2]);
            total();
        }
    });
    tab_no();
}

function diver1()
{
    var wingname = document.getElementById('itmno').value;
    let table_no=$("#table_no").val();
    let log= $.ajax({
        url: 'ajax/item_ajax.php',
        type: "POST",
        dataType: 'json',
        data: {
            wingname: wingname,
            table_no: table_no,
        },
        success: function(data) 
        {
            if(data[0]=='Wrong Code')
            {
                $("#itmno").css("border", "1px solid orange");
            }else
            {
                $("#itmno").css("border", "1px solid green");
            }
            $("#autocomplete").val(data[1]);
            $("#prc").val(data[2]);
            total();
        }
    });
    // console.log(log);
}

//item search to onchange
function store()
{
    var wingname = document.getElementById('autocomplete').value;
    let table_no=$("#table_no").val();

    $.ajax({
        url: 'ajax/item_nam_ajax.php',
        type: "POST",
        dataType: 'json',
        data: {
            wingname: wingname,
            table_no: table_no,
        },
        success: function(data) 
        {
            $("#itmno").val(data[0]);
            $("#itmnam").val(data[1]);
            $("#prc").val(data[2]);
            total();
            
        }
    });
    // tab_no();
}


$("#qty").keyup(total);
function total()
{
    var qt = parseInt($("#qty").val());
    if (!isNaN(qt) && Number.isInteger(qt) && qt !== 0 && $("#qty").val() === qt.toString())
    {
        var prc = $("#prc").val();
        if(prc !== '') 
        {
            var x = (qt * parseFloat(prc)).toFixed(2);
            $("#tot").val(x);   
        }else
        {
            $("#tot").val('');
        }
    }else
    {
        $("#qty").val('');
        $("#tot").val('');
    }
}


function insert()
{
    var itdate = $('#datepicker').val();
    let captain = $('#captain12').val();
    var table_no = $('#table_no').val();
    var priceform = $('#priceform').val();
    var itmno = $("#itmno").val();
    var captainname = $("#captainname").val();
    var itname = $("#autocomplete").val();
    var qty = $("#qty").val();
    var prc = $("#prc").val();
    var total = $("#tot").val();
   
  		if(qty=="" && qty==0)
        {
          	qty=1;
          	total=prc*qty;
        }
    if(itdate != "" && table_no != "" && captain != "" && priceform != "" && itmno != "" && itname != "" && qty != "" && captainname != '') 
    {
        let log=$.ajax({
                    type: "post",
                    url: "ajax/table_form_insert.php",
                    data: {
                            captain: captain,
                            date: itdate,
                            itmno: itmno,
                            itmnam: itname,
                            prc: prc,
                            qty: qty,
                            tot: total,
                            tabno: table_no,
                            captainname:captainname
                        },
                    cache: false,
                    success: function(status)
                    {
                        $("#qty").val("");
                        $("#itmno").val("");
                        document.getElementById('autocomplete').value='';
                        $("#prc").val("");
                        $("#tot").val("");
                        $('#itemlist').load("current_data.php?x="+table_no);
                        $('#boxx').load("final_search.php");
                        $('#boxx2').load("shiftTable.php");
                        
                        
                    }
                });
                // console.log(log);
    }
    else
    {
        alert("Empty Feild...");
        exit();
    }
    document.getElementById("itmno").focus();
}

$("input").bind('keydown', function(e)
{
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
    }else if(e.key === "Shift")
    {
        let sess=$('#sess').val();
      	var currentInput = document.activeElement.id;
      	console.log(currentInput);
          if(currentInput=='qty')
          {
              autocomplete.focus();
          }else if(currentInput=='autocomplete')
          {
              itmno.focus();
          }
          else if(currentInput=='itmno' && sess!='Captain')
          {
              captain12.focus();
          }
          else if(currentInput=='itmno' && sess=='Captain')
          {
              table_no.focus();
          }
          else if(currentInput=='captain12')
          {
              table_no.focus();
          }
    }

});


function tab_no(wingname)
{
    console.log(wingname);
    // $("#captain12").val('');
    // $("#captainname").val('');
    let log=$.ajax({
        url: 'ajax/table_no.php',
        type: "POST",
        dataType: 'json',
        data: {
            wingname: wingname,
        },
        success: function(data)
        {
            if(data=="none")
            {
                $("#table_no").val('');
            }else
            {
                $("#table_no").val(wingname);
                $('#itemlist').load("current_data.php?x="+wingname);
            }
            console.log(data)
        }
    }); 
}

function cap_code(wingname)
{
    let log=$.ajax({
        url: 'ajax/table_no.php',
        type: "POST",
        dataType: 'json',
        data: {
            cap_code: wingname,
        },
        success: function(data)
        {
            if(data[0] != wingname)
            {
                $("#captain12").val('');
            }else
            {
                $("#captain12").val(data[1]);
                $("#captainname").val(data[1]);
            }
        }
    }); 
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
    }else if (event.altKey && event.keyCode === 84)
    {
        $('#tbody tr').each(function()
        {
            var td =$(this).find('td:nth-child(2)').text();
            if(td==table_no)
            {
                $('#DirectPrint').val(1);
                $(this).find('#clc1').click();
            }
        });
    }
    else if(event.altKey && event.keyCode === 90)
    {
        window.location='table_form.php';
    }
});



