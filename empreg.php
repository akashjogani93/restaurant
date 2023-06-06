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
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <!-- <li><a href="#">Item Master</a></li> -->
                </ol>
            </section>
            <section class="content">
                <div class="box box-default">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <form class="form-horizontal" name="form1" id="form11" method="post" action="empreginsert.php" enctype="multipart/form-data"> -->
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
                                        <!--<button type="button" data-toggle="modal" data-target="#finalModal" class="btn btn-warning">Add User</button>-->
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
                                                <input type="password" class="form-control" name="password" id="pass" required placeholder="Password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <center>
                                        <button type="submit" class="btn btn-primary" style="padding:10px; padding-left:20px; padding-right:20px;" onclick="subt()">Submit</button>
                                    </center>
                                </div>
                            <!-- </form> -->
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
                                    <th>Emp_Id</th>
                                    <th>Emp_Name</th>
                                    <th>Type</th>
                                    <th>User Name</th>
                                    <th>Password</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql="SELECT * FROM `empreg` WHERE `cap_code`!=0";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['empid']; ?></td>
                                                    <td><?php echo $row['empname']; ?></td>
                                                    <td><?php echo $row['type']; ?></td>
                                              
                                                    <td><?php echo $row['uname']; ?></td>
                                                    <td><?php echo $row['pass']; ?></td>
                                                    <td>
                                                        <!-- <a href="empedit.php?del=<?php echo $row['empid'];?>"
                                                            class="btn btn-danger btn-sm">Delete</a> -->
                                                        <button type="submit" class="btn btn-danger" onclick="handleClick(this)">Delete</button>

                                                    </td>
                                                </tr>
                                            <?php
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