<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
        .error{color: red;}</style>
        <?php require_once("header.php"); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Tables
                </h1>
                <!-- <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>            
                </ol> -->
            </section>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="box-body">
                        <form class="form-horizontal" role="form" action="add_table.php" method="post">
                            <div class="col-md-2">
                                <label for="inputPassword3" class="control-label" id="checku">Table Name</label>
                                <input type="text" id="form-field-1" placeholder="Table Name" name="t1" class="form-control" required="required" onInput="checku()"/>
                                <input type="hidden" id="form-field-1" placeholder="" name="t11" value="buildclean" class="col-xs-10 col-sm-5" />
                            </div>
                            <div class="col-md-3">
                                <label for="inputPassword3" class="control-label">Select AC/NonAc</label>
                                <select class="form-control" name="ac" id="ac">
                                    <option>Non Ac</option>
                                    <option>Ac</option>
                                  	<option>Non-Chargeable</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-info" type="Submit" id="sub1" style="margin-top:25px;">
                                    Submit
                                </button>
                            </div>
                            </form>
                        </div>
                        
                    </div>
                    <div class="row" >
                        <!-- <div class="col-md-12">
                            <form class="form-horizontal" role="form" action="add_table.php" method="post">
                                <div class="form-group">
                                    <div class="col-md-9">
                                        &nbsp;&nbsp;<input type="hidden" id="form-field-1" placeholder="" name="t1" value="buildclean" class="col-xs-10 col-sm-5" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Table Name</label>
                                    <div class="col-md-9">
                                        &nbsp;&nbsp;<input type="text" id="form-field-1" placeholder="Table Name" name="t1" class="col-xs-10 col-sm-5" required="required" />
                                    </div>
                                </div>
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button class="btn btn-info" type="Submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            Submit
                                        </button>
                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i>
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>   -->
                        <div class="col-md-12">
                            <?php
                                include("dbcon.php");
                                $sql = "SELECT * FROM addtable";
                                $retval = mysqli_query($conn,$sql);
                                 $i=1;
                                if(! $retval )
                                {
                                  die('Could not get data: ' . mysqli_error($conn));
                                }
                            ?>                                                 
                            <div class="clearfix">
                                <div class="pull-right tableTools-container"></div>
                            </div>
                            <div class="col-md-12">
                                <!--<div class="table-header">Detail / Per Month </div>-->
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>                                                        
                                            <th>SlNo.</th>
                                            <th style="display:none;">table number</th>
                                            <th>Table Name</th>
                                            <th>AC/Non</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row=mysqli_fetch_array($retval))
                                            {
                                                ?>
                                                <tr>                                                    
                                                    <td><?php echo $i; ?></td>
                                                    <td style="display:none;"><?php echo $row['table_ID']; ?></td>
                                                    <td><?php echo $row['table_Name']; ?></td>
                                                    <td><?php echo $row['ac']; ?></td>
                                                    <td><button v-on:click="editItem($event)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#category">
                                                           Edit
                                                        </button>
                                                    </td>
                                                    <td><a href="ajax/addcate.php?del1=<?php echo $row['table_ID'];?>"
                                                            class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php
                                               $i=$i+1;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>    
                        </div>    
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
                                            <label for="exampleInputFile" id="checku1">Table no</label>
                                            <input type="text" class="form-control" id="tno" placeholder="tableno" onInput="checku1()">
                                            <input type="hidden" class="form-control" id="tid" placeholder="tableno">
                                            <label id="empty"></label>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <select class="form-control" name="ac1" id="ac1">
                                                <option>Non Ac</option>
                                                <option>Ac</option>
                                              	<option>Non-Chargeable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" onclick="submit();" id="adduser" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </section>
        </div>
        <?php require_once("footer.php"); ?>
        <div class="control-sidebar-bg"></div>
    </div>
    <script>
        
    function checku()
    {
        // alert('hi');
        var tab=$("#form-field-1").val();
        // alert(tab)
        jQuery.ajax({
            url:'ajax/accnum.php',
            data:{tab:tab},
            type:"POST",
            success:function(data){
                $("#checku").html(data);
            },
            error:function(){}

    });
    }

    function checku1()
    {
        // alert('hi');
        var tab=$("#tno").val();
        var tid=$("#tid").val();
        // alert(tab)
        jQuery.ajax({
            url:'ajax/accnum.php',
            data:{tab1:tab,tid:tid},
            type:"POST",
            success:function(data){
                $("#checku1").html(data);
            },
            error:function(){}

    });
    }
    </script>
    <script src="js/addtable.js"></script>

    </body>
</html>
