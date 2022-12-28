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

    $query = "select name as mess_name from mess_details where mess_admin='$username' and email='$email'";
    $result = mysqli_query($con,$query);
    $data = mysqli_fetch_Assoc($result);
    $mess_name = $data['mess_name'];

    $query = "SELECT * FROM updatemenu_history where mess_name='$mess_name' order by update_on desc";
    $result = mysqli_query($con,$query);
    $res = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $i=0;
    // prx($data);  
        
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Menu History | Online mess</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/mymess.css">
    <!-- <link rel="stylesheet" href="../css/exploremess.css"> -->
    <?php require('explorecss.php'); ?>
    <script src="https://use.fontawesome.com/c94c407848.js"></script>
    <style>
        .sidepanel :nth-child(2){
            margin-top: 90px !important;
        }
        .main-color-bg
        {
            background-color : rgb(255, 99, 72) !important;
        }
        body{
            background: url("../img/table-bg.jpg") center ;
            background-attachment: fixed;
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>
<?php 


?>

<body>
    <!-- side panel section  -->
    <div id="mySidepanel" class="sidepanel">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="detailsview.php?name=<?php echo $mess_name; ?>" ><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;My mess</a>
        <a href="updatemenu.php"  ><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Update menu</a>
        <a href="../php/menuhistory.php" class="active"><i class="fa fa-history" aria-hidden="true"></i>&nbsp;Menu History</a>
        <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout</a>
    </div>

    <button class="openbtn" onclick="openNav()">☰ Menu</button>

    <section id="main" class="my-form">
        <div class="container">
            <!-- //new user sections  -->
            <div class="panel panel-default">
                <div class="panel-heading main-color-bg text-center">
                    <h1 class="panel-title"><i class="fa fa-history" aria-hidden="true"></i>&nbsp;<h1>My updated Menu History</h1></h1>
                </div>
                <div class="panel-body text-capitalize table-responsive">
                    <table class="table  table-striped table-hover table-font">
                        <thead>
                            <tr>
                                <th scope="col">Sr.no</th>
                                <th scope="col">Menu 1</th>
                                <th scope="col">menu 2</th>
                                <th scope="col">menu 3</th>
                                <th scope="col">Base Price</th>
                                <th scope="col">Discount Price</th>
                                <th scope="col">updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($res as $key=>$row):
						        $i=1; ?>
                            <tr>
                                <th scope="row"><?php echo $i;?></th>
                                <td><?php if($row['menu_1']!="") echo $row['menu_1']; else echo "-";?></td>
                                <td><?php if($row['menu_2']!="") echo $row['menu_2']; else echo "-";?></td>
                                <td><?php if($row['menu_3']!="") echo $row['menu_3']; else echo "-";?></td>
                                <td><?php echo $row['base_price'];?></td>
                                <td><?php echo $row['discount_price'];?></td>
                                <td><?php echo $row['update_on'];?></td>
                            </tr>
                        <?php 
						$i++;
                            endforeach;?>
						<?php if($i==0) : ?>
                            <tr>
                                <td colspan="5">No updated menu History Found!!!</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
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