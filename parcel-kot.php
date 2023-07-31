<body class="hold-transition skin-blue sidebar-mini"onload="myFunction()">
    <div class="wrapper" id="form1">
    <style>
    *{
        font-size:11pt;
    }
   
    .fst{
        padding:0 4px;
        display:flex;
        justify-content:space-between;
    }
    th {
   
    font-weight:600;
    padding:0 !important;
        font-size:12px;
        margin:0;
        color:black;
}
td{
   
    padding:4px 0!important;
    font-weight:600;
    padding:0 !important;
        font-size:12px;
        margin:0;
        color:black;
}
.box-body{
    width:100%;
    justify-content:center ! important;
    padding:0px !important;
}
@page{
    margin:0;
    padding:0;
}
h5 {
    margin: 2px !important;
    font-size: 12px !important;
    font-weight: 600 !important;
    color: black;
}

.fst h6 {
    margin: 2px !important;
    font-size: 12px;
    font-weight: 600 !important;

    color: black;

}
      tbody{
        border-bottom:solid 2px #000;
      }
    </style>
        <?php require_once("header.php"); 
            require_once("dbcon.php"); 
            if(isset($_GET['tabno']))
            {
                $current_date = date('Y-m-d');
                $tab1=$_GET['tabno'];
                $sql="SELECT * FROM `kot` WHERE `kot`=0 AND `tabno`='$tab1' AND `date`='$current_date'";
                $c=mysqli_query($conn, $sql);
                if (mysqli_num_rows($c) > 0)
                {
                    // $sql1="SELECT `capname` FROM `temtable` WHERE `kot`=1 AND `tabno`='$tab1'";
                    // $c1=mysqli_query($conn, $sql1);
                    // while($row1 = mysqli_fetch_assoc($c1)) 
                    // { 
                    //     $cap= $row1['capname'];
                    // }
                    $sqlkot="SELECT MAX(`kot_num`) AS `kotnumber` FROM `kot_history` WHERE `date`='$current_date'";
                    $c111=mysqli_query($conn, $sqlkot);
                    $kotrow=mysqli_num_rows($c111);
                    if($kotrow > 0)
                    {
                        
                        while($row111 = mysqli_fetch_assoc($c111)) 
                        {
                            $kotnumber= $row111['kotnumber']+1;
                        }
                    }else
                    {
                        $kotnumber=1;
                    }
                    $c11=mysqli_query($conn, $sql);
                    while($row11 = mysqli_fetch_assoc($c11)) 
                    {
                        $kot_num= $row11['kot_num'];
                    }

                    
                }else
                {
                    echo '<script>alert("No New Items.!");</script>';
                    echo '<script>location="parcel.php";</script>';
                }      
        ?>
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content">
                <!-- Table -->
                <div class="box" >
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="fst">
                                    <h5 style="text-align:center;">
                                    <b>OYE SHAWA
                                    </h5>
                                  <h5 style="text-align:center;">
                                   KOT BILL</b>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="fst" style="">
                                    <!-- <h5>KOT/CHECK LIST</h5> -->
                                    <h5>Parcel NO-<?php echo $tab1; ?></h5>
                                    
                                    <h5><?php 
                                            $current_date = date('d-m-Y');
                                            echo $current_date;
                                    ?></h5>
                                    
                                </div>
                            </div>
                       </div>
                       <div class="row">
                            <div class="col-md-12">
                                <div class="fst" style="">
                                <h5>Kot No-<?php echo $kotnumber; ?></h5>
                               
                                    <h6><?php
                                        date_default_timezone_set('Asia/Kolkata');
                                        $current_time = date("h:i:s A");
                                        echo $current_time;
                                        ?></h6>
                                    <!-- <h5>Waiter-<?php echo $cap; ?></h5> -->
                                </div>
                            </div>
                       </div>
                       
                       <hr style="margin:0; padding:2px 0; font-weight:10px;width:100%;">
                        <div class="row">
                            <div class="col-md-12">
                            <table style="width:99%; margin-left:auto; margin-right:auto;">

                                    <thead>
                                        <tr>
                                            <!-- <th style="width:10%;" class="text-left">No</th> -->
                                            <th style="width:70%;" class="text-left">Item Name</th>
                                            <th style="width:20%;" class="text-right">Quantity</th>
                                        </tr >
                                    </thead >
                                        <tbody >
                                            
                                            <tr style="border-bottom:1px solid #eee; margin-top:10px;"></tr>
                                            <?php 
                                                    $i=0;
                                                    while($row = mysqli_fetch_assoc($c)) 
                                                    { 
                                                        ?>
                                                        <tr style="border-top:1px solid #eee;margin:5px 0;">
                                                            <!-- <td class="text-left"><?php echo $i=$i+1; ?></td> -->
                                                            <td class="text-left"><?php echo $row['itmnam']; ?></td>
                                                            <td class="text-right"><?php echo $row['qty']; ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                
                                            ?>
                                        <!-- <tr>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>vada sambar</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>vada sambar</td>
                                            <td>2</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- End Table -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
      


        </div>
        <?php
        
    }
        ?>

    <script type="text/javascript">
//    function printcontent(el) {
//  var w = window.open();
//           var restorepage = document.body.innerHTML;
//           console.log(restorepage);
//           var printcontent = document.getElementById(el).innerHTML;
//           w.document.body.innerHTML = printcontent;
//         w.window.print();
//          w.onafterprint = function(event) {
//              w.close()
//           }
//     w.document.body.innerHTML=restorepage;
//         w.close();
//   window.location="table_form.php";
//     }

<?php $tab=$_GET['tabno']?>

function myFunction() 
{
   window.print();
   var tab ="<?php echo $tab; ?>";
   var kotnumber ="<?php echo $kotnumber; ?>";
    //    window.onafterprint = function(event) {
        window.location.href ="kot-parcel_cancel.php?tab=" + tab + "&kotnumber=" + kotnumber;
    // };
         
}

    </script>
</body>

</html>
