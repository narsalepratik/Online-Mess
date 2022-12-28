<?php
    session_start();
    if(!(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['ADMIN'])))
    {
        include("invalidurl.php");
    }

    require("header.php");
    require('database.php');

    $error_messname = "";
    $error_email = "";
    $error_poster = "";
    $success = "";
    $flag = false; //just for checking the all fullfill conditions

    $email = "";
    $messname = "";
    $mess_admin_name = "";
    $city = "";
    $mess_address ="";
    $mess_admin_password= "";
    $phone = "";
    $photo_1 = "";
    $photo_2 = "";

    //extracting the cities
    $query = "select * from locations";
    $result = mysqli_query($con,$query);
    $cities = mysqli_fetch_assoc($result);

    if(isset($_POST['add_mess']))
    {
        //fetching data
        $city = strtolower(mysqli_real_escape_string($con,$_POST['city']));
        $mess_admin_name = strtolower(mysqli_real_escape_string($con,$_POST['mess_admin_name']));
        $messname = strtolower(mysqli_real_escape_string($con,$_POST['mess_name']));
        $email = strtolower(mysqli_real_escape_string($con,$_POST['admin_email']));
        $mess_address = strtolower(mysqli_real_escape_string($con,$_POST['messaddress']));
        $mess_admin_password = strtolower(mysqli_real_escape_string($con,$_POST['user_password']));
        $phone = strtolower(mysqli_real_escape_string($con,$_POST['phone']));

        $messname = preg_replace("! !","_",$messname);

        // email checking
        $query = "select * from admin where email='".$email."'";
        $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result) and $flag = true)
            $error_email = "This email address is allready exists...";

        // mess name uniqueness checking
        $query = "select * from mess_admin where mess_name='".$messname."'";
        $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result))
        {
            $error_messname = "This mess name is allready exists...";
            $flag = true;
        }

        //extracting the cities
        $query = "select * from locations";
        $result = mysqli_query($con,$query);
        $cities = mysqli_fetch_assoc($result);

        //getting posters ang validating
        $photo_1 = $_FILES["picture1"]; 
        $photo_2 = $_FILES["picture2"]; 

        $photo_name_1 = $photo_1['name'];
        $photo_name_2 = $photo_2['name'];

        $photo_name_1 = preg_replace("!-!","_",$photo_name_1);
        $photo_name_2 = preg_replace("!-!","_",$photo_name_2);

        $photo_name_1 = ucwords($photo_name_1);
        $photo_name_2 = ucwords($photo_name_2);
        
        if( $flag==false && ($photo_1['type']=="image/jpeg" || $photo_1['type']=="image/png" || $photo_1['type']=="image/jpg") && ($photo_2['type']=="image/jpeg" || $photo_2['type']=="image/png" ||$photo_2['type']=="image/jpg"))
        {
            move_uploaded_file($photo_1['tmp_name'],"../posters/".$messname."_".$photo_name_1);
            move_uploaded_file($photo_2['tmp_name'],"../posters/".$messname."_".$photo_name_2);

            $photo_name_1 = "../posters/".$messname."_".$photo_name_1 ;
            $photo_name_2 = "../posters/".$messname."_".$photo_name_2 ;
            // echo $photo_name_1;
            // echo "<br>";
            // echo $photo_name_2;
            // die();

        }else {
            $error_poster = "posters should be in jpj/png format";
            $flag = true;
        }

        //inserting the data in databases in flag is false
        if($flag==false)
        {
            // data inserting in admin table
            $query = "INSERT INTO admin  VALUES ('$mess_admin_name','$email','$mess_admin_password',2,'$city')";
            $result = mysqli_query($con,$query);

            $query = "INSERT INTO mess_admin (username,mess_name,email,mobile,city,address,poster1,poster2) VALUES ('$mess_admin_name','$messname','$email','$phone','$city','$mess_address','$photo_name_1','$photo_name_2')";
            $result = mysqli_query($con,$query);

            //insertin into mess_details table
            $query = "INSERT INTO mess_details (mess_admin,email,name,city) VALUES ('$mess_admin_name','$email','$messname','$city')";
            $result = mysqli_query($con,$query);
            
            // unset all previous values
            $error_messname = "";
            $error_email = "";
            $error_poster = "";
            $flag = false; //just for checking the all fullfill conditions

            $success = $messname." mess added Successfully!!!";

            $email = "";
            $messname = "";
            $mess_admin_name = "";
            $city = "";
            $mess_address ="";
            $mess_admin_password= "";
            $phone = "";
            $photo_1 = "";
            $photo_2 = "";
        }
        
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
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://use.fontawesome.com/c94c407848.js"></script>
    <style>
    .sidepanel :nth-child(2) {
        margin-top: 90px !important;
    }
    </style>
</head>

<body>

    <!-- side panel section  -->
    <div id="mySidepanel" class="sidepanel">
        <!-- <div class="block"></div> -->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="newmess.php" class="active">Add New Mess</a>
        <a href="handle_mess.php">Handle Mess</a>
        <a href="addlocation.php"><i class="fa fa-map-marker" aria-hidden="true"></i>Add New Mess Location</a>
        <a href="invite.php" ><i class="fa fa-inbox" aria-hidden="true"></i>&nbsp;Invitation list</a>
        <a href="mostfavourite.php" ><i class="fa fa-star" aria-hidden="true"></i>&nbsp;Most Favourite Mess</a>
        <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout</a>
    </div>

    <button class="openbtn" onclick="openNav()">☰ Menu</button>


    <section id="main" class="my-form">
        <div class="container">

            <!-- //new user sections  -->
            <div class="panel panel-default">
                <div class="panel-heading main-color-bg text-center">
                    <h1 class="panel-title"><h1>Add New Mess</h1></h1>
                </div>
                <div class="panel-body text-capitalize ">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="Mess_name">Mess name</label><small class="form-text text-muted">&nbsp;Mess name must be Unique</small>
                                <input type="text" class="form-control is-valid" name="mess_name" id="Mess_name"
                                    placeholder="Enter mess name.." value="<?php echo $messname; ?>" required>
                                <small class="form-text text-danger"><?php echo $error_messname; ?></small>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="Mess_name">Mess Admin name</label>
                                <input type="text" class="form-control" name="mess_admin_name" id="Mess_admin_name"
                                    value="<?php echo $mess_admin_name; ?>" placeholder="Enter mess admin name.."
                                    required>

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="admin_email"
                                    value="<?php echo $email; ?>" placeholder="Enter Email.." required>
                                <small class="form-text text-danger"><?php echo $error_email; ?></small>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="user_password" id="password"
                                    placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="address">Address</label>
                                <input type="text" id="address" class="form-control" name="messaddress"
                                    value="<?php echo $mess_address; ?>" placeholder="Enter the Exact Address.."
                                    required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">City</label>
                                <select id="inputState" class="form-control" name="city">
                                    <option selected diabaled>Choose city..</option>
                                    <?php 
                                        $query = "select * from locations";
                                        $result = mysqli_query($con,$query);
                                        $cities = mysqli_fetch_assoc($result);
                                    ?>
                                    <?php while($cities = mysqli_fetch_assoc($result)): ?>
                                        <option id="<?php echo $cities['city']; ?>"><?php echo $cities['city']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="phone">phone number</label><small class="form-text text-muted">&nbsp;(10
                                    digit number)</small>
                                <input type="tel" id="phone" name="phone" class="form-control"
                                    placeholder="Eg- 8479126506" pattern="[0-9]{10}" value="<?php echo $phone; ?>"
                                    required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="picture1">Poster 1</label>
                                <input type="file" name="picture1" class="form-control-file" id="picture1"  required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="picture2">Poster 2</label>
                                <input type="file" name="picture2" class="form-control-file" id="picture2"  required>
                                <small class="form-text text-danger">&nbsp;<?php $error_poster; ?></small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group  col-sm-12 ">
                                <h5 class="form-text text-success text-center"><?php echo $success; ?></h5>
                                <button type="submit" name="add_mess" class="btn btn-info btn-block">
                                    <h4>Add Mess</h4>
                                </button>
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