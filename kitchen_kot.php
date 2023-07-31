<?php require_once("header.php"); ?>
<style>
    .table-box{
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .table-s{
        height:50px;
        width:80px;
        background-color:#009879;
        margin:0 10px;
        padding:10px
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
                                <center><h4>Running Tables</h4></center>
                                <div class="table-box">
                                    <div class="table-s" v-for="(table, index) in tables" :key="index.tabno" @click=singleTableCli(table) :class="{ 'highlighted': selectedTable === table.tabno }">
                                        <center><p class="table_name">{{ table.tabno }}</p></center>
                                    </div>
                                </div>
                            </div></br>
                            <!-- <div class="row">
                                <center><h4>Running KOT</h4></center>
                                <div class="table-box">
                                    <div class="table-kot" v-for="(kot, index) in kots" :key="kot.kot_num">
                                        <center><p class="table_name">KOT-{{ kot.kot_num }}</p></center>
                                    </div>
                                </div>
                            </div> -->
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
                        vm.tables=response;
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
                singleTableCli(table)
                {
                    const vm=this;
                    vm.alldata={}
                    vm.selectedTable = table.tabno;
                    var tabno=table.tabno;
                    console.log(tabno)
                    // var tabno="T-1";

                    if (vm.timeoutId) 
                    {
                        clearTimeout(vm.timeoutId);
                    }

                    let log=$.post('ajax/kots_kitchen.php',{tabno:tabno})
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
                            vm.singleTableCli(table);
                        }, 5000);
                    
                },
                // singleKotCli()
                // {
                    
                //     const vm=this;
                //     vm.alldata=[];
                //     for (const kot of this.kots)
                //     {
                //         const kotNum = kot.kot_num;
                //         const url = 'ajax/kots_kitchen.php';
                //         const postData = { kotNum: kotNum };
                //         $.post(url,postData)
                //         .done(data => {
                //                 console.log(data);
                //             })
                //             .fail(function(jqXHR,textStatus,errorThrown)
                //             {
                //                 console.error("AJAX error:", textStatus, errorThrown);
                //             });
                //     }
                // },
            },
            mounted(){
                this.fetchTables();
                // this.singleTableCli();
            }
        });
    </script>
</body>