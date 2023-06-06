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
        padding: 8px;
        line-height: 1 !important;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }

@page{
    margin:0;
    padding:0;
}
.box-body{
    width:100%;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 1px !important;

}
    
    </style>
       <?php require_once("header.php"); ?>
        <?php
            $tdate = $_GET['tdate'];
            // $tabsec = $_GET['tabsec'];
            $fdate = $_GET['fdate'];

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
                             <center><b><h5>SHIVA HOTEL</h5></b>
                            <h6>MAKANUR CROSS, NH4</h6>
                            <h6>RANEBENNUR</h6>
                            <?php 
                                    $new_date = date("d/m/Y", strtotime($fdate));
                                    $new_date1 = date("d/m/Y", strtotime($tdate));
                                ?>
                                <h6>From: <?php echo $new_date; ?> TO <?php echo $new_date1; ?></h6>
                            <b><h5>Sales Amount-Month Wise</h5></b>
                        </center>
                        </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:60%;" class="text-center">Bill Date</th>
                                <th style="width:40%;" class="text-center">Bill Amount</th>
                            </tr>
                        </thead>
                        <tbody id="tb">
                            <?php
                                require_once("dbcon.php");
                                $online=0;
                                $grandTotal = 0;
                                $discount=0;
                          $tot_amount=0;
                               
                                    $sql3= "select slno, SUM(gndtot) as gndtot, date, discount, SUM(gstamt) AS gsttot, SUM(nettot) AS netprc,SUM(discount) AS discount, paymentmode from tabletot WHERE date BETWEEN '$fdate' AND '$tdate' GROUP BY DAY(date)";
                                    
                               
                                    $result = mysqli_query($conn, $sql3);
                                   // var_dump($result);
                                    $result2= mysqli_query($conn, $sql3);
                                    $res= mysqli_fetch_assoc($result2);
                                    if (mysqli_num_rows($result) > 0) 
                                    {
                                        // output data of each row
                                        
                                        while($row = mysqli_fetch_assoc($result)) 
                                        {
                                            $grandTotal += $row['gndtot'];
                                            $discount +=$row['discount'];

                                        ?>
                                        <tr>
                                            <td><span style="margin-left:5px;"><?php echo date("d-M-Y", strtotime( $row['date'])); ?></span></td>
                                            <!--<td><?php echo $row['slno']; ?></td>-->
                                            <td class="text-right"><span style="margin-right:20px;"><?php echo number_format($row['gndtot'],2); ?></span</td>
                                            <!--  <td><?php echo $row['grdtot']; ?></td>-->
                                            <!-- <td><?php echo $row['discount']; ?></td>
                                            <td><?php echo $row['paymentmode']; ?></td> -->
                                        </tr>
                                        <?php  if($row['paymentmode']=="online"){$online+=$row['gndtot'];  }
                                          $tot_amount=$tot_amount+$row['gndtot'];
                                    } }  ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-center"><b><?php echo "Total Amount"; ?></b></td>
                                        <td class="text-right"><b style="margin-right:20px;"><?php echo number_format($tot_amount,2); ?></b></td>
                                    </tr>
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
    window.onafterprint = function(event)
    {
        window.location.href ="billmonthwise.php";
    };
}

</script> 
</body>

</html>