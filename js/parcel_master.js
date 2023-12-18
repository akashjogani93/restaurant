var direct;
$(document).ready(function()
{
    const urlParams = new URLSearchParams(window.location.search);
    const statuscancel = urlParams.get('tabno');
    $('#itemlist').load("parcel_data.php?tabno="+statuscancel);
    $('#boxx').load("parcelBill_data.php");
    let log=$.ajax({
        type: 'GET',
        dataType: 'json',
        url: 'parcel_session.php',
        success: function(response) 
        {
            var Table=response.Table;
            if(response.BillEdit==true)
            {
                $('#itemlist').load("parcel_data.php?tabno="+Table);
            }else
            {
                // $('#boxx2').load("tableShift.php");
                let sess=$('#cashType').val();
                if(sess!='Captain')
                {
                    $('#boxx1').load("bill_setelment.php?order=1");
                }
            }
        }
    });
    direct=true;
    $("#table_no").focus();

    $(function() {
        // $("#table_no").autocomplete({
        //     source: function (request, response)
        //     {
        //         let log= $.ajax({
        //             url: "ajax/table_master.php",
        //             type: "post",
        //             dataType: "json",
        //             data: {
        //                 search: request.term,
        //             },
        //             success: function (data)
        //             {
        //                 response(data);
        //             },
        //         });
        //     },
        //     select: function (event, ui)
        //     {
        //         $("#table_no").val(ui.item.label);
        //         return false;
        //     },
        //     focus: function (event, ui) 
        //     {
        //         $("#table_no").val(ui.item.label);
        //         return false;
        //     },
        // });
        $("#captain12").autocomplete({
            source: function (request, response)
            {
                let log= $.ajax({
                    url: "ajax/table_master.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        capcode: request.term,
                    },
                    success: function (data)
                    {
                        response(data);
                    },  
                });
            },
            select: function (event, ui) 
            {
                $("#captain12").val(ui.item.label);
                return false;
            },
            focus: function (event, ui)
            {
                $("#captain12").val(ui.item.label);
                return false;
            },
        });
        $("#autocomplete").autocomplete({
            source: function (request, response)
            {
                let log= $.ajax({
                    url: "ajax/table_master.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        itemnamedata: request.term,
                    },
                    success: function (data)
                    {
                        response(data);
                    },
                });
            },
            select: function (event, ui) 
            {
                $("#autocomplete").val(ui.item.label);
                return false;
            },
            focus: function (event, ui) 
            {
                $("#autocomplete").val(ui.item.label);
                return false;
            },
        });
    });

    $("input[type=text], input[type=number]").on("keydown", function (e) 
    {
        if (e.key === "Enter" || e.keyCode === 13) 
        {
            e.preventDefault();
            var inputFields = $("input[type=text], input[type=number]");
            var currentIndex = inputFields.index(this);
            var nextInput = inputFields.eq(currentIndex + 1);
            if (nextInput.length > 0) 
            {
                nextInput.focus();
            }
        }else if (e.key === "Shift" || e.keyCode === 16)
        {
            e.preventDefault();
            var inputFields = $("input[type=text], input[type=number]");
            var currentIndex = inputFields.index(this);
                // Calculate the index of the previous input field
                var prevIndex = currentIndex - 1;

                if (prevIndex >= 0) {
                    var prevInput = inputFields.eq(prevIndex);
                    prevInput.focus();
                }
        }
    });

    $(document).on("keydown", function (e)
    {
        var table_no = $("#table_no").val();
        if (e.altKey && (e.key === "z" || e.keyCode === 90)) {
            e.preventDefault();
            window.location='parcel_master.php';
        }else if (e.altKey && (e.key === "x" || e.keyCode === 88)) 
        {
            document.getElementById("kotPrint").click();
        }else if (e.altKey && (e.key === "a" || e.keyCode === 65)) {
            console.log('running');
            e.preventDefault();
            document.getElementById("printAllItem").click();
        }else if (e.altKey && (e.key === "c" || e.keyCode === 67)) {
            e.preventDefault();
            $('#tbody tr').each(function () 
            {
                var td = $(this).find('td:nth-child(2)').text();
                if (td == table_no) 
                {
                    direct=true;
                    $(this).find('#printData').click();
                }
            });
        }
        else if (e.altKey && (e.key === "t" || e.keyCode === 84)) {
            e.preventDefault();
            $('#tbody tr').each(function () 
            {
                var td = $(this).find('td:nth-child(2)').text();
                if (td == table_no) 
                {
                    direct=false;
                    $(this).find('#printData').click();
                }
            });
        }
    });

    //QTY ENTER IN TWO TIMES
    var enterKeyPressTimestamp = 0;
    $("#qty").on("keydown", function (e) {
        if (e.key === "Enter" || e.keyCode === 13) {
            e.preventDefault();
            var currentTime = Date.now();
            var timeElapsed = currentTime - enterKeyPressTimestamp;
            if (timeElapsed < 500) {
                OrderAdd();
            }
            enterKeyPressTimestamp = currentTime;
        }
    });

    $('#qty').on('input',function(e)
    {
        total();
    });
});

function tab_no(tabName)
{
    // console.log('runnig');
    // $("#captain12").val('');
    // $("#captainname").val('');
    // let log=$.ajax({
    //     url: 'ajax/parcel_master.php',
    //     type: "POST",
    //     dataType: 'json',
    //     data: {
    //         tabName: tabName,
    //     },
    //     success: function(data)
    //     {
    //         if(data=="none")
    //         {
    //             $("#table_no").val('').focus();
    //         }else   
    //         {
        if(tabName!='')
        {
                $("#table_no").val(tabName);
                $('#itemlist').load("parcel_data.php?tabno="+tabName);
                $('#boxx').load("parcelBill_data.php");
        }else
        {
            $('#itemlist').empty();
            $("#captain12").val('');
            $("#captainname").val('');
        }
    //         }
    //     }
    // }); 
}

function cap_codeCange(capCode)
{
    // console.log('running');
    let log=$.ajax({
        url: 'ajax/table_master.php',
        type: "POST",
        dataType: 'json',
        data: {
            cap_code: capCode,
        },
        success: function(data)
        {
            if(data[0] != capCode)
            {
                $("#captain12").val('').focus();
            }else
            {
                $("#captain12").val(data[1]);
                $("#captainname").val(data[0]);
            }
        }
    }); 
}

function item_no()
{
    var itemno = document.getElementById('itmno').value;
    let table_no=$("#table_no").val();

    let log= $.ajax({
        url: 'ajax/parcel_master.php',
        type: "POST",
        dataType: 'json',
        data: {
            item_no: itemno,
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
                $("input[name=itmno]").one("keydown", function (e) 
                {
                    if (e.key === "Enter" || e.keyCode === 13) 
                    {
                        e.preventDefault();
                        $("#qty").focus();
                    }
                });
            }
            $("#autocomplete").val(data[1]);
            $("#prc").val(data[2]);
            total();
        }
    });
}

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

function store()
{
    var wingname = document.getElementById('autocomplete').value;
    let table_no=$("#table_no").val();
    let log=$.ajax({
        url: 'ajax/parcel_master.php',
        type: "POST",
        dataType: 'json',
        data: {
            itemname: wingname,
            ite_table_no: table_no,
        },
        success: function(data) 
        {
            console.log(data);
            $("#itmno").val(data[0]);
            $("#itmnam").val(data[1]);
            $("#prc").val(data[2]);
            total();
        }
    });
    // console.log(log);
}

function OrderAdd()
{
    var itdate = $('#datepicker').val();
    let captain = $('#captain12').val();
    var table_no = $('#table_no').val();
    // var priceform = $('#priceform').val();
    var itmno = $("#itmno").val();
    var captainCode = $("#captainname").val();
    var itname = $("#autocomplete").val();
    var qty = $("#qty").val();
    var prc = $("#prc").val();
    var total = $("#tot").val();
    // console.log(captainCode);
    if(qty=="" && qty==0)
    {
        qty=1;
        total=prc*qty;
    }
    if(table_no != "" && captain != "" && itmno != "" && itname != "" && qty != "" && captainCode != '') 
    {
        let log=$.ajax({
            type: "post",
            url: "ajax/parcel_master.php",
            data: {
                    captain: captain,
                    date: itdate,
                    itmno: itmno,
                    itmnam: itname,
                    prc: prc,
                    qty: qty,
                    tot: total,
                    tabno: table_no,
                    captainname:captainCode
                },
            cache: false,
            success: function(status)
            {
                // console.log(status);
                $("#qty").val("");
                $("#itmno").val("");
                document.getElementById('autocomplete').value='';
                $("#prc").val("");
                $("#tot").val("");
                $('#itemlist').load("parcel_data.php?tabno="+table_no);
                $('#boxx').load("parcelBill_data.php");
                // $('#boxx2').load("shiftTable.php");
            }
        });
    }
    else
    {
        if (table_no == "") {
            $("#table_no").css("border-color", "red");
        }
        if (captain == "") {
            $("#captain12").css("border-color", "red");
        }
        if (itmno == "") {
            $("#itmno").css("border-color", "red");
        }
        if (itname == "") {
            $("#autocomplete").css("border-color", "red");
        }
        return;
    
    }
    $('#itmno').focus();
}

function KotPrint(tabno)
{
    let log=$.ajax({
        type: "post",
        url: "ajax/parcel_master.php",
        data:{
                kot: tabno,
            },
        cache: false,
        success: function(status)
        {
            window.location="parcel_kot.php?tabno="+status;
        }
    });
}

function cancel_Kot(kotnumber)
{
    let log=$.ajax({
        type: "post",
        url: "ajax/parcel_master.php",
        data:{
                cancel_Kot: kotnumber,
            },
        cache: false,
        success: function(status)
        {
            console.log(status);
            window.location="parcel_master.php?tabno="+status;
        }
    });
}

function printAllItem(tabno)
{
    window.location="parcel_item.php?tabno="+tabno;
}

function delitm(slno)
{
    if (slno != "") 
    {
        $.ajax({
            type: "post",
            url: "ajax/parcel_master.php",
            data: {
                itmno: slno,
                delete: "delete"
            },
            success: function(status) 
            {
                // console.log(status);
                $('#itemlist').load("parcel_data.php?tabno="+status);
                // $('#boxx').load("final_search.php");
            }
        });
    } else {
        alert("Please Select Item");
    }
}

//merge Table Button
function mergeTable() 
{
    $('.tbl').css("display", "block");
    $('.blacnk').css("display", "block");
    $('#merge').css("display", "block");
    $('#select').css("display", "none")
}
//click To Merge
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
            success: function(data) 
            {
                window.location.href = 'table_master.php?tabno='+x;
            }
        });
    }else
    {
        alert('select 2 or More Table');
    }
}

function printData(tab_no,event)
{
    var row = (event && event.target) ? event.target.closest('tr') : null;
    if (row) 
    {
        var tabnoValue = tab_no;
        var capnameElement = row.querySelector('td:nth-child(4)');
        var capnameValue = capnameElement ? capnameElement.textContent : '';
        var disPerValue = row.querySelector('.disPer').value;
        var chargebleValue = row.querySelector('#chargeble').value;

        if(disPerValue=='%')
        {
            disPerValue=0;
        }
        var i=0;
        if(tab_no != '' && i<1)
        {
            $('#printData').prop('disabled',true);
            let log=$.ajax({
                url:"ajax/parcel_master_save.php",
                method:"POST",
                // dataType:'json',
                data:
                {
                    tabno: tab_no,
                    captain:capnameValue,
                    dis:disPerValue,
                    charge:chargebleValue,
                },
                success: function(status)
                {
                    if(direct==true)
                    {
                        window.location="finalInvoice.php?billno="+status+"&back=1&pri=1";
                    }
                    else
                    {
                        location.reload();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error: " + textStatus, errorThrown);
                }
            });
            // console.log(log);
        }
    } else 
    {
        console.error('Row not found.');
        return;
    }
}

function viewData(tabno)
{
    $('#itemlist').load("parcel_data.php?tabno="+tabno);
}

function settle(event)
{
    var currentRow = event.currentTarget.closest('tr');

    // Get values from the cells in the current row
    var billno = currentRow.querySelector('td:nth-child(1)').textContent;
    var tabno = currentRow.querySelector('td:nth-child(2)').textContent;
    var amount = currentRow.querySelector('td:nth-child(3)').textContent;
    var paymentMethod = document.getElementById('payment').value;

    // Now you have the values, and you can use them as needed
    // console.log('billno:', billno);
    // console.log('tabno:', tabno);
    // console.log('amount:', amount);
    // console.log('paymentMethod:', paymentMethod);
    let log=$.ajax({
        type: 'POST',
        url: 'ajax/billsettle.php',
        data: { billno:billno,paymentMethod: paymentMethod },
        success: function(response) 
        {
            $('#boxx1').load("bill_setelment.php?order=1");
            // console.log(response);
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            console.error(errorThrown);
            // $('#boxx1').load("final_setelment.php?order="+order);
        }
    });
    // console.log(log)
}

function editBill(event)
{
    var currentRow = event.currentTarget.closest('tr');
    var billno = currentRow.querySelector('td:nth-child(1)').textContent;
    var tabno = currentRow.querySelector('td:nth-child(2)').textContent;
    $.ajax({
        type: 'POST',
        url: 'parcel_session.php',
        data: { billno: billno,tabno:tabno },
        success: function(response) 
        {
            $('#itemlist').load("parcel_data.php?tabno="+tabno);
            $('#boxx').load("parcelBill_data.php");
            $('#boxx2').remove();
            $('#boxx1').remove();
        }
    });
}