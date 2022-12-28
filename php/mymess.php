<?php
    session_start();
    if(!(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['MESS_ADMIN'])))
    {
        include("invalidurl.php");
    }
    require("header.php");
    require('database.php');
    $username = $_SESSION['USERNAME'];
    $email = $_SESSION['EMAIL'];
    $query = "SELECT mess_admin,name as mess_name,city,mess_open_time,mess_close_time,base_price,discount_price FROM mess_details where mess_admin='$username' and email='$email'";
    echo $query;
    
       
    $result = mysqli_query($con,$query);
        $i = mysqli_num_rows($result);
        $data = mysqli_fetch_assoc($result);
        $_SESSION['MESSNAME '] = $data['mess_name'];
        
        // pr($data);  
        
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My mess | Online mess</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/mymess.css">
    <!-- <link rel="stylesheet" href="../css/exploremess.css"> -->
    <?php require('mymesscss.php'); ?>
    <script src="https://use.fontawesome.com/c94c407848.js"></script>
    <style>
        .sidepanel :nth-child(2){
            margin-top: 90px !important;
        }
    </style>
</head>
<?php 


?>

<body>
    <!-- side panel section  -->
    <div id="mySidepanel" class="sidepanel">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="mymess.php" class="active"><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;My mess</a>
        <a href="updatemenu.php" ><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Update menu</a>
        <a href="menuHistory.php"><i class="fa fa-history" aria-hidden="true"></i>&nbsp;Menu History</a>
        <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout</a>
    </div>

    <button class="openbtn" onclick="openNav()">☰ Menu</button>

    <section id="messes">

        <div class="container">
            <!-- mess section  -->
            <div class="row justify-content-center ">
                <div class="col-md-10 ">
                    <div class="panel panel-default .dash-shadow-box bg-color bx-shadow">
                        <div class="panel-body">
                            <div class="col-md-4 col-sm-4">
                                <div class="imgBox">
                                    <input type="checkbox">
                                    <span class="bg1-<?php echo $data['mess_name']; ?>"></span>
                                    <span class="bg2-<?php echo $data['mess_name']; ?>"></span>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-5 bg-color col-md-offset-1 col-sm-offset-2 table-bg font-size">
                                <table class="table table-borderless table-dark table ">
                                    <thead>
                                        <tr class="my-center">
                                            <th scope="col" colspan="2">
                                                <h1 style="text-shadow: 2px 2px 4px #F79F1F;"><?php echo $data['mess_name']; ?></h1>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><i class="fa fa-map-marker"></i>&nbsp;<?php echo $data['city']; ?></td>
                                            <td rowspan="2">
                                                <div class="price">
                                                    <h4>per thali</h4>
                                                    <h2><?php echo $data['discount_price'];?> Rs</h2>
                                                    <h5 style="text-decoration: line-through;"><?php echo $data["discount_price"];;?> Rs</h5>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            
                                            <td><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<span style="color:#1B1464;font-family: Times New Roman, Times, serif;"> open at :<?php echo date('d-m-Y H:i',$open); ?></span> <br>
                                                 <span style="color:#e84118;font-family: Times New Roman, Times, serif;">close at :<?php echo $data["mess_close_time"]; ?></span> 
                                            </td>
                                        </tr>
                                        <tr class="my-center">
                                            <td colspan="2">
                                                <div class="viewbutton ">
                                                    <button class="button"><span><a href="detailsview.php?name=<?php echo $data['mess_name'];?>">View
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

            <?php if($i==0): ?>
                <div class="panel panel-default .dash-shadow-box bg-color bx-shadow">
                    <div class="panel-body text-center ">
                        <h2>No any result found!!</h2>
                    </div>
                </div>
             <?php endif; ?>
        </div>

    </section>


    <script src="./bootstrap/bootstrap.min.js"></script>
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