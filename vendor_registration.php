<?php require_once("header.php");?>
<style>
    .error {
        border-color: red;
    }
    .footerset{
        position: fixed;
        bottom: 0;
        width:100%;
    }
    #example1{
        height:20% !important;
    }
    .tablebox{
        height: 350px;
        overflow-y:scroll;
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
                                            <input type="text" class="form-control" name="vendor" placeholder="Type Here.." v-model="vendor" autocomplete="off" @input="validateVendorName">
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
                                        <label for="inputEmail3" class="col-sm-4 control-label">FSSAI NO:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="fssi" placeholder="Type Here" v-model="fssi" autocomplete="off" @input="validateFssi">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Mobile Number:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="mobile" placeholder="Type Here" v-model="mobile" autocomplete="off" @input="validateMobile">
                                            <span v-if="mobileNameerror" style="color:red" class="error">Number Is Not Valid Or already Used.</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Vendor Address:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="adds" placeholder="Type Here.." v-model="adds" autocomplete="off">
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
                        <table id="example1" class="table">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th style="display:none">id</th>
                                    <th>Vendor Name</th>
                                    <th>GST No</th>
                                    <th>FSSI No</th>
                                    <th>Address</th>
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
                                    <td>{{ item.fssi }}</td>
                                    <td>{{ item.adds }}</td>
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
    <script src="js/kitchen_int.js"></script>
    <script>
        $(document).ready(function()
        {
            const ven_reg=new Vendor();
        });
    </script>
</body>