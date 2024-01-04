<?php require_once("header.php");?>
<body class="hold-transition skin-blue sidebar-mini"onload="myFunction()">
    <div class="wrapper" id="form1">
        <style>
            body{
                background-color:white;
            }
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
        <?php  
            require_once("dbcon.php"); 
            if(isset($_GET['tabno']))
            {
                $current_date = date('Y-m-d');
                $tab1=$_GET['tabno'];
                $sql="SELECT * FROM `temtable` WHERE `kot_num`='$tab1'";
                $c=mysqli_query($conn, $sql);
                if (mysqli_num_rows($c) > 0)
                {
                    $c11=mysqli_query($conn, $sql);
                    while($row11 = mysqli_fetch_assoc($c11)) 
                    {

                        $table_no= $row11['tabno'];
                        $cap= $row11['capname'];
                    }
                }else
                {
                    echo '<script>alert("No New Items.!");</script>';
                    echo '<script>location="table_master.php";</script>';
                }   
            }   
        ?>
        <div class="content-wrapper">
            <section class="content">
                <div class="box" >
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="fst">
                                    <h5 style="text-align:center;">
                                   <b>OYE SHAWA
                                    </h5>
                                  <h5 style="text-align:center;">
                                  Food KOT</b>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="fst" style="">
                                    <h5>KOT No-<?php echo $tab1; ?></h5>
                                    <h5><?php 
                                            echo $current_date;
                                    ?></h5>
                                </div>
                            </div>
                       </div>
                       <div class="row">
                            <div class="col-md-12">
                                <div class="fst" style="">
                                    <h5>Table No-<?php echo $table_no; ?></h5>
                                    <h6><?php
                                        date_default_timezone_set('Asia/Kolkata');
                                        $current_time = date("h:i:s A");
                                        echo $current_time;
                                        ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="fst" style="">
                                    <h5>Waiter-<?php echo $cap; ?></h5>
                                </div>
                            </div>
                        </div>
                        <hr style="margin:0; padding:2px 0; font-weight:10px;width:100%;">
                        <div class="row">
                            <div class="col-md-12">
                                <table style="width:99%; padding-left:4px;padding-right:4px; margin-left:auto; margin-right:auto;">
                                    <thead>
                                        <tr>
                                            <th style="width:80%;">Item Name</th>
                                            <th style="width:20%;" class="text-right">Quantity</th>
                                        </tr >
                                    </thead >
                                    <tbody>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
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
function myFunction() 
{
   window.print();
   var tab="<?php echo $table_no; ?>";
    // window.onafterprint = function(event)
    // {
        window.location.href ="table_master.php?tabno="+tab;
    // };
}
</script>
</body>
</html>
