<?php
    $colors = array("lightpink", "lightsalmon", "lightseagreen", "lightblue", "lightgreen", "lightgoldenrodyellow", "lightcyan", "lightcoral", "lightseagreen"," lightgray");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            padding: 0;
            margin: 0;
            
        }
        .name{
            text-align:center;
        }
        .name h1{
            font-size: 4rem;
            text-transform: capitalize;
            text-shadow: 2px 3px 5px <?php echo $colors[rand(0,9)]; ?>;
            position: relative;
            pointer-events: none;
        }
        .name h1::before{
            content: "";
            position: absolute;
            left: 45%;
            bottom: 0;
            width: 10%;
            height: 3px;
            background-color: <?php echo $colors[(rand(0,9)+1)%9]; ?>;
        }
        section.gallery
        {
            /* padding: 10px; */
            background-color: #eccc68;
            /* margin-top:1px; */
            /* background : url("../img/photossectionbg.svg") lightgoldenrodyellow !important;
            background-size : cover;
            background-position-y: top;
            background-blend-mode: multiply; */
            
        }
        
        .gallery .container{
            position: relative;
            display: flex;
            justify-content:space-evenly;
            align-items: center;
            flex-wrap: wrap;
            /* width: 100%; */
            padding: 3vw;
        }
        .gallery .container .card{
            position: relative;
            width: 320px;
            height: 320px;
            overflow: hidden;
            margin: 10px;
            border-radius: 5px;
            transition: 0.5s;
        }
        .gallery .container .card .imgbox,
        .gallery .container .card .content
        {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 11;
        }
        .gallery .container .card .imgbox img{
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            
        }
        section .container .card .content::before
        {
            content: "";
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0%;
            top: 0;
            transform: scaleX(0);
            /* background-color: tomato; */
            transition: transform 0.5s ease-in-out;
            transform-origin: right;
        }
        section .container .card:hover .content::before
        {
            transform: scaleX(1);
            /* background-color: tomato; */
            background:linear-gradient(<?php echo $colors[rand(0,9)]; ?>,transparent,<?php echo $colors[(rand(0,9)+4)%9]; ?>);
            transition: transform 0.5s ease-in-out;
            transform-origin: left;

        }
        section.gallery .container .card:hover
        {
            border-radius: 10px;
            box-shadow: 8px 10px 10px lightgrey;
        }
        section.gallery .container .card .content
        {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        section.gallery .container .card .content h2{
            letter-spacing: 1.2px;
            font-size: 3rem;
            text-transform: capitalize;
            transition:  0.5s ease-in-out;
            transform: translateX(-350px);
            transition-delay: 0s;
            color: #121619;
        }
        section.gallery .container .card:hover .content h2
        {
            transform: translateX(0px);
            transition-delay: 0.4s;
        }
        @media(max-width:950px)        {
            section.gallery{
                padding: 0;
                /* background-color: <?php echo $colors[(rand(0,9)+2)%9]; ?>; */
            }
        }


        /* gallery */
        section.gallery{
            width: 93.5%;
            min-height: 50vh;
            background-color: #121619;
            position: relative;
            overflow: hidden;
            border: none;
            color: white;
        }
        section.gallery span#bg{
            width: 100%;
            min-height: 20%;
            background: url("../img/customer-bottom-bg.png") transparent;
            transform:scale(-1,-1);
            background-position: bottom;
            background-repeat: no-repeat;
            position: absolute;
            left: -5px;
            top: -1px !important;
        }
            section.gallery::before{
                content: "";
                background-image: url("../img/chef-bg.png");
                background-position: bottom;
                background-repeat: no-repeat;
                background-size: cover;
                opacity: 0.2;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border: none;
            }
            section.gallery::a fter{
                content: "";
                background: url("../img/customer-bottom-bg.png") top;
                width: 100%;
                min-height: 10%;
                background-position: top;
                background-repeat: no-repeat;
                position: absolute;
                left: -0.4vw;
                bottom: -0px !important;
                border: none;
            }
            section.gallery span#bg-down{
            width: 100%;
            min-height: 20%;
            background: url("../img/customer-bottom-bg.png") transparent;
            background-position: top;
            background-repeat: no-repeat;
            position: absolute;
            left: -5px;
            bottom: -100px !important;
            border:none;
        }
            @media (max-width:1110px)
            {
                section.gallery::after{
                    bottom: -75px;
                }
                section.gallery span{
                    top: -75px;
                }
            }
    </style>
</head>
<body>
    
    <section class="gallery">
        <span id="bg"></span>
        <div class="name">
            <h1><span style="color: #fd9d3e;">F</span>ood <span style="color: #fd9d3e;">G</span>allery</h1>
            <br>
            <p style="color: #fd9d3e;text-transform: capitalize; font-size: x-large;letter-spacing: 2px;">Healthy food for healthy body</p>
        </div>
        <div class="container">
            <div class="card">
                <div class="imgbox"><img src="../img/gallery1.jpg" alt="img can't load"></div>
                <div class="content">
                    <h2>Indian <br>  thali</h2>
                </div>
            </div>

            <div class="card">
                <div class="imgbox"><img src="../img/gallery5.jpg" alt="img can't load"></div>
                <div class="content">
                    <h2>Bhaji-Roti</h2>
                </div>
            </div>

            <div class="card">
                <div class="imgbox"><img src="../img/gallery3.jpg" alt="img can't load"></div>
                <div class="content">
                    <h2>mashroom</h2>
                </div>
            </div>

            <div class="card">
                <div class="imgbox"><img src="../img/gallery4.jpg" alt="img can't load"></div>
                <div class="content">
                    <h2>sandwich</h2>
                </div>
            </div>

            <div class="card">
                <div class="imgbox"><img src="../img/gallery3.jpg" alt="img can't load"></div>
                <div class="content">
                    <h2>mashroom</h2>
                </div>
            </div>

            <div class="card">
                <div class="imgbox"><img src="../img/gallery8.jpg" alt="img can't load"></div>
                <div class="content">
                    <h2>Biryani</h2>
                </div>
            </div>

            <div class="card">
                <div class="imgbox"><img src="../img/gallery2.jpg" alt="img can't load"></div>
                <div class="content">
                    <h2>Full Indian thali</h2>
                </div>
            </div>
        </div>
        <span id="bg-down"></span>
    </section>
    
</body>
</html>