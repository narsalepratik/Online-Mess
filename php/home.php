<?php
    if(isset($_REQUEST['get_invitation']))
    {
        require('database.php');
        $email = mysqli_real_escape_string($con,$_REQUEST['invitation_email']);
        $query = "insert into invitations values('$email',0)";
        $res = mysqli_query($con,$query);
        if(isset($res))
        {
            ?>
            <script>
            window.alert("Invitation request sended successfully;");
            </script>
            <?php
        }
            
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>online mess</title>
    <link rel="stylesheet" href="../css/homecss.css">
    <script src="https://use.fontawesome.com/c94c407848.js"></script>
    <!-- <link rel="stylesheet" href="hoverbtn.css"> -->
    <!-- <link rel="stylesheet" href="../bootstrap/bootstrap.min.css"> -->
    <style>
        .heading{
            color:#ffa801;
        }
        section.what
        {
            width: 92%;
            min-height: 35vh;
            background-color: #fd9d3e;
            position: relative;
            margin: 20px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 15vh;
            flex-direction: column-reverse;
        }
        .what::before{
            content: "";
            width: 100%;
            height: 20vh;
            background: url("../img/order-top.png") no-repeat white bottom center;
            position: absolute;
            top: -1px;
            border: none;
            background-size: cover;
        }
        .what::after{
            content: "";
            width: 100%;
            height: 20vh;
            background: url("../img/order-bottom.png") no-repeat white bottom center;
            position: absolute;
            background-size: cover;
            bottom: -1px;
            border: none;
        }
        .what .card{
            display: flex;
            justify-content: center;
            align-items: center;
            width: auto;
            height: 420px;
            color: black;
        }
        .what .card .content{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .card h2{
            letter-spacing: 2px;
            margin-bottom: 20px;
        }
        .card p{
            text-indent: 55px;
            line-height: 30px;
            padding: 4px 8px;
            font-size: 1.5rem;
        }
        .card p::first-letter{
            font-size: 2.6em;
        }

        /* contact form */
        .form-inline {  
            display: flex;
            flex-flow: row wrap;
            align-items: center;
            }

            

            .form-inline input {
            vertical-align: middle;
            margin: 5px 10px 5px 15px;
            background-color: #fff;
            border: 1px solid black;
            height: 55px;
            padding: 5px 15px 5px 30px;
            font-size: 1.5rem;
            outline:none;
            width:45vw;
            border-radius:40px;
            }

            .form-inline button {
            background-color: #121619;
            border: 1px solid #121619;
            color: white;
            cursor: pointer;
            position : relative;
            /* right: 8px; */
            right: 255px;
            padding: 10px 25px;
            font-size: 1.5rem;
            outline:none;
            width:calc(70px + 10rem);
            border-radius:40px;
            margin:7px;
            color:#fd9d3e;
            }

            .form-inline button:hover {
            background-color: #121723;
        
            }

            @media (max-width: 800px) {
            .form-inline input {
                margin: 10px 0;
            }
            
            .form-inline {
                flex-direction: column;
                align-items: stretch;
            }
            }
    </style>
</head>

<body style="height: 1000px;">
    <header>
        <img src="../img/back.jpg" alt="" class="banner">
        <!-- <img src="../img/head-bg.jpg" alt="" class="banner"> -->
        <a href="./home.php" class="logo"><span class="heading">O</span>nline <span class="heading">M</span>ess</a>
        <!-- for mobile devices -->
        <div class="toggle"></div>
        <nav>
            <ul class="list">
                <li><a href="./home.php">Home</a></li>
                <li><a href="./exploremess.php">Explore</a></li>
                <li><a href="../php/learnmore.php">Learn More</a></li>
                <li><a href="../php/my_fav.php">My favourite Messes</a></li>
                <?php 
                    // if (session_status() === PHP_SESSION_NONE) {
                    //     @ob_start();
                    //     session_start();
                    // }
                    $user = "<i class='fa fa-user' aria-hidden='true'></i>&nbsp;";
                    if(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['ADMIN'])) echo "<li><a href='../php/dashboard.php' type='button'>&nbsp;".$user.$_SESSION['USERNAME'] ."</a></li>";
                    else if(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['MESS_ADMIN'])) echo "<li><a href='../php/updatemenu.php' type='button'>&nbsp;".$user.$_SESSION['USERNAME'] ."</a></li>";
                    else if(isset($_SESSION['IS_LOGIN']) ) echo "<li><a href='../php/logout.php' type='button'>&nbsp;".$user.$_SESSION['USERNAME'] ."</a></li>";
                    else echo "<li><a href='../php/login.php'>login </a></li>";
                ?>
                    
            </ul>
        </nav>

    </header>
    <!-- what is an onlinr mess  -->
    <!-- <section id="about">
        <h2>What is Online Mess</h2>
        <p>
            In cities, people who are dependent on messes for their daily meals generally struggle to find a place where
            they can get hygienic food. Even if one finds such mess which provide quality of food, they will have to pay
            for a month's charges to get it at an affordable price.           
        </p>
        <p>
            Our initiative is to help such people find messes which provide hygienic food at the least possible price.
        </p>

        
    </section> -->

    <section class="what">
        <div class="card">
            <div class="content">
            <h2>What is Online Mess</h2>
            <p>
                In cities, people who are dependent on messes for their daily meals generally struggle to find a place where
                they can get hygienic food. Even if one finds such mess which provide quality of food, they will have to pay
                for a month's charges to get it at an affordable price.           
            </p>
            <p>
                Our initiative is to help such people find messes which provide hygienic food at the least possible price.
            </p>
            </div>
        </div>
    </section>

    <!-- food gallery section  -->
    <?php require("foodgallery.php"); ?>

    <!-- discover the feature -->
    <section class="why">
        <div class="discover">
            <h1>Discover Features!!</h1>
        </div>
        <div id="features">
            <div class="row">
                <div class="col">
                    <div class="info-box">
                        <div><img src="../img/share (2).png" alt=""></div>
                        <p><h2>Save Time</h2></p>
                    </div>
                </div>
                <div class="col">
                    <div class="info-box">
                    <div><img src="../img/click.png" alt=""></div>
                    <p><h2> Easy To use </h2></p>
                    </div>
                </div>
                <div class="col">
                    <div class="info-box">
                    <div><img src="../img/healthy.png" alt=""></div>
                    <p><h2>Healthy Meals</h2></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br><br>
    
    <!-- contact form  -->
    <section class="what">
        <div class="card">
            <div class="content">
            <h2>Want to Register Your Mess??</h2>
            <p>
                We have taken care of messes!! We have created  an interface for Mess Administrator where he can update mess details on daliy basis.before that you need to send your 'Business mail' for getting  invitation as well as oue terms & conditions...
            </p>
            
            <form class="form-inline" action="">
                <input type="email" id="email" placeholder="Enter email..." name="invitation_email" required>
                <button type="submit" name="get_invitation">Get invitation</button>
            </form>
            </div>
        </div>
    </section>
    <script>
        window.addEventListener("scroll", function () {
            const header = document.querySelector("header");
            // if(window.scrollY==0)
            // {
            //     document.querySelector("header div").setAttribute("style","visibility:hidden;")
            // }else
            // {
            //     document.querySelector("header nav").setAttribute("style","visibility:visible;")
            // }
            header.classList.toggle("sticty", window.scrollY > 0);
        });

        const togglemenu = document.querySelector(".toggle");
        togglemenu.addEventListener("click", function () {
            togglemenu.classList.toggle("active");
            document.querySelector("header nav").classList.toggle("active");
        })
    </script>
    <!-- <script src="../bootstrap/bootstrap.min.js"></script> -->
</body>

</html>