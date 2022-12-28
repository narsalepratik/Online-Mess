<?php
    session_start();
    if(!(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['ADMIN'])))
    {
        include("invalidurl.php");
    }
    require("header.php");
    require('database.php');
    $error_msg = "";
    $city = "";
    if( isset($_POST['addcity']) )
    {
        $city = strtolower(mysqli_real_escape_string($con,$_POST['city']));
        $query = "select * from locations where city='$city'";
        $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result))
        {
            $error_msg = "This location is already exists!!";
        }
        else {
            $query = "insert into locations VALUES ('$city')";
            $result = mysqli_query($con,$query);
                $error_msg = "$city added successfully..";
                redirect('dashboard.php');
        }
    }

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

        //getting total locations
        $query = "select count(*) as total from locations";
        $res = mysqli_query($con,$query);
        $totalmesslocations = mysqli_fetch_assoc($res);


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
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add mess location | online mess</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://use.fontawesome.com/c94c407848.js"></script>
</head>
    <style>
        .my-button{
            width: 30%;
            margin: 8px 0 0 15px;
            background-color: royalblue;
            outline: none;
        }
        .font-size input{
            font-size: large;
            padding: 7px 12px;
            margin-bottom: 5px;
        }
        .font-size{
            font-size:2rem;
        }
    
        .sidepanel :nth-child(2){
            margin-top: 90px !important;
        }
    
    </style>
<body>

    <!-- side panel section  -->
    <div id="mySidepanel" class="sidepanel">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="newmess.php" >Add New Mess</a>
        <a href="handle_mess.php">Handle Mess</a>
        <a href="addlocation.php" class="active"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Add New Mess Location</a>
        <a href="invite.php" ><i class="fa fa-inbox" aria-hidden="true"></i>&nbsp;Invitation list</a>
        <a href="mostfavourite.php" ><i class="fa fa-star" aria-hidden="true"></i>&nbsp;Most Favourite Mess</a>
        <a href="logout.php" ><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout</a>
    </div>

    <button class="openbtn" onclick="openNav()">☰ Menu</button>

    <section id="main">
        <div class="container">
            <!-- dashboard  -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default .dash-shadow-box">
                        <div class="panel-heading  main-color-bg text-center">
                            <h3 class="panel-title ">&nbsp;Dashboard</h3> 
                        </div>
                        <div class="panel-body">
                            <div class="col-md-3 col-sm-3 ">
                                <div class="well dash-box">
                                    <h2><i class="fa fa-users" aria-hidden="true"></i>&nbsp;<?php echo $totalusers['total'];?></h2>
                                    <h4>total users</h4>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="well dash-box">
                                    <h2><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;</span><?php echo $totalmesses['total'];?></h2>
                                    <h4>Total mess</h4>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="well dash-box">
                                    <h2><i class="fa fa-eercast" aria-hidden="true" style="color:green;"></i>&nbsp;<?php echo $totalactivemesses; ?></h2>
                                    <h4>Active messes</h4>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 ">
                                <div class="well dash-box">
                                    <h2><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;<?php echo $totalmesslocations['total'];?></h2>
                                    <h4>Total mess locations</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //new user sections  -->
            <div class="panel panel-default">
                <div class="panel-heading main-color-bg text-center">
                    <h1 class="panel-title display-3"><h3><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;ADD new Mess Location</h1></h3>
                </div>
                <div class="panel-body text-capitalize ">
                    <form method="POST">
                        <div class="form-group col-md-9 font-size">
                            <label for="city">Email address</label>
                            <input type="text" value="<?php echo $city; ?>" class="form-control" id="city" name="city"
                                placeholder="Enter New mess location..." required>
                            <small id="city" class="form-text  text-danger mx-2"><?php echo $error_msg; ?></small>
                        </div>
                        <button type="submit" name="addcity" class="btn btn-primary my-button">Add Location</button>
                    </form>
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
</body >
</html >