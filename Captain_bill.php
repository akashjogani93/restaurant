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
                             <center>
                                <!-- <b><h5>SHIVA HOTEL</h5></b>
                            <h6>MAKANUR CROSS, NH4</h6>
                            <h6>RANEBENNUR</h6> -->
                            <b><h5>Sales Amount-Captain Wise</h5></b>

                            <h6>From: <?php echo $fdate; ?> To <?php echo $tdate; ?></h6>
                        </center>
                        </div>
                    <table id='example1' class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th>Sl/no</th>
                                        <th> Captain  Name</th>
                                        <th>Captain Sale</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 

                                        require_once("dbcon.php");
                                        
                                        $sql_item_name = "SELECT DISTINCT `capnam`,SUM(`nettot`) AS NET ,`date` FROM `tabletot` WHERE `date` BETWEEN '$fdate' AND '$tdate' GROUP BY `capnam`";
                                          $result = mysqli_query($conn, $sql_item_name);
                                        if (mysqli_num_rows($result) > 0) 
                                        {
                                            $sn=1;
                                           $total=0;
                                            while($row = mysqli_fetch_assoc($result)) 
                                            {
                                                if($row['capnam']=="")
                                                {
                                                    $capname="Parcel";
                                                }else{ $capname=$row['capnam'];}
                                                $tot=$row['NET'];
                                                $total=$total+$tot;
                                                ?>
                                                <tr>
                                                    <td><?php echo $sn++; ?></td>
                                                    <td><?php echo $capname; ?></td>
                                                <td><?php echo number_format(round($tot),2);?></td>
                                                </tr>
                                                
                                <?php		}
                                               
                                        }
                                        
                                   ?>
								</tbody>
                                <tfoot>
                                        
                                        <tr>
                                            <td colspan="2" class="text-center"><b><?php echo "Total Amount"; ?></b></td>
                                            <td><b><?php echo number_format(round($total),2); ?></b></td>
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
    // window.onafterprint = function(event)
    // {
        window.location.href ="captain_report.php";
    // };
}

</script> 
</body>

</html>