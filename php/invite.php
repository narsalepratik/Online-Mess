<?php
    session_start();
    if(!(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['ADMIN'])))
    {
        include("invalidurl.php");
    }
    require("header.php");
    require('database.php');
    
    if(isset($_REQUEST['id']) && $_REQUEST['type']=='delete')
    {
        $email = mysqli_real_escape_string($con,$_REQUEST['id']);
        $query = "delete from invitations where email='$email'";
        $res = mysqli_query($con,$query);        

    }

    //getting mails
        $query = "SELECT * FROM invitations order by status";
        $result = mysqli_query($con,$query);
        $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
        // prx($data); 
        
    $i = 1;
?>

<?php
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation | online mess</title>
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
            <a href="handle_mess.php" >Handle Mess</a>
            <a href="addlocation.php"><i class="fa fa-map-marker" aria-hidden="true"></i>Add New Mess &nbsp; Location</a>
            <a href="invite.php" class="active"><i class="fa fa-inbox" aria-hidden="true"></i>&nbsp;Invitation list</a>
            <a href="mostfavourite.php" ><i class="fa fa-star" aria-hidden="true"></i>&nbsp;Most Favourite Mess</a>
            <a href="logout.php" ><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout</a>
        </div>

  <button class="openbtn" onclick="openNav()">☰ Menu</button>

    <section id="main">
        <div class="container">
            
            <!-- //handle list  -->
            <div class="panel panel-default">
                <div class="panel-heading main-color-bg text-center">
                    <h1 class="panel-title">Invitations</h1>
                </div>
                <div class="panel-body text-capitalize table-responsive">
                    <table class="table  table-striped table-hover table-font">
                        <thead>
                            <tr>
                            <th scope="col">Sr.no</th>
                              <th scope="col">Email</th>
                              <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(mysqli_num_rows($result)>0): 
                                 foreach($data as $key => $value): ?>
                            <tr>
                                <th scope="row"><?php echo $i;?></th>
                                <td><?php echo $value['email'];?></td>
                                <td>
                                <!-- actions -->
                                <a href="invite.php?id=<?php echo $value['email']; ?>&type=delete" class="btn btn-danger btn-sm">Delete</a>
                                &nbsp;
                                <?php if($value['status']==0): ?>
                                    <a href="mailto:<?php echo $value['email']; ?>" class="btn btn-info btn-sm"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Invite</a>
                                <?php else: ?>
                                    <a href="void:javascript(0)" class="btn btn-success btn-sm"></i>&nbsp;Invited</a>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <?php 
                            $i++;
                                 endforeach;
                                else: ?>
                                <tr>
                                    <td colspan="3" class="text-center text-info"><h3>No Data Found!! </h3></td>
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