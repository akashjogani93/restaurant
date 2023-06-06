<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error{color: red;}
        </style>
        <?php require_once("header.php"); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Stock Inventary
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <!-- <li><a href="#">Stock Master</a></li> -->
                </ol>
            </section>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="box-body">
                        <form class="form-horizontal" role="form" action="add_table.php" method="post">
                            <div class="col-md-2">
                                <label for="inputPassword3" class="control-label">Name of Product</label>
                                <input type="text" id="form-field-1"  placeholder="Name of Product"  name="p1" class="form-control" required="required" />
                            </div>
                            <div class="col-md-2">
                                    <button class="btn btn-info" type="Submit" style="margin-top:25px;">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                            Submit
                                    </button>
                            </div>
                            <!-- <div class="col-md-2">
                                <button class="btn" type="reset" style="margin-top:25px;">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                            Reset
                                </button>
                            </div> -->
                            </form>
                        </div>
                    </div>
                    <div class="row">
                    </div></br>
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="clearfix">
                                <div class="pull-right tableTools-container">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- <div class="table-header">Detail / Per Month </div> -->
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>                                                        
                                                <th>Product ID</th>
                                                <th>Product Name</th>                                                    
                                                <th>Edit</th>
                                                <!-- <th>Delete</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            include("dbcon.php");
                                            $sql = "SELECT * FROM products";
                                            $retval = mysqli_query($conn,$sql);
                                            if(! $retval )
                                            {
                                                die('Could not get data: ' . mysqli_error($conn));
                                            }
                                            while($row = mysqli_fetch_assoc($retval))
                                            { 
                                                ?>
                                                    <tr>                                                    
                                                        <td><?php echo $row['pid']; ?></td>                                                   
                                                        <td><?php echo $row['pname']; ?></td>
                                                        <!-- <td><a href="add_prodct1.php?id=<?php echo $row['pid'];?> "><button class="btn btn-info" type="submit">
                                                        <i class="ace-icon fa fa-check bigger-110"></i>EDIT</button></td> -->
                                                        <td><button v-on:click="editItem($event)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#category">
                                                            <i class="fa fa-fw fa-edit"></i>Edit
                                                            </button>
                                                        </td>

                                                        <!-- <td><a href="#?id=<?php echo $row['pid'];?> "><button class="btn btn-danger" type="submit">
                                                        <i class="ace-icon fa fa-trash bigger-110"></i>DELETE</button></td> -->
                                                        <!-- <td><a href="ajax/create_p.php?del1=<?php echo $row['pid'];?>"
                                                            class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i>Delete</a>
                                                        </td> -->
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><b>Edit Table</b></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="box-body form1">
                                                <div class="form-group col-md-12">
                                                    <label for="exampleInputFile">Product Name</label>
                                                    <input type="text" class="form-control" id="tno" placeholder="product Name">
                                                    <input type="hidden" class="form-control" id="tid" placeholder="tableno">
                                                    <label id="empty"></label>
                                                </div>
                                            </div>
                                            <div class="box-footer">
                                                <button type="submit" onclick="submit();" id="adduser" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <section>
            <script>
                $(function () {
                    $("#dynamic-table").DataTable();
                    $('#example2').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false
                    });
                });

                function submit() 
                {
                    $("#empty").fadeIn();
                    // $("#catsus").fadeIn();
                    let cat = $('#tno').val();
                    let tid = $('#tid').val();
                    if (cat != "" & tid != "") 
                    {
                        $.ajax({
                            url: 'ajax/create_p.php',
                            type: "POST",
                            data: {
                                tedit : cat,tid: tid
                            },
                            success: function(data) 
                            {
                                alert(data);
                                window.location.href="add_prodct1.php";
                            }
                        });
                    }else{
                        $('#empty').html(`<span style='color:red'>Empty field..</span>`);
                        $("#empty").fadeOut(1000);
                    }
                }

                var app = new Vue({
                    el: '#dynamic-table',
                    
                    methods: {
                        editItem : function(e) 
                        {
                            var tar = e.currentTarget;
                            var chil = tar.parentElement.parentElement.children;
                            var form = $("#category input");
                            console.log(form);
                            form[0].value = (chil[1].innerHTML);
                            form[1].value = (chil[0].innerHTML);
                        }
                    }
                });
        </script>
        </div>
    </div>
</body>
</html>