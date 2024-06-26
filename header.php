<?php session_start(); 
include('link.php');
require_once("dbcon.php"); 
if(!isset($_SESSION['tye']))
{
     echo "<script>alert('Please login first');window.location = 'index.php';</script>";
     exit;
}
$cash_type=$_SESSION['tye'];
$cash_id=$_SESSION['id'];
$name=$_SESSION['name'];

$query = "SELECT * FROM `dayshedule` ORDER BY id DESC LIMIT 1";
$runi=mysqli_query($conn,$query);
if(mysqli_num_rows($runi) > 0)
{
    while($rowid=mysqli_fetch_assoc($runi))
    {
        $sheduleid=$rowid['shedule'];
        $sheduledate=$rowid['date'];
    }
}else
{
    $sheduleid=0;
    $sheduledate='';
}

$_SESSION['sheduleid']=$sheduleid;
$_SESSION['sheduledate']=$sheduledate;
$sheduleidday=$_SESSION['sheduleid'];

if($cash_type=='admin' || $cash_type=='Manager')
{
}else
{   
    if($sheduleidday==0)
    {
        echo '<script>alert("Day Is Closed");</script>';
        echo '<script>location="logout.php";</script>';
    }
}
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500;700&display=swap');
    body{
        font-family: 'Roboto Mono', monospace;
    }
    .table-striped>tbody>tr:nth-of-type(odd){
        background-color:rgba(255, 255, 255, 0.4);
    }
    .logos{
        width:16px;
        margin-right:6px;
    }
    .right-align {
        text-align: right;
    }
</style>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <header class="main-header">
            <a href="home.php" class="logo">
                <span class="logo-lg">
                    <img src="img/logo.png" style="object-fit:contain;width:110px;" alt="">
            </span>
            </a>
            <nav class="navbar navbar-static-top">
                <img src="img/slide1.png" alt="" width="35px" height="35px" data-toggle="offcanvas" role="button" id="myImage">
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                    </div>
                    <div class="pull-left info">
                    </div>
                </div>
                <ul class="sidebar-menu">
                  <?php 
                  	if($cash_type=='admin' || $cash_type=='Manager')
                    {
                        ?>
                  			<li><a href="home.php"> <img class="logos" src="img/i1.png" alt=""> <span>Dashboard</span></a></li>
                    		<li><a href="item_form.php"><img class="logos" src="img/i2.png" alt=""> <span>Menu Master</span></a></li>
                    		<li><a href="table_master.php"><img class="logos" src="img/i3.png" alt=""> <span>Tables Master</span></a></li>
                    		<!-- <li><a href="parcel_master.php"><img class="logos" src="img/i4.png" alt=""><span>Parcel Master</span></a></li> -->
                    		<!-- <li><a href="addtable.php"><img class="logos" src="img/i5.png" alt=""><span>Add Table</span></a></li> -->
                    		<li><a href="kitchen_kot.php"><img class="logos" src="img/i5.png" alt=""><span>Kitchen-Kot</span></a></li>
                            <li class="treeview">
                                <a href="#">
                                <img class="logos" src="img/i6.png" alt="">
                                    <span>Store Inventory</span>
                                    <span class="pull-right-container">
                                        <img class="logos" src="img/arrow.png" alt="">
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="store_product.php"><img class="logos" src="img/circle.png" alt=""> Create Product</a></li>
                                    <li><a href="store_purchase_product.php"><img class="logos" src="img/circle.png" alt="">Purchase Stock</a></li>
                                    <li><a href="store_kitchen_given.php"><img class="logos" src="img/circle.png" alt="">Kitchen</a></li>
                                    <li><a href="store_beveragesSale.php"><img class="logos" src="img/circle.png" alt="">Beverages</a></li>
                                    <li><a href="store_parcelmaterial.php"><img class="logos" src="img/circle.png" alt="">Material</a></li>
                                    <li><a href="store_stock.php"><img class="logos" src="img/circle.png" alt="">View Stock</a></li>
                                    <li><a href="wastage.php"><img class="logos" src="img/circle.png" alt="">Wastage Stock</a></li>
                                    <li><a href="store_stock_report.php"><img class="logos" src="img/circle.png" alt="">Purchse Stock</a></li>
                                    <li><a href="vendor_registration.php"><img class="logos" src="img/circle.png" alt="">Vendor Registration</a></li>
                                    <li><a href="purchaseRecords.php"><img class="logos" src="img/circle.png" alt="">Purchase Bills</a></li>
                                    <li><a href="vendor_payment.php"><img class="logos" src="img/circle.png" alt="">Vendor Payment Details</a></li>
                                    <li><a href="individual_payment.php"><img class="logos" src="img/circle.png" alt="">Individual Vendor Payment</a></li>
                                </ul>
                            </li>
                    		<li><a href="create_assets.php"><img class="logos" src="img/i5.png" alt=""><span>Assets</span></a></li>
                            <li><a href="reports.php"><img class="logos" src="img/circle.png" alt="">Reports</a></li>
                            <?php 
                            if($cash_type=='admin')
                            {
                            ?>
                                <li class="treeview">
                                    <a href="#">
                                        <img class="logos" src="img/i7.png" alt=""><span>Employees</span>
                                            <span class="pull-right-container">
                                            <img class="logos" src="img/arrow.png" alt="">
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="active"><a href="empreg.php"><img class="logos" src="img/circle.png" alt="">Registration</a></li>
                                    </ul>
                                </li>
                                <li><a href="manager_edit_bills.php"><img class="logos" src="img/circle.png" alt="">Manager Bills</a></li>
                                <li><a href="login_time.php"><img class="logos" src="img/circle.png" alt="">Login Details</a></li>
                            <?php
                            }
                            ?>
                            <li><a href="changepass.php"><img class="logos" src="img/i4.png" alt=""><span>Change Password</span></a></li>
                            <li><a href="logout.php"><img class="logos" src="img/i4.png" alt=""><span>Logout</span></a></li>
                  		<?php    
                    }else
                    {
                      ?>
                            <script>
                                window.addEventListener('DOMContentLoaded', function() 
                                {
                                    var img = document.getElementById('myImage');
                                    img.click();
                                });
                            </script>
                    		<li><a href="table_master.php"><img class="logos" src="img/i3.png" alt=""> <span>Tables Master</span></a></li>
                  			<li><a href="logout.php"><img class="logos" src="img/i4.png" alt=""><span>Logout</span></a></li>
                  	<?php	
                    }
                  ?>
                </ul>
            </section>
        </aside>
