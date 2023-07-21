<?php require_once("header.php");?>
<style>
    .error {
        border-color: red;
    }
    .footerset{
        position: fixed;
        bottom: 0;
        width:100%;
        /* left: 0;
        width: 100%; */
    }
    #example1{
        height:20% !important;
    }
    .tablebox{
        height: 350px;
        overflow-y:scroll;
    }
</style>
<body class="hold-transition skin-blue sidebar-mini">
    <div id="app">
        <div class="wrapper" id="form1"></div>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Vendor Details
                </h1>
            </section>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Vendor Name:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="vendor" placeholder="Type Here.." v-model="vendor" autocomplete="off">
                                            <input type="hidden" class="form-control" name="id" placeholder="Type Here.." v-model="id" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword3" class="col-sm-4 control-label">GST No:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="gst" placeholder="Type Here.." v-model="gst" autocomplete="off">
                                            <span v-if="gstNameError" style="color:red" class="error">GST No Is Not Valid.</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-5 control-label">Mobile Number:</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="mobile" placeholder="Type Here" v-model="mobile" autocomplete="off" @input="validateMobile">
                                            <span v-if="mobileNameerror" style="color:red" class="error">Number Is Not Valid Or already Used.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>  
                    </div>
                </div>
                <div class="box-footer">
                    <center>
                        <button v-if="!editMode" type="button" class="btn btn-primary" @click="addItem">Register</button>
                        <button v-else type="button" class="btn btn-primary" @click="updateItem">Update</button>
                    </center>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Vendor List</h3>
                    </div>
                    <div class="box-body tablebox">
                        <table id="example1" class="table table-bordered table-striped" style="height:100px !important;">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th style="display:none">id</th>
                                    <th>Vendor Name</th>
                                    <th>GST No</th>
                                    <th>Mobile Number</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in stockList" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td style="display:none">{{ item.id }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.gst }}</td>
                                    <td>{{ item.mobile }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" @click="EditItem(item, index)">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script>
        var app=new Vue({
                el:'#app',
                data:{
                    stockList: [],
                    editMode: false,
                    vendor: '',
                    gst: '',
                    id:'',
                    mobile: '',
                    gstNameError:false,
                    mobileNameerror:false
                },
                mounted(){
                    this.fetchData();
                },
                methods:{
                    fetchData(){
                        const vm=this;
                       let log= $.ajax({
                        url: 'ajax/fetch_vendors.php',
                        method: 'POST',
                        success(response) {
                            vm.stockList=response;
                        },
                        error(xhr, status, error) {
                            console.error(error);
                        }
                    });
                    },
                    validateMobile()
                    {
                        mobile=this.mobile;
                        const regex = /[^\d]/g;
                        if (regex.test(this.mobile)) 
                        {
                            this.mobile = this.mobile.replace(regex, '');
                        }
                    },
                    addItem() 
                    {
                        vendor=this.vendor;
                        mobile=this.mobile;
                        gst=this.gst;
                        if (vendor && mobile && gst) 
                        {
                            // const gstinRegex = /^[0-9A-Z]{2}[0-9A-Z]{10}[0-9A-Z]{1}[1-9A-Z]{1}[0-9A-Z]{2}[0-9A-Z]{2}$/;
                            // if(gstinRegex.test(gst))
                            // {
                            //     console.log('GST Is Valid');
                                
                            // }else
                            // {
                            //     console.log('GST Is Not Valid');
                            //     this.gstNameError=true;
                            //     return;
                            // }

                            if(mobile.length>10 && mobile.length<10)
                            {
                                this.mobileNameerror=false;
                                return;
                            }
                            let log=$.ajax({
                                url:'ajax/vendor_reg.php',
                                type: 'POST',
                                data:{
                                    vendor:vendor,
                                    mobile:mobile,
                                    gst:gst,
                                    insert:'insert'
                                },
                                success : function(response)
                                {
                                    switch(true)
                                    {
                                        case response==3:
                                            alert('Mobile Not Alredy Exists');
                                            break;
                                        case response==2:
                                            alert('Vendor Name Already Used');
                                            break;
                                        case response==1:
                                            alert('Vendor Name And Mobile Number Already Added');
                                            break;
                                        case response==0:
                                            alert("Vendor Registered Successfully");
                                            window.location="vendor_registration.php"
                                        default:
                                            break;
                                    }
                                },
                                error(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                            console.log(log)

                        } else {
                            $('.form-control').removeClass('error');
                            if (!vendor) 
                            {
                                $('input[name="vendor"]').addClass('error');
                            }
                            if (!mobile) 
                            {
                                $('input[name="mobile"]').addClass('error');
                            }
                            if (!gst) 
                            {
                                $('input[name="gst"]').addClass('error');
                            }
                        }

                    },
                    updateItem() 
                    {
                        id=this.id;
                        vendor=this.vendor;
                        mobile=this.mobile;
                        gst=this.gst;
                        if (vendor && mobile && gst) 
                        {
                            const gstinRegex = /^[0-9A-Z]{2}[0-9A-Z]{10}[0-9A-Z]{1}[1-9A-Z]{1}[0-9A-Z]{2}[0-9A-Z]{2}$/;
                            // if(gstinRegex.test(gst))
                            // {
                            //     console.log('GST Is Valid');
                                
                            // }else
                            // {
                            //     console.log('GST Is Not Valid');
                            //     this.gstNameError=true;
                            //     return;
                            // }

                            if(mobile.length>10 && mobile.length<10)
                            {
                                this.mobileNameerror=false;
                                return;
                            }
                            let log=$.ajax({
                                url:'ajax/vendor_reg.php',
                                type: 'POST',
                                data:{
                                    vendor:vendor,
                                    mobile:mobile,
                                    gst:gst,
                                    id:id,
                                    insert:'update'
                                },
                                success : function(response)
                                {
                                    switch(true)
                                    {
                                        case response==3:
                                            alert('Mobile Not Alredy Exists');
                                            break;
                                        case response==2:
                                            alert('Vendor Name Already Used');
                                            break;
                                        case response==1:
                                            alert('Vendor Name And Mobile Number Already Added');
                                            break;
                                        case response==0:
                                            alert("Vendor Updated Successfully");
                                            window.location="vendor_registration.php"
                                        default:
                                            break;
                                    }
                                },
                                error(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                            console.log(log)

                        }else 
                        {
                            $('.form-control').removeClass('error');
                            if (!vendor) 
                            {
                                $('input[name="vendor"]').addClass('error');
                            }
                            if (!mobile) 
                            {
                                $('input[name="mobile"]').addClass('error');
                            }
                            if (!gst) 
                            {
                                $('input[name="gst"]').addClass('error');
                            }
                            // Implementation for updating an item
                        }
                    },
                    EditItem(item, index)
                    {
                        this.editMode=true;
                        this.id= item.id;
                        this.vendor = item.name;
                        this.gst = item.gst;
                        this.mobile = item.mobile;
                    }
                }
        });
    </script>
</body>