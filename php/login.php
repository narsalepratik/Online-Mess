<?php
    require("header.php");
    require('database.php');
    
    $error_msg = "";
    $username="";
    $email="";


    $query = "select * from locations";
    $result = mysqli_query($con,$query);
    $locations = mysqli_fetch_all($result,MYSQLI_ASSOC);
    // prx($locations);
    if(isset($_POST['signin']))
    {
        $username = mysqli_real_escape_string( $con,$_POST['username'] );
        $pass = mysqli_real_escape_string($con, $_POST['password'] );
        $role = mysqli_real_escape_string($con, $_POST['role'] );
        $query = "select * from admin where username='$username' and password='$pass' and role='$role'";
        // echo $query;
        $result = mysqli_query($con,$query);
        $data = mysqli_fetch_assoc($result);
        if( mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['IS_LOGIN'] = "YES";
            $_SESSION['USERNAME'] = $username;
            $_SESSION['EMAIL'] = $data['email'];
            if($role==1)
                {
                    $_SESSION['ADMIN'] = "YES";
                    redirect('dashboard.php');
                }
            elseif($role==2)
                {
                    $_SESSION['MESS_ADMIN'] = "YES"; 
                    redirect('updatemenu.php');
                }
            
            redirect('exploremess.php');        
        }
        else
        {
            $error_msg = "Please enter valid login details...";
            // echo $error_msg;
        }
    }

    // for user registritaion 
    if(isset($_POST['signup']))
    {
        $username = mysqli_real_escape_string( $con,$_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email'] );
        $pass = mysqli_real_escape_string($con, $_POST['password'] );
        $role = mysqli_real_escape_string($con, $_POST['role'] );
        $city = mysqli_real_escape_string($con, $_POST['city'] );
        $query = "select * from admin where username='$username' and email='$email'";
        // echo $query;
        
        $result = mysqli_query($con,$query);
        if( mysqli_num_rows($result) > 0)
        {
            $username="";
            $email="";
            ?>
                <script type="text/javascript">
                    alert('<?php echo "user already exists...try again"; ?>');
                </script>
            <?php
        }
        else
        {
            $query = "insert into admin(username,email,password,role,city) values('$username','$email','$pass',$role,'$city')";
            $result = mysqli_query($con,$query);
            redirect('login.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1L, initial-scale=1.0">
    <title>Login | Online mess</title>
    <link rel="stylesheet" href="../css/form.css">
    <style>
    .ll {
        margin-left: 25px;
    }

    .bg-red {
        background-color: red;
    }

    .bg-green {
        background-color: lightgreen;
    }

    section .container .user h2 {
        color: antiquewhite;
    }

    .custom-select {
        width:200px;
        margin:0 0 10px 5px;
    }
    .custom-select select{
        background: linear-gradient(transparent,rgba(189, 181, 168, 0.9));
        padding:5px 10px;
        outline:none;
        font-size:1.2em;
        color:crimson;
    }
    .custom-select select option{
        background: linear-gradient(transparent,rgba(189, 181, 168, 0.9));
        padding:5px 10px;
    }
    .container form h2{
        color:antiquewhite;
    }
    .container .containt{
        color:antiquewhite !important;
    }
    .signup{
        color:antiquewhite;
    }
    </style>
</head>

<body>
    <section>
        <div class="container">
            <div class="user Sign-in-Box">
                <div class="imgBox"><img src="../img/keyimg.jpg" alt="Key image "></div>
                <div class="form-Box">
                    <form action="" method="post">
                        <h2>Sign In</h2>
                        <div class="inner">
                            <input type="text" id="text" name="username" value="<?php echo $username; ?>" autocomplete="off" onkeyup="changecolor(this);"
                                required>
                            <span class="containt">UserName</span>
                        </div>
                        <div class="inner">
                            <input type="password" name="password" autocomplete="off" onkeyup="changecolor(this);"
                                required>
                            <span class="containt">Password</span>
                        </div>
                        <div class="custom-select" style="width:400px;"> 
                            <select name="role" require>
                                <option value="3">User</option>
                                <option value="2">Mess Admin</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <div class="input-submit">
                            <input class="btn1" type="submit" name="signin" value="submit">
                        </div>
                        <p style="color:red;"> <?php echo $error_msg;?></p>
                        <p class="signup">Don't have an account? <a href="#" onclick="Toggle();">Sign Up.</a></p>
                    </form>
                </div>
            </div>

            <div class="user Sign-up-Box" id="register">
                <!-- <div class="imgBox"><img src="../img/keyimg1.jpg" alt="Key image "></div> -->
                <div class="form-Box">
                    <form action="" method="post">
                        <h2 style="margin-top: 10px; color:antiquewhite;">Create An Account as user</h2>
                        <div class="inner ll">
                            <input type="text" id="text" name="username" autocomplete="off" value="<?php echo $username; ?>" onkeyup="changecolor(this);"
                                required>
                            <span class="containt">Name</span>
                        </div>
                        <div class="inner ll">
                            <input type="email" name="email" autocomplete="off" value="<?php echo $email; ?>" onsubmit="emailchecker(this);"
                                onkeyup="changecolor(this);" required>
                            <span class="containt">Email</span>
                        </div>
                        <div class="inner ll">
                            <input type="password" name="password" autocomplete="off" onkeyup="changecolor(this);"
                                required>
                            <span class="containt">Password</span>
                        </div>
                        <div class="custom-select" style="width:400px;margin-left:25px;"> 
                            <select name="city" require>
                                <option value="-1" selected disabled>select your city</option>
                                <?php foreach($locations as $loc): ?>
                                    <option value="<?php echo $loc['city']; ?>"> <?php echo $loc['city']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="custom-select" style="width:400px;display:none;margin-left:20px;"> 
                            <select name="role" require>
                                <option value="3">User</option>
                            </select>
                        </div>
                        <div class="input-submit ll " style="cursor:pointer;">
                            <input class="btn1" type="submit" value="Register" name="signup" style="width: 79%;">
                        </div>
                        <p style="color:red; margin-left:20px;"> <?php echo $error_msg;?></p>
                        <p class="signup ll">Already have an account? <a href="#" onclick="Toggle();">Sign In.</a></p>
                    </form>
                </div>
                <div class="imgBox"><img src="../img/keyimg1.jpg" alt="Key image "></div>
            </div>
        </div>
    </section>

    <script>
    function Toggle() {
        const section = document.querySelector("section");
        let container = document.querySelector(".container");
        container.classList.toggle("active");
        section.classList.toggle("active");
    }

    function changecolor(e) {
        if (e.value.length > 0)
            e.classList.add("bg-green");
        else
            e.classList.remove("bg-green");
    }

    function emailchecker(obj) {
        if (obj.value.length > 0) {
            let value = obj.value
            value = value.toString();
            let doti = value.lastIndexOf(".");
            let $i = value.lastIndexOf("@");
            let light = document.querySelector(".light");
            if (doti - $i > 4 && value.length - doti == 4) {
                // do nothing
                obj.classList.remove("bg-red");
            } else {
                window.alert("Please entar the valid email...");
                obj.classList.add("bg-red");
            }
        }
    }
    </script>
</body>

</html>