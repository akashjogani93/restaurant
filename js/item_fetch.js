$(document).ready(function()
{
    itemload();
});

function itemload()
{
    $('#itemlist').load("item_fetch.php?x=All");
    // $('#cat').change(function(){
    //     let x = $(this).val();
    //     console.log(x);
    //     y = x.replaceAll(/[ ,."&",]/g,"%20");
    //      console.log(y);
    //     $('#itemlist').load("item_fetch.php?x="+y);
    // });
}
function addmenu()
{
    $("#empty1").fadeIn();
    var cat1 = "veg";
    var itm = $('#itm').val();
    var prc = $('#prc').val();
    var prc1 = $('#prc1').val();
    var itm_code = $('#itm_code').val();
    // alert(itm_code);

    if (cat1 != "" & cat1 != "All" & itm != "" & prc != "" & prc1 != "" & itm_code != "" & prc!=0 & prc1!=0) 
    {
        let log=$.ajax({
            url: 'ajax/addcate.php',
            type: "POST",
            data: {
                cat1 : cat1,itm : itm,prc : prc,prc1 : prc1,itm_code:itm_code
            },
            success: function(data) 
            {
                $('#itm_code').val('');
                $('#itm').val('');
                $('#prc').val('');
                $('#prc1').val('');
                $('#empty1').html(`<span style='color:green'>Menu Added..<span>`);
                $("#empty1").fadeOut(1000);
                itemload()
            }
        });
      console.log(log);

    }else
    {
        $('#empty1').html(`<span style='color:red'>Empty field..</span>`);
        $("#empty1").fadeOut(3000);
    }
}


function checku()
{
    let itemcode=$("#itm_code").val();
    if (itemcode!=0)
    {
        jQuery.ajax({
            url:'ajax/accnum.php',
            data:'itm=' +$("#itm_code").val(),
            type:"POST",
            success:function(data){
                $("#checku").html(data);
            },
            error:function(){}
    
        });
    }else
    {
        $("#checku").html('<span style="color:red">Not Valid</span>');
        $('#sub').prop('disabled',true);
    }
}

function checku1()
{
    var itmm = $("#itmm_code").val();

    var sl = $("#itmm_code1").val();
    if(itmm!=0)
    {
        jQuery.ajax({
            url:'ajax/accnum.php',
            data:{itmm:itmm,sl:sl},
            type:"POST",
            success:function(data){
                $("#checku1").html(data);
            },
            error:function(){}
    
        });
    }else
    {
        $("#checku1").html('<span style="color:red">Not Valid</span>');
        $('#sub1').prop('disabled',true);
    }
}





function editmenu()
{
    $("#editt").fadeIn();
    var cat1 = "veg";
    var sl = $('#sl').val();
    var itm = $('#itmnam').val();
    var prc = $('#editprc').val();
    var prc1 = $('#editprc1').val();
    var itmm_code = $('#itmm_code').val();
    var itmm_code1 = $('#itmm_code1').val();
    if (cat1 != "" & cat1 != "All" & itm != "" & prc != "" & prc1 != "" & itmm_code != "" & itmm_code1 != "") 
    {
        $.ajax({
            url: 'ajax/addcate.php',
            type: "POST",
            data: {
                editcat1 : cat1,itm : itm,prc : prc,prc1 : prc1,sl : sl,itmm_code:itmm_code,itmm_code1:itmm_code1
            },
            success: function(data) 
            {
                // alert(data);
                $("#empty1").fadeIn();
                $('#itmm_code').val('');
                $('#itmnam').val('');
                $('#editprc').val('');
                $('#editprc1').val('');
                $('#myModal').modal('hide');
                $('#empty1').html(`<span style='color:green'>Menu Edited..<span>`);
                $("#empty1").fadeOut(1000);
                itemload()
            }
        });
    }
    else
    {
        $('#editt').html(`<span style='color:red'>Empty field..</span>`);
        $("#editt").fadeOut(3000);
    }
}

//item fetch.php
