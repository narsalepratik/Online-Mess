<?php
    session_start();
    if(!(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['ADMIN'])))
    {
        include("invalidurl.php");
    }
    require("header.php");
    require('database.php');
    
    //getting New users & customers
        $query = "SELECT username,mess_name,email,city,added_on FROM mess_admin";
        $result = mysqli_query($con,$query);
        $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
        // prx($data); 
        
    //getting total messes
        $query = "select count(*) as total from admin";
        $res = mysqli_query($con,$query);
        $totalusers = mysqli_fetch_assoc($res);
        // prx($totalusers);

    //getting total locations
        $query = "select count(*) as total from mess_details";
        $res = mysqli_query($con,$query);
        $totalmesses = mysqli_fetch_assoc($res);
        // prx($totalmesses);
    $i = 1;
?>
<!-- delete mess feacher -->
<?php
    if(isset($_REQUEST['id']) && $_REQUEST['type']=='delete')
    {
        $mess_name = mysqli_real_escape_string($con,$_REQUEST['id']);
        $query = "select * from mess_admin where mess_name='$mess_name'";
        $res = mysqli_query($con,$query);
        $messdetails = mysqli_fetch_assoc($res);
        // prx($messdetails);
        $username = $messdetails['username'];
        $useremail = $messdetails['email'];

        if(mysqli_num_rows($res))
        {
            $query = "delete from mess_admin where mess_name='$mess_name'";
            $res = mysqli_query($con,$query);
            $query = "delete from admin where username='$username' and email='$useremail' ";
            $res = mysqli_query($con,$query);
            $query = "delete from updatemenu_history where mess_name='$mess_name'";
            $res = mysqli_query($con,$query);
            $query = "delete from mess_details where mess_admin='$username' and name='$mess_name' and email='$useremail' ";
            $res = mysqli_query($con,$query);
            redirect('handle_mess.php');
        }
    }
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
            <a href="dashboard.php">Dashboard</a>
            <a href="newmess.php" >Add New Mess</a>
            <a href="handle_mess.php" class="active">Handle Mess</a>
            <a href="addlocation.php"><i class="fa fa-map-marker" aria-hidden="true"></i>Add New Mess &nbsp; Location</a>
            <a href="invite.php" ><i class="fa fa-inbox" aria-hidden="true"></i>&nbsp;Invitation list</a>
            <a href="mostfavourite.php" ><i class="fa fa-star" aria-hidden="true"></i>&nbsp;Most Favourite Mess</a>
            <a href="logout.php" ><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout</a>
        </div>

  <button class="openbtn" onclick="openNav()">☰ Menu</button>

    <section id="main">
        <div class="container">
            <!-- dashboard  -->
            <div class="row">
                <!-- <div class="col-md-12"> -->
                    <!-- <div class="panel panel-default .dash-shadow-box">
                        <div class="panel-heading  main-color-bg">
                            <h3 class="panel-title ">&nbsp;Dashboard</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-4 col-sm-4 ">
                                <div class="well dash-box">
                                    <h2><i class='fa fa-user' aria-hidden='true'></i>&nbsp;<?php echo $totalusers['total'];?></h2>
                                    <h4>total users</h4>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="well dash-box">
                                    <h2><i class="fas fa-users"></i><?php echo $totalmesses['total'];?></h2>
                                    <h4>Total mess</h4>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="well dash-box">
                                    <h2><i class="fas fa-signal"></i></span>100</h2>
                                    <h4>Active messes</h4>
                                </div>
                            </div>
                        </div>
                    </div> -->
                <!-- </div> -->
            </div>
            <!-- //handle mess sections  -->
            <div class="panel panel-default">
                <div class="panel-heading main-color-bg text-center">
                    <h1 class="panel-title"><h1>Handle Messes</h1> </h1>
                </div>
                <div class="panel-body text-capitalize table-responsive">
                    <table class="table  table-striped table-hover table-font">
                        <thead>
                            <tr>
                            <th scope="col">Sr.no</th>
                              <th scope="col">Mess name</th>
                              <th scope="col"><i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;Mess Admin</th>
                              <th scope="col"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Location</th>
                              <th scope="col"><i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;Added on</th>
                              <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(mysqli_num_rows($result)>0): 
                                 foreach($data as $key => $value): ?>
                            <tr>
                                <th scope="row"><?php echo $i;?></th>
                                <td><?php echo $value['mess_name'];?></td>
                                <td><?php echo $value['username'];?></td>
                                <td><?php echo $value['city'];?></td>
                                <td><?php $dateStr=strtotime($value['added_on']);
                                      echo date('d-m-Y',$dateStr);
                                    ?>
                                </td>
                                <td>
                                <!-- actions -->
                                <a href="handle_mess.php?id=<?php echo $value['mess_name']; ?>&type=delete" class="btn btn-danger btn-sm">Delete</a>
                                &nbsp;
                                <a href="mailto:<?php echo $value['email']; ?>" class="btn btn-success btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Mail</a>
                                </td>
                            </tr>
                            <?php 
                            $i++;
                                 endforeach;
                                else: ?>
                                <tr>
                                    <td colspan="5"><h3>No Data Found!! </h3></td>
                                </tr>
                            <?php endif; ?>
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