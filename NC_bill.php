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
                            <b><h5>Sales Nc Report</h5></b>

                            <h6>From: <?php echo $fdate; ?> To <?php echo $tdate; ?></h6>
                        </center>
                        </div>
                    <table id='example1' class='table table-bordered table-striped' >
                        <thead>
                            <tr>
                                <th style="width:60%">Item Name</th>
                                <th style="width:20%">Qty</th>
                                <!-- <th style="width:20%">Amt</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                             require_once("dbcon.php");
                                $sql_item_name = "SELECT DISTINCT `itmno` FROM `tabledata` WHERE `tot`=0 AND `date` BETWEEN '$fdate' AND '$tdate';";
                                $result = mysqli_query($conn, $sql_item_name);
                                $tot=0;
                                if (mysqli_num_rows($result) > 0) 
                                {
                                    $totamt=0;
                                    while($row = mysqli_fetch_assoc($result)) 
                                    {
                                        //echo $i."=>".$row['itmnam']."<br>";
                                        $item = $row['itmno'];
                                        
                                        $sql = "SELECT sum(qty) AS total_qty,itmnam, sum(tot) AS tot, COUNT(billno) AS bill FROM tabledata where `tot`=0 AND itmno='$item' AND `date` BETWEEN '$fdate' AND '$tdate';"; 
                                       
                                        $result1 = mysqli_query($conn, $sql);
                                        
                                        if (mysqli_num_rows($result1) > 0) 
                                        {
                                            $i=1;
                                            
                                            while($row1 = mysqli_fetch_assoc($result1)) 
                                            {
                                                $item = $row1['itmnam'];
                                                $total_qty = $row1['total_qty'];
                                                $tota = $row1['tot'];
                                                $bill = $row1['bill'];
                                                $tot+=$total_qty;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $item; ?></td>
                                                        <td><?php echo $total_qty; ?></td>
                                                        <!-- <td><?php echo $tota; ?></td> -->
                                                    </tr>
                                                <?php
                                                $i++;
                                                
                                            }
                                            
                                        }
                                        $totamt=$totamt+$tota;
                                    }
                                    ?>
                                    </tbody>
                                    <!-- <tfoot>
                                        
                                        <tr>
                                            <td colspan="2" class="text-center"><b><?php echo "Total Amount"; ?></b></td>
                                            <td><b><?php echo $totamt; ?></b></td>
                                        </tr>
                                    </tfoot> -->

                                
                                    <?php
                                    

                                }
                            ?>
                            
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
        window.location.href ="nc_itemwise.php";
    };
}

</script> 
</body>

</html>