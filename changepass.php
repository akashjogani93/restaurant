<?php require_once("header.php"); ?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
            .error {
                color: red;
            }

			.box{
				width:100%;
				display:flex;
				justify-content:center;
				padding-top:50px;
			}
        </style>
        
		<script>
                $("#dyna").text("Change Password");
            </script>
        <div class="content-wrapper">
            <!-- <section class="content-header">
                <h1>
                    Change Password Admin Side.
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                </ol>
            </section> -->

            <section class="content">
                <div class="box">
                    <div class="box-body"style="width:50%;">
                    <form action="" method="post" enctype="multipart/form-data">  
          	 	<div class="table-responsive">
          	 	  <table class="table table-bordered">
                    <thead>
                    	<tr>
	                    	<th>Enter Password:</th>
                        	<td><input type="text" name="old" class="form-control form-control-sm" required="" style="border:1px solid #c5cad5;"  placeholder="Old Password">
                        	<input type="text" value="1" name="id" class="form-control form-control-sm" required="" style="display:none;" placeholder="Old Password">
                       
                    	</tr>
                    	<tr>
                    		<th>Create password:</th>
                    		<td><input type="text" name="createpass" id="files" class="form-control form-control-sm"  required="" style="border:1px solid #c5cad5;"placeholder="create new Password"/></td>
                    	</tr>
                    	<tr>
                    		<th>Confirm Password</th>
                    		<td><input type="text" class="form-control form-control-sm" name="confirmpass" required="" title="Select Html File" style="border:1px solid #c5cad5;"placeholder="Confirm Password"></td>
                    	</tr>
                          
                    		<tr>
                    			<td></td>
                    			<td>
                    				<button type="submit" name="New_pass" class="btn btn-sm btn-success col-md-3"style="margin-right:10px;">Submit</button>
                    				<button type="reset" class="btn btn-sm btn-danger col-md-3">Reset</button>
                    			</td>
                    		</tr>
                    	</thead>
                    	</table>
                    </div>
                    </form></br>
                        </div>
                </div>
            </section>


        </div>
    </div>
    <?php require_once("footer.php"); ?>
</body>

<?php  
 //update Password
if(isset($_POST['New_pass']))
{
    include('dbcon.php');

	$old=$_POST['old'];
	$create_pass=$_POST['createpass'];
	$confirm_pass=$_POST['confirmpass'];
    if($create_pass==$confirm_pass)
	{
			$query="SELECT * FROM login WHERE pass='$old' and `type`='admin';";
			$confirm=mysqli_query($conn,$query) or die(mysqli_error());
			if(mysqli_num_rows($confirm) > 0)
			{
				while($row=mysqli_fetch_array($confirm))
				{
					$query="UPDATE `login` SET `pass`='$confirm_pass' WHERE `type`='admin'";
					$confirm=mysqli_query($conn,$query) or die(mysqli_error());
					if($confirm)
					{
						echo "<script>alert('Password Updated');</script>";
						echo "<script>location='logout.php';</script>";
					}
				}
			}else
			{
				echo "<script>alert('Password Wrong, Try Again');</script>";
			}
	}
	else
	{
		echo "<script>alert('Password Mismatch');</script>";
		echo "<script>location='changepass.php';</script>";
	}
}
?>