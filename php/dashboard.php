<?php
    session_start();
    if(!(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['ADMIN'])))
    {
        include("invalidurl.php");
    }
    require("header.php");
    require('database.php');
    
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
    <title>Admin | Dashboard |online mess</title>
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
            <a href="dashboard.php" class="active">Dashboard</a>
            <a href="newmess.php" >Add New Mess</a>
            <a href="handle_mess.php" >Handle Mess</a>
            <a href="addlocation.php"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Add New Mess Location</a>
            <a href="invite.php"></i><i class="fa fa-inbox" aria-hidden="true"></i>&nbsp;Invitation list</a>
            <a href="mostfavourite.php" ><i class="fa fa-star" aria-hidden="true"></i>&nbsp;Most Favourite Mess</a>
            <a href="logout.php" ><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout</a>
        </div>

  <button class="openbtn" onclick="openNav()">☰ Menu</button>

    <section id="main">
        <div class="container ">
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
                <div class="panel-heading main-color-bg">
                    <h1 class="panel-title">New users & customers</h1>
                </div>
                <div class="panel-body text-capitalize table-responsive">
                    <table class="table  table-striped table-hover table-font">
                        <thead>
                            <tr>
                                <th scope="col">Sr.no</th>
                                <th scope="col">username</th>
                                <th scope="col">email</th>
                                <th scope="col">Location</th>
                                <th scope="col">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(mysqli_num_rows($result)>0){
						$i=1;
						while($row=mysqli_fetch_assoc($result)){
						?>
                            <tr>
                                <th scope="row"><?php echo $i;?></th>
                                <td><?php echo $row['username'];?></td>
                                <td><?php echo $row['email'];?></td>
                                <td><?php echo $row['city'];?></td>
                                <td><?php echo $row['role'];?></td>
                            </tr>
                        <?php 
						$i++;
						} } else { ?>
                            <tr>
                                <td colspan="5">No data found</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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