<?php

    if(!isset($_REQUEST['name']))
    {
        redirect('invalidurl.php');
    }
    require("header.php");
    require('database.php');

    $messname = mysqli_real_escape_string($con,$_REQUEST['name']);

    $query = "select * from mess_details where name='$messname'";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result)==0)
        redirect('invalidurl.php');
    else {
        $data = mysqli_fetch_assoc($result);
        $query = "select * from mess_admin where mess_name='$messname'";
        $result = mysqli_query($con,$query);
        $res = mysqli_fetch_assoc($result);
        // echo $res['city'];
        // prx($res);
    }

    if(isset($_SESSION['IS_LOGIN'])){

        $user = $_SESSION['USERNAME'];
        $email = $_SESSION['EMAIL'] ;
        $already_mark = false;

        $query = "select mess_name from favourite where email='$email' and user='$user'";
        // echo $query;
        $fav = mysqli_query($con,$query);
        $messes = array();
        while($row = mysqli_fetch_assoc($fav))
        {
            array_push($messes,$row['mess_name']);  
        }
        
        if(in_array($messname,$messes))
        {
            $already_mark = true;
        }
        else if(isset($_POST['mark']))
        {
            // $messname = mysqli_real_escape_string($con,$_REQUEST['mess_name']);
            if(!isset($_SESSION['USERNAME']))
                redirect('login.php');
            $query = "insert into favourite values('$user','$email','$messname')";
            // echo $query;
            $fav = mysqli_query($con,$query);
            $already_mark = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['name']; ?> | online mess</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <style>
    * {
        margin: 0;
        padding: 0;
    }
    body{
        background: url("../img/detailsviewbg.jpg") center !important;
        /* background: url("../img/detailsviewbg2.jpg") center !important; */
        background-attachment: fixed !important;
        background-size: cover !important;
        background-repeat: no-repeat !important;
    }
    .main {
        min-height: 100vh;
        padding-top: 40px;
        background-attachment: fixed;
        background-size: cover;
        position: relative;
        padding: 8rem 0;
        /* background: url("../img/footer_bottom_img.png") no-repeat rgba(48, 57, 82, .8) bottom center; */
        mix-blend-mode: multiply;
        background-size: contain;
    }

    .myshadow {
        box-shadow: 3px 3px 5px lightgray;
    }

    .mt {
        margin: 20px 0;
    }

    .bg {
        background-color: rgba(248, 246, 246, 0.8) !important;
        /* background-color: red !important; */
    }

    .contain {
        display: flex !important;
        justify-content: space-evenly !important;
        align-items: center;
    }

    .contain div img {
        width: 400px;
        height: 400px;
        background-size: cover;
        border-radius: 10px;
    }

    .fix {
        background-size: cover;
    }
    .panel-body{
        /* background:rgba(130, 191, 13,0.5) !important; */
    }
    @media (max-width:950px) {
        .contain {
            display: flex !important;
            justify-content: space-evenly !important;
            align-items: center;
            flex-direction: column !important;
        }
    }
    </style>
</head>

<body>

    <section class="main">
        <div class="container text-capitalize">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-danger mt text-center myshadow">
                        <div class="p-2 panel-heading">
                            <h1><?php echo $data['name']; ?></h1>
                        </div>
                    </div>
                </div>
                <div class="panel-body contain">
                    <div class="col-sm-6" style="overflow: hidden;">
                        <img src="<?php echo $res['poster1']; ?>" class="rounded  mx-auto d-block"
                            alt="image not found">
                    </div>
                    <div class="col-sm-6" style="overflow: hidden;">
                        <img src="<?php echo $res['poster2']; ?>" class="figure-img  img-fluid rounded"
                            alt="image not found">
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-sm-6">
                            <img src="./img/gallery1.jpg" class="rounded mx-auto d-block" alt="image not found">
                        </div>
                        <div class="col-sm-6">
                            <img src="./img/gallery2.jpg" class="figure-img img-fluid rounded" alt="image not found">
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="panel panel-success myshadow mt">
                    <div class="panel-heading text-center">
                        <h2>Today's Menu</h2>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-4">
                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="#">
                                        <img class="media-object" src="../img/menues.png" alt="img">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Menu 01.</h4>
                                    <h3><?php if($data['menu1']=="" || $data['menu1']=="None") echo"-";  else echo $data['menu1'];?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="#">
                                        <img class="media-object" src="../img/menues.png" alt="img">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Menu 02.</h4>
                                    <h3><?php if($data['menu2']=="" || $data['menu2']=="None") echo"-";  else echo $data['menu2'];?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="#">
                                        <img class="media-object" src="../img/menues.png" alt="img">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Menu 03.</h4>
                                    <h3><?php if($data['menu3']=="" || $data['menu3']=="None") echo"-";  else echo $data['menu3'];?></h3>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <hr>
                        <hr>
                        <div class="col-sm-5">
                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="#">
                                        <img class="media-object" src="../img/indian.png" alt="img">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Base Price</h4>
                                    <h3><s><?php echo $data['base_price']; ?></s></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="#">
                                        <img class="media-object" src="../img/indian (1).png" alt="img">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Discount Price</h4>
                                    <h3><?php echo $data['discount_price']; ?></h3>
                                </div>
                            </div>
                        </div>
                        <!-- //prices -->

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="panel panel-success myshadow mt">
                    <div class="panel-body text-left">
                        <!-- open time  -->
                        <div class="col-sm-6 ">
                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="#">
                                        <img class="media-object" src="../img/open.png" alt="img">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <?php
                                    $date = strtotime($data['mess_open_time']);
                                ?>
                                    <h4 class="media-heading">Open At&nbsp;<?php echo date("d M'Y",$date); ?></h4>
                                    on&nbsp;<h4><?php echo date('H:i',$date); ?></h4>
                                </div>
                            </div>
                        </div>
                        <!-- //close time -->
                        <div class="col-sm-6">
                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="#">
                                        <img class="media-object" src="../img/closeat.png" alt="img">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <?php
                                    $date = strtotime($data['mess_close_time']);
                                ?>
                                    <h4 class="media-heading">close at&nbsp;<?php echo date("d M'Y",$date); ?></h4>
                                    &nbsp;<h4><?php echo date('H:i',$date); ?></h4>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <hr>
                        <hr>
                        <hr>
                        <!-- city -->
                        <div class="col-sm-6">
                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="#">
                                        <img class="media-object" src="../img/city.png" alt="img">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">City</h4>
                                    <h4><?php echo $res['city']; ?></h4>
                                </div>
                            </div>
                        </div>
                        <!-- address  -->
                        <div class="col-sm-5 offset-sm-2">
                            <div class="media">
                                <div class="media-left media-middle">
                                    <a href="#">
                                        <img class="media-object" src="../img/placeholder.png" alt="img">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Address</h4>
                                    <h5><?php echo $res['address']; ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- payment  -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-warning text-center myshadow mt">
                        <div class="panel-heading">
                            <h4>Payment will be done at mess</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- bookmark  -->
            <?php if(isset($_SESSION['IS_LOGIN'])): ?>
                <?php if($already_mark==false): ?>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                    
                            <form method="post">
                                <input type="text" value="<?php $messname;?>" style="display:none;" name="mess_name">
                                <button type="submit" class="btn btn-info btn-lg mb-2" name="mark"><h4>Mark as Favourite</h4></botton>
                            </form>

                        </div>
                    </div>
                <?php  else: ?>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <!-- <img src="https://media.giphy.com/media/73dPyPAzGShcTWSYYY/giphy.gif" height="250px" alt="Favourite"/> -->
                            <!-- <img src="https://media.giphy.com/media/SXIoZ0wA8ajIHwXRpN/giphy.gif" height="250px" alt="Favourite"/> -->
                            <img src="https://media.giphy.com/media/9IZR9lsoIoCctttIHv/giphy.gif" height="250px" alt="Favourite"/>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
    <script src="../bootstrap/bootstrap.min.js"></script>
</body>

</html>