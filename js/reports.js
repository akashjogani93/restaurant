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
                // console.log(status);
                $('#kotdata').append(status);
                // window.location="table_master.php?tabno="+status;
            }
        });
    }
    day_sales()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        let log=$.ajax({
            type: "post",
            url: "ajax/reports.php",
            data:{
                    daysale: 'daysale',
                    fdate:fdate,
                    tdate:tdate
                },
            cache: false,
            success: function(status)
            {
                $('#dayData').empty();
                $('#dayData').append(status);
            }
        });
        // console.log(log);
    }
    month_sales()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
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
    }
}