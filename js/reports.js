class Reports
{
    constructor()
    {
        this.initializeTabs();
    }
    initializeTabs()
    {
        var currentDate = new Date();
        var formattedDate = currentDate.toISOString().split('T')[0];
        $("#fdate").val(formattedDate);
        $("#tdate").val(formattedDate);

        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
    }
    Kot_cancel()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        if (new Date(tdate) < new Date(fdate)) {
            alert("Please Select Valid Date");
            return; // Stop further execution if the condition is not met
        }
        
        let log=$.ajax({
            type: "post",
            url: "ajax/reports.php",
            data:{
                    cancelkot: 'cancelkot',
                    fdate:fdate,
                    tdate:tdate
                },
            cache: false,
            success: function(status)
            {
                $('#mainData').empty();
                $('#mainData').append(status);
            }
        });
    }
    day_sales()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        if (new Date(tdate) < new Date(fdate)) {
            alert("Please Select Valid Date");
            return; // Stop further execution if the condition is not met
        }
        var typ=$("#typ").val();
        // var typ='All';
        let log=$.ajax({
            type: "post",
            url: "ajax/reports.php",
            data:{
                    daysale: 'daysale',
                    fdate:fdate,
                    tdate:tdate,
                    typ:typ
                },
            cache: false,
            success: function(status)
            {
                $('#mainData').empty();
                $('#mainData').append(status);
            }
        });
        console.log(log);
    }
    month_sales()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        if (new Date(tdate) < new Date(fdate)) {
            alert("Please Select Valid Date");
            return; // Stop further execution if the condition is not met
        }
        let log=$.ajax({
            type: "post",
            url: "ajax/reports.php",
            data:{
                    monthsale: 'monthSale',
                    fdate:fdate,
                    tdate:tdate
                },
            cache: false,
            success: function(status)
            {
                $('#monthData').empty();
                $('#monthData').append(status);
            }
        });
    }
    day_foodInvoice()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        if (new Date(tdate) < new Date(fdate)) {
            alert("Please Select Valid Date");
            return; // Stop further execution if the condition is not met
        }
        let log=$.ajax({
            type: "post",
            url: "ajax/reports.php",
            data:{
                    dayFoodInvoice: 'dayFoodInvoice',
                    fdate:fdate,
                    tdate:tdate
                },
            cache: false,
            success: function(status)
            {
                $('#maintable').empty();
                $('#maintable').append(status);
            }
        });
    }
    menu_Qty()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        if (new Date(tdate) < new Date(fdate)) {
            alert("Please Select Valid Date");
            return; // Stop further execution if the condition is not met
        }
        let log=$.ajax({
            type: "post",
            url: "ajax/reports.php",
            data:{
                    menuQty: 'menuQty',
                    fdate:fdate,
                    tdate:tdate
                },
            cache: false,
            success: function(status)
            {
                $('#menuqtySale').empty();
                $('#menuqtySale').append(status);
            }
        });
    }
    singleFood()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        if (new Date(tdate) < new Date(fdate)) {
            alert("Please Select Valid Date");
            return; // Stop further execution if the condition is not met
        }
        let log=$.ajax({
            type: "post",
            url: "ajax/reports.php",
            data:{
                    singlefood: 'singlefood',
                    fdate:fdate,
                    tdate:tdate
                },
            cache: false,
            success: function(status)
            {
                $('#singleFood').empty();
                $('#singleFood').append(status);
            }
        });
        // console.log(log);
    }
    cashierReport()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        if (new Date(tdate) < new Date(fdate)) {
            alert("Please Select Valid Date");
            return; // Stop further execution if the condition is not met
        }
        let log=$.ajax({
            type: "post",
            url: "ajax/reports.php",
            data:{
                    cashier: 'cashier',
                    fdate:fdate,
                    tdate:tdate
                },
            cache: false,
            success: function(status)
            {
                $('#cashierData').empty();
                $('#cashierData').append(status);
            }
        });
        console.log(log);
    }
    captainData()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        if (new Date(tdate) < new Date(fdate)) {
            alert("Please Select Valid Date");
            return; // Stop further execution if the condition is not met
        }
        let log=$.ajax({
            type: "post",
            url: "ajax/reports.php",
            data:{
                    captainData: 'captainData',
                    fdate:fdate,
                    tdate:tdate
                },
            cache: false,
            success: function(status)
            {
                $('#captainData').empty();
                $('#captainData').append(status);
            }
        });
        // console.log(log);
    }
    payment()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        if (new Date(tdate) < new Date(fdate)) {
            alert("Please Select Valid Date");
            return; // Stop further execution if the condition is not met
        }
        var pay=$("#pay").val();
        let log=$.ajax({
            type: "post",
            url: "ajax/reports.php",
            data:{
                    paymentMode: 'payment',
                    pay:pay,
                    fdate:fdate,
                    tdate:tdate
                },
            cache: false,
            success: function(status)
            {
                $('#payment').empty();
                $('#payment').append(status);
            }
        });
        //console.log(log);
    }
    Food_kot()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        if (new Date(tdate) < new Date(fdate)) {
            alert("Please Select Valid Date");
            return; // Stop further execution if the condition is not met
        }
        let log=$.ajax({
            type: "post",
            url: "ajax/reports.php",
            data:{
                    foodkot: 'foodkot',
                    fdate:fdate,
                    tdate:tdate
                },
            cache: false,
            success: function(status)
            {
                $('#mainData').empty();
                $('#mainData').append(status);
            }
        });
    }
    managerEdit()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();

        if (new Date(tdate) < new Date(fdate)) {
            alert("Please Select Valid Date");
            return; // Stop further execution if the condition is not met
        }

        let log=$.ajax({
            type: "post",
            url: "ajax/reports.php",
            data:{
                    managerEdit: 'managerEdit',
                    fdate:fdate,
                    tdate:tdate
                },
            cache: false,
            success: function(status)
            {
                $('#mainData').empty();
                $('#mainData').append(status);
            }
        });
    }
    loginTime()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        if (new Date(tdate) < new Date(fdate)) {
            alert("Please Select Valid Date");
            return; // Stop further execution if the condition is not met
        }
        
        let log=$.ajax({
            type: "post",
            url: "ajax/reports.php",
            data:{
                    loginTime: 'loginTime',
                    fdate:fdate,
                    tdate:tdate
                },
            cache: false,
            success: function(status)
            {
                $('#loginTime').empty();
                $('#loginTime').append(status);
            }
        });
        console.log(log);
    }
}