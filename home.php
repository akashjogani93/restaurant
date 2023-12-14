<?php require_once("header.php"); ?>
<style>
    .main{
        margin:20px;
    }
    .boxx1{
        padding:10px 0;
        background-color:rgba(248, 7, 7, 0.6);
    }
    .boxx2{
        padding:10px 0;
        background-color:rgba(29, 225, 49, 0.6);
    }
    .boxx3{
        padding:10px 0;
        background-color:rgba(181, 0, 255, 0.6);
    }
    .boxx4{
        padding:10px 0;
        background-color:rgba(29, 120, 115, 0.6);
    }
    h1{
        color:white;
    }
    .imag{
        padding:30px 10px 0 0;
    }
    .boxx1 ,  .boxx2 , .boxx3, .boxx4{
        margin:0 5px;
    }
</style>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="main">
                <div class="row">

                    <div class=" col-md-3">
                        <a href="item_form.php"> 
                            <div class="boxx1 col-md-11">
                                <div class="col-md-8">
                                    <h1>Menu Master</h1>
                                </div>
                                <div class="imag col-md-4">
                                    <img src="img/box1.png" alt="" width="70" height="70">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class=" col-md-3">
                       <a href="table_form.php">
                            <div class="boxx2 col-md-11">
                                <div class="col-md-8">
                                    <h1>Table Master</h1>
                                </div>
                                <div class="imag col-md-4">
                                    <img src="img/box2.png" alt="" width="70" height="70">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class=" col-md-3">
                        <a href="reports.php">
                            <div class="boxx3 col-md-11">
                                <div class="col-md-8">
                                    <h1>Report Master</h1>
                                </div>
                                <div class="imag col-md-4">
                                    <img src="img/box3.png" alt="" width="70" height="70">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class=" col-md-3">
                        <a href="parcel.php">
                            <div class="boxx4 col-md-11">
                                <div class="col-md-8">
                                    <h1>Parcel Master</h1>
                                </div>
                                <div class="imag col-md-4">
                                    <img src="img/box4.png" alt="" width="70" height="70">
                                </div>
                            </div>
                        </a>
                    </div>
                </div><br>

                
            </div>
        </section>

        
    </div>
            <?php require_once("footer.php"); ?>

    </body>
</html>
