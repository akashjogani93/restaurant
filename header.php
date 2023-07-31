<?php session_start(); 
include('link.php');
if(!isset($_SESSION['tye']))
{
     echo "<script>alert('Please login first');window.location = 'index.php';</script>";
     exit;
}
$cash_type=$_SESSION['tye'];
$cash_id=$_SESSION['id'];
$name=$_SESSION['name'];

?>
<style>
    .table-striped>tbody>tr:nth-of-type(odd){
        background-color:rgba(255, 255, 255, 0.4);
    }
    .logos{
        width:16px;
        margin-right:6px;
    }
</style>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <header class="main-header">
            <a href="home.php" class="logo">
                <span class="logo-mini"></span>
                <span class="logo-lg"><img src="img/logo.png" alt=""><b>Oye Shawa</b></span>
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
                    		<li><a href="table_form.php"><img class="logos" src="img/i3.png" alt=""> <span>Tables Master</span></a></li>
                    		<li><a href="parcel.php"><img class="logos" src="img/i4.png" alt=""><span>Parcel</span></a></li>
                    		<li><a href="addtable.php"><img class="logos" src="img/i5.png" alt=""><span>Add Table</span></a></li>
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
                                    <li><a href="add_prodct1.php"><img class="logos" src="img/circle.png" alt=""> Create Product</a></li>
                                    <!-- <li><a href="store_form.php"><img class="logos" src="img/circle.png" alt=""> Purchase Item</a></li> -->
                                    <li><a href="purchase_product.php"><img class="logos" src="img/circle.png" alt="">Purchase Item</a></li>
                                    <!-- <li><a href="kitchen_form.php"><img class="logos" src="img/circle.png" alt=""> Kitchen Inventory</a></li> -->
                                    <li><a href="kitchen_given.php"><img class="logos" src="img/circle.png" alt=""> Kitchen Inventory</a></li>
                                    <li><a href="stockavilable.php"><img class="logos" src="img/circle.png" alt=""> View Stock</a></li>
                                    <li><a href="purchaseRecords.php"><img class="logos" src="img/circle.png" alt="">Purchase Records</a></li>
                                    <li><a href="vendor_registration.php"><img class="logos" src="img/circle.png" alt="">Vendor Registration</a></li>
                                    <li><a href="vendor_payment.php"><img class="logos" src="img/circle.png" alt="">Vendor Payment Details</a></li>
                                    <li><a href="individual_payment.php"><img class="logos" src="img/circle.png" alt="">Individual Vendor Payment</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <img class="logos" src="img/i7.png" alt=""> <span>Employees</span>
                                    <span class="pull-right-container">
                                    <img class="logos" src="img/arrow.png" alt="">
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="active"><a href="empreg.php"><img class="logos" src="img/circle.png" alt="">Registration</a></li>
                                </ul>
                            </li>
                  			<li class="treeview">
                              <a href="#">
                              <img class="logos" src="img/i9.png" alt="">
                                  <span>Reports</span>
                                  <span class="pull-right-container">
                                      <img class="logos" src="img/arrow.png" alt="">
                                  </span>
                              </a>
                              <ul class="treeview-menu">
                                    <li><a href="singlebill_form.php"><img class="logos" src="img/circle.png" alt="">Single Bill</a></li>
                                    <li><a href="billdate.php"><img class="logos" src="img/circle.png" alt=""> Bill Datewise</a></li>
                                    <li><a href="day_calculate.php"><img class="logos" src="img/circle.png" alt=""> <span>Bill Monthwise</span></a></li>
                                    <li><a href="menu_print.php"><img class="logos" src="img/circle.png" alt=""> <span>Menu Master Records</span></a></li>
                                    <li><a href="dailyreport.php"><img class="logos" src="img/circle.png" alt=""> <span>Item Wise Report</span></a></li>
                                    <li><a href="day_amount.php"><img class="logos" src="img/circle.png" alt=""> <span>Day Calculation</span></a></li>
                                    <li><a href="nc_reports.php"><img class="logos" src="img/circle.png" alt=""> <span>NC Single Bill</span></a></li>
                                    <li><a href="nc_itemwise.php"><img class="logos" src="img/circle.png" alt=""> <span>NC Item Wise Reports</span></a></li>
                                    <li><a href="captain_report.php"><img class="logos" src="img/circle.png" alt=""> <span>Captain Report </span></a>
                                    <li><a href="payment.php"><img class="logos" src="img/circle.png" alt=""> <span>Payments</span></a>
                                  </li> 
                              </ul>
                  			</li>
                            <li><a href="kot_trash.php"><img class="logos" src="img/i4.png" alt=""><span>KOT Cancelled</span></a></li>
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
                  			<!-- <li><a href="home.php"> <img class="logos" src="img/i1.png" alt=""> <span>Dashboard</span></a></li> -->
                    		<li><a href="table_form.php"><img class="logos" src="img/i3.png" alt=""> <span>Tables Master</span></a></li>
                  			<li><a href="logout.php"><img class="logos" src="img/i4.png" alt=""><span>Logout</span></a></li>
                  	<?php	
                    }
                  ?>
                </ul>
            </section>
        </aside>
