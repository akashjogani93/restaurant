<?php require_once("header.php"); ?>
<style>
    .table-box{
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .table-s{
        height:50px;
        /* width:80px; */
        background-color:#009879;
        margin:0 10px;
        padding:10px;

        float: left;
        width: 23% !important;
        /* border:1px solid black; */
        margin:10px;
    }
    .table-kot{
        height:50px;
        width:120px;
        background-color:#f39c12;
        margin:0 10px;
        padding:10px
    }
    .table_name{
        justify-content:center;
        color:white;
    }
    .highlighted 
    {
      background-color: #7C9D96;
    }
    .kot-items{
        width: 95%;
        overflow: auto;
    }
    .runing-tables,.parcel-tables
    {
        width:48%;
        overflow:auto;
    }
    .tbale{
        float: left;
        width: 23% !important;
        border:1px solid black;
        margin:10px;
        /* justify-content:center; */
    }
    table thead tr{
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    }
    table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
    }
    table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
    }
    .table{
        margin-bottom:0 !important;

    }
    .kot-header{
        background-color:#7C9D96 !important;
    }
    /* .highlighted>.table_name
    {
        color:dark;
    } */
</style>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1"></div>
        <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Kitchen KOT
            </h1>
        </section>
        <section class="content">
            <div id="app">
            <div class="box box-default">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body">
                            <div class="row">
                                <div class="table-box">
                                    <div class="runing-tables">
                                        <center><h4>Running Tables</h4></center>
                                        <div class="table-s" v-for="(table, index) in tables" :key="index.tabno" @click=singleTableCli(table,0) :class="{ 'highlighted': selectedTable === table.tabno }">
                                            <center><p class="table_name">{{ table.tabno }}</p></center>
                                        </div>
                                    </div>
                                    <div class="parcel-tables">
                                        <center><h4>Parcel Tables</h4></center>
                                        <div class="table-s" v-for="(parcel, index) in parcels" :key="index.tabno" @click=singleTableCli(parcel,1) :class="{ 'highlighted': selectedTable === parcel.tabno }">
                                            <center><p class="table_name">{{ parcel.tabno }}</p></center>
                                        </div>
                                    </div>
                                </div>
                            </div></br>
                        </div>
                        <div class="box">
                            <div class="row">
                                <div class="table-box">
                                    <div class="kot-items">
                                        <div class="tbale" v-for="(data, kotNum) in alldata" :key="kotNum">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr class="kot-header">
                                                    <th :colspan="2" class="text-center">KOT-{{ kotNum }}</th>
                                                </tr>
                                                <thead>
                                                    <tr>
                                                        <th>Menu Name</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(item, index) in data" :key="index">
                                                        <td>{{ item.itmnam }}</td>
                                                        <td>{{ item.qty }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </box>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="cdn/dataTables.buttons.min.js"></script>
    <script src="cdn/buttons.print.min.js"></script>

    <script>

        var app=new Vue({
            el:'#app',
            data:{
                tables:[],
                parcels:[],
                kots:[],
                selectedTable:null,
                alldata: {},
                timeoutId: null,
            },
            methods: {
                fetchTables() 
                {
                    const vm=this;
                    let log=$.post('ajax/kots_kitchen.php',{fetchTable:"Tables"})
                    .done(function(response)
                    {
                        vm.tables=response.tables;
                        vm.parcels = response.parcels;
                    })
                    .fail(function(jqXHR,textStatus,errorThrown)
                    {
                        console.error("AJAX error:", textStatus, errorThrown);
                    });
                    setTimeout(()=>
                    {
                        vm.fetchTables();
                    },5000)
                },
                singleTableCli(table,status)
                {
                    const vm=this;
                    vm.alldata={}
                    vm.selectedTable = table.tabno;
                    var tabno=table.tabno;
                    console.log(tabno);
                    console.log(status)
                    if (vm.timeoutId) 
                    {
                        clearTimeout(vm.timeoutId);
                    }

                    let log=$.post('ajax/kots_kitchen.php',{tabno:tabno,status:status})
                        .done(function(response)
                        {
                            if (response && Object.keys(response).length > 0) 
                            {
                                vm.alldata=response;
                            }
                        })
                        .fail(function(jqXHR,textStatus,errorThrown)
                        {
                            console.error("AJAX error:", textStatus, errorThrown);
                        });

                        vm.timeoutId = setTimeout(() => 
                        {
                            vm.singleTableCli(table,status);
                        }, 5000);
                    
                },
            },
            mounted(){
                this.fetchTables();
            }
        });
    </script>
</body>