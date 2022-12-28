<style>
    *{
    padding: 0;
    margin: 0;
    font-family: Georgia, 'Times New Roman', Times, serif;
}

/* image box css  */
#messes{
    margin: 20px 10px 5px 250px;
}
.bg-color{
    transition: 3s ease !important;
    background:linear-gradient(150deg,lightpink,lightblue,#9c88ff) !important;
}
.bg-color:hover{
    background:linear-gradient(150deg,lightpink,lightblue,#9c88ff,lightpink) !important;
    
}
.bx-shadow{
    box-shadow: 2px 4px 5px #dcdde1;
    transition: 1s;
}
.bx-shadow:hover{
    box-shadow: 3px 5px 6px #dcdde1,-1px -2px 4px #dcdde1;
}
.imgBox{
    width: 300px ;
    height: 300px ;
    background: #000;
    transform-style: preserve-3d;
    perspective: 1000px;
    margin-left: 15px;
    box-shadow: 2px 2px 5px #dcdde1,-2px -2px 5px #dcdde1;
}
.imgBox input[type="checkbox"]
{
    position: relative;
    width: 100% ;
    height: 100%;
    outline: none;
    appearance:none;
    cursor: pointer;
}
.imgBox span{
    position: absolute;
    top: 0;
    height: 100%;
    width: 50%;
    pointer-events: none;
    transform-style: preserve-3d;
}
<?php 
    //  include('database.php');
     if(!(isset($con)))
        $con = mysqli_connect("localhost","root","191070061","online_mess");
        
     $query = "SELECT * FROM mess_admin a INNER JOIN mess_details d WHERE a.mess_name=d.name";
     $result = mysqli_query($con,$query);
     $i = mysqli_num_rows($result);
     $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
     
?>
    <?php foreach($data as $key=>$value): ?>
        .imgBox span.<?php echo "bg1-".$value['mess_name']; ?>{
            left: 0;
            background: url("<?php echo $value['poster1']; ?>");
            background-size: cover;
        }
        .imgBox span.<?php echo "bg1-".$value['mess_name']; ?>::before{
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: url("<?php echo $value['poster2']; ?>");
            background-size: cover;
            transform-origin: right;
            transition: 2s;
            backface-visibility: hidden;
        }
        .imgBox input[type="checkbox"]:checked ~ span.<?php echo "bg1-".$value['mess_name']; ?>::before
        {
            transform: rotateY(180deg);
        }
        .imgBox span.<?php echo "bg2-".$value['mess_name']; ?>{
            right: 0;
            background: url("<?php echo $value['poster2']; ?>");
            background-size: cover;
            background-position-x: 50%;
        }
        .imgBox span.<?php echo "bg2-".$value['mess_name']; ?>::before{
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: url("<?php echo $value['poster1']; ?>");
            background-size: cover;
            transform-origin: left;
            transition: 2s;
            backface-visibility: hidden;
            background-position-x: 95%;
            transform: rotateY(180deg);
        }
        .imgBox input[type="checkbox"]:checked ~ span.<?php echo "bg2-".$value['mess_name']; ?>::before
        {
            transform: rotateX(360deg);
        }
    <?php endforeach; ?>


/* meess name section  */
.bg-color{
    background: transparent;
}
.font-size{
    text-transform: capitalize;
    font-size: x-large;
}
.my-center{
    align-items: center;
    text-align: center;
}

/* //price box  */
table .price{
    background-color: #F97F51;
    padding: 2px 8px;
    text-align: center;
    clip-path: polygon(20% 0%, 80% 0%, 100% 20%, 100% 80%, 80% 100%, 20% 100%, 0% 80%, 0% 20%);
}
/* view button  */
.viewbutton .button {
    border-radius: 4px;
    background-color: #ED4C67;
    border: none;
    color: #FFFFFF;
    text-align: center;
    font-size: 24px;
    padding: 8px 12px;
    width: 170px;
    transition: all 0.5s;
    cursor: pointer;
    margin: 5px;
    box-shadow: 0 2 5px lightgray,2px 14px 5px grey !important;
  }
  
  .viewbutton .button span {
    cursor: pointer;
    display: inline-block;
    position: relative;
    transition: 0.5s;
  }
  
  .viewbutton .button span:after {
    content: '\00bb';
    position: absolute;
    opacity: 0;
    top: 0;
    right: -20px;
    transition: 0.5s;
  }
  .viewbutton .button span a{
      text-decoration: none;
      color: white;
      text-transform: capitalize;
  }
  .viewbutton .button:hover span {
    padding-right: 25px;
  }
  
  .viewbutton  .button:hover span:after {
    opacity: 1;
    right: 0;
  }

  @media(max-width:767px)
  {
    .imgBox input[type="checkbox"]{
        margin-right: 15px !important;
    }
    .table-bg {
        /* backdrop-filter: drop-shadow(12px 4px 6px black) !important; */
        transform: translate3d(-3px,13px,19px) !important;
        width: 77%;
        margin-left: 10%;
    }
    .imgBox{
        transform: translateX(10vw);
        justify-content: center;
    }
  }
  @media(max-width:470px)
  {
    .table-bg{
        justify-content: center;
        width: 90%;
        transform: translate(-10px,10px) !important;
        box-shadow: 10px 12px 4px linear-gradient(150deg,lightpink,lightblue,#9c88ff) ;
    }
    .imgBox{
        transform: translateX(-9%);
        justify-content: center;
    }
  }
</style>