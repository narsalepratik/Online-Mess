<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
    margin: 0%;
    padding: 0%;
    font-family: Georgia, 'Times New Roman', Times, serif;
    }
    header{
        position: relative;
        left: 0;
        top: 0;
        width: 100%;
        height: 90px;
        background-color: aqua;
        transition: 1s ease;
        background-image: url("../img/back.jpg");
        background-position: 100%;
        background-color: rgba(0, 0, 0, 0.1);
        z-index :11;
    }
    header .logo{
        position: absolute;
        top: 50%;
        left: 15%;
        min-width: 150px;
        transform: translate(-50%,-50%);
        font-size: 3vw;
        color: blanchedalmond;
        text-decoration: none;
        text-transform: uppercase;
        font-weight: bolder;
        text-align: center;
        transition: 1s;
        z-index: 1;
    }
    header nav{
        position: absolute;
        height: 100%;
        top: 0;
        right: 7vw;
        display: flex;
        z-index: 1;
        /* box-shadow: 0.6px 1px 10px grey; */
    }
    header nav .list{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    header.sticty nav .list{
        transform: translateX(0);
        opacity: 1;
        transition-delay:0.5s;
    }
    header nav .list{
        list-style: none;
    }
    header nav .list li a{
        text-transform: capitalize;
        text-decoration: none;
        display: inline-block;
        padding: 10px 15px;
        font-size: 1.3em;
        color: whitesmoke;
        text-decoration:none;
    }
    header nav .list li a:hover{
        color: blueviolet;
        background-color: rgba(245, 211, 168,0.8);
        border-radius: 10px 0 10px 0;
    }
    
    @media(max-width:950px)
    {
        header .logo{
            position: absolute;
            top: 50%;
            left: 15%;
            min-width: 150px;
            transform: translate(0,-50%);
            font-size: 1.5rem;
        }
        header nav .list{
            display: none;
            visibility: hidden;
        }
        header div.toggle{
            position:fixed;
            top: 20px;
            right: 3vw;
            width: 50px;
            height: 50px;
            cursor: pointer;
            background: white  url("../img/menu.png");
            background-size: 30px;
            background-repeat: no-repeat;
            background-position: center;
            box-shadow:0px 0px 1px 1px rgb(248, 248, 248);
        }
        header div.toggle.active{
            background: white  url("../img/close.png");
            background-size: 30px;
            background-repeat: no-repeat;
            background-position: center;
        }
        header nav.active ul.list
    {
        position: fixed;
        top: 85px;
        left: 0;
        width: 100%;
        padding-bottom: 25px;
        padding-top: 0px;
        padding-left: 20vw;
        height: 100vh;
        background-color: black;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items:flex-start;
        visibility: visible;
        text-align: center;
    }
    header nav.active ul.list li
    {
        padding:15px 0 0 15px;
    }
    header nav.active ul.list li a{
        transition: 0.25s ease;
    }
    header nav.active ul.list li a:hover{
        background-color: rgb(65, 64, 64);
        color: red;
        transform: translate(10px,2px);
    }
    header nav.active ul.list a{
        font-size: 1.5em;
    }
    }
    a{
    text-decoration:none !important;
    }
    </style>
</head>
<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<body>
    <header>
        <a href="../php/home.php" class="logo">Online Mess</a>
        <!-- for mobile devices -->
        <div class="toggle"></div>
        <nav>
            <ul class="list">
                <li><a href="../php/home.php">Home</a></li>
                <li><a href="exploremess.php">Explore</a></li>
                <li><a href="../php/learnmore.php">Learn More</a></li>
                <li><a href="../php/my_fav.php">My favourite Messes</a></li>
                <?php 
                    $user = "<i class='fa fa-user' aria-hidden='true'></i>&nbsp;";
                    if(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['ADMIN'])) echo "<li><a href='../php/dashboard.php' type='button'>&nbsp;".$user.$_SESSION['USERNAME'] ."</a></li>";
                    else if(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['MESS_ADMIN'])) echo "<li><a href='../php/updatemenu.php' type='button'>&nbsp;".$user.$_SESSION['USERNAME'] ."</a></li>";
                    else if(isset($_SESSION['IS_LOGIN']) ) echo "<li><a href='../php/logout.php' type='button'>&nbsp;".$user.$_SESSION['USERNAME'] ."</a></li>";
                    else echo "<li><a href='../php/login.php'>login </a></li>";
                ?>
            </ul>
        </nav>

    </header>
    <script>
        const togglemenu = document.querySelector(".toggle");
        togglemenu.addEventListener("click", function () {
            togglemenu.classList.toggle("active");
            document.querySelector("header nav").classList.toggle("active");
        })
        window.onscroll = function() {scrollFunction()};

        // function scrollFunction() {
        // if (document.body.scrollTop > 5 || document.documentElement.scrollTop > 5) {
        //     document.querySelector("header").height = "80px";
        //     document.querySelector("header .logo").fontSize = "2.5vw";
        // } else {
        //     document.querySelector("header").height = "90px";
        //     document.querySelector("header .logo").fontSize = "3vw";
        //     }
        // }
    </script>
</body>
</html>