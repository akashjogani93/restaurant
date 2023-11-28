class Reports
{
    constructor() 
    {
        this.initializeTabs();
    }
    initializeTabs()
    {
        var currentDate = new Date();
        var firstDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
        var lastDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
        
        var formattedFirstDate = firstDate.toISOString().split('T')[0];
        var formattedLastDate = lastDate.toISOString().split('T')[0];
        
        $("#fdate").val(formattedFirstDate);
        $("#tdate").val(formattedLastDate);
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
    }
}