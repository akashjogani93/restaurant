<body class="hold-transition skin-blue sidebar-mini"onload="myFunction()" >
    <div class="wrapper" id="form1">
    <style>
        body{
            background-color:white;
        }
    *{
        font-size:11pt;
    }

    th{
        font-size:12px;
        font-weight:600;
    }
    td{
        font-size:12px;
        
    }
    span{
        font-size:12px;
    }
    h5{
        font-size: 12px;
        margin-top: -7px !important;
        margin-bottom: 8px !important;
        font-weight:700 !important;
    }
    h6{
        font-size: 10px;
        margin-top: -7px !important;
    margin-bottom: 8px !important;
    }

    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 2px;
        line-height: 1 !important;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
@media print {
        @page {
            padding:0;
margin:0;
        }
        
    }
.box-body{
    width:100%;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 1px !important;

}
    
    </style>
       <?php //require_once("header.php"); ?>
        <?php
            // $tdate = $_GET['tdate'];
            // $tabsec = $_GET['tabsec'];
            $fdate = $_GET['fdate'];
            //some new one

        ?>
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="mainprint" style="background-color:white;">
            <!-- Content Header (Page header) -->
            <section class="content">
                <!-- Table -->
                <div class="box" >
                    <!-- /.box-header -->
                    <div class="box-body">
                    <div class="col-md-12 addres">
                             <center><b>
                                <!-- <h5>SHIVA HOTEL</h5></b>
                            <h6>MAKANUR CROSS, NH4</h6>
                            <h6>RANEBENNUR</h6> -->
                            <b><h5>Sales Day Calculation-Amount Wise</h5></b>

                            <h6>Date: <?php echo $fdate; ?></h6>
                        </center>
                        </div>
                    <table id="example1" class="table table-bordered table-striped" style="width:100%;">
                        <thead>
                            
                        </thead>
                        <tbody id="tb">
<tr>
                                <th style="width:33%">Bill NO</th>
                               
                                <th style="width:34%">Bill Amount</th>
                                <th style="width:33%">Payment</th>
                            </tr>
                            <?php
                                require_once("dbcon.php");

                                $sql = "SELECT * FROM `tabletot` WHERE `date`='$fdate' ";
                               
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) 
                                {

                                    $net11=0;
                                    while($row = mysqli_fetch_assoc($result)) 
                                    {
                                        $amount=round($row['nettot']);
                                        $net11 +=round($row['nettot']);
                                        $disamt1=$row['disamt'];
                                      ?>
                                       <tr>
                                                <td style="width:33%"><?php echo $row['slno']; ?></td>
                                              
                                                <td style="width:34%"><?php echo number_format($amount,2); ?></td>
                                                <td style="width:33%"><?php echo $row['paymentmode']; ?></td>
                                            </tr>
                                          <?php 
                                    }

                                }
                            ?>
 <tr>
                                <td class="text-center"><b><?php echo "Total"; ?></b></td>
                                
                                <td  class="text-right" colspan="2"><b style="margin-right:5px;"><?php echo number_format(round($net11) ,2); ?></b></td>
                            </tr>
                        </tbody>
                        <tfoot>
                           
                        </tfoot>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="jquery.PrintArea.js"></script>
    <script type="text/javascript">

function myFunction()
{
    window.print();
    // window.onafterprint = function(event)
    // {
        window.location.href ="payment.php";
    // };
}

</script> 
</body>

</html>