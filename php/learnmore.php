<?php
    require("header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn More | Online mess</title>
    <link rel="stylesheet" href="../css/learn more.css">
    <style>
    * {
        margin: 0;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: large;
        padding: 0;
    }

    .container {
        width: 100%;
        position: relative;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        background: cornsilk url("../img/learn_more_bg.jpg") !important;
        background-position: center;
        background-attachment: fixed !important;
        background-repeat: no-repeat;
        background-size: cover !important;
        min-height: 100vh;
        background-color: rgb(224, 222, 222);
        background-blend-mode: multiply;
    }

    .container h2 {
        font-size: 2em;
        color: rgb(245, 245, 245);
        letter-spacing: 1.6px;
        position: relative;
        margin: 3vw 1vw;
        background-color: tomato;
        clip-path: polygon(75% 0, 100% 49%, 75% 100%, 25% 100%, 0% 50%, 25% 0%);
        width: 350px;
        box-shadow: 10px 30px 45px grey;
        text-align: center;
        padding: 1vw;
    }

    .container h2:hover {
        animation: shake 0.5s;
        animation-iteration-count: infinite;
    }

    @keyframes shake {
        0% {
            transform: translate(1px, 1px) rotate(0deg);
        }

        10% {
            transform: translate(-1px, -2px) rotate(-1deg);
        }

        20% {
            transform: translate(-3px, 0px) rotate(1deg);
        }

        30% {
            transform: translate(3px, 2px) rotate(0deg);
        }

        40% {
            transform: translate(1px, -1px) rotate(1deg);
        }

        50% {
            transform: translate(-1px, 2px) rotate(-1deg);
        }

        60% {
            transform: translate(-3px, 1px) rotate(0deg);
        }

        70% {
            transform: translate(3px, 1px) rotate(-1deg);
        }

        80% {
            transform: translate(-1px, -1px) rotate(1deg);
        }

        90% {
            transform: translate(1px, 2px) rotate(0deg);
        }

        100% {
            transform: translate(1px, -2px) rotate(-1deg);
        }
    }

    @media(max-width:470px) {
        .container h2 {
            font-size: 1.6em;
            width: 320px;
        }
    }

    .container h2::bef ore {
        content: "";
        position: absolute;
        width: 300px;
        height: 30px;
        background-color: tomato;
        bottom: -5px;
        left: 27%;
        clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
    }

    .container .blog {
        margin: 2.5vw 5vw;
        display: flex;
        justify-content: center;
        flex-direction: column;
        flex-wrap: wrap;
        align-items: center;
        text-align: center;
    }

    .container .blog {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4));
        border-radius: 2em;
        padding: 3em;
    }

    .container .blog:nth-last-child(1) {
        color: khaki;
    }

    .container .blog h3 {
        letter-spacing: 1.5px;
        font-weight: 800;
        font-size: xx-large;
        padding: 15px 10px;
        text-transform: capitalize;
        position: relative;
        color: antiquewhite;
    }

    .container .blog h3::before {
        content: "";
        position: absolute;
        left: 0;

    }

    .container .blog p {
        text-indent: 15px;
        font-size: 22px;
        color: gold;
    }

    .container .blog p::selection {
        background-color: rgb(230, 177, 247);
    }
    </style>
</head>

<body>
    <section>
        <div class="container">
            <h2>Online Mess</h2>
            <div class="blog">
                <h3>An initiative by the students for the students</h3>
                <p>
                    Ever thought about breaking free from the nauseating atmosphere of your daily mess ? Ever found it
                    unfair when you have to pay for an entire month's meal at a time just to get few percents of
                    discount ? This is where our concept of Online Mess arises!
                    <br> Here we have listed a number of messes which cover a variety of cuisines and are verified on
                    the basis of the food quality, hygiene level and affordability especially from perspective of
                    students.
                </p>
            </div>
            <div class="blog">
                <h3>Pay for one item at a time</h3>
                <p>
                    Unlike traditional messes subscriptions, we are charging you only for the meal that you have chosen
                    and without any sort of weekly-monthly plan or restriction. So, you don't have to pay for a monthly
                    subscription to get it at a affordable price.
                </p>
            </div>
            <div class="blog">
                <h3>Henceforth, don't compromise for hygiene</h3>
                <p>
                    We guarantee the cleanliness and hygiene level of each of the environment in which your meal is
                    cooked. Each and every mess listed on this platform have been inspected and verified in terms of the
                    hygiene level at the cooking site.
                </p>
            </div>
            <div class="blog">
                <h3>Earn great discounts</h3>
                <p>We assure you that our item listing is always the same as the offline listings of the
                    restaurant/mess. We are also giving additional discounts. You can even verify this fact by visiting
                    particular mess itself.</p>
            </div>
            <div class="blog">
                <h3>Experience a variety of cuisines</h3>
                <p>We know that eating the same food or cuisine everyday is boring. So we've made sure that you will
                    always have something different to try out.</p>
            </div>
            <div class="blog">
                <h3>Register your mess</h3>
                <p>We also care for the messes! We have created an interface for mess owners to register their mess
                    using a 'Business' account. After that, the particular mess will be assigned a hygiene rating after
                    the inspection. This is how messes are listed on this platform.</p>
            </div>
            <div class="blog">
                <h3>Let's start your journey by exploring the messes in your city.</h3>
            </div>
        </div>
    </section>
</body>

</html>