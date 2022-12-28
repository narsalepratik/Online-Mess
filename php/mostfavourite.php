<?php
    session_start();
    if(!(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['ADMIN'])))
    {
        include("invalidurl.php");
    }
    require("header.php");
    require('database.php');
    
    //most favourite mess
        $query = "select mess_name FROM favourite 
                GROUP BY mess_name 
                HAVING COUNT(mess_name) >= (SELECT COUNT(mess_name) GROUP BY mess_name) ORDER by COUNT(mess_name) DESC, mess_name ASC LIMIT 1";
        $result = mysqli_query($con,$query);
        $data = mysqli_fetch_assoc($result);
        $messname = $data['mess_name'];

    //getting New users & customers
        $query = "SELECT username,email,city,assignrole(role) as role FROM admin LIMIT 10";
        $result = mysqli_query($con,$query);
        $data = mysqli_fetch_assoc($result);
        // prx($data);  
        
    //getting total messes
        $query = "select count(*) as total from admin";
        $res = mysqli_query($con,$query);
        $totalusers = mysqli_fetch_assoc($res);
        // prx($totalusers);

    //getting total locations
        $query = "select count(*) as total from mess_admin";
        $res = mysqli_query($con,$query);
        $totalmesses = mysqli_fetch_assoc($res);
        // prx($totalmesses);

    //total active messes
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d h:i:s");
        // echo "current timestamp : ".$date;
        // die();
        $query = "select mess_open_time as open,mess_close_time as close from mess_details";
        $res = mysqli_query($con,$query);
        $totalactivemesses = 0;
        while($row=mysqli_fetch_assoc($res))
        {
            
            $open = date("Y-m-d h:i:s",strtotime($row['open']));
            $close = date("Y-m-d h:i:s",strtotime($row['close']));
            if($open<=$date and $date<=$close)
            {
                // echo $close." >= ".$date."<br>";
                $totalactivemesses += 1;
            }
            
        }

        // echo $totalactivemesses;
        // die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Most favourite mess |online mess</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://use.fontawesome.com/c94c407848.js"></script>
    <style>
        .sidepanel :nth-child(2){
            margin-top: 90px !important;
        }
    </style>
</head>

<body>

    <!-- side panel section  -->
    <div id="mySidepanel" class="sidepanel">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <a href="dashboard.php" >Dashboard</a>
            <a href="newmess.php" >Add New Mess</a>
            <a href="handle_mess.php" >Handle Mess</a>
            <a href="addlocation.php"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Add New Mess Location</a>
            <a href="invite.php"></i><i class="fa fa-inbox" aria-hidden="true"></i>&nbsp;Invitation list</a>
            <a href="mostfavourite.php" class="active" ><i class="fa fa-star" aria-hidden="true"></i>&nbsp;Most Favourite Mess</a>
            <a href="logout.php" ><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout</a>
        </div>

  <button class="openbtn" onclick="openNav()">☰ Menu</button>

    <section id="main">
        <div class="container">
            <!-- dashboard  -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default .dash-shadow-box">
                        <div class="panel-heading  main-color-bg">
                            <h3 class="panel-title ">&nbsp;Dashboard</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-4 col-sm-4 ">
                                <div class="well dash-box">
                                    <h2><i class="fa fa-users" style="color:#82589F;" aria-hidden="true"></i>&nbsp;<?php echo $totalusers['total'];?></h2>
                                    <h4>total users</h4>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="well dash-box">
                                    <h2><i class="fa fa-calculator"style="color:#82589F;" aria-hidden="true"></i>&nbsp;<?php echo $totalmesses['total'];?></h2>
                                    <h4>Total mess</h4>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="well dash-box">
                                    <h2><i class="fa fa-eercast" aria-hidden="true" style="color:green;"></i>&nbsp;</span><?php echo $totalactivemesses; ?></h2>
                                    <h4>Active messes</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //new user sections  -->
            <div class="panel panel-default">
                <div class="panel-heading  text-center" style="background-color:rgba(247, 159, 31,1.0) !important;color:black !important;">
                    <h1 class="panel-title"><h2><img src="https://media.giphy.com/media/9IZR9lsoIoCctttIHv/giphy.gif" height="60px" alt="Favourite"/>Most Favourite Mess Ever!!</h2></h1>
                </div>
                <div class="panel-body text-capitalize table-responsive">
                    <div class="jumbotron">
                        <h1><i class="fa fa-star" aria-hidden="true" style="color:rgba(247, 159, 31,1.0) !important;"></i>&nbsp;<?php echo $messname;?></h1>
                        <br>
                        <p><a class="btn  btn-lg" href="detailsview.php?name=<?php echo $messname;?>" role="button" style="background-color:rgba(24, 44, 97,.9) !important;color:white !important;"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Details</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="../bootstrap/bootstrap.min.js"></script>

    <!-- side bar toggle menu  -->
    <script>
        function openNav() {
            document.getElementById("mySidepanel").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>
</body>
</html>