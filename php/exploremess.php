<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore | Online mess</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../css/exploremess.css"> -->
    <?php include('explorecss.php'); ?>
    <script src="https://use.fontawesome.com/c94c407848.js"></script>
    <style>
        body{
            background: url("../img/explorebg.jpg") center !important;
            background-attachment: fixed !important;
            background-size: cover !important;
            background-repeat: no-repeat !important;
        }
        @media (max-width:1000px) {
            body{
                background:linear-gradient(90deg, rgba(241, 242, 246,1.0),transparent,rgba(241, 242, 246,1.0)) !important;
            }
        }
        #messes{
            position:relative;
        }
        
        /* side pannel menu  */
        .sidepanel {
            width: 270px !important;
            position: fixed;
            z-index: 1;
            min-height: 30vh;
            top: 180px !important;
            left: 20px;
            background-color: rgba(252, 66, 123,1.0);
            overflow: hidden;
            transition: 0.5s;
            padding: 30px 20px 30px 20px;
            box-shadow: 2px 5px 10px grey,-2px -5px 10px grey;
            transition: 2s;
            transform-origin: top;
            display: none;
            text-transform: capitalize;
            border-radius: 10% 0 10% 0;
            font-weight:600px;
        }
        .my-btn{
            width: 230px !important;
            margin: 5px 0;
            text-transform: capitalize;
            font-size: 2.2rem;
        }
        
        

        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #111;
            color: antiquewhite;
            padding: 10px 15px;
            border: none;
            background-color: rgb(53, 2, 70);
            margin: 15px 0 0 15px;
            box-shadow: 2px 2px 5px lightgray;
            position: fixed;
            left:20px;
        }
        
        .openbtn:hover {
            background-color: rgba(50, 2, 68, 0.8);
        }
        
        @media(max-width:1110px) {
            .sidepanel {
                width: 0;
            }
            .sidepanel .closebtn{
                display: block;
            }
            section#main{
                margin: 20px 0 10px 20px !important;
            }
        }

        .block{
            margin-top: 90px !important;
            width: 2px;
            height: 2px;
            background: transparent;
        }
    </style>
</head>
<?php

    require("header.php");
    require('functions.php');
    $data = array();
    $i = 0;
    
    if(isset($_REQUEST['open']))
    {
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d h:i:s");
        $query = "SELECT * FROM mess_admin a INNER JOIN mess_details d WHERE a.mess_name=d.name";
        $res = mysqli_query($con,$query);
        while($row=mysqli_fetch_assoc($res))
        {
            $open = date("Y-m-d h:i:s",strtotime($row['mess_open_time']));
            $close = date("Y-m-d h:i:s",strtotime($row['mess_close_time']));
            if(($open<=$date and $date<=$close))
            {
                $i += 1;
                array_push($data,$row);
            }           
        }
    }
    else if(isset($_REQUEST['mycity']))
    {
        if(!(isset($_SESSION['IS_LOGIN'])))
            {
                ?>
                    <script>
                        window.alert("For finding the messes in your city, you must need to login first!!");
                    </script>
                <?php
                redirect("exploremess.php");
            }
        else{
            include('apilocation.php');
            if(!isset($city))
            {
                $username = $_SESSION['USERNAME'];
                $email = $_SESSION['EMAIL'];
                $query = "select city from admin where username='".$username."' and email='".$email."'";
                $result = mysqli_query($con,$query);
                $ans = mysqli_fetch_assoc($result);
                $city = $ans['city'];
            }
            $query = "SELECT * FRom mess_details d,mess_admin a WHERE a.mess_name=d.name and d.city='".$city."' ORDER BY d.discount_price";
            // echo $query;
            // die();
            $result = mysqli_query($con,$query);
            $i = mysqli_num_rows($result);
            $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
            // prx($data);
        }
    }
    else if(isset($_REQUEST['low']))
    {
        $query = "SELECT * FRom mess_details d,mess_admin a WHERE a.mess_name=d.name ORDER BY d.discount_price";
        $result = mysqli_query($con,$query);
        $i = mysqli_num_rows($result);
        $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
        // prx($data);
    }
    else if(isset($_REQUEST['high']))
    {
        $query = "SELECT * FRom mess_details d,mess_admin a WHERE a.mess_name=d.name ORDER BY d.discount_price desc";
        $result = mysqli_query($con,$query);
        $i = mysqli_num_rows($result);
        $data = mysqli_fetch_all($result,MYSQLI_ASSOC);

    }
    else{
        $query = "SELECT * FROM mess_admin a INNER JOIN mess_details d WHERE a.mess_name=d.name ";
        $result = mysqli_query($con,$query);
        $i = mysqli_num_rows($result);
        $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
    // pr($data);
      
?>

<body>
        <!-- filter menus  -->

        <div id="mySidepanel" class="sidepanel">

            <div class="container">
                <div class="row">
                    <div class="col">
                    <div class="dtn-box">
                        <form method="post">
                            <button type="submit" class="btn my-btn btn-lg" name="all"><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;All messes </button>
                        </form>
                    </div>
                    <div class="dtn-box">
                        <form method="post">
                            <button type="submit" class="btn my-btn btn-lg" name="open"><i class="fa fa-eercast" aria-hidden="true" style="color:green;"></i>&nbsp;Currently Open </button>
                        </form>
                    </div>
                    <div class="dtn-box">
                        <form method="post">
                            <button type="submit" class="btn my-btn btn-lg" name="mycity"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;In my city </button>
                        </form>
                    </div>
                    <div class="dtn-box">
                        <form method="post">
                            <button type="submit" class="btn my-btn btn-lg" name="low"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>&nbsp;low to high price </button>
                        </form>
                    </div>
                    <div class="dtn-box">
                        <form method="post">
                            <button type="submit" class="btn my-btn btn-lg" name="high"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i>&nbsp;high to low price </button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>

        </div>

        <button class="openbtn" onclick="openNav()"><i class="fa fa-filter" aria-hidden="true" style="color:white;"></i> Filter</button>

    <section id="messes">
        <div class="container">
            <!-- mess section  -->
            <?php foreach($data as $key => $value): ?>
            
            <div class="row justify-content-center ">
                <div class="col-md-10 ">
                    <div class="panel panel-default .dash-shadow-box bg-color bx-shadow">
                        <div class="panel-body">
                            <div class="col-md-4 col-sm-4">
                                <div class="imgBox">
                                    <input type="checkbox">
                                    <span class="bg1-<?php echo $value['mess_name']; ?>"></span>
                                    <span class="bg2-<?php echo $value['mess_name']; ?>"></span>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-5 bg-color col-md-offset-1 col-sm-offset-2 table-bg font-size">
                                <table class="table table-borderless table-dark table ">
                                    <thead>
                                        <tr class="my-center">
                                            <th scope="col" colspan="2">
                                                <h1 style="text-shadow: 2px 2px 4px #F79F1F;"><?php echo $value['mess_name']; ?></h1>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><i class="fa fa-map-marker"></i>&nbsp;<?php echo $value['city']; ?></td>
                                            <td rowspan="2">
                                                <div class="price">
                                                    <h4>per thali</h4>
                                                    <h2><?php echo $value['discount_price'];?> Rs</h2>
                                                    <h5 style="text-decoration: line-through;"><?php echo $value['base_price'];?> Rs</h5>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <?php
                                                $open = strtotime($value['mess_open_time']) ;
                                                $close = strtotime($value['mess_close_time']) ;
                                            ?>
                                            <td><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<span style="color:#1B1464;font-family: Times New Roman, Times, serif;"> open at :<?php echo date("d M'y H:i ",$open); ?></span> <br>
                                                 <span style="color:#e84118;font-family: Times New Roman, Times, serif;">close at :<?php echo date("d M'y H:i ",$close); ?></span> 
                                            </td>
                                        </tr>
                                        <tr class="my-center">
                                            <td colspan="2">
                                                <div class="viewbutton ">
                                                    <button class="button"><span><a href="detailsview.php?name=<?php echo $value['mess_name'];?>">View
                                                                Menu</a></span></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>

            <?php if($i==0): ?>
                <div class="panel panel-default .dash-shadow-box bg-color bx-shadow">
                    <div class="panel-body text-center ">
                        <h2>No any mess found!!</h2>
                    </div>
                </div>
             <?php endif; ?>
        </div>

    </section>
    <!-- side bar toggle menu  -->
    <script>
            function openNav() {
                if(document.getElementById("mySidepanel").style.display == "block")
                    document.getElementById("mySidepanel").style.display = "none";
                else
                    document.getElementById("mySidepanel").style.display = "block";
                // document.getElementById("mySidepanel").classList.toggle("displaynone");
            }
            
    </script>

    <script src="./bootstrap/bootstrap.min.js"></script>
</body>

</html>