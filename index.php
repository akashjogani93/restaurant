<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="img/logo.png"  sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="inde/bootstrap.min.css">

    <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="inde/css2.css">

    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script> -->
    <script src="inde/jquery.slim.min.js"></script>
    <script src="inde/bootstrap.bundle.min.js"></script>
    <script src="inde/boxicons.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
    <!-- <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script> -->

    <title>OYE SHAWA</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500;700&display=swap');


body{

    font-family: 'Roboto Mono', monospace;
}
        body, html{
        height: 100%;
       
        }
        .container-fluid{
            padding:0;
            margin:0; 
            /* width:100%; */
            height:100%;
            overflow-x:hidden;
            overflow-y:hidden;
        }
        .back {
        /* The image used */
        background-image: url("img/Group.png");
            margin:0;
            padding:0;
        /* Full height */
        height: 100% !important;

        /* Center and scale the image nicely */
        /* /* background-position: center; */
        background-repeat: no-repeat;
        background-size: cover;
        }
        .log{
            /* margin-left:auto;
            margin-right:auto; */
            margin:auto;
            width:auto;
        }
        IMG.displayed {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
       h6{
            font-weight:600;
            font-size:16px;
            font-family: 'Inter';
       }

       .group 			  { 
    position:relative; 
    margin-bottom:15px; 
    }
    input 				{
    font-size:18px;
    /* padding:0px 10px 0px 5px; */
    display:block;
    width:350px;
    border:none;
    border-bottom:2px solid rgba(0, 0, 0, 0.6); 
    }
    input:focus 		{ outline:none; }

    ::placeholder{
        color:rgba(0, 0, 0, 0.6);
        font-size:14px;
        font-family: 'Inter';
    }
    /* LABEL ======================================= */
    label{
    color:rgba(0, 0, 0, 0.6); 
    font-size:16px;
    font-weight:600;
    font-family: 'Inter';
    }
    .btn{
        width: 100%;
        background-color:rgba(0, 0, 0, 0.6);
        color:white;
    }
    .btn:hover{
        background-color:rgba(0, 0, 0, 0.6);
        color:white;
    }
    /* BOTTOM BARS ================================= */
    .bar 	{ position:relative; display:block; width:300px; }
    .bar:before, .bar:after 	{
    content:'';
    height:2px; 
    width:0;
    bottom:1px; 
    position:absolute;
    background:#5264AE; 
    transition:0.2s ease all; 
    -moz-transition:0.2s ease all; 
    -webkit-transition:0.2s ease all;
    }
    /* .bar:before {
    left:50%;
    }
    .bar:after {
    right:50%; 
    } */

    /* active state
    input:focus ~ .bar:before, input:focus ~ .bar:after {
    width:50%;
    } */

 
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row"  style="height:100%;">
            <div class="col-md-8 back1">
                <div class="back"></div>
            </div>
            <div class="co1-md-4 log">
                <div class="logo">
                    <img src="./img/Oyeshava.png" style="width:150px;" alt="" class="displayed">
                    <center><h6>WELCOME TO THE OYESHAWA</h6></center>
                </div></br>
                <div class="form2">
                <form  action="login_check.php" name="Login_Form" method="POST">
                    <div class="group">     
                        <label>Username</label>
                        <input type="text" required placeholder="Username" name="user" autofocus autocomplete="off">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                    </div>
      
                    <div class="group">  
                        <label>Password</label>
                        <input type="password" required placeholder="Password" name="pass" autocomplete="off">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                    </div></br>
                    <div class="group">  
                        
                        <button type="submit" name="login" class="btn">Log In</button>
                        
                    </div>
                </form>
                </div>
                
            </div>
        </div>
    </div>
</body>

</html>