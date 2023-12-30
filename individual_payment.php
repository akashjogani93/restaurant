<?php require_once("header.php"); ?>
<style>
    .error{color: red;}
    .highlight-row {
        background-color: yellow !important;
    }
    .th-texts{
        padding:10px; font-size:18px;
    }
    .th-amounts{
        padding:10px; font-size:16px;
    }
    .th-texts1{
        padding:10px; font-size:18px; background-color:#E4F2F9
    }
                .th-amounts1{
                    padding:10px; font-size:16px; background-color:#E4F2F9
                }
                .payment-but{
                    padding:10px;
                }
                .dymic{
                    width:35%; background-color:#fff;
                }
                .thea{
                    border: 1px solid black important; padding:20px;
                }
                .pamt{
                    border-color: #0a5f81;
                }
                .table>thead
                {
                    background-color:grey;
                    color:white;
                }
            .table{
                    border-collapse: collapse;
                }
                .table th,
                .table td 
                {
                    border: 1px solid black;
                    padding: 5px;
                }
            </style>
<body class="hold-transition skin-blue sidebar-mini">
    <div id="app">
        <div class="wrapper" id="form1">
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Individual Vendor Payment
                    </h1>
                </section>
                <section class="content">
                    <div class="box box-default">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Select Vendor</label>
                                            <div class="col-sm-8">
                                                <select name="pname" id="pid" required class="form-control pname" v-model="vendorOption" @change="vendorChange">
                                                    <option value="">Select Vendor</option>
                                                    <option v-for="ven in vens" :value="ven.slno">{{ ven.vendor }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Payment List</h3>
                        </div>
                        <div class="box-body tablebox">
                            <table id="dynamic-table" class="table">
                                <thead>
                                    <tr>
                                        <!-- <th>Sl No</th> -->
                                        <th>Payment Date</th>
                                        <th>Amount</th>
                                        <th>Paid</th>
                                        <th>Remain</th>
                                        <!-- <th>Pending</th> -->
                                        <th>Discount</th>
                                        <!-- <th>settled</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in paymentList" :key="item.id" :class= "{'highlight-row':item.settle==1}">
                                        <!-- <td>{{ index + 1 }}</td> -->
                                        <td>{{ item.date }}</td>
                                        <td class="right-align">{{ item.amt }}</td>
                                        <td class="right-align">{{ item.paid }}</td>
                                        <!-- <td>{{ item.remain }}</td> -->
                                        <td class="right-align">{{ item.remain }}</td>
                                        <td class="right-align">{{ item.disc }}</td>
                                        <!-- <td>{{ item.settle }}</td> -->
                                    </tr>
                                </tbody>
                            </table></br></br>
                            <div>
                                <center><table id="dynamic-table" class="dymic">
                                    <thead v-if="paymentList.length > 0" class="thea">
                                        <tr>
                                            <th class="font-weight-bold text-primary th-texts">Amount To Pay:</th>
                                            <th class="font-weight-bold text-danger th-amounts">
                                                {{
                                                    paymentList.length > 0
                                                        ? (paymentList.reduce((sum, payment) => sum + (parseFloat(payment.amt) - parseFloat(payment.paid)), 0)).toFixed(2)
                                                        : 0
                                                }}
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="font-weight-bold text-primary th-texts1">Pay Amount:</th>
                                            <th class="font-weight-bold text-danger th-amounts1"><input type="number" class="form-control pamt" name="pamt" placeholder="Paid Amount" v-model="amount" id="pamt" @keypress="restrictNonNumeric" @input="updatePaid"></th>
                                        </tr>
                                        <!-- <tr>
                                            <th class="font-weight-bold text-primary th-texts1">Discount Amount:</th>
                                            <th class="font-weight-bold text-danger th-amounts1"><input type="number" class="form-control pamt" name="pamt" placeholder="Discount Amount" v-model="discount" id="discount" @keypress="restrictNonNumeric" @input="discAmount"></th>
                                        </tr> -->
                                        <!-- <tr>
                                            <th class="font-weight-bold text-primary th-texts">Remain Amount:</th>
                                            <th class="font-weight-bold text-danger th-amounts">{{ pending }}</th>
                                        </tr> -->
                                        <tr>
                                            <th class="font-weight-bold text-primary payment-but"><button class="btn btn-danger" @click="settleBill">Payment</button></th>
                                        </tr>
                                    </thead>
                                    <!-- <p v-else>No payments found.</p> -->
                                </table></center>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script>

                $(function () {
                    // $("#dynamic-table").DataTable({
                    //     columnDefs: [
                    //         { "orderable": false, "targets": -1 }
                    //     ]
                    // });

                    // $('#example2').DataTable({
                    //     "paging": true,
                    //     "lengthChange": false,
                    //     "searching": false,
                    //     "ordering": true,
                    //     "info": true,
                    //     "autoWidth": false
                    // });
                });

        var app=new Vue({
            el:'#app',
            data:{
                vendorOption:'',
                vens: [],
                paymentList:[],
                amount: 0,
                discount:0,
                pending:0,
            },
            mounted() {
                this.fetchOptions();
            },
            methods:{
                fetchOptions()
                {
                    const vm=this;
                    let log=$.ajax({
                        url: 'ajax/fetch_options.php',
                        method: 'POST',
                        data:{ven:'ven'},
                        success(response) 
                        {
                            vm.vens = response;
                        },
                        error(xhr, status, error) 
                        {
                            console.error(error);
                        }
                    });
                },
                vendorChange()
                {
                    const vm=this;
                    vendorOption=this.vendorOption;
                    if (vendorOption!='')
                    {
                        $.post('ajax/fetch_options.php',{ vendorOption: vendorOption })
                            .done(function(response) 
                            {
                                vm.paymentList=response;
                            })
                            .fail(function(jqXHR, textStatus, errorThrown) {
                                console.error("AJAX error:", textStatus, errorThrown);
                            });
                    }else
                    {
                        vm.paymentList=[];
                    }

                },
                settleBill()
                {
                    const vm=this;
                    const amountPay = parseFloat(this.amount);
                    const amountDiscount = parseFloat(this.discount);
                    const pendingAmount = this.paymentList.reduce((sum, payment) => sum + parseFloat(payment.remain), 0);
                    vendorOption=this.vendorOption;
                    if (isNaN(amountPay)) 
                    {
                        this.amount = 0;
                    }
                    console.log(amountPay,amountDiscount,pendingAmount,vendorOption)
                    if (amountPay!=0 && pendingAmount!=0)
                    {
                        $.post('ajax/fetch_options.php',{ 
                            amountPay:amountPay,
                            discount :amountDiscount,
                            pendingAmount:pendingAmount,
                            vendorName:vendorOption
                        })
                        .done(function(response)
                        {
                            console.log(response);
                            vm.vendorChange();
                            vm.amount=0;

                        })
                        .fail(function(jqXHR, textStatus, errorThrown)
                        {
                            console.error("AJAX error:", textStatus, errorThrown);
                        })
                    }

                },
                updatePaid(event)
                {
                    const amountPay = parseFloat(this.amount);
                    const amountDiscount = parseFloat(this.discount);
                    const pendingAmount = this.paymentList.reduce((sum, payment) => sum + parseFloat(payment.remain), 0);
                    if (isNaN(amountDiscount)) 
                    {
                        this.discount = 0;
                    }

                    const renameAmount=pendingAmount-amountDiscount;

                    const finalAmount=pendingAmount-(amountPay+amountDiscount);

                    if(amountPay > pendingAmount-amountDiscount)
                    {
                        this.amount=renameAmount;
                        this.pending=0;
                    }else
                    {
                        this.pending=finalAmount;
                    }
                },
                discAmount(event)
                {
                    const amountPay = parseFloat(this.amount);
                    const amountDiscount = parseFloat(this.discount);
                    // const pendingAmount=this.paymentList[this.paymentList.length - 1].pending;
                    const pendingAmount = this.paymentList.reduce((sum, payment) => sum + parseFloat(payment.remain), 0);
                    if (isNaN(amountPay)) 
                    {
                        this.amount = 0;
                    }
                    const renameAmount=pendingAmount-amountPay;
                    const finalAmount=pendingAmount-(amountPay+amountDiscount);
                    if(amountDiscount > renameAmount)
                    {
                        this.discount=renameAmount;
                        this.pending=0;
                    }else
                    {
                        this.pending=finalAmount;
                    }

                    
                },
                restrictNonNumeric(event) 
                {
                    const keycode = event.keyCode ? event.keyCode : event.which;

                    if ((keycode >= 48 && keycode <= 57) || keycode === 8) 
                    {
                        return true;
                    } else {
                        event.preventDefault();
                        return false;
                    }
                }
            }
        });
    </script>
</body>