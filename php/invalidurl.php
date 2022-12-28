<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <title>Error</title>
    <style>
        .my-btn{
            box-shadow:4px 2px 10px lightgrey,-4px -2px 10px lightgrey;
            outline:none;
            background:#3742fa;
            color:white;
            border-radius:20px;
            margin:20px;
        }
        .my-btn:hover{
            background:rgba(55, 66, 250,0.899);
        }
        *{
            letter-spacing:1.4px !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="../img/404-error.jpg" class="img-fluid" alt="404 error">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center text-capitalize">
                <h2>404 - PAGE NOT FOUND</h2>
                <h4>
                the page you are looking that might have been removed <br> had it's name changed or is unavailable for you.</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <a href="../php/home.php" class="btn btn-lg  my-btn">GO TO HOMEPAGE</a>
            </div>
        </div>
    </div>
    <script src="../bootstrap/bootstrap.min.js"></script>
</body>
</html>
<?php 
    die();
?>