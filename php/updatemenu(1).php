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
    // echo $query;
    
    $result = mysqli_query($con,$query);
    $i = mysqli_num_rows($result);
    $data = mysqli_fetch_assoc($result);
    $_SESSION['MESSNAME '] = $data['mess_name'];
    
    $username = $_SESSION['USERNAME'];
    $email = $_SESSION['EMAIL'];
    $query = "SELECT mess_admin,name as mess_name,city,mess_open_time,mess_close_time,base_price,discount_price FROM mess_details where mess_admin='$username' and email='$email'";
    // echo $query;
       
    $result = mysqli_query($con,$query);
        $i = mysqli_num_rows($result);
        $data = mysqli_fetch_assoc($result);
        // prx($data);  
    // if(mysqli_num_rows($result)==0)
    //     redirect('login.php');

        
     if(isset($_POST['update_menu']))   
     {
         if(isset($_POST['menu_1']))
            $menu_1 = ucwords(mysqli_real_escape_string($con,$_POST['menu_1']));
        else
            $menu_1 = 'None';

            if(isset($_POST['menu_2']))
            $menu_2 = ucwords(mysqli_real_escape_string($con,$_POST['menu_2']));
        else
            $menu_2 = 'None';

            if(isset($_POST['menu_3']))
            $menu_3 = ucwords(mysqli_real_escape_string($con,$_POST['menu_3']));
        else
            $menu_3 = 'None';

        $discount_price = $_POST['discount_price'];
        $base_price  = $_POST['base_price'];
        $mess_open_time = $_POST['open_time'];
        $mess_close_time = $_POST['close_time'];

        // $mess_close_time = (string)$mess_close_time;
        // $mess_open_time = (string)$mess_open_time;

        // $mess_close_time = strtotime("Y-m-i H:i:s",$mess_close_time);
        // $mess_open_time = strtotime("Y-m-i H:i:s",$mess_open_time);
         $query = "UPDATE  mess_details
                    SET menu1 ='$menu_1',menu2 = '$menu_2',menu3 = '$menu_3',base_price = $base_price, discount_price = $discount_price, mess_open_time = '$mess_open_time',mess_close_time = '$mess_close_time'
                    WHERE mess_admin='$username' AND email = '$email'";
        $res = mysqli_query($con,$query);
        redirect('menuHistory.php');
        // echo $query;
     }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new mess | Onlinemess</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/updatemess.css">
    <script src="https://use.fontawesome.com/c94c407848.js"></script>
    <style>
    .main-color-bg{
        background-color:rgb(47, 53, 66) !important;
    }
    </style>
</head>

<body>

    <!-- side panel section  -->
    <div id="mySidepanel" class="sidepanel">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="detailsview.php?name=<?php echo $_SESSION['MESSNAME ']; ?>" ><i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;My mess</a>
        <a href="updatemenu.php" class="active"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Update menu</a>
        <a href="menuhistory.php"><i class="fa fa-history" aria-hidden="true"></i>&nbsp;Menu History</a>
        <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout</a>
    </div>

    <button class="openbtn" onclick="openNav()">☰ Menu</button>


    <section id="main" class="my-form">
        <div class="container">

            <!-- //new user sections  -->
            <div class="panel panel-default">
                <div class="panel-heading main-color-bg text-center">
                    <h1 class="panel-title h1"><h1> Update mess menu</h1> </h1>
                </div>
                <div class="panel-body text-capitalize ">
                    <form method="POST">
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="Mess_name">Mess name</label>
                                <input type="text" class="form-control is-valid" id="Mess_name" placeholder="Enter mess name.."
                                 value="<?php echo $data['mess_name'] ?>"    disabled>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="Mess_name">Mess Admin name</label>
                                <input type="text" class="form-control" id="Mess_admin_name"
                                value="<?php echo $data['mess_admin'] ?>"    placeholder="Enter mess admin name.." disabled>

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="user_email"
                                value="<?php echo $email ?>"    placeholder="Enter Email.." disabled>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="inputState">city</label>
                                <input type="text" class="form-control" value="<?php echo $data['city'] ?>" id="inputstate" value="panvel" disabled>
                            </div>
                        </div>
                        <!-- menu  -->
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="menu_1">Menu 1</label>
                                <input type="text" id="menu_1" class="form-control" name="menu_1"
                                    placeholder="Enter menu.." >
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="menu_2">Menu 2</label>
                                <input type="text" id="menu_2" class="form-control" name="menu_2"
                                    placeholder="Enter menu.." >
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="menu_3">Menu 3</label>
                                <input type="text" id="menu_3" class="form-control" name="menu_3"
                                    placeholder="Enter menu..">
                            </div>
                        </div>

                        <!-- prices -->
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="base_price">Base Price</label>
                                <input type="number" id="base_price" value="<?php echo $data['base_price'] ?>" class="form-control" name="base_price" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="discount_price">Discount price</label>
                                <input type="number" min="1" max="100" id="discount_price" value="<?php echo $data['discount_price'] ?>" class="form-control" name="discount_price" required>
                            </div>
                        </div>
                        <!-- dates  -->
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="open_time">Mess open Time & date</label>
                                <input type="datetime-local" id="open_time" class="form-control" name="open_time" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="close_time">Mess close Time & date</label>
                                <input type="datetime-local" min="1" max="100" id="close_time" class="form-control" name="close_time" required>
                            </div>
                        </div>
                        <!-- submit  -->
                        <div class="form-row">
                            <div class="form-group  col-sm-12 ">
                                <button type="submit" min="1" max="100" name="update_menu" class="btn btn btn-success btn-block"><h4>Update Menu</h4></button>
                            </div>
                        </div>
                        
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
</body>

</html>