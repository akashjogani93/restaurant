$(document).ready(function()
{
    fetchuser();
    $("#example1").DataTable();


    $('#mobile').keypress(function(event)
    {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if ((keycode < 47 || keycode > 57))
        {
            return false;
        }else
        {
            return true;
        }
    });

});
$("#type").change(function() 
{
   if ($('#type').val() == "Captain")
   {
    //    $("#unamepass1").css("display", "none");
      $("#unamepass").css("display", "block");
    }else if($('#type').val() == "Manager")
    {
        // $("#unamepass1").css("display", "none");
        $("#unamepass").css("display", "block");
    }
   else{
    	   $("#unamepass").css("display", "none");
        	// $("#unamepass1").css("display", "block");
    }
});
function submit() 
{
    $("#empty").fadeIn();
    $("#useradd").fadeIn();
    let user = $('#user').val();
    if (user != "") 
    {
    //     var minLength = 3;
    //     if(cat.length<minLength)
    //     {
    //         $('#empty').html(`<span style='color:red'>This is Short..</span>`);
    //         $("#empty").fadeOut(2000);
    //     }else
    //     {
            $.ajax({
                url: 'ajax/emp.php',
                type: "POST",
                data: {
                    user : user
                },
                success: function(data) 
                {
                    $('#finalModal').modal('hide');
                    $('#useradd').html(`<span style='color:green'>Added User..</span>`);
                    $("#useradd").fadeOut(2000);
                    fetchuser()
                }
            });
        // }
    }else{
        $('#empty').html(`<span style='color:red'>Empty field..</span>`);
        $("#empty").fadeOut(1000);
    }
}


function fetchuser()
{
    let log = $.ajax({
        url: 'ajax/emp.php',
        type: "POST",
        dataType: 'json',
        data: {
            usertype : 'user',
        },
        success: function(data)
        {
            // console.log(data);
            for (var i = 0; i < data.length; i++) 
            {
                var opt = document.createElement("option");
                opt.text = data[i];
                opt.value =data[i];
                var x = document.getElementById("type");
                x.add(opt);
            }
        }
    });
}


function subt()
{
    let ty=$("#type").val();
    let empid=$("#empid").val();
    let empname=$("#empname").val();
    let uname=$("#uname").val();
    let pass=$("#pass").val();
    let mobile=$("#mobile").val();
    let login='get'; 
   if(ty=="Manager" || ty=="Captain")
   {
        if(uname=="" && pass=="")
        {
            alert("Please Fill All Feilds");
            exit();
        }
        login='not';
   }
   if(empname!='' && ty!='')
   {
        $.ajax({
            type:'POST',
            url:'empreginsert.php',
            data:{
                ty:ty,
                empid:empid,
                empname:empname,
                uname:uname,
                mobile:mobile,
                pass:pass,
                login:login
            },
            success :function(response)
            {   
                alert(response);
                window.location="empreg.php";
            }
        });
   }else{
    alert("Please Fill All Feilds");
   }

}

function subt1()
{
    let ty=$("#type").val();
    let empid=$("#empid").val();
    let empname=$("#empname").val();
    let uname=$("#uname").val();
    let pass=$("#pass").val();
    let mobile=$("#mobile").val();
    let login='get'; 
   if(ty=="Manager" || ty=="Captain")
   {
        if(uname=="" && pass=="")
        {
            alert("Please Fill All Feilds");
            exit();
        }
        login='not';
   }
   if(empname!='' && ty!='')
   {
        $.ajax({
            type:'POST',
            url:'empregupdate.php',
            data:{
                ty:ty,
                empid:empid,
                empname:empname,
                uname:uname,
                mobile:mobile,
                pass:pass,
                login:login
            },
            success :function(response)
            {   
                alert(response);
                window.location="empreg.php";
            }
        });
   }else{
    alert("Please Fill All Feilds");
   }
}

function getRowValues(event, empid) {
    var row = event.target.closest("tr");
    var cells = Array.from(row.getElementsByTagName("td"));

    var name = cells[2].innerText;
    var mobile = cells[3].innerText;
    var type = cells[4].innerText;
    var user = cells[5].innerText;
    var pass = cells[6].innerText;

    $('#mainSub').hide();
    $('#mainedit').show();

    $('#empid').val(empid);
    $('#empname').val(name);
    $('#mobile').val(mobile);
    $('#type').val(type);

    if(type=="Manager" || type=="Captain")
    {
        $("#unamepass").show();
        $("#uname").val(user);
        $("#pass").val(pass);
    }

}
  
  function handleClick(cell) {
    var confirmation = window.confirm("Are you sure..?");

    if(confirmation)
    {
        // var [col1, col2, col3] = getRowValues(cell);
        var row = cell.closest("tr");
        var cells = row.getElementsByTagName("td");
        var col1 = cells[0].innerText;
        var col2 = cells[1].innerText;
        var col3 = cells[2].innerText;
        var login='get';
        if(col3!='STW')
        {
            login='not';
        }
        $.ajax({
            type:'POST',
            url:'ajax/empdel.php',
            data:{
                empid:col1,
                login:login,
                uname:col3,
            },
            success :function(response)
            {   
                alert(response);
                window.location="empreg.php";
            }
        });
    }

  
  }