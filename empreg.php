<?php require_once("header.php"); ?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
        .error {
            color: red;
        }
        </style>
        <?php
			require_once("header.php");
			require_once("dbcon.php");
            $cnt = 0;
            $sql1 = "SELECT max(empid) FROM empreg";
            $retval1 = mysqli_query($conn, $sql1 );

            if(! $retval1 ) {
                die('Could not get data: ' . mysqli_error($conn));
            }
            while($row1 = mysqli_fetch_assoc($retval1)) {
                $cnt=$row1['max(empid)'];
                $cnt++;
            }
        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Employee Registration
                </h1>
            </section>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Select User</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="type" name="type" required>
                                                <option value="">Select User</option>
                                                
                                            </select>
                                            <label id="useradd"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Emp_Id</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" placeholder="Emp Id" name="empid" id="empid" value="<?php echo $cnt; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword3" class="col-sm-4 control-label">Emp_Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="empname" id='empname' placeholder="Employee Name">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword3" class="col-sm-4 control-label">Mobile</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="mobile" id='mobile' placeholder="Mobile Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="unamepass" style="display:none;">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail3" class="col-sm-4 control-label">User Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="uname" id="uname" required placeholder="User Name">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword3" class="col-sm-4 control-label">Password</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="password" id="pass" required placeholder="Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <center>
                                    <button type="submit" class="btn btn-primary" style="padding:10px; padding-left:20px; padding-right:20px;" onclick="subt()" id="mainSub">Submit</button>
                                    <button type="submit" class="btn btn-danger" style="padding:10px; padding-left:20px; padding-right:20px; display:none;" onclick="subt1()" id="mainedit">Update</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Employee Details</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Cap_code</th>
                                    <th>Emp_Name</th>
                                    <th>Mobile</th>
                                    <th>Type</th>
                                    <?php 
                                        if($cash_type=='admin')
                                        {
                                    ?>
                                            <th>User Name</th>
                                            <th>Password</th>
                                            <th>Edit</th>
                                    <?php 
                                        }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql="SELECT `empreg`.* FROM `empreg`";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) 
                                    {
                                        $i=0;
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                            $id=$row['empid'];
                                            $query="SELECT * FROM `login` WHERE `id`='$id'";
                                            $result1 = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($result1) > 0) 
                                            {
                                                while($row1 = mysqli_fetch_assoc($result1))
                                                {
                                                    $user=$row1['user'];
                                                    $pass=$row1['user'];
                                                }
                                            }else
                                            {
                                                $user='';
                                                $pass='';
                                            }

                                            ?>
                                                <tr>
                                                    <td><?php echo $i+1; ?></td>
                                                    <td><?php echo $row['empid']; ?></td>
                                                    <td><?php echo $row['empname']; ?></td>
                                                    <td><?php echo $row['mobile']; ?></td>
                                                    <td><?php echo $row['type']; ?></td>
                                              
                                                    <?php 
                                                        if($cash_type=='admin')
                                                        {
                                                    ?>
                                                            <td><?php echo $user ?></td>
                                                            <td><?php echo $pass ?></td>
                                                            <td>
                                                                <button class="btn btn-info" id="edit" onclick="getRowValues(event,this.value)" value="<?php echo $row['empid']; ?>">Edit</button>
                                                            </td>
                                                    <?php 
                                                        }
                                                    ?>
                                                </tr>
                                            <?php
                                            $i++;
                                        }
                                    }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Edit</h4>
                                </div>
                                <form class="form-horizontal" method="post" action="empedit.php" id="editform"
                                    enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <!-- Horizontal Form -->

                                            <!-- /.box-header -->
                                            <!-- form start -->

                                            <div class="box-body">

                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">Select
                                                        User</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control typeone" id="typeone" name="type" required>
                                                            <option value="">Select User</option>
                                                            <option value="Captain">Captain</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail3"
                                                        class="col-md-4 control-label">Emp_Id</label>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" placeholder="empid"
                                                            name="empid" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword3"
                                                        class="col-sm-4 control-label">Emp_Name</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="empname"
                                                            placeholder="Emp Name" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail3"
                                                        class="col-sm-4 control-label">Address</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="address"
                                                            placeholder="Address" required>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword3"
                                                        class="col-sm-4 control-label">Mobile</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="mobile"
                                                            placeholder="Mobile" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword3"
                                                        class="col-sm-4 control-label">ID</label>
                                                    <div class="col-sm-6">
                                                        <input type="file" class="form-control" name="upl1"
                                                            placeholder="ID">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                <label for="inputPassword3" class="col-sm-4 control-label">Bank Passbook</label>
                                                    <div class="col-sm-6">
                                                        <input type="file" class="form-control" name="upl2" placeholder="ID" accept="image/*">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Monthly
                                                        Salary</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="salary"
                                                            placeholder="Salary" required>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12" style="display: none;">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">User Name
                                                    </label>
                                                    <div class="col-sm-6">
                                                        <input type="text" id="unamefield" class="form-control"
                                                            name="uname" placeholder="User Name">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12" style="display: none;">
                                                    <label for="inputPassword3" class="col-sm-4 control-label">Password
                                                    </label>
                                                    <div class="col-sm-6">
                                                        <input type="password" id="passfield" class="form-control"
                                                            name="password" placeholder="Password">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- /.modal -->
                    <div class="modal fade" id="finalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><b>Add User</b></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="box-body form1">
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputFile">User</label>
                                            <input type="text" class="form-control" id="user" placeholder="user">
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
    <?php include('footer.php'); ?>
    
    <script src="js/empreg.js"></script>
    <script>
        $(".edit").click(function(e) 
        {
            var tar = e.currentTarget;
            var chil = tar.parentElement.parentElement.children;
            var form = $("#editform input");
            console.log(form[3].value);
            $('#typeone').val(chil[2].innerHTML);
            form[0].value = (chil[0].innerHTML);
			form[1].value = (chil[1].innerHTML);
			form[2].value = (chil[3].innerHTML);
			form[3].value = (chil[4].innerHTML);
			form[6].value = (chil[7].innerHTML);
        });
    </script>
</body>