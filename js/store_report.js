class Reports
{
    constructor() 
    {
        this.initializeTabs();
    }
    initializeTabs()
    {
        var yourDateValue = new Date();
        var formattedDate = yourDateValue.toISOString().substr(0, 10)
        $("#fdate").val(formattedDate);
        $("#tdate").val(formattedDate);
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        
    }
    store_data()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        let log=$.ajax({
            type: "post",
            url: "ajax/store_reports.php",
            data:{
                    store_report: 'store_report',
                    fdate:fdate,
                    tdate:tdate
                },
            cache: false,
            success: function(status)
            {
                $('#kotdata').empty();
                $('#kotdata').append(status);
                // window.location="table_master.php?tabno="+status;
            }
        });
        // console.log(log);
    }
    assets_data()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        let log=$.ajax({
            type: "post",
            url: "ajax/store_reports.php",
            data:{
                    assets: 'assets',
                    fdate:fdate,
                    tdate:tdate
                },
            cache: false,
            success: function(status)
            {
                $('#kotdata').empty();
                $('#kotdata').append(status);
                // window.location="table_master.php?tabno="+status;
            }
        });
        // console.log(log);
    }
    damage_data()
    {
        var fdate=$("#fdate").val();
        var tdate=$("#tdate").val();
        let log=$.ajax({
            type: "post",
            url: "ajax/store_reports.php",
            data:{
                    damData: 'damData',
                    fdate:fdate,
                    tdate:tdate
                },
            cache: false,
            success: function(status)
            {
                $('#damData').empty();
                $('#damData').append(status);
                // window.location="table_master.php?tabno="+status;
            }
        });
    }
}