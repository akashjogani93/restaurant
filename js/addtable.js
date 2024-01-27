var app = new Vue({
    el: '#dynamic-table',
    
    methods: {
        editItem : function(e) 
        {
            var tar = e.currentTarget;
            var chil = tar.parentElement.parentElement.children;
            var form = $("#category input");
            console.log(form);
            form[0].value = (chil[2].innerHTML);
            form[1].value = (chil[1].innerHTML);
            $("#ac1").val(chil[3].innerHTML);
            // form[1].value = (chil[1].innerHTML);
        }
    }
});
$(function () 
{
    $("#dynamic-table").DataTable({
        columnDefs: [
            { targets: [4, 5], orderable: false } // Disable sorting for columns 2 and 3
         ]
    });
});

function submit()
{
    $("#empty").fadeIn();
    // $("#catsus").fadeIn();
    let cat = $('#tno').val();
    let tid = $('#tid').val();
    let ac1 = $('#ac1').val();
    if (cat != "" & tid != "") 
    {
        $.ajax({
            url: 'ajax/addcate.php',
            type: "POST",
            data: {
                tedit : cat,tid: tid,ac1:ac1
            },
            success: function(data) 
            {
                alert(data);
                window.location.href="addtable.php";
            }
        });
    }else{
        $('#empty').html(`<span style='color:red'>Empty field..</span>`);
        $("#empty").fadeOut(1000);
    }
}
